<?php

use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

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


Route::get('/', [App\Http\Controllers\PostController::class, 'view_all_posts_on_home'])->name('view_all_posts_on_home');

Auth::routes();
//  Routes  for Manipulating  Posts
Route::get('/home', [App\Http\Controllers\PostController::class, 'view_all_posts'])->name('home');
Route::get('/show_form', [App\Http\Controllers\PostController::class, 'show_form'])->name('show_form');
Route::post('/save_post/{uuid?}', [App\Http\Controllers\PostController::class, 'edit'])->name('save_post');
Route::get('/delete_post/{uuid?}', [App\Http\Controllers\PostController::class, 'delete_post'])->name('delete_post');
Route::get('/edit_post_data_display/{uuid?}', [App\Http\Controllers\PostController::class, 'edit_post_data_display'])->name('edit_post_data_display');
Route::get('/show_post_to_edit', [App\Http\Controllers\PostController::class, 'show_post_to_edit'])->name('show_post_to_edit');
Route::post('/edit_post_save/{uuid}', [App\Http\Controllers\PostController::class, 'edit_save'])->name('edit_post_save');

//  Routes  for Manipulating Comments
Route::post('/save_comment/{post_id?}', [App\Http\Controllers\CommentController::class, 'edit'])->middleware('auth');

