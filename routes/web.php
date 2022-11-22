<?php

use App\Http\Controllers\GuideProductionMaterialController;
use App\Http\Controllers\Web\Decor\WebCellController;
use App\Http\Controllers\Web\Decor\WebDecorController;
use App\Http\Controllers\Web\Decor\WebMaterialController;
use App\Http\Controllers\Web\Decor\WebStoryMaterialController;
use App\Http\Controllers\Web\Decor\WebTypeMaterialController;
use Illuminate\Support\Facades\Route;

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



Route::get('/laravel', function () {
    return view('welcome');
});
//Route::get('/', function (){
//    return view('production_material');
//});
Route::get('/material/{material}', [WebMaterialController::class, 'index']);

//Route::get('/cell', function (){
//    return view('cell');
//});

//Route::get('/cell', [WebCellController::class, 'dd']);

Route::get('/cell/update/{storage_id}', [WebCellController::class, 'ViewCellUpdate']);
Route::get('/cell/rack/all//{storage_id}', [WebCellController::class, 'GetCellRackAll']);
Route::get('/cell/{storage_id}', [WebCellController::class, 'CellGet']);
Route::post('/cell/{storage_id}', [WebCellController::class, 'CellUpdate']);
Route::delete('/cell/{storage_id}', [WebCellController::class, 'CellDestroy']);


//Route::get('/decor', function (){
//    return view('decor');
//});

Route::get('/decor', [WebDecorController::class, 'DecorGet']);
Route::get('/decor/{id}/{decorName}', [WebDecorController::class, 'DecorWebCU']);
Route::post('/decor', [WebDecorController::class, 'DecorCreateAndUpdate']);
Route::delete('/decor/{id}', [WebDecorController::class, 'DecorDestroy']);


//Route::get('/type_material', function (){
//    return view('type_material');
//});
Route::get('/type_material', [WebTypeMaterialController::class, 'TypeMaterialGet']);
Route::get('/type_material/{id}/{tmName}', [WebTypeMaterialController::class, 'GetCreateTypeMaterial']);
Route::post('/type_material', [WebTypeMaterialController::class, 'TypeMaterialCreate']);
Route::delete('/type_material/{id}', [WebTypeMaterialController::class, 'TypeMaterialDestroy']);



Route::get('/story_material', [WebStoryMaterialController::class, 'StoryMaterialGet']);
//Route::get('/story_material', function (){
//    return view('story_material');
//});
