<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/', function () {
    return view('applicant.dashboard');
})->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete_photo');

    // Route::get('/dashboard-recruiter', function () {
    //     return view('recruiter.dashboard-recruiter');
    // })->name('dashboard-recruiter');

    Route::get('/dashboard-recruiter', [ProjectController::class, 'index'])->name('dashboard-recruiter');

    // Route::get('/add-project', function () {
    //     return view('recruiter.add-project');
    // })->name('add-project');

    Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');

    // Route::get('/job', function () {
    //     return view('admin.job');
    // })->name('job');

    Route::get('/job', [JobController::class, 'index'])->name('job');

    Route::get('/add-job', function () {
        return view('admin.add-job');
    })->name('add-job');

    Route::post('/add-job', [JobController::class, 'store'])->name('job.store');

    Route::get('/job/{id}/edit', [JobController::class, 'edit'])->name('job.edit');
    Route::put('/job/{job}', [JobController::class, 'update'])->name('job.update');
});

require __DIR__.'/auth.php';
