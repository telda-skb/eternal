<?php

namespace App\Livewire\Supervisor;

use App\Models\Internship;
use App\Models\Logbook;
use App\Models\User;
use App\Services\LogbookService;
use Illuminate\Support\Collection;
use Livewire\Component;
use Livewire\WithPagination;

class LogbookReview extends Component
{
    use WithPagination;

    public $filterStatus = '';

    public $search = '';

    public ?string $internId = null;

    public ?string $filteredInternName = null;

    public bool $showRevisionModal = false;

    public string $revisionNotes = '';

    public ?string $selectedLogbookId = null;

    public array $selectedLogbooks = [];

    public int $totalSubmitted = 0;

    private LogbookService $logbookService;

    public function boot(LogbookService $logbookService): void
    {
        $this->logbookService = $logbookService;
    }

    public function mount(): void
    {
        $this->internId = request()->query('intern_id');

        if ($this->internId) {
            $this->filteredInternName = User::find($this->internId)?->internProfile?->full_name;
        }

        $this->totalSubmitted = Logbook::whereHas('internship', fn ($q) => $q->where('supervisor_id', auth()->id()))
            ->when($this->internId, fn ($q) => $q->where('intern_id', $this->internId))
            ->where('validation_status', 'submitted')->count();
    }

    public function updatingFilterStatus(): void
    {
        $this->resetPage();
        $this->selectedLogbooks = [];
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
        $this->selectedLogbooks = [];
    }

    public function updatingInternId(): void
    {
        $this->resetPage();
        $this->selectedLogbooks = [];
    }

    public function clearInternFilter(): void
    {
        $this->internId = null;
        $this->filteredInternName = null;
        $this->resetPage();
        $this->selectedLogbooks = [];
    }

    public function toggleIntern(string $internId): void
    {
        if ($this->internId === $internId) {
            $this->clearInternFilter();

            return;
        }

        $internship = Internship::with('intern.internProfile')
            ->where('supervisor_id', auth()->id())
            ->where('intern_id', $internId)
            ->first();

        if (! $internship) {
            return;
        }

        $this->internId = $internId;
        $this->filteredInternName = $internship->intern?->internProfile?->full_name
            ?? $internship->intern?->email;
        $this->resetPage();
        $this->selectedLogbooks = [];
    }

    public function openRevision(string $id): void
    {
        $this->selectedLogbookId = $id;
        $this->revisionNotes = '';
        $this->showRevisionModal = true;
    }

    public function requestRevision(): void
    {
        $this->validate(['revisionNotes' => 'required|string|max:1000']);

        $logbook = Logbook::whereHas('internship', fn ($q) => $q->where('supervisor_id', auth()->id()))
            ->findOrFail($this->selectedLogbookId);
        $logbook->update([
            'validation_status' => 'revision_requested',
            'revision_notes' => $this->revisionNotes,
        ]);

        $this->showRevisionModal = false;
        $this->revisionNotes = '';
        $this->selectedLogbookId = null;
        $this->dispatch('toast', message: 'Revisi berhasil diminta.', type: 'success');
    }

    public function approve(string $id): void
    {
        Logbook::whereHas('internship', fn ($q) => $q->where('supervisor_id', auth()->id()))
            ->where('validation_status', 'submitted')
            ->where('id', $id)
            ->update(['validation_status' => 'approved']);
        $this->dispatch('toast', message: 'Logbook disetujui.', type: 'success');
    }

    public function bulkApprove(): void
    {
        $count = count($this->selectedLogbooks);

        Logbook::whereHas('internship', fn ($q) => $q->where('supervisor_id', auth()->id()))
            ->when($this->internId, fn ($q) => $q->where('intern_id', $this->internId))
            ->where('validation_status', 'submitted')
            ->whereIn('id', $this->selectedLogbooks)
            ->update(['validation_status' => 'approved']);
        $this->selectedLogbooks = [];
        $this->dispatch('toast', message: $count.' logbook disetujui.', type: 'success');
    }

    public function toggleSelectAll(): void
    {
        $ids = Logbook::whereHas('internship', fn ($q) => $q->where('supervisor_id', auth()->id()))
            ->when($this->internId, fn ($q) => $q->where('intern_id', $this->internId))
            ->where('validation_status', 'submitted')
            ->pluck('id')
            ->toArray();
        $this->selectedLogbooks = count($this->selectedLogbooks) === count($ids) ? [] : $ids;
    }

    public function render()
    {
        $logbooks = $this->logbookService->getSupervisorPaginatedList(
            auth()->id(),
            $this->filterStatus,
            $this->search,
            $this->internId
        );

        $mentoredInterns = $this->mentoredInterns();

        return view('livewire.supervisor.logbook-review', compact('logbooks', 'mentoredInterns'));
    }

    private function mentoredInterns(): Collection
    {
        $internships = Internship::with('intern.internProfile')
            ->where('supervisor_id', auth()->id())
            ->where('status', 'active')
            ->get()
            ->unique('intern_id')
            ->values();

        if ($internships->isEmpty()) {
            return new Collection;
        }

        $summaries = $this->logbookService->attendanceSummaryByIntern(auth()->id());

        return $internships
            ->map(fn (Internship $internship) => [
                'id' => (string) $internship->intern_id,
                'name' => $internship->intern?->internProfile?->full_name
                    ?? $internship->intern?->email
                    ?? 'Peserta',
                'photo' => $internship->intern?->internProfile?->photo_url,
                'attendance' => $summaries[$internship->intern_id]
                    ?? ['hadir' => 0, 'sakit' => 0, 'izin' => 0, 'total' => 0],
            ])
            ->sortBy('name')
            ->values();
    }
}
