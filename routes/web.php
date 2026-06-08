<?php

use App\Http\Controllers\SuratController;
\Route::resource('surat', SuratController::class);



//Route::get('/', [SuratController::class, 'daftarSurat']);
Route::resource('surat', SuratController::class);

