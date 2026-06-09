<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return ('Welcome To Agripath route is working');
});

Route::get('/darshan', function (){
    return ('Hello Darshan');
});
