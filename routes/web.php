<?php

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

Auth::routes();
Route::get('/', fn () => redirect('/login'));

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/profile', 'HomeController@profile')->name('profile');
Route::get('/profile/edit', 'HomeController@profileEdit')->name('profile.edit');
Route::put('/profile/update', 'HomeController@profileUpdate')->name('profile.update');
Route::get('/profile/changepassword', 'HomeController@changePasswordForm')->name('profile.change.password');
Route::post('/profile/changepassword', 'HomeController@changePassword')->name('profile.changepassword');

Route::group(['middleware' => ['auth','role:Admin']], function () {
    Route::get('/roles-permissions', 'RolePermissionController@roles')->name('roles-permissions');
    Route::get('/role-create', 'RolePermissionController@createRole')->name('role.create');
    Route::post('/role-store', 'RolePermissionController@storeRole')->name('role.store');
    Route::get('/role-edit/{id}', 'RolePermissionController@editRole')->name('role.edit');
    Route::put('/role-update/{id}', 'RolePermissionController@updateRole')->name('role.update');

    Route::get('/permission-create', 'RolePermissionController@createPermission')->name('permission.create');
    Route::post('/permission-store', 'RolePermissionController@storePermission')->name('permission.store');
    Route::get('/permission-edit/{id}', 'RolePermissionController@editPermission')->name('permission.edit');
    Route::put('/permission-update/{id}', 'RolePermissionController@updatePermission')->name('permission.update');

    Route::get('assign-subject-to-class/{id}', 'GradeController@assignSubject')->name('class.assign.subject');
    Route::post('assign-subject-to-class/{id}', 'GradeController@storeAssignedSubject')->name('store.class.assign.subject');

    Route::get('timetable', 'TimetableController@index')->name('timetables.index');
    Route::get('timetable/{grade}/grade', 'TimetableController@grade')->name('timetable.grade');
    Route::get('timetable/{grade}/grades/show', 'TimetableController@grade_show')->name('timetable.grade.show');
    Route::post('timetable/{grade}/grade', 'TimetableController@grade_store')->name('timetable.grade.update');

    Route::get('diary', 'DiaryController@index')->name('diary.index');
    Route::get('diary/{grade}/grade', 'DiaryController@grade')->name('diary.grade');
    Route::get('diary/{grade}/grade/show', 'DiaryController@grade_show')->name('diary.grade.show');

    Route::resource('assignrole', 'RoleAssign');
    Route::resource('classes', 'GradeController');
    Route::resource('subject', 'SubjectController');
    Route::resource('teacher', 'TeacherController');
    Route::resource('parents', 'ParentsController');
    Route::resource('student', 'StudentController');
    Route::get('attendance', 'AttendanceController@index')->name('attendance.index');

    Route::get('journals', 'JournalController@index')->name('journals.index');
    Route::get('journals/{grade}/grade', 'JournalController@grade')->name('journals.grade');
    Route::get('journals/{grade}/grade/show', 'JournalController@grade_show')->name('journals.grade.show');
    Route::post('journals/{grade}/grade', 'JournalController@grade_store')->name('journals.grade.update');
});

Route::group(['middleware' => ['auth','role:Teacher']], function () {
    Route::post('attendance', 'AttendanceController@store')->name('teacher.attendance.store');
    Route::get('attendance-create/{classid}', 'AttendanceController@createByTeacher')->name('teacher.attendance.create');
});

Route::group(['middleware' => ['auth','role:Parent']], 
    fn () => Route::get('attendance/{attendance}', 'AttendanceController@show')->name('attendance.show'));

Route::group(['middleware' => ['auth','role:Student']], function () {

});
