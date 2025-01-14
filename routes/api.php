<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::group(['middleware' => 'jwt.auth'], function() {
    // User
    Route::post('profile', 'API\UserController@profile');
    Route::put('profile', 'API\UserController@edit');
    Route::put('profile/edit-password', 'API\UserController@editPassword');
    Route::post('profile/image', 'API\UserController@uploadImage');
    Route::delete('profile', 'API\UserController@delete');

    // Bookmarks
    Route::post('bookmark/{id}', 'API\UserController@addBookmark');
    Route::delete('bookmark/{id}', 'API\UserController@deleteBookmark');

    // Course review, tags and skills
    Route::group(['middleware' => 'user.verified'], function () {
        Route::post('courses/{id}/review', 'CourseController@review');
        Route::post('courses/{id}/tags', 'CourseController@attachTags');
        Route::post('courses/{id}/skills', 'CourseController@attachSkills');
    });

    Route::get('courses/{id}/review', 'CourseController@getReview');

});


Route::post('login', 'API\UserController@loginJWT');
Route::post('register', 'API\UserController@registerJWT');
Route::get('register/activate/{token}', 'API\UserController@activate');

// Search
Route::get('/courses/search', 'CourseController@search');

// Quick search
Route::get('/courses/quick-search', 'CourseController@quickSearch');
Route::get('/professors/quick-search', 'ProfessorController@quickSearch');
Route::get('/skills/quick-search', 'SkillsController@quickSearch');
Route::get('/majors/quick-search', 'MajorController@quickSearch');

Route::resources([
    'courses' => 'CourseController',
    'professors' => 'ProfessorController',
    'universities' => 'UniversityController',
    'faculties' => 'FacultyController',
//    'departments' => 'DepartmentController',
    'chairs' => 'ChairController',
]);

// Load course prev reviews
Route::get('courses/{id}/reviews', 'CourseController@loadReviews');


/**
 * Tags
 */
Route::get('/tags/courses', 'CoursesTagsController@index');
Route::get('/tags/courses/{courseTag}', 'CoursesTagsController@show');
Route::get('/tags/professors', 'ProfessorsTagsController@index');
Route::get('/tags/professors/{courseTag}', 'ProfessorsTagsController@show');


//Route::group(['middleware' => ['auth:api', 'role:super-admin']], function () {
//    Route::post('fau', 'Univis\FauController@fau');
//});
