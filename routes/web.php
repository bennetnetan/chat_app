<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/chat', [ChatController::class, 'index'])->name('chat.index'); // Display chat interface
Route::post('/chat/send', [ChatController::class, 'sendMessage'])->name('chat.send'); // Handle sending messages

Route::get('/messages', 'ChatController@getMessages');

// Route::get('/chatroom', 'ChatController@index')->name('ch');
