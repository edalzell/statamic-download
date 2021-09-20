<?php

use Edalzell\Download\DownloadController;
use Illuminate\Support\Facades\Route;

Route::get('file', [DownloadController::class, '__invoke'])->name('download.show');
