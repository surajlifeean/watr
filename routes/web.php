<?php

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
    return view('welcome');
});


// Route::get('/report', function () {
//     return view('report');
// });

// Route::get('/about', function () {
//     return view('about');
// });



// Route::get('/contact', function () {
//     return view('contact');
// });




// Route::get('/doctors-chamber', function () {
//     return view('doctorsChamber');
// });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/about', 'HomeController@about')->name('about');
Route::get('/send-otp/{email}', 'EmailController@sendOtp');

#Route::get('user/{id}', 'UserController@show');

Route::prefix('admin')->group(function() {

	Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
	Route::post('/login','Auth\AdminLoginController@login')->name('admin.login.submit');
	Route::get('/', 'AdminController@index')->name('admin');
    Route::resource('parameter', 'Admin\ParameterManagementController');
    Route::resource('test', 'Admin\TestManagementController');
    Route::get('parameter/delete/{id}', array('as' => 'admin.parameter.delete', 'uses' => 'Admin\ParameterManagementController@delete'));
    Route::get('test/delete/{id}', array('as' => 'admin.test.delete', 'uses' => 'Admin\TestManagementController@delete'));
    // Route::get('/user/{$id}', 'Admin\UserManagementController@show')->name('admin.user.show');
    Route::get('user/{id}', array('as' => 'admin.user.show', 'uses' => 'Admin\UserManagementController@show'));

    Route::get('/user', 'Admin\UserManagementController@index')->name('admin.user.index');

    Route::resource('contact', 'Admin\ContactController');

    Route::resource('aboutus', 'Admin\AboutusController');

    Route::resource('partner', 'Admin\PartnerController');

    Route::resource('assistance', 'Admin\AssistanceController');

    Route::resource('order', 'Admin\OrderController');

    Route::resource('report', 'Admin\ReportController');

    Route::get('/pdfreport/{id}', 'Admin\ReportController@pdfReport')->name('admin.pdfreport');

    Route::resource('recommendation', 'Admin\RecommendationController');

    Route::resource('param-recomm', 'Admin\ParamRecommController');

    Route::post('/logout','Auth\AdminLoginController@logout')->name('admin.logout');

    Route::get('partner/statuschange/{id}', array('as' => 'admin.partner.statuschange', 'uses' => 'Admin\PartnerController@statuschange'));

    Route::get('assistance/statuschange/{id}', array('as' => 'admin.assistance.statuschange', 'uses' => 'Admin\AssistanceController@statuschange'));

    Route::get('recommendation/delete/{id}', array('as' => 'admin.recommendation.delete', 'uses' => 'Admin\RecommendationController@delete'));

});


    Route::prefix('member')->group(function() {

	Route::get('/login', 'Auth\MemberLoginController@showLoginForm')->name('partner.login');
	Route::post('/login','Auth\MemberLoginController@login')->name('member.login.submit');
	Route::get('/','MemberController@index')->name('member');
    Route::post('/logout','Auth\MemberLoginController@logout')->name('member.logout');
    Route::resource('order-member', 'Admin\OrderController');

 //    Route::resource('parameter', 'Admin\ParameterManagementController');
 //    Route::resource('test', 'Admin\TestManagementController');   
});