<?php

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

use App\Http\Controllers\AuthorizationController;
use App\Http\Controllers\PostController;
use App\Models\Technology;

Route::get('/login', [AuthorizationController::class, 'index']);

Route::get('/', function() {

    return view('mainPage');
});

// Route::get('/laravel/prologue/', function() {
//     return view('posts.laravel.prologue.prologue');
// });

Route::get('/artem', function() {
    return view('artem');
});

Route::get('/laravel/first_meeting/prologue', function() {
    return view('laravel.first_meeting.prologue');
});

Route::get('/laravel/architecture', function() {
    return view('laravel.architecture.index');
});

Route::get('/laravel/basic', function() {
    return view('laravel.basic.index');
});

Route::get('/{technology}/{chapter}/{theme}', [PostController::class, 'show']);
Route::get('/{technology}', function() {return 'menu';});




// /laravel/first_meeting/prologue
// /larave
//     /first_meeting
//         /prologue

// При нажатие на технологию, слева и справа выдвигаются окна, слева меню, справа контент.
// в правом верхнем углу будет закрыть. Тогда это окно технологии закрывается.
// Структура меню как на оф сайте.
// Также будет pdf версия книги.



// Вообщем нужно написать оглавление и уже потом тут проектировать


// use App\Models\Theme;

// Route::get('/test', function() {
//     $test = Theme::join('technologies', 'technology', '=', 'technologies.id')->join('chapters', 'chapter', '=', 'chapters.id')->get();
//     return $test;
// });
