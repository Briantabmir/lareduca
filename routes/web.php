<?php


use Illuminate\Support\Facades\Route;
use App\Livewire\CourseManagement;
use App\Livewire\AssignmentsManagement;
use App\LiveWire\AssignmentSubmissions;
use App\Livewire\StudentProgressTracker;
use App\Livewire\UserManagement;
use App\Livewire\CourseEnrollment;
use App\Livewire\EducationalGamesIntegration;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::get('/courses', CourseManagement::class)->name('courses');
Route::get('/assignments', AssignmentsManagement::class)->name('assignments');
Route::get('/assignments/{assignmentId}/submissions', AssignmentSubmissions::class)->name('assignment.submissions');
Route::get('/progress/{courseId}', StudentProgressTracker::class)->name('progress');
Route::get('/users', UserManagement::class)->name('users');
Route::get('/enroll', CourseEnrollment::class)->name('enrollments');
Route::get('/games', EducationalGamesIntegration::class)->name('games');


