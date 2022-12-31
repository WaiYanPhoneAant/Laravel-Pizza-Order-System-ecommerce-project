<?php


use App\Models\Product;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\User\AjaxController;
use App\Http\Controllers\User\UserController;





// login,register
Route::middleware(['admin_auth'])->group(function () {
    Route::redirect('/', 'loginPage');
    Route::get('loginPage',[AuthController::class,'loginPage'])->name('auth#loginPage');
    Route::get('registerPage',[AuthController::class,'registerPage'])->name('auth#registerPage');

});






Route::middleware([
    'auth',
])->group(function () {

    //dashboard
    Route::get('dashboard',[AuthController::class,'dashboard'])->name('dashboard');


    Route::middleware(['admin_auth'])->group(function(){
        // category
        Route::prefix('category')->group(function(){
            Route::get('list',[CategoryController::class,'list'])->name('category#list');
            
            // to view category page ui
            Route::get('create/page',[CategoryController::class,'createPage'])->name('category#createPage');
            
            // to create category data cteate
            Route::post('create',[CategoryController::class,'create'])->name('category#create');

            //delete category
            Route::get('delete/{id}',[CategoryController::class,'delete'])->name('category#delete');


            //to show update_page 
            Route::get('edit/{id}',[CategoryController::class,'editpage'])->name('category#editpage');

            //to update data
            Route::post('update',[CategoryController::class,'update'])->name('category#update');

        });

        // admin account

        Route::prefix('admin')->group(function () {
            //password
            Route::get('password/change',[AdminController::class,'changePasswordPage'])->name('admin#changePasswordPage');
            Route::post('change/password',[AdminController::class,'changePassword'])->name('admin#changePassword');

            //profile
            Route::get('details',[AdminController::class,'detail'])->name('admin#details');
            Route::get('edit',[AdminController::class,'edit'])->name('admin#edit');
            Route::post('update',[AdminController::class,'update'])->name('admin#update');

            //adminlist
            Route::get('list',[AdminController::class,'list'])->name('admin#list');
           //admin acc delete
           Route::get('delete/{id}',[AdminController::class,'delete'])->name('admin#delete'); 

           //admin role change
           Route::get('role/changePage/{id}',[AdminController::class,'rolePage'])->name('admin#rolePage'); 

           //update admin role
           Route::post('role/update/{id}',[AdminController::class,'roleupdate'])->name('admin#roleupdate');

           //customer list for admin page
           Route::get('customerList',[AdminController::class,'customerList'])->name('customer#list');
           
           //customer mails list
           Route::get('mails/list',[ContactController::class,'customerMailList'])->name('mails#List');
           //ajax 
           Route::prefix('ajax')->group(function () {
                Route::get('/order/filterStatus',[AjaxController::class,'filterStatus'])->name('ajax#filterStatus');
                Route::get('/order/statusUpdate',[AjaxController::class,'statusUpdate'])->name('order#statusUpdate');
                Route::get('/user/RoleChange/',[AjaxController::class,'rolechange'])->name('user#rolechange');
                
            });
        });

        Route::prefix('products')->group(function () {
            Route::get('list',[ProductController::class,'list'])->name('products#list');
            Route::get('create',[ProductController::class,'createPage'])->name('products#createPage');
            Route::post('create',[ProductController::class,'create'])->name('products#create');
            Route::get('delete/{id}',[ProductController::class,'delete'])->name('products#delete');
            Route::get('detail/{id}',[ProductController::class,'detail'])->name('products#detail');
            Route::get('update/page/{id}',[ProductController::class,'updatePage'])->name('products#updatePage');
            Route::post('update/{id}',[ProductController::class,'update'])->name('products#update');
        });

        Route::prefix('order')->group(function () {
            Route::get('list',[OrderController::class,'orderList'])->name('Order#list');
            Route::get('orderInfo/{order_code}',[OrderController::class,'orderInfo'])->name('order#Info');
            
        });
        
    });


    

    // User
    Route::group(['prefix'=>'user','middleware'=>['user_auth']],function(){
        Route::get('/home',[UserController::class,'home'])->name('user#home');

        // account detail
        Route::prefix('account')->group(function () {
            Route::get('/detail',[UserController::class,'accountdetail'])->name('account#detail'); 
            Route::get('/editPage',[UserController::class,'accounteditPage'])->name('account#editPage');
            Route::post('/update',[UserController::class,'accountupdate'])->name('account#update');
        });   

        Route::prefix('/password')->group(function () {
            Route::get('/changePage',[UserController::class,'pwChangePage'])->name('password#changePage');     
            Route::post('/change',[UserController::class,'passwordChange'])->name('password#change');    
            
            
        });

        Route::prefix('ajax')->group(function () {
            Route::get('/pizzaList',[AjaxController::class,'pizzaList'])->name('ajax#list');
            Route::get('/pizzafilter',[AjaxController::class,'filter'])->name('ajax#filter');
            Route::get('/AddtoCart',[AjaxController::class,'addtoCart'])->name('ajax#AddtoCart');
            Route::get('/order',[AjaxController::class,'order'])->name('order');
            Route::get('/ClearAllCarts',[AjaxController::class,'clearAllCarts'])->name('ajax#clearAllCarts');
            Route::get('/ClearOneItemCart',[AjaxController::class,'ClearOneItemCart'])->name('ajax#ClearOneItemCart');
            Route::get('/product/viewCount/',[AjaxController::class,'viewcount'])->name('product#viewcount');
           
        });

        Route::prefix('products')->group(function () {
            Route::get('/detail/{id}',[UserController::class,'detail'])->name('pizza#detail');
           
        });

        Route::prefix('cart')->group(function () {
            Route::get('/list',[CartController::class,'cartList'])->name('cart#list');
            Route::get('/order/history',[CartController::class,'Orderhistroy'])->name('order#history');
        });

        Route::prefix('contact')->group(function () {
            Route::get('/contactPage',[ContactController::class,'contactPage'])->name('contact#page');
            Route::post('/contactSend',[ContactController::class,'contactSend'])->name('contact#send');
        });
    });
});


