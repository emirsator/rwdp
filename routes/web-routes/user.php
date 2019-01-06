<?php 

Route::group(['middleware' => 'can:manage-users'], function () {
    // User routes
    Route::get('/user', ['as' => 'users', 'uses' => 'UserController@index']);
    Route::delete('/user/{id}', ['as' => 'users.delete', 'uses' => 'UserController@delete']);
    
    Route::get('/user/create', ['as' => 'users.createview', 'uses' => 'UserController@createview']);
    Route::post('/user/create', ['as' => 'users.create', 'uses' => 'UserController@create']);
    
    Route::get('/user/edit/{id}', ['as' => 'users.editview', 'uses' => 'UserController@editview']);
    Route::put('/user/edit/{id}', ['as' => 'users.edit', 'uses' => 'UserController@edit']);
    
    Route::post('/user/{id}/role', ['as' => 'users.addrole', 'uses' => 'UserController@addRole']);
    Route::delete('/user/{userId}/role/{roleUserId}', ['as' => 'users.deleterole', 'uses' => 'UserController@deleteRole']);
    Route::get('/user/{id}/roles', ['as' => 'users.roles', 'uses' => 'UserController@roles']);
    
    Route::post('/user/{id}/document', ['as' => 'users.adddocument', 'uses' => 'UserController@adddocument']);

    Route::get('/user/{id}', ['as' => 'users.details', 'uses' => 'UserController@details']);
});