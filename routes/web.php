<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MadahController;
use App\Http\Controllers\MonaSebatController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Livewire\NotificationSweetAlert;
use App\Http\Controllers\AlbumController;
use App\Http\Controllers\TaskController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', function () {
    return redirect('login');
});
Route::post('register/action', [UserController::class,'register'])->name('user.register');

Route::group(['middleware' => ['Admin']], function () {
    Route::get('/admin', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
    Route::get('/logout-user', function(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        return redirect('login');
    });

    Route::resource('admin/roles', RoleController::class);
    Route::resource('admin/users', UserController::class);

    //task routes
    Route::resource('admin/tasks',TaskController::class);
    Route::get('admin/task/set-progress/{id}', [TaskController::class,'progressTask'])->name('set.task.progress');
    Route::get('admin/task/done/{id}', [TaskController::class,'doneTask'])->name('done.task');
    Route::get('admin/task/delete/{id}', [TaskController::class,'deleteTask'])->name('delete.task');
    Route::get('admin/task/search', [TaskController::class,'SearchItem'])->name('search.task');

});
