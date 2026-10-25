<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JobController;


Route::get('/', function () {
    return redirect()->route('jobs.create');
});

//contact form routes


Route::get('/jobs/create', [JobController::class, 'create'])->name('jobs.create');


Route::post('/jobs', [JobController::class, 'store'])->name('jobs.store');
