<?php

use Illuminate\Support\Facades\Route;

use App\Http\Livewire\Assignments;
use App\Http\Livewire\Catatans;
use App\Http\Livewire\Jams;
use App\Http\Livewire\Materials;
use App\Http\Livewire\Nilais;

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

Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('assignment', Assignments::class)->name('assignment');

Route::get('catatan', Catatans::class)->name('catatan');

Route::get('jam', Jams::class)->name('jam');

Route::get('material', Materials::class)->name('material');

Route::get('nilai', Nilais::class)->name('nilai');