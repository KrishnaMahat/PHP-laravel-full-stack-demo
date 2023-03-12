<?php
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\UserController;
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
Route::get('/myprofile/{user_id}', [\App\Http\Controllers\MyprofileController::class, 'index']);
Route::get('/meme/profile/{user_id}', [\App\Http\Controllers\OtherprofileController::class, 'index']);
Route::get('/meme', [\App\Http\Controllers\BlogPostController::class, 'index']);

Route::get('/meme/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'show']);

Route::get('/meme/create/post', [\App\Http\Controllers\BlogPostController::class, 'create']);
Route::post('/meme/create/post', [\App\Http\Controllers\BlogPostController::class, 'store']); 
Route::get('/meme/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'edit']); 
Route::put('/meme/{blogPost}/edit', [\App\Http\Controllers\BlogPostController::class, 'update']); 
Route::delete('/meme/{blogPost}', [\App\Http\Controllers\BlogPostController::class, 'destroy']); 


Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::post('/users/{id}/store', [App\Http\Controllers\UserController::class, 'store'])->name('users.store');

Route::post('/users/{uid}/destroy', [App\Http\Controllers\UserController::class, 'destroy'])->name('users.destroy');

?>