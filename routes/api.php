<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RouteController;

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


// ****************API For Our Pizza_Order_project****************
/* 
*   for product list
*   /api/productlist(get)
*
*   for category list
*   /api/categoryList(get)
*   
*   for Category Delete
*   /api/categoryDelete(post)
*   {
*       'id'=>category_id,
*    }
*
*
*  for contact create
*   /api/contactCreate(post)
*   {
*       'name'=>'user_name',
*       'email'=>'email',
*       'message'=>'message',
*   }
*
*
*
*  for categoryCreate
*   /api/categoryCreate(post)
*   {
*       'name'=>'category_name',
*   }
*
*
*  for categoryEdit
*   /api/categoryEdit/{id}(get)
*
*
*
*
*    for categoryUpdate
*    /api/categoryUpdate(post)
*    {
*       id=>'id for update',
*       name=>'update_category_name',
*         
*     }
*
****************************************************/




//get
Route::get('productList',[RouteController::class,'productlist']);
Route::get('categoryList',[RouteController::class,'categoryList']);
// edit 
Route::get('categoryEdit/{id}',[RouteController::class,'categoryEdit']);

//category Delete
Route::post('categoryDelete',[RouteController::class,'categoryDelete']);

//message Create
Route::post('contactCreate',[RouteController::class,'contactCreate']);

//update
Route::post('categoryCreate',[RouteController::class,'categoryCreate']);
Route::post('categoryUpdate',[RouteController::class,'categoryUpdate']);