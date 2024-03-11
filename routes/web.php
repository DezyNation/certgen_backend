<?php

use App\Models\Form;
use App\Models\User;
use App\Models\Submission;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Hash;
use Intervention\Image\ImageManager;
use Illuminate\Support\Facades\Route;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\Typography\FontFactory;

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
    User::create([
        'name'  => 'Admin',
        'email' > 'admin@itasinc.com',
        'password' => Hash::make('@40Kmph00')
    ]);
    return ['iTasinc' => 'v1'];
});

require __DIR__ . '/auth.php';
