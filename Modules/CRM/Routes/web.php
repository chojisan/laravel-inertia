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

Route::prefix('crm')->name('crm.')->group(function() {

    // Organizations

    Route::middleware('auth')->resource('organizations', 'OrganizationsController');

    Route::put('organizations/{organization}/restore', 'OrganizationsController@restore')
    ->name('organizations.restore')
    ->middleware('auth');


    // Contacts

    Route::middleware('auth')->resource('contacts', 'ContactsController');

    Route::put('contacts/{contact}/restore', 'ContactsController@restore')
    ->name('contacts.restore')
    ->middleware('auth');


    // Reports

    Route::get('reports', 'ReportsController@index')
    ->name('reports')
    ->middleware('auth');
});
