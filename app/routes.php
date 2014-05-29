<?php

/**
 * Root route
 */
Route::get('/', 'IndexController@index');
Route::get('/profile', 'ProfileController@index');

/**
 * Route authtest
 */
Route::get(
    '/authtest',
    [
        'before' => 'auth.basic',
        function () {
            return View::make('profile');
        }
    ]
);

/**
 * Templates resource
 */
Route::resource('templates', 'TemplatesController');

/**
 * UploadsController
 */

Route::post('upload', 'UploadsController@upload');
Route::post('resume', 'UploadsController@resume');

/**
 * TemplateRestController
 */
Route::group(
    ['prefix' => 'api/exa'],
    function () {
        Route::resource('users', 'UserRestController');
        Route::resource('events', 'EventRestController');
        Route::resource('speakers', 'SpeakerRestController');
        Route::resource('sessions', 'SessionRestController');
	    Route::resource('sponsors', 'SponsorsRestController');
	    Route::resource('exhibitors', 'ExhibitorsRestController');
	    Route::resource('booths', 'BoothsRestController');

    }
);
  

/**
 * Groups resource
 */

Route::resource('groups', 'GroupsController');


/**
 * Users resource
 */
Route::controller('users', 'UsersController');

Route::resource('managers', 'ManagersController');

/**
*   Events resource
*/
Route::resource('events', 'EventsController');

/**
*   Speaker resource
*/
Route::resource('speakers', 'SpeakersController');

/**
*   Speaker resource
*/
Route::resource('session', 'MysessionsController');


Route::resource('sponsors', 'SponsorsController');
// Route::resource('sponsers', 'SponsorsController');
Route::resource('exhibitors', 'ExhibitorsController');
Route::resource('booths', 'BoothsController');

