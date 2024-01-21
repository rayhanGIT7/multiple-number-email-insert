<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetDataController;




// Route::get('/', function () {
//     return view('index');
// });

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



Route::get('/', [EmployeeController::class, 'create'])->name('index');

Route::post('/insert',[EmployeeController::class,'store'])->name('employee.insert');
Route::get('/getData', [GetDataController::class, 'GetData'])->name('employee.getData');

require __DIR__.'/auth.php';
