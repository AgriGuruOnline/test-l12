<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/', function () {
    return back()->with('success', 'Form submitted successfully!');
});
