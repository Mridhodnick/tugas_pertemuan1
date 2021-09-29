<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TrainersController;
use App\Http\Controllers\StudentsController;

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

Route::get('/', [App\Http\Controllers\PagesController::class, 'mainpage']);

//pages controller
Route::get('/about', [App\Http\Controllers\PagesController::class, 'about']);
Route::get('/mainpage', [App\Http\Controllers\PagesController::class, 'mainpage']);
Route::get('/events', [App\Http\Controllers\PagesController::class, 'events']);
Route::get('/courses', [App\Http\Controllers\PagesController::class, 'courses']);
Route::get('/trainers', [App\Http\Controllers\PagesController::class, 'trainers']);
Route::get('/register_as_trainer', [App\Http\Controllers\PagesController::class, 'register_as_trainers'])->name('registerastrainers');

Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//admin controlller
Route::get('/admin/dashboard','App\Http\Controllers\AdminController@index')->middleware('role:admin');

//trainers controller
Route::get('/trainers/dashboard', [TrainersController::class,'index'])->middleware('role:trainers');
Route::get('/trainers/courses', [TrainersController::class,'show_courses'])->middleware('role:trainers')->name('trainers_courses');
Route::get('/trainers/discussions',[TrainersController::class,'show_discussions'])->middleware('role:trainers');
Route::get('/trainers/profile', [TrainersController::class,'show_profile'])->middleware('role:trainers');
Route::get('/trainers/create', [TrainersController::class,'create'])->middleware('role:trainers');
Route::post('/trainers/dashboard',[TrainersController::class,'store'])->middleware('role:trainers');
Route::get('/trainers/class_attendee', [TrainersController::class,'class_attendee'])->middleware('role:trainers');
Route::post('/trainers/delete', [TrainersController::class,'destroy'])->middleware('role:trainers');
Route::post('/trainers/edit', [TrainersController::class,'edit'])->middleware('role:trainers');
Route::post('/trainers/update', [TrainersController::class,'update'])->middleware('role:trainers');
Route::post('/trainers/update_profile',[TrainersController::class,'update_profile'])->middleware('role:trainers')->name('trainers_update_profile');
Route::post('/trainers/update_response',[TrainersController::class,'edit_response'])->middleware('role:trainers')->name('trainers_update_response');
Route::post('/trainers/store_updated_response', [TrainersController::class,'store_updated_response'])->middleware('role:trainers')->name('store_updated_response');
Route::post('/trainers/delete_response', [TrainersController::class,'delete_response'])->middleware('role:trainers')->name('trainers_delete_response');
Route::post('/trainers/create_discussions_topic', [TrainersController::class,'create_discussions'])->middleware('role:trainers')->name('trainers_ask');
Route::post('/trainers/edit_question', [TrainersController::class,'edit_question'])->middleware('role:trainers')->name('trainers_edit_question');
Route::post('/trainers/store_updated_question', [TrainersController::class,'store_updated_question'])->middleware('role:trainers')->name('store_updated_question');
Route::post('/trainers/delete_question', [TrainersController::class,'delete_question'])->middleware('role:trainers')->name('trainers_delete_question');
Route::post('/trainers/create_response', [TrainersController::class,'create_responses'])->middleware('role:trainers')->name('trainers_response');
Route::get('/trainers/search_user', [TrainersController::class,'cari_user'])->middleware('role:trainers')->name('trainers.cari.user');
Route::get('/trainers/seacrh_courses',[TrainersController::class,'cari_course'])->middleware('role:trainers')->name('trainers.cari.course');

