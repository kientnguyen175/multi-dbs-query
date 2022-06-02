<?php

Route::get('/index', function() {
    return view('index');
})->middleware('basicAuth');
