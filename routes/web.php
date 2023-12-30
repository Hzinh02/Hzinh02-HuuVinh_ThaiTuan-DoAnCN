<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


//Frontend

Route::get('/', [HomeController::class, 'index'])->name('trangindex');
Route::get('/trangchu', [HomeController::class, 'index']);

//Login
Route::get('/register_login', [HomeController::class, 'form']);
Route::post('/register_login', [HomeController::class, 'PostRegister'])->name('register');
Route::get('/login', [HomeController::class, 'form'])->name('LoginPage');
Route::post('/login', [HomeController::class, 'PostLogin'])->name('login');

//Filter
Route::get('/drink/{x}', [HomeController::class, 'filter_drink'])->name('drink.filter');
Route::get('/sortdrinkpriceasc', [HomeController::class, 'sort_Drink_Asc'])->name('sort.drinkasc');
Route::get('/sortdrinkpricedesc', [HomeController::class, 'sort_Drink_Desc'])->name('sort.drinkdesc');
Route::get('/sortdrinknameasc', [HomeController::class, 'sort_Drink_Name_Asc'])->name('sort.drinknameasc');
Route::get('/sortdrinknamedesc', [HomeController::class, 'sort_Drink_Name_Desc'])->name('sort.drinknamedesc');
Route::get('/search', [HomeController::class, 'Search'])->name('drink.search');

Route::get('/sortdrinkascprice/{id}', [HomeController::class, 'sort_DrinkByCategory_Asc'])->name('sort.drinkascprice');
Route::get('/sortdrinkdescprice/{id}', [HomeController::class, 'sort_DrinkByCategory_Desc'])->name('sort.drinkdescprice');
Route::get('/sortdrinkascname/{id}', [HomeController::class, 'sort_DrinkNameByCategory_Asc'])->name('sort.drinkascname');
Route::get('/sortdrinkdescname/{id}', [HomeController::class, 'sort_DrinkNameByCategory_Desc'])->name('sort.drinkdescname');

Route::get('/detail/{id}', [HomeController::class, 'Detail'])->name('detail');



Route::prefix('trangchu')->middleware('isUser')->group(function () {
    Route::get('/', [HomeController::class, 'index'])->name('trangchu');

    //Cart
    Route::get('/drinkcart/{id}', [HomeController::class, 'addDrinktoCart'])->name('addtocart');
    Route::get('/shoppingcart', [HomeController::class, 'DrinkCart'])->name('shopping.cart');
    Route::delete('/deletecart', [HomeController::class, 'DeleteCart'])->name('delete_cart');
    Route::get('/change-qty/{id}', [HomeController::class, 'UpdateCart'])->name('update.cart');

    //Order
    Route::get('/order', [HomeController::class, 'formorder'])->middleware('checkCart');
    Route::post('/order', [HomeController::class, 'AddOrder'])->middleware('checkCart')->name('order.add');
    Route::get('/showorder', [HomeController::class, 'show_order'])->name('listorder');
    Route::get('/deleteorder/{id}', [HomeController::class, 'delete_order'])->name('order.delete');
    Route::get('/orderdetail/{id}', [HomeController::class, 'detail_order'])->name('order.detail');


    //Logout
    Route::get('/logout', [HomeController::class, 'LogOut'])->name('logoutuser');
});


//Backend
Route::prefix('admin')->middleware('isAdmin')->group(function () {
    Route::get('/', [AdminController::class, 'showdashboard'])->name('adminpage');

    //Category
    Route::get('/addcategory', [AdminController::class, 'formthem']);
    Route::post('/addcategory', [AdminController::class, 'add_category'])->name('cat.add');
    Route::get('/showcategory', [AdminController::class, 'show_category'])->name('listcategory');
    Route::get('/editcatgory/{id}', [AdminController::class, 'edit_category'])->name('cat.edit');
    Route::put('/updatecatgory/{id}', [AdminController::class, 'update_category'])->name('cat.update');
    Route::get('/deletecategory/{id}', [AdminController::class, 'delete_category'])->name('cat.delete');

    //Drink
    Route::get('/showdrink', [AdminController::class, 'show_drink'])->name('listdrink');
    Route::get('/adddrink', [AdminController::class, 'formthemdrink']);
    Route::post('/adddrink', [AdminController::class, 'add_drink'])->name('drink.add');
    Route::get('/editdrink/{id}', [AdminController::class, 'edit_drink'])->name('drink.edit');
    Route::put('/updatedrink/{id}', [AdminController::class, 'update_drink'])->name('drink.update');
    Route::get('/deletedrink/{id}', [AdminController::class, 'delete_drink'])->name('drink.delete');

    //User
    Route::get('/showusers', [AdminController::class, 'show_users'])->name('listusers');
    Route::get('/showorder_user', [AdminController::class, 'show_order_user'])->name('listorderuser');
    Route::get('/deleteuser/{email}', [AdminController::class, 'delete_user'])->name('user.delete');
    Route::get('/setroleadmin/{email}', [AdminController::class, 'admin_setrole'])->name('users.setroleadmin');
    Route::get('/unsetroleadmin/{email}', [AdminController::class, 'admin_unsetrole'])->name('users.unsetroleadmin');

    //Order
    Route::get('/orderconfirm/{id}', [AdminController::class, 'confirm_order'])->name('order.confirm');
    Route::get('/orderunconfirm/{id}', [AdminController::class, 'unconfirm_order'])->name('order.unconfirm');
    Route::get('/orderdelivery/{id}', [AdminController::class, 'delivery_order'])->name('order.delivery');

    //Logout
    Route::get('/logout', [AdminController::class, 'LogOut'])->name('logoutadmin');
});
