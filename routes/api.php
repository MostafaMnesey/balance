<?php

use App\Http\Controllers\Api\Auth\AuthController;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::post('patients/register', [AuthController::class, 'register'])->name('patients.register');
Route::post('patients/login', [AuthController::class, 'login'])->name('patients.login');