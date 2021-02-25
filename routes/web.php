<?php

use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('moderation', [VideoController::class, 'moderation'])->name('moderation');
Route::post('moderation', [VideoController::class, 'moderationResults'])->name('moderationResults');


Route::get('result', [VideoController::class, 'result'])->name('result');

Route::get('label', [VideoController::class, 'label'])->name('label');
Route::post('label', [VideoController::class, 'labelCheckResults'])->name('labelCheckResults');

Route::get('test', [VideoController::class, 'test'])->name('test');
