<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;

use App\Post;
use App\User;
use App\Like;
use App\Comment;
//use Symfony\Component\Routing\Annotation\Route;

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

Route::get('/', function () {
    return view('FrontView.index');
});

Auth::routes();
//this route is nessasary to edit route
Route::resource('users', 'UsersController');

Route::resource('employees', 'EmployeesController');

Route::resource('products', 'ProductsController');



Route::get('edit', 'UsersController@edit')->name('edit');

Route::get('edit', 'EmployeesController@edit')->name('edit');

Route::get('edit', 'ProductsController@edit')->name('edit');




Route::get('destroyuser/{id}', 'UsersController@destroyuser')->name('destroyuser');

Route::get('delete/{id}', 'EmployeesController@delete')->name('delete');

Route::get('destroy/{id}', 'ProductsController@destroy')->name('destroy');

Route::get('remove/{id}', 'ProductsController@remove')->name('remove');





Route::get('searchuser/{id}', 'UsersController@searchuser')->name('searchuser');

Route::get('searchemployee/{id}', 'EmployeesController@searchemployee')->name('searchemployee');

Route::get('searchproduct/{id}', 'ProductsController@searchproduct')->name('searchproduct');

Route::get('productdetails/{id}', 'ProductsController@productdetails')->name('productdetails');

Route::get('cart/{id}', 'ProductsController@cart')->name('cart');





Route::get('adduser', 'UsersController@adduser')->name('adduser');

Route::get('addemployee', 'EmployeesController@addemployee')->name('addemployee');

Route::get('addcateg', 'ProductsController@addcateg')->name('addcateg');

Route::get('addproduct', 'ProductsController@addproduct')->name('addproduct');


Route::match(['get', 'post'], 'ajax-image-upload','ProductsController@ajaxImage') ;





Route::get('/home', 'HomeController@index')->name('home');



Route::get('/userlist', 'UsersController@userlist')->name('userlist');

Route::get('/employeeList', 'EmployeesController@employeeList')->name('employeeList');

Route::get('/productlist', 'ProductsController@productlist')->name('productlist');

Route::get('/shop','ProductsController@shop')->name('shop')->middleware('auth');

Route::get('/contact','ProductsController@contact')->name('contact')->middleware('auth');


Route::get('/index','ProductsController@index')->name('index');

Route::get('/admin','HomeController@admin')->name('admin')->middleware('auth');

Route::get('/cart_details','ProductsController@cart_details')->name('cart_details')->middleware('auth');

//Route::get('/notification','ContactsController@notification')->name('notification');


Route::get('contactmsg','ContactsController@contactmsg')->name('contactmsg');

Route::get('/redirect', 'SocialAuthFacebookController@redirect');
Route::get('/callback', 'SocialAuthFacebookController@callback');
