<?php

use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InfoUserController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ResetController;
use App\Http\Controllers\SessionsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ObjectiveController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\SubjectController;

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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [HomeController::class, 'home']);
	Route::get('dashboard', function () {
		return view('dashboard');
	})->name('dashboard');

	Route::get('billing', function () {
		return view('billing');
	})->name('billing');

	Route::get('profile', function () {
		return view('profile');
	})->name('profile');

	Route::get('rtl', function () {
		return view('rtl');
	})->name('rtl');


	Route::get('tables', function () {
		return view('tables');
	})->name('tables');

    Route::get('virtual-reality', function () {
		return view('virtual-reality');
	})->name('virtual-reality');

    Route::get('static-sign-in', function () {
		return view('static-sign-in');
	})->name('sign-in');

    Route::get('static-sign-up', function () {
		return view('static-sign-up');
	})->name('sign-up');

    Route::get('/logout', [SessionsController::class, 'destroy']);
	Route::get('/user-profile', [InfoUserController::class, 'create']);
	Route::post('/user-profile', [InfoUserController::class, 'store']);
    Route::get('/login', function () {
		return view('dashboard');
	})->name('sign-up');




    //users
	Route::get('user-management',[InfoUserController::class, 'listUsers'])->name('user-management');
    Route::post('/create-user', [InfoUserController::class, 'createUser'])->name('create-user');
    Route::get('user/suspend/{id}', [InfoUserController::class, 'suspendUser'])->name('suspend.user');
    Route::get('user/activate/{id}', [InfoUserController::class, 'activateUser'])->name('activate.user');
    Route::get('user/delete/{id}', [InfoUserController::class, 'deleteUser'])->name('delete.user');
    Route::get('user/{id}', [InfoUserController::class, 'viewUser'])->name('view.user');
    Route::get('/deleted-users', [InfoUserController::class, 'deletedUsers'])->name('deleted.users');

    //class room
    Route::get('classroom-management', [ClassroomController::class, 'listClassrooms'])->name('classroom-management');
    Route::post('/create-classroom', [ClassroomController::class, 'createClassroom'])->name('create-classroom');
    Route::get('classroom/suspend/{id}', [ClassroomController::class, 'suspendClassroom'])->name('suspend.classroom');
    Route::get('classroom/activate/{id}', [ClassroomController::class, 'activateClassroom'])->name('activate.classroom');
    Route::get('classroom/delete/{id}', [ClassroomController::class, 'deleteClassroom'])->name('delete.classroom');
    Route::get('classroom/{id}', [ClassroomController::class, 'viewClassroom'])->name('view.classroom');
    Route::get('/deleted-classrooms', [ClassroomController::class, 'deletedClassrooms'])->name('deleted.classrooms');

    //subject
    Route::post('/create-subject', [SubjectController::class, 'createSubject'])->name('create-subject');
    Route::get('subject/delete/{id}', [SubjectController::class, 'deleteSubject'])->name('delete.subject');
    Route::get('subject/{id}', [SubjectController::class, 'viewSubject'])->name('view.subject');

    //objective
	Route::get('objective-management',[ObjectiveController::class, 'listObjectives'])->name('objective-management');
    Route::post('/create-objective', [ObjectiveController::class, 'createObjective'])->name('create-objective');
    Route::get('objective/delete/{id}', [ObjectiveController::class, 'deleteObjective'])->name('delete.objective');

    //offer
	Route::get('offer-management',[OfferController::class, 'listOffers'])->name('offer-management');
    Route::post('/create-offer', [OfferController::class, 'createOffer'])->name('create-offer');
    Route::get('offer/delete/{id}', [OfferController::class, 'deleteOffer'])->name('delete.offer');
    Route::get('/recommend-offer/{id}', [OfferController::class, 'recommendOffer'])->name('recommend.offer');
    Route::get('/view-offer/{id}', [OfferController::class, 'viewOffer'])->name('view.offer');
    Route::post('/update-offer', [OfferController::class, 'updateOffer'])->name('update.offer');
    Route::post('/offer-detail', [OfferController::class, 'offerDetail'])->name('offer.detail');
    Route::get('/delete-offer-detail/{id}', [OfferController::class, 'deleteOfferDetail'])->name('delete-offer-detail');


});



Route::group(['middleware' => 'guest'], function () {
    Route::get('/register', [RegisterController::class, 'create']);
    Route::post('/register', [RegisterController::class, 'store']);
    Route::get('/login', [SessionsController::class, 'create']);
    Route::post('/session', [SessionsController::class, 'store']);
	Route::get('/login/forgot-password', [ResetController::class, 'create']);
	Route::post('/forgot-password', [ResetController::class, 'sendEmail']);
	Route::get('/reset-password/{token}', [ResetController::class, 'resetPass'])->name('password.reset');
	Route::post('/reset-password', [ChangePasswordController::class, 'changePassword'])->name('password.update');

});

Route::get('/login', function () {
    return view('session/login-session');
})->name('login');
