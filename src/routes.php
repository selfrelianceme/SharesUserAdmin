<?php

Route::group(['prefix' => config('adminamazing.path').'/sharesuseradmin', 'middleware' => ['web','CheckAccess']], function() {
	Route::get('/', 'Selfreliance\SharesUserAdmin\SharesUserAdminController@index')->name('SharesUserAdmin');
	Route::get('/create', 'Selfreliance\SharesUserAdmin\SharesUserAdminController@create')->name('SharesUserAdminCreate');
	Route::post('/create', 'Selfreliance\SharesUserAdmin\SharesUserAdminController@store')->name('SharesUserAdminStore');
});
