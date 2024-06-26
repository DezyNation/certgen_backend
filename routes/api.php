<?php

use App\Http\Controllers\CertificateController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FormController;
use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\TemplateController;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('admin')->group(function () {
    Route::apiResource('forms', FormController::class);
    Route::apiResource('templates', TemplateController::class)->middleware('auth:api');
    Route::get('responses/{id}', [SubmissionController::class, 'responses'])->middleware('auth:api');
    Route::get('overview', [Controller::class, 'overview'])->middleware('auth:api');
    Route::get('download/{id?}', [SubmissionController::class, 'download'])->middleware('auth:api');
});
Route::apiResource('submissions', SubmissionController::class);

// Route::get('download-certificate/{id}', [CertificateController::class, 'show']);
Route::get('sample-certificate/{id}', [CertificateController::class, 'sample']);
Route::get('form/{id}', [FormController::class, 'activeForm']);
Route::get('my-certificates/{id}', [CertificateController::class, 'myCertificates']);
// ->middleware('auth:api');
