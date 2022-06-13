<?php

use App\Http\Controllers\Backend\EquipmentItemController;
use App\Http\Controllers\Backend\EquipmentTypeController;
use App\Http\Controllers\Backend\JobRequestsController;
use Tabuna\Breadcrumbs\Trail;

Route::get('jobs', function () {
    return view('backend.jobs.index');
})->name('jobs.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'));
    });

// Student Routes ---------------------------------------------------------------------------------

// Index
Route::get('jobs/student/', [JobRequestsController::class, 'student_index'])
    ->name('jobs.student.index')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Requests'));
    });

// Create
Route::get('jobs/student/create', [JobRequestsController::class, 'student_create'])
    ->name('jobs.student.create')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Requests'), route('admin.jobs.student.index'))
            ->push(__('Create'));
    });

// Store
Route::post('jobs/student/', [JobRequestsController::class, 'student_store'])
    ->name('jobs.student.store');

// Show
Route::get('jobs/student/{jobRequests}/view/', [JobRequestsController::class, 'student_show'])
    ->name('jobs.student.show')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Requests'), route('admin.jobs.student.index'))
            ->push(__('Show'));
    });

// Confirm
Route::get('jobs/student/{jobRequests}/confirm/', [JobRequestsController::class, 'student_confirm'])
    ->name('jobs.student.confirm')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Requests'), route('admin.jobs.student.index'))
            ->push(__('Confirm'));
    });

// Summary
Route::get('jobs/student/{jobRequests}/summary/', [JobRequestsController::class, 'student_summary'])
    ->name('jobs.student.summary')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Requests'), route('admin.jobs.student.index'))
            ->push(__('Summary'));
    });

// Delete
Route::get('jobs/student/{jobRequests}/delete/', [JobRequestsController::class, 'student_delete'])
    ->name('jobs.student.delete')
    ->breadcrumbs(function (Trail $trail) {
        $trail->push(__('Home'), route('admin.dashboard'))
            ->push(__('Fabrications'), route('admin.jobs.index'))
            ->push(__('Requests'), route('admin.jobs.student.index'))
            ->push(__('Delete'));
    });

// Destroy
Route::delete('jobs/student/{jobRequests}/', [JobRequestsController::class, 'student_destroy'])
    ->name('jobs.student.destroy');


// Supervisor Routes ----------------------------------------------------------------------------
Route::middleware(['role:Administrator|Lecturer'])->group(function () {
    // Index.
    Route::get('/jobs/supervisor', [JobRequestsController::class, 'supervisor_index'])
        ->name('jobs.supervisor.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Fabrications'), route('admin.jobs.index'))
                ->push(__('Supervisor'), route('admin.jobs.supervisor.index'));;
        });

    // Show
    Route::get('/jobs/supervisor/{jobRequests}/view/', [JobRequestsController::class, 'supervisor_show'])
        ->name('jobs.supervisor.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Fabrications'), route('admin.jobs.index'))
                ->push(__('Supervisor'), route('admin.jobs.supervisor.index'))
                ->push(__('Show'));
        });


    // Store the different types of updates
    Route::post('/jobs/supervisor/{jobRequests}/approve/', [JobRequestsController::class, 'supervisor_approve'])
        ->name('jobs.supervisor.approve');

    Route::post('/jobs/supervisor/{jobRequests}/reject/', [JobRequestsController::class, 'supervisor_reject'])
        ->name('jobs.supervisor.reject');

    Route::post('/jobs/supervisor/{jobRequests}/revise/', [JobRequestsController::class, 'supervisor_revise'])
        ->name('jobs.supervisor.revise');
});

// Technical Officer Routes ----------------------------------------------------------------------------

Route::middleware(['role:Administrator|Technical Officer'])->group(function () {
    // Index
    Route::get('/jobs/officer', [JobRequestsController::class, 'techOfficer_index'])
        ->name('jobs.officer.index')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Fabrications'), route('admin.jobs.index'))
                ->push(__('Technical Officer'), route('admin.jobs.officer.index'));;
        });

    // Show
    Route::get('/jobs/officer/{jobRequests}/view', [JobRequestsController::class, 'officer_show'])
        ->name('jobs.officer.show')
        ->breadcrumbs(function (Trail $trail) {
            $trail->push(__('Home'), route('admin.dashboard'))
                ->push(__('Fabrications'), route('admin.jobs.index'))
                ->push(__('Technical Officer'), route('admin.jobs.officer.index'))
                ->push(__('Show'));
        });

    // Store
    Route::post('/jobs/officer/', [JobRequestsController::class, 'officer_store'])
        ->name('jobs.officer.store');

});

?>
