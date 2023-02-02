<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\App;

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

Route::get('dashboard', [LoginController::class, 'dashboard'])->middleware('system_admin'); 
Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('custom-login', [LoginController::class, 'customLogin'])->name('login.custom'); 
Route::get('registration', [LoginController::class, 'registration'])->name('register-user');
Route::post('custom-registration', [LoginController::class, 'customRegistration'])->name('register.custom'); 
Route::post('signout', [LoginController::class, 'signOut'])->name('signout');

Route::get('/', function () {
    return view('index');
 });
 
 Route::get('/about', function () {
    return view('about');
 });
 
 Route::get('/dashboard', [\App\Http\Controllers\DashboardController::class, 'index'])->middleware('system_admin');
 Route::get('/profile', [\App\Http\Controllers\DashboardController::class, 'profile']);

 Route::get('/blog', [\App\Http\Controllers\BlogPostController::class, 'index']);
 Route::get('/blog/{blogPost}/page_{page}', [\App\Http\Controllers\BlogPostController::class, 'show']);
 Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show_by_category'])->name('blog.category');
 Route::get('/admin/blog', [\App\Http\Controllers\BlogPostController::class, 'view']);
 Route::get('/admin/blog/list', [\App\Http\Controllers\BlogPostController::class, 'viewall'])->name('admin.blog');
 Route::post('/blog/apply', [\App\Http\Controllers\BlogPostController::class, 'applyAction'])->name('blog.apply'); 
 Route::post('/blog/views', [\App\Http\Controllers\BlogPostController::class, 'postViews'])->name('blog.views'); 
 // Route::get('/blog/{blogPost}/page_{page}', [\App\Http\Controllers\BlogPostController::class, 'getPages']);
 Route::get('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'create'])->name('blog.create'); 
 
 Route::post('/admin/comments', [\App\Http\Controllers\CommentsController::class, 'store'])->name("comments.store");
 Route::get('/admin/comments', [\App\Http\Controllers\CommentsController::class, 'index']);
 Route::get('/admin/comments', [\App\Http\Controllers\CommentsController::class, 'viewall'])->name('admin.comments');
 Route::post('/admin/comments/delete', [\App\Http\Controllers\CommentsController::class, 'delete'])->name('admin.comments.delete');
 Route::delete('/admin/{comments}', [\App\Http\Controllers\CommentsController::class, 'destroy']); 
 Route::post('/admin/comments/apply', [\App\Http\Controllers\CommentsController::class, 'applyAction'])->name('comment.apply'); 
 
 Route::get('/admin/categories', [\App\Http\Controllers\CategoriesController::class, 'index']);
 Route::post('/admin/categories', [\App\Http\Controllers\CategoriesController::class, 'store'])->name('categories.store');
 Route::get('/admin/categories', [\App\Http\Controllers\CategoriesController::class, 'viewall'])->name('admin.categories');
 Route::get('/admin/{categories}/categories', [\App\Http\Controllers\CategoriesController::class, 'edit'])->name('admin.categories.edit');
 Route::put('/admin/categories', [\App\Http\Controllers\CategoriesController::class, 'update'])->name('admin.categories.update');
 Route::post('/admin/categories/delete', [\App\Http\Controllers\CategoriesController::class, 'delete'])->name('admin.categories.delete');
 Route::delete('/admin/{categories}', [\App\Http\Controllers\CategoriesController::class, 'destroy']); //deletes post from the database
 Route::post('/admin/categories/apply', [\App\Http\Controllers\CategoriesController::class, 'applyAction'])->name('category.apply'); 

 Route::post('/blog/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']); //saves the created post to the databse
//  Route::get('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);
 Route::get('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit'])->name('blog.edit');; //shows edit post form
 Route::put('/blog/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']); //commits edited post to the database 
 Route::put('/blog/edit', [\App\Http\Controllers\BlogPostController::class, 'update'])->name('admin.blog.edit'); //commits edited post to the database 
 Route::post('/blog/delete', [\App\Http\Controllers\BlogPostController::class, 'delete'])->name('admin.blog.delete'); //deletes post from the database
 Route::delete('/blog/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy']); //deletes post from the database
 
 Route::get('/user', [\App\Http\Controllers\UserdataController::class, 'create'])->name('user.register');
 Route::post('/user', [\App\Http\Controllers\UserdataController::class, 'store'])->name('user.store');
 // Route::get('/user', [App\Http\Controllers\UserdataController::class, 'create'])->name('user.register')->middleware('super_admin');
 Route::get('/contact', [\App\Http\Controllers\SendEmailController::class, 'index'])->name('contact');
 Route::post('/contact/send', [\App\Http\Controllers\SendEmailController::class, 'send'])->name('contact');
 Route::get('/admin/users', [\App\Http\Controllers\UserController::class, 'view']);
 Route::get('/admin/users/list', [\App\Http\Controllers\UserController::class, 'viewall'])->name('admin.users');
 
 Route::get('/roles', [\App\Http\Controllers\RoleController::class, 'index'])->name('roles.index');
 Route::get('/roles/create', [\App\Http\Controllers\RoleController::class, 'create'])->name('roles.create');
 Route::post('/roles/store', [\App\Http\Controllers\RoleController::class, 'store'])->name('roles.store');
 Route::get('/roles/{id}/edit', [\App\Http\Controllers\RoleController::class, 'edit'])->name('roles.edit');
 Route::put('/roles/{id}/update', [\App\Http\Controllers\RoleController::class, 'update'])->name('roles.update');
 Route::delete('/roles/{id}/delete', [\App\Http\Controllers\RoleController::class, 'destroy'])->name('roles.destroy');
 
 Route::get('/menu', [\App\Http\Controllers\MenuController::class, 'index'])->name('menu.index');
 Route::get('/menu/create', [\App\Http\Controllers\MenuController::class, 'create'])->name('menu.create');
 Route::post('/menu/store', [\App\Http\Controllers\MenuController::class, 'store'])->name('menu.store');
 Route::get('/menu/{id}/edit', [\App\Http\Controllers\MenuController::class, 'edit'])->name('menu.edit');
 Route::put('/menu/{id}/update', [\App\Http\Controllers\MenuController::class, 'update'])->name('menu.update');
 Route::delete('/menu/{id}/delete', [\App\Http\Controllers\MenuController::class, 'destroy'])->name('menu.destroy');
 
 
 Route::get('/services', function () {
    return view('services');
 });
 
 Route::get('/portfolio', function () {
    return view('portfolio-details');
 });
 
 Route::get('/inner-page', function () {
    return view('inner-page');
 });
 
 Route::get('/home', [\App\Http\Controllers\HomeController::class, 'index'])->name('home');
 Route::get('admin/home', [\App\Http\Controllers\HomeController::class, 'admin'])->name('admin.home')->middleware('admin');
 