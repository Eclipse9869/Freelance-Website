<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CategoryController;
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

// Route::get('/', function () {
//     return view('applicant.dashboard');
// })->name('dashboard');

Route::get('/', [CategoryController::class, 'home'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::delete('/profile/delete-photo', [ProfileController::class, 'deletePhoto'])->name('profile.delete_photo');

    Route::get('/all-category', [ProjectController::class, 'dashboard'])->name('all-category');
    Route::get('/category/{id}', [CategoryController::class, 'show'])->name('category.show');
    // Route::get('/projects/{projects}', [ProjectController::class, 'showDashboard'])->name('projects.showDashboard');

    // Route::get('/dashboard-recruiter', [ProjectController::class, 'index'])->name('dashboard-recruiter');
    // Route::get('/projects/create', [ProjectController::class, 'create'])->name('projects.create');
    // Route::post('/projects', [ProjectController::class, 'store'])->name('projects.store');
    // Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');
    // Route::get('/projects/{project}/edit', [ProjectController::class, 'edit'])->name('projects.edit');
    // Route::put('/projects/{project}', [ProjectController::class, 'update'])->name('projects.update');
    Route::resource('projects', ProjectController::class);

    Route::get('/job', [JobController::class, 'index'])->name('job');
    Route::get('/add-job', [JobController::class, 'create'])->name('job.create');
    Route::post('/add-job', [JobController::class, 'store'])->name('job.store');
    Route::get('/job/{id}/edit', [JobController::class, 'edit'])->name('job.edit');
    Route::put('/job/{job}', [JobController::class, 'update'])->name('job.update');

    Route::get('/category-job', [CategoryController::class, 'index'])->name('category-job');
    Route::post('/category-job', [CategoryController::class, 'store'])->name('category-job.store');
    Route::put('/category-job/{id}', [CategoryController::class, 'update'])->name('category-job.update');
});

require __DIR__.'/auth.php';
