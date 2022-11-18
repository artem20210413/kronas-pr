<?php

use App\Http\Controllers\Api\DecorController;
use App\Http\Controllers\Api\CellController;
use App\Http\Controllers\Api\StoryMaterialController;
use App\Http\Controllers\Api\TypeMaterialController;
use App\Http\Controllers\Api\MaterialController;
use App\Http\Middleware\EnsureTokenIsValid;
use App\Models\Cell;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('v1/cell/delete', [CellController::class, 'destroy']);
//Route::put('v1/cell/update/{id}', function (Cell $cell) {
//    return (new CellController)->update($cell);
//});

//Route::get('/users/{user}', function (User $user) {
//    return $user->email;
//});


//Route::get('test/{part_1?}/{part_2?}',[DecorController::class, 'testURL']);//test



/* снять  матреиал с учета / для мобильной версии */
Route::get('v1/user/{user}/material/{material_id}/take', [MaterialController::class, 'takeMaterial'])->middleware('check_token');
/* переместить материал в ячейку / для мобильной версии */
Route::get('v1/user/{user}/material/{material_id}/cell/{cell_id}/move', [MaterialController::class, 'moveMaterial'])->middleware('check_token');

Route::get('v1/material/help', [MaterialController::class, 'MaterialHelp'])->middleware('check_token');
Route::get('v1/material', [MaterialController::class, 'MaterialGet'])->middleware('check_token');
Route::post('v1/material', [MaterialController::class, 'MaterialPost']);
Route::delete('v1/material', [MaterialController::class, 'MaterialDelete'])->middleware('check_token');


Route::get('v1/story-material', [StoryMaterialController::class, 'StoryMaterialGet'])->middleware('check_token');

//Route::get('v1/cell/{cell_id}/get', [CellController::class, 'CellId']);
Route::get('v1/cell', [CellController::class, 'cellGet'])->middleware('check_token');
Route::post('v1/cell', [CellController::class, 'CellUpdate'])->middleware('check_token');
Route::delete('v1/cell', [CellController::class, 'CellDestroy'])->middleware('check_token');


Route::get('v1/decor', [DecorController::class, 'DecorGet'])->middleware('check_token');
Route::post('v1/decor', [DecorController::class, 'DecorCreateAndUpdate'])->middleware('check_token');
Route::delete('v1/decor', [DecorController::class, 'DecorDestroy'])->middleware('check_token');

Route::get('v1/type-material', [TypeMaterialController::class, 'TypeMaterialGet'])->middleware('check_token');
Route::post('v1/type-material', [TypeMaterialController::class, 'TypeMaterialCreate'])->middleware('check_token');
Route::delete('v1/type-material', [TypeMaterialController::class, 'TypeMaterialDestroy'])->middleware('check_token');

/** Admin User routes */
//Route::group(['middleware' => [Helper::getImplodeRoleNames([])]], static function () {
//    /** User  routes */
//    Route::get('/users', [UsersController::class, 'index']);
//    Route::get('/users/search/{name}', [UsersController::class, 'search']);
//    Route::get('/roles', [RolesController::class, 'index']);
//});
//Route::put('/services/{id}', [ServiceController::class, 'update']);
