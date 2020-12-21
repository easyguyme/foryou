<?php
use Spatie\WelcomeNotification\WelcomesNewUsers;
use App\Http\Controllers\Auth\WelcomeController;

Route::redirect('/', '/login');
Route::redirect('/home', '/admin');
Auth::routes(['register' => false]);
Route::group(['middleware' => ['web', WelcomesNewUsers::class,]], function () {
    Route::get('welcome/{user}', [WelcomeController::class, 'showWelcomeForm'])->name('welcome');
    Route::post('welcome/{user}', [WelcomeController::class, 'savePassword']);
});
Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Patients
    Route::delete('patients/destroy', 'PatientsController@massDestroy')->name('patients.massDestroy');
    Route::resource('patients', 'PatientsController');
    //Exercises
    Route::delete('exercises/destroy', 'ExerciseController@massDestroy')->name('exercises.massDestroy');
    Route::resource('exercises', 'ExerciseController');
    //Workouts
    Route::post('workouts/add', 'WorkoutController@massAdd')->name('workouts.massAdd');
    Route::resource('workouts', 'WorkoutController');
    Route::delete('workouts/del/{user_id}/{workout_id}', 'WorkoutController@destroys')->name('workouts.destroys');

    Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
    Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
    Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);

    //program
    Route::post('programs/add', 'ProgramController@massAdd')->name('programs.massAdd');
    Route::post('programs/exadd', 'ProgramController@massUpdate')->name('programs.massUpdate');
    Route::get('programs/get_id/{id}', 'ProgramController@getId')->name('programs.getId');
    Route::delete('programs/destroy', 'ProgramController@massDestroy')->name('programs.massDestroy');
    Route::delete('programs/del', 'ProgramController@massDelete')->name('programs.massDelete');
    Route::resource('programs', 'ProgramController');
    Route::get('/send/email', 'HomeController@mail')->name('sendmail');
});
