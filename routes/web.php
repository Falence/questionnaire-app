<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppController;
use App\Http\Controllers\QuestionnaireController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\SurveyController;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [AppController::class, 'index'])->name('home');

Route::get('/questionnaires/create', [QuestionnaireController::class, 'create']);
Route::post('/questionnaires', [QuestionnaireController::class, 'store']);
Route::get('/questionnaires/{questionnaire}', [QuestionnaireController::class, 'show']);

Route::get('/questionnaires/{questionnaire}/questions/create', [QuestionController::class, 'create']);
Route::post('/questionnaires/{questionnaire}/questions', [QuestionController::class, 'store']);

Route::get('/surveys/{questionnaire}-{slug}', [SurveyController::class, 'show']);
Route::post('/surveys/{questionnaire}-{slug}', [SurveyController::class, 'store']);
