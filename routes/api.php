<?php

use App\Http\Controllers\CellController;
use App\Http\Controllers\DecorController;
use App\Http\Controllers\TypeMaterialController;
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


//Route::post('v1/cell',['App\Http\Controllers\CellController','set_cell']);
//Route::get('test/ddd', function () {
//    return 'sdfsdfdfdf';
//});
Route::post('v1/cell/delete', [CellController::class, 'destroy']);
Route::put('v1/cell/update/{id}', function (Cell $cell) {
    return (new CellController)->update($cell);
});

Route::get('/users/{user}', function (User $user) {
    return $user->email;
});
Route::post('v1/cell',['App\Http\Controllers\CellController','tranporate']);
Route::post('v1/cell/update', [CellController::class, 'CellUpdate']);
Route::post('v1/cell/destroy', [CellController::class, 'CellDestroy']);
Route::post('v1/cell/get', [CellController::class, 'CellGet']);

//test pull
Route::get('test',[DecorController::class, 'testURL2'])->whereNumber('id');//where('id','[0-9]');//test
Route::get('test/{part_1?}/{part_2?}',[DecorController::class, 'testURL']);//test



Route::get('v1/decor/create_or_update', [DecorController::class, 'DecorCreateAndUpdate']);
//Route::post('v1/decor/update', [DecorController::class, 'DecorUpdate']);
Route::get('v1/decor', [DecorController::class, 'DecorGet']);
Route::post('v1/decor/destroy', [DecorController::class, 'DecorDestroy']);

Route::post('v1/type-material/create', [TypeMaterialController::class, 'TypeMaterialCreate']);
Route::post('v1/type-material/get', [TypeMaterialController::class, 'TypeMaterialGet']);
Route::post('v1/type-material/destroy', [TypeMaterialController::class, 'TypeMaterialDestroy']);

/** Admin User routes */
//Route::group(['middleware' => [Helper::getImplodeRoleNames([])]], static function () {
//    /** User  routes */
//    Route::get('/users', [UsersController::class, 'index']);
//    Route::get('/users/search/{name}', [UsersController::class, 'search']);
//    Route::get('/roles', [RolesController::class, 'index']);
//});
//Route::put('/services/{id}', [ServiceController::class, 'update']);
