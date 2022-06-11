<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Task;
use App\Http\Controllers\TaskController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('task')->group(function () {
    Route::post('/', [TaskController::class, 'store'])->name('store.task');
    Route::put('/{id}', [TaskController::class, 'update'])->name('update.task');
    Route::patch('/{id}/status', [TaskController::class, 'updateTaskStatus'])->name('update.task.status');
    Route::post('/{id}/tag', [TaskController::class, 'addTaskTag'])->name('add.task.tag');
    Route::get('/', [TaskController::class, 'index'])->name('index.tasks');
    Route::get('/{id}/file_url', [TaskController::class, 'showFileUrl'])->name('show.file.url.task');
});
