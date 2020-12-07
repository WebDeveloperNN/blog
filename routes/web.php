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

// =============================================================================================================
// ====================================Laravel section start====================================================
// =============================================================================================================
// Prologue + Getting Started
Route::get('/laravel/prologue', function() {
    return view('laravel.prologue.index');
});
// Architecture Concepts
// The Basics
// Frontend
// Security
// Digging Deeper
// Database
// Eloquent ORM
// Testing
// Packages
// API Documentation
Route::redirect('/laravel/api', url('https://laravel.com/api/8.x/'), 301);
// =============================================================================================================
// =====================================Laravel section end=====================================================
// =============================================================================================================



Route::get('/laravel/database', function() {
    return view('laravel.database.index');
});

Route::get('/laravel/deep_study', function() {
    return view('laravel.deep_study.index');
});

Route::get('/laravel/architecture', function() {
    return view('laravel.architecture.index');
});

Route::get('/laravel/basic', function() {
    return view('laravel.basic.index');
});

Route::get('/laravel/frontend', function() {
    return view('laravel.frontend.index');
});

Route::get('/laravel/security', function() {
    return view('laravel.security.index');
});


// Route::get('/{technology}/{chapter}/{theme}', [PostController::class, 'show']);
// Route::get('/{technology}', function() {return 'menu';});





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

// В чем смысл сайта, который я делаю:
// 1) Информация в сжатом виде
// 2) На языке, который я понимаю
// 3) Хорошая навигация

// Также нужно написать план
// 1) Laravel
// 2) Базы данных / SQL
// 3) Git
// 4) Компьютерные сети
// 5) Линукс
// 6) Хакинг
// 7) C++



//  https://refactoring.guru/ru/design-patterns/composite
//     https://refactoring.guru/ru
//     https://vk.com/doc232854130_363180666?hash=3cf084e0f49818490b&dl=1df87a3e56130d1582
//     https://losst.ru/wp-content/uploads/2016/08/progit-ru.1027.pdf
//     https://server.179.ru/tasks/cpp/total/
//     https://www.youtube.com/watch?v=Rp9e1Y-vdBM
//     https://www.youtube.com/watch?v=PQ1C_0EAHFI
//     http://helpexe.ru/programmirovanie/kak-sdelat-okno-koda-visual-studio-prozrachnym-v
//     https://laravel.ru/docs/v5/schema
//     базы данных книги
