<?php

use Illuminate\Support\Facades\Auth;
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


Auth::routes([
    'register' => false
]);

Route::get('/', function () {
    if (Auth::user()->hasRole('admin')) {
        return redirect()->route('admin.home');
    } else {
        return redirect()->route('home');
    }
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');

// Admin
Route::prefix('admin')->name('admin.')->middleware('auth', 'role:admin')->group(function () {
    Route::get('/home', 'HomeController@index')->name('home');
    Route::view('rayon', 'admin.rayon.index')->name('rayon');
    Route::view('major', 'admin.major.index')->name('major');
    Route::view('rombel', 'admin.rombel.index')->name('rombel');
    Route::view('student', 'admin.student.index')->name('student');

    Route::resource('teacher', 'Admin\TeacherController');
    Route::get('cek-nip', 'Admin\TeacherController@cekNip')->name('teacher.cek-nip');
    Route::post('teacher/datatables', 'Admin\TeacherController@datatables')->name('teacher.datatables');
    Route::post('teacher/import', 'Admin\TeacherController@import')->name('teacher.import');

    Route::resource('student', 'Admin\StudentController');
    Route::get('cek-nis', 'Admin\StudentController@cekNis')->name('student.cek-nis');
    Route::post('student/datatables', 'Admin\StudentController@datatables')->name('student.datatables');
    Route::post('student/import', 'Admin\StudentController@import')->name('student.import');

    Route::view('assignment', 'admin.assignment.index')->name('assignment');
});

Route::name('student.')->middleware('auth', 'role:student')->group(function () {
    Route::view('to-do', 'student.todo.index')->name('to-do.index');
    Route::view('assignments', 'student.assignment.index')->name('assignment.index');
    Route::view('assignments/{id}/details', 'student.assignment.detail')->name('assignments.detail');
});

Route::name('pembimbing.')->middleware(['auth', 'role:pembimbing'])->group(function () {
    Route::prefix('r')->name('rayon.')->group(function () {
        Route::view('', 'pembimbing.rayon')->name('index');
        Route::name('student.')->group(function () {
            Route::view('/{id}', 'pembimbing.students.index')->name('index');
        });
    });
});
