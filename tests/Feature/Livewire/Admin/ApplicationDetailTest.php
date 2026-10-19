<?php

namespace Tests\Feature\Livewire\Admin;

use App\Livewire\Admin\ApplicationDetail;
use App\Models\Application;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

class ApplicationDetailTest extends TestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        Notification::fake();
    }

    private function makeApplication(string $state = 'submitted'): Application
    {
        $intern = User::factory()->intern()->create();
        $this->createFullInternProfile($intern);

        return Application::factory()->{$state}()->create(['intern_id' => $intern->id]);
    }

    public function test_render_includes_current_status_option(): void
    {
        $application = $this->makeApplication('submitted');
        $this->loginAsAdmin();

        Livewire::test(ApplicationDetail::class, ['id' => $application->id])
            ->assertSet('reviewStatus', 'submitted')
            ->assertSeeHtml('value="submitted"');
    }

    public function test_save_without_status_change_persists_admin_notes(): void
    {
        $application = $this->makeApplication('underReview');
        $this->loginAsAdmin();

        Livewire::test(ApplicationDetail::class, ['id' => $application->id])
            ->set('adminNotes', 'Catatan untuk review lanjutan.')
            ->call('updateStatus')
            ->assertHasNoErrors()
            ->assertDispatched('toast', message: 'Perubahan berhasil disimpan.', type: 'success');

        $application->refresh();

        $this->assertSame('under_review', $application->status);
        $this->assertSame('Catatan untuk review lanjutan.', $application->admin_notes);
    }

    public function test_submitted_can_move_to_under_review(): void
    {
        $application = $this->makeApplication('submitted');
        $this->loginAsAdmin();

        Livewire::test(ApplicationDetail::class, ['id' => $application->id])
            ->set('reviewStatus', 'under_review')
            ->call('updateStatus')
            ->assertDispatched('toast', message: 'Status lamaran berhasil diperbarui.', type: 'success');

        $this->assertSame('under_review', $application->fresh()->status);
    }

    public function test_under_review_cannot_skip_to_accepted(): void
    {
        $application = $this->makeApplication('underReview');
        $this->loginAsAdmin();

        Livewire::test(ApplicationDetail::class, ['id' => $application->id])
            ->set('reviewStatus', 'accepted')
            ->call('updateStatus')
            ->assertDispatched('toast', message: 'Tidak bisa mengubah status dari under_review ke accepted.', type: 'error');

        $this->assertSame('under_review', $application->fresh()->status);
    }

    public function test_under_review_can_be_scheduled_for_interview(): void
    {
        $application = $this->makeApplication('underReview');
        $this->loginAsAdmin();

        Livewire::test(ApplicationDetail::class, ['id' => $application->id])
            ->set('reviewStatus', 'interview_scheduled')
            ->set('interviewDate', '2026-11-01T10:00')
            ->call('updateStatus')
            ->assertDispatched('toast', message: 'Status lamaran berhasil diperbarui.', type: 'success');

        $application->refresh();

        $this->assertSame('interview_scheduled', $application->status);
        $this->assertNotNull($application->interview_date);
    }

    public function test_interview_can_progress_to_accepted(): void
    {
        $application = $this->makeApplication('interviewScheduled');
        $this->loginAsAdmin();

        Livewire::test(ApplicationDetail::class, ['id' => $application->id])
            ->set('reviewStatus', 'accepted')
            ->call('updateStatus')
            ->assertDispatched('toast', message: 'Status lamaran berhasil diperbarui.', type: 'success');

        $this->assertSame('accepted', $application->fresh()->status);
    }

    public function test_invalid_status_shows_visible_validation_error(): void
    {
        $application = $this->makeApplication('submitted');
        $this->loginAsAdmin();

        Livewire::test(ApplicationDetail::class, ['id' => $application->id])
            ->set('reviewStatus', 'bogus_status')
            ->call('updateStatus')
            ->assertHasErrors(['reviewStatus'])
            ->assertDispatched('toast', type: 'error');

        $this->assertSame('submitted', $application->fresh()->status);
    }

    public function test_rejected_requires_reason_with_visible_error(): void
    {
        $application = $this->makeApplication('underReview');
        $this->loginAsAdmin();

        Livewire::test(ApplicationDetail::class, ['id' => $application->id])
            ->set('reviewStatus', 'rejected')
            ->set('rejectionReason', null)
            ->call('updateStatus')
            ->assertHasErrors(['rejectionReason'])
            ->assertDispatched('toast', type: 'error');

        $this->assertSame('under_review', $application->fresh()->status);
    }
}
