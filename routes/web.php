<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return redirect()->route('projects.index');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');


    //Rutas para Proyectos
    Route::get('/projects', [ProjectController::class, 'index'])->name('projects.index');

    Route::get('/projects/crear', [ProjectController::class, 'create'])->name('projects.create');
    Route::post('/projects/crear', [ProjectController::class, 'store'])->name('projects.store');

    Route::get('/projects/{id}/editar', [ProjectController::class, 'edit'])->name('projects.edit')->whereNumber('id');
    Route::put('/projects/{id}/editar', [ProjectController::class, 'update'])->name('projects.update')->whereNumber('id');

    Route::get('/projects/{id}/ver', [ProjectController::class, 'show'])->name('projects.show')->whereNumber('id');

    Route::delete('/projects/{id}/eliminar', [ProjectController::class, 'destroy'])->name('projects.destroy')->whereNumber('id');

    Route::get('/projects/buscar', [ProjectController::class, 'search'])->name('projects.search');
    Route::get('/projects/filtro', [ProjectController::class, 'filtro'])->name('projects.filtro');

//Rutas para Comentarios
    Route::post('/projects/{id}/comentarios/crear', [CommentController::class, 'store'])->name('comments.store')->whereNumber('id');

    Route::get('/projects/{id}/comentarios/editar', [CommentController::class, 'edit'])->name('comments.edit')->whereNumber('id');
    Route::put('/projects/{id}/comentarios/editar', [CommentController::class, 'update'])->name('comments.update')->whereNumber('id');

    Route::delete('/projects/{id}/comentarios/eliminar', [CommentController::class, 'destroy'])->name('comments.destroy')->whereNumber('id');

//Rutas para Archivos
    Route::post('/projects/upload/', [FileController::class, 'upload'])->name('upload.file');
    Route::get('/download/{id}', [FileController::class, 'download'])->name('download.file')->whereNumber('id');

    Route::delete('/projects/{id}/archivos/eliminar', [FileController::class, 'destroy'])->name('files.destroy')->whereNumber('id');

    //Rutas para User
    Route::get('/projects/profesores/ver', [UserController::class, 'profesores'])->name('users.profesores');
    Route::get('/projects/estudiantes/ver', [UserController::class, 'estudiantes'])->name('users.estudiantes');



});

require __DIR__.'/auth.php';
