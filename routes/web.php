<?php

Route::group(['middleware' => ['XSS']], function () {

    /* language */
    Route::get('/translate/{translate}', 'CommonController@cookie_translate');
    /* language */

    Route::get('/', 'CommonController@view_index');
    Route::get('/index', 'CommonController@view_index');

    Auth::routes();

    Route::get('/logout', 'Admin\CommonController@logout');

    /* Crawler */
    Route::post('/crawlerSite', ['as' => 'crawlerSite', 'uses' => 'CommonController@update_crawlerSite']);
});
