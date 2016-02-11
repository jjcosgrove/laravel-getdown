<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => 'web'], function () {
    Route::auth();
    Route::get('/', [
        'as' => 'home',
        'uses' => function(){
            return View('home');
        }
    ]);

    //templates
    Route::get('/templates', [
        'as' => 'templates',
        'uses' => 'AppController@templates'
    ]);
    Route::get('/templates/new', [
        'as' => 'create-new-template',
        'uses' => 'AppController@createNewTemplate'
    ]);
    Route::post('/templates/new', [
        'as' => 'save-template',
        'uses' => 'AppController@saveTemplate'
    ]);
    Route::get('/templates/view/{id}', [
        'as' => 'view-template',
        'uses' => 'AppController@viewTemplate'
    ]);
    Route::get('/templates/edit/{id}', [
        'as' => 'edit-template',
        'uses' => 'AppController@editTemplate'
    ]);
    Route::post('/templates/edit/{id}', [
        'as' => 'update-template',
        'uses' => 'AppController@updateTemplate'
    ]);
    Route::get('/templates/delete/{id}', [
        'as' => 'delete-template',
        'uses' => 'AppController@deleteTemplate'
    ]);

    //documents
    Route::get('/documents', [
        'as' => 'documents',
        'uses' => 'AppController@documents'
    ]);
    Route::get('/documents/new', [
        'as' => 'create-new-document',
        'uses' => 'AppController@createNewDocument'
    ]);
    Route::get('/documents/new/{id}', [
        'as' => 'create-new-document-from-template',
        'uses' => 'AppController@createNewDocumentFromTemplate'
    ]);
    Route::post('/documents/new', [
        'as' => 'save-document',
        'uses' => 'AppController@saveDocument'
    ]);
    Route::get('/documents/view/{id}', [
        'as' => 'view-document',
        'uses' => 'AppController@viewDocument'
    ]);
    Route::get('/documents/edit/{id}', [
        'as' => 'edit-document',
        'uses' => 'AppController@editDocument'
    ]);
    Route::post('/documents/edit/{id}', [
        'as' => 'update-document',
        'uses' => 'AppController@updateDocument'
    ]);
    Route::get('/documents/delete/{id}', [
        'as' => 'delete-document',
        'uses' => 'AppController@deleteDocument'
    ]);

    //preferences
    Route::get('/preferences', [
        'as' => 'get-preferences',
        'uses' => 'AppController@getPreferences'
    ]);
    Route::post('/preferences', [
        'as' => 'update-preferences',
        'uses' => 'AppController@updatePreferences'
    ]);
});