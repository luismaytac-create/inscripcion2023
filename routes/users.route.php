<?php
Route::group(['namespace' => 'Users'], function() {
	Route::resource('users', 'UsersController');
});

