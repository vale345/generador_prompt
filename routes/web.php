<?php
use App\Http\Controllers\PromptController;
use Illuminate\Support\Facades\Route;

Route::get('/',          [PromptController::class, 'index'])->name('prompt.index');
Route::post('/generate', [PromptController::class, 'generate'])->name('prompt.generate');
