<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\BookIssueController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\MemberController;

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::resource('books', BookController::class);
    Route::resource('categories', CategoryController::class);
    Route::resource('authors', AuthorController::class);
    Route::resource('members', MemberController::class);

    Route::get('/issues', [BookIssueController::class, 'index'])->name('issues.index');
    Route::get('/issues/create', [BookIssueController::class, 'create'])->name('issues.create');
    Route::post('/issues', [BookIssueController::class, 'store'])->name('issues.store');

    Route::get('/issues/{id}/edit', [BookIssueController::class, 'edit'])->name('issues.edit');
    Route::put('/issues/{id}', [BookIssueController::class, 'update'])->name('issues.update');

    Route::post('/issues/{id}/return', [BookIssueController::class, 'returnBook'])->name('issues.return');
    Route::get('/return-history', [BookIssueController::class, 'history'])->name('issues.history');
    // Route::get('/issues', [BookIssueController::class,'index'])->name('issues.index');
    // Route::get('/issues/{id}/edit', [BookIssueController::class,'edit'])->name('issues.edit');
    // Route::put('/issues/{id}', [BookIssueController::class,'update'])->name('issues.update');
    // Route::get('/issue-books', [BookIssueController::class, 'create'])->name('issue.create');
    // Route::post('/issue-books', [BookIssueController::class, 'store'])->name('issue.store');

    // Route::get('/return-book/{id}', [BookIssueController::class, 'returnBook'])->name('issue.return');
});


require __DIR__.'/auth.php';