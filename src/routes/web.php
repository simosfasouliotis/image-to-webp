<?php

use Illuminate\Support\Facades\Route;
use SimosFasouliotis\ImageToWebp\Controllers\ImageToWebpController;

$urlPrefix = config('imageToWebp.urlSegment');

Route::get('assets/img/' . $urlPrefix . '/{pathSegment1}/{pathSegment2}/{filename}', ImageToWebpController::class)
    ->where('pathSegment1', '[a-zA-Z]+')
    ->where('pathSegment2', '[a-zA-Z]+')
    ->where('filename', '(.*)\.(webp)');
Route::get('assets/img/' . $urlPrefix . '/{pathSegment1}/{filename}', ImageToWebpController::class)
    ->where('pathSegment1', '[a-zA-Z]+')
    ->where('filename', '(.*)\.(webp)');
Route::get('assets/img/' . $urlPrefix . '/{filename}', ImageToWebpController::class)
    ->where('filename', '(.*)\.(webp)');
