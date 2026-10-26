<?php

namespace App\Livewire\Intern;

use App\Models\Internship;
use App\Models\Logbook;
use App\Services\LogbookService;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;

#[Layout('layouts::app', ['title' => 'Logbook'])]
class LogbookList extends Component
{
    use WithPagination;

    public string $filterStatus = '';

    public bool $hasActiveInternship = false;

    private LogbookService $logbookService;

    public function boot(LogbookService $logbookService): void
    {
        $this->logbookService = $logbookService;
    }

    public function mount(): void
    {
        $this->hasActiveInternship = Internship::where('intern_id', auth()->id())
            ->where('status', 'active')->exists();
    }

    public function updatingFilterStatus(): void
    {
        $this->resetPage();
    }

    public function submit(string $id): void
    {
        try {
            $logbook = Logbook::where('intern_id', auth()->id())->findOrFail($id);
            $this->logbookService->submit($logbook, auth()->user());
            $this->dispatch('toast', message: 'Logbook berhasil dikirim ke supervisor.', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('toast', message: 'Gagal mengirim logbook: '.$e->getMessage(), type: 'error');
        }
    }

    public function delete(string $id): void
    {
        try {
            $logbook = Logbook::where('intern_id', auth()->id())->findOrFail($id);

            if ($logbook->validation_status !== 'draft') {
                throw new \Exception('Logbook yang sudah dikirim tidak bisa dihapus.');
            }

            $logbook->delete();
            $this->dispatch('toast', message: 'Logbook dihapus.', type: 'success');
        } catch (\Exception $e) {
            $this->dispatch('toast', message: 'Gagal menghapus logbook: '.$e->getMessage(), type: 'error');
        }
    }

    public function render()
    {
        $logbooks = Logbook::with('internship')
            ->where('intern_id', auth()->id())
            ->when($this->filterStatus, fn ($q) => $q->where('validation_status', $this->filterStatus))
            ->latest('activity_date')
            ->paginate(15);

        $attendanceSummary = $this->logbookService->attendanceSummaryForIntern(auth()->id());

        return view('livewire.intern.logbook-list', compact('logbooks', 'attendanceSummary'));
    }
}
