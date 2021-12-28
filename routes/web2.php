<?php

Route::prefix('admin-ui')->as('admin.')->middleware('admin')->namespace('App\Http\Controllers\Admin')->group(function(){
	Route::resource('plans', PlansController::class);

});

