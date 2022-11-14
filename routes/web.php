<?php
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login',[LoginController::class, 'login'])->name('login');
Route::post('/postlogin',[LoginController::class, 'postlogin'])->name('post.login');
Route::get('/logout',[LoginController::class, 'logout'])->name('logout');

Route::get('/admin/datauser',[AdminController::class, 'datauser'])->name('user');
Route::get('/admin/datauser/formuser',[AdminController::class, 'formuser'])->name('form.user');
Route::post('/admin/datauser/create',[AdminController::class, 'createuser'])->name('create.user');
Route::get('/admin/{id}/edituser', [AdminController::class, 'edituser'])->name('user.edit');
Route::post('/admin/{id}/updateuser', [AdminController::class, 'updateuser'])->name('user.update');
Route::get('/admin/{id}/deleteuser', [AdminController::class, 'deleteuser'])->name('user.delete');


Route::get('/admin', [AdminController::class, 'dashboard']);
Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

Route::get('/admin/datacalon', [AdminController::class, 'datacandidate'])->name('data.candidate');
Route::get('/admin/datacalon/form', [AdminController::class, 'form'])->name('data.form');
Route::post('/admin/datacalon/create', [AdminController::class, 'createcandidate'])->name('create.candidate');
Route::get('/admin/{id}/edit', [AdminController::class, 'edit'])->name('data.edit');
Route::post('/admin/{id}/update', [AdminController::class, 'update'])->name('data.update');
Route::get('/admin/{id}/delete', [AdminController::class, 'delete'])->name('data.delete');
Route::get('/admin/fuzzifikasi', [AdminController::class, 'fuzzi'])->name('fuzzifikasi');

Route::get('/admin/variable', [AdminController::class, 'variable'])->name('variable');
Route::get('/admin/variable/form', [AdminController::class, 'formvariable'])->name('form.variable');
Route::post('/admin/variable/create', [AdminController::class, 'createvariable'])->name('create.variable');

Route::get('/admin/rule',[AdminController::class,'rules'])->name('rules');
Route::get('/admin/rule/form',[AdminController::class,'ruleform'])->name('rule.form');
Route::post('/admin/rule/create', [AdminController::class, 'createrule'])->name('create.rule');
Route::get('/admin/{id}/editrule', [AdminController::class, 'editrule'])->name('data.edit.rule');
Route::post('/admin/{id}/updaterule', [AdminController::class, 'updaterule'])->name('data.update.rule');
Route::get('/admin/{id}/deleterule', [AdminController::class, 'deleterule'])->name('data.delete.rule');

