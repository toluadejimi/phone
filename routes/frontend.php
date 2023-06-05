<?php 
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AUTH\RegisterController;
use App\Http\Controllers\Frontend as FRONTEND;



Auth::routes();
Route::get('/',  			        [FRONTEND\HomeController::class,'index']);
Route::get('/',  			        [FRONTEND\HomeController::class,'index']);
Route::post('/register-user', 		    [AUTH\RegisterController::class,'create']);




?>