<?php
namespace App\Http\Controllers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
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
Route::get('/', [MainController::class, 'index'])->name('main.index');


Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/main/about', [MainController::class, 'about'])->name('main.about');
//Route::get('/afisha', [AfishaController::class, 'index']);
Route::get('/afisha-date/{date}', [AfishaController::class, 'afisha_date'])->name('afisha.index');

Route::get('/masterclass/{id}/{event_id}', [MasterclassController::class, 'index'])->name('masterclass');
Route::delete('afisha/delete/{id}', [AfishaController::class, 'delete'])->name('masterclass.delete');
Route::get('/cabinets', [CabinetsController::class, 'index'])->name('cabinets.index');
Route::get('/cabinet{id}', [CabinetController::class, 'index'])->name('cabinet.index');
Route::post('/seat-booking', [SeatController::class, 'booking'])->name('seat.booking');

Auth::routes();
Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/test', [TestController::class, 'index'])->name('test');

Route::get('/account', [AccountController::class, 'index'])->name('account');
Route::post('/account/cancel', [AccountController::class, 'cancel'])->name('account.cancel');
Route::post('/account/user/id', [AccountController::class, 'edit_user'])->name('account.user.edit');

Route::get('/admin', [AdminController::class, 'index'])->name('admin.index')->middleware('admin');
Route::get('/lector', [LecturerController::class, 'index'])->name('lector.index')->middleware('lector');
Route::get('/lector/form/{cabinet_id}', [LecturerController::class, 'form'])->name('lector.create.form')->middleware('lector');
Route::post('/lector/create', [LecturerController::class, 'create'])->name('lector.create')->middleware('lector');
Route::post('/admin/edit', [AdminController::class, 'edit'])->name('admin.edit.user')->middleware('admin');
Route::post('/admin/publish/masterclass', [AdminController::class, 'publishMasterclass'])->name('admin.publish.masterclass')->middleware('admin');
Route::post('/admin/decline/masterclass', [AdminController::class, 'declineMasterclass'])->name('admin.decline.masterclass')->middleware('admin');
