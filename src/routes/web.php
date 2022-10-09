<?php

use Illuminate\Support\Facades\Route;
use SimosFasouliotis\ImageToWebp\Controllers\ImageToWebpController;

Route::get('image-to-webp', ImageToWebpController::class);