//students
Route::get('/students/dashboard', [StudentsController::class,'index'])->middleware('role:students');
Route::get('/students/discussions',[StudentsController::class,'show_discussions'])->middleware('role:students');
Route::post('/students/create_discussions_topic',[StudentsController::class,'create_discussions'])->middleware('role:students')->name('students_ask');
Route::post('/students/edit_question', [StudentsController::class,'edit_question'])->middleware('role:students')->name('students_edit_question');
Route::post('/students/store_updated_question', [StudentsController::class,'store_updated_question'])->middleware('role:students');
Route::post('/students/update_response',[StudentsController::class,'edit_response'])->middleware('role:students')->name('students_update_response');
Route::post('/students/store_updated_response', [StudentsController::class,'store_updated_response'])->middleware('role:students')->name('students.store.updated.response');
Route::post('/students/delete_response', [StudentsController::class,'delete_response'])->middleware('role:students')->name('students_delete_response');
Route::post('/students/create_response', [StudentsController::class,'create_responses'])->middleware('role:students')->name('students_response');
Route::get('/students/profile', [StudentsController::class,'show_profile'])->middleware('role:students');
Route::post('/students/update_profile',[StudentsController::class,'update_profile'])->middleware('role:students')->name('students_update_profile');
Route::get('/students/trainers_list',[StudentsController::class,'trainers_list'])->middleware('role:students');
Route::get('/students/search_user', [StudentsController::class,'cari_user'])->middleware('role:students')->name('students.cari.user');
Route::get('/students/search_course', [StudentsController::class,'cari_course'])->middleware('role:students')->name('students.cari.course');
Route::get('/students/courses', [StudentsController::class,'show_courses'])->middleware('role:students');
Route::get('/students/delete_question',[StudentsController::class,'delete_question'])->middleware('role:students')->name('students_delete_question');

//admin
Route::get('/admin/dashboard',[AdminController::class,'index'])->middleware('role:admin');
Route::get('/admin/discussions',[AdminController::class,'show_discussions'])->middleware('role:admin');
Route::get('/admin/search_questions', [AdminController::class,'cari_questions'])->middleware('role:admin')->name('admin.cari.questions');
Route::post('/admin/create_discussions_topic',[AdminController::class,'create_discussions'])->middleware('role:admin')->name('admin_ask');
Route::post('/admin/edit_question', [AdminController::class,'edit_question'])->middleware('role:admin')->name('admin_edit_question');
Route::post('/admin/store_updated_question', [AdminController::class,'store_updated_question'])->middleware('role:admin');
Route::post('/students/delete_question', [AdminController::class,'delete_question'])->middleware('role:admin')->name('admin_delete_question');
Route::post('/admin/admin_response',[AdminController::class,'edit_response'])->middleware('role:admin')->name('admin_update_response');
Route::post('/admin/store_updated_response', [AdminController::class,'store_updated_response'])->middleware('role:admin')->name('admin.store.updated.response');
Route::post('/admin/delete_response', [AdminController::class,'delete_response'])->middleware('role:admin')->name('admin_delete_response');
Route::post('/admin/create_response', [AdminController::class,'create_responses'])->middleware('role:admin')->name('admin_response');
Route::get('/admin/profile', [AdminController::class,'show_profile'])->middleware('role:admin');
Route::post('/admin/update_profile',[AdminController::class,'update_profile'])->middleware('role:admin')->name('admin_update_profile');
Route::get('/admin/users_list',[AdminController::class,'users_list'])->middleware('role:admin');
Route::post('/admin/delete_user',[AdminController::class,'delete_user'])->middleware('role:admin')->name('delete.user');
Route::get('/admin/search_user', [AdminController::class,'cari_user'])->middleware('role:admin')->name('admin.cari.user');
Route::get('/admin/courses_list',[AdminController::class,'show_courses'])->middleware('role:admin')->name('admin.courses');
Route::post('/admin/delete_course',[AdminController::class,'delete_course'])->middleware('role:admin')->name('admin.delete.course');
Route::get('/admin/events',[AdminController::class,'events'])->middleware('role:admin')->name('events');
Route::post('/admin/create_events',[AdminController::class,'create_events'])->middleware('role:admin')->name('create.events');
Route::post('/admin/edit_events',[AdminController::class,'edit_events'])->middleware('role:admin')->name('edit.event');
Route::post('/admin/store_edited_events',[AdminController::class, 'store_edited_events'])->middleware('role:admin')->name('save.edited.events');
Route::post('/admin/delete_event', [AdminController::class,'delete_event'])->middleware('role:admin')->name('delete.event');
Route::get('/admin/add_user',[AdminController::class,'create_user'])->middleware('role:admin');
Route::post('/admin/store_user',[AdminController::class,'store_user'])->middleware('role:admin')->name('store.user');
Route::get('/admin/seacrh_courses',[AdminController::class,'cari_course'])->middleware('role:admin')->name('admin.cari.course');
