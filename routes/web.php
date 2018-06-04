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
Route::get('/search', 'ShipmentController@search')->name('search');
Route::get('/algoria', function () {
	return view('search');
});

Route::get('/map', function () {
	return view('csv.map');
});

Route::get('/', function () {
	return view('view');
});

Auth::routes();

Route::get('/courier/{name}', function () {
	return redirect('/');
})->where('name', '[A-Za-z]+');

Route::get('/courier', function () {
	$newrole = Auth::user()->roles;
	// var_dump($newrole); die;
	foreach ($newrole as $name) {
		$rolename = $name->name;
	}
	return view('welcome', compact('rolename'));
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('users', 'UserController');
Route::resource('roles', 'RoleController');
Route::resource('shipment', 'ShipmentController');
Route::resource('product', 'ProductController');
Route::resource('reports', 'ReportController');
Route::resource('container', 'ContainerController');
Route::resource('branches', 'BranchController');

Route::post('updateStatus/{id}', 'ShipmentController@updateStatus')->name('updateStatus');
Route::post('barcodeUpdate/{bar_code}', 'ShipmentController@barcodeUpdate')->name('barcodeUpdate');
Route::post('barcodeIn/{bar_code}', 'ShipmentController@barcodeIn')->name('barcodeIn');
Route::get('csv', 'ShipmentController@csv')->name('csv');
Route::post('csv/import', 'ShipmentController@import')->name('import');
Route::post('getShipments', 'ShipmentController@getShipments')->name('getShipments');
Route::post('csv/export', 'ShipmentController@export')->name('export');
Route::post('getcoordinatesArray/{id}', 'ShipmentController@getcoordinatesArray')->name('getcoordinatesArray');

Route::post('AddShipments/{id}', 'ContainerController@AddShipments')->name('AddShipments');
Route::post('conupdateStatus/{id}', 'ContainerController@conupdateStatus')->name('conupdateStatus');
Route::post('getShipmentArray/{id}', 'ContainerController@getShipmentArray')->name('getShipmentArray');
Route::post('getContainers', 'ContainerController@getContainers')->name('getContainers');

Route::post('productAdd/{id}', 'ProductController@productAdd')->name('productAdd');
Route::post('getProducts', 'ProductController@getProducts')->name('getProducts');

Route::post('getUsers', 'UserController@getUsers')->name('getUsers');
Route::post('getLogedinUsers', 'UserController@getLogedinUsers')->name('getLogedinUsers');
Route::post('profile/{id}', 'UserController@profile')->name('profile');

Route::post('getUsersRole', 'RoleController@getUsersRole')->name('getUsersRole');
Route::post('getRoles', 'RoleController@getRoles')->name('getRoles');

Route::post('getBranch', 'BranchController@getBranch')->name('getBranch');

// Reports

Route::post('shipmentExpo', 'ReportController@shipmentExpo')->name('shipmentExpo');
Route::post('userExpo', 'ReportController@userExpo')->name('userExpo');
Route::post('ratesExpo', 'ReportController@ratesExpo')->name('ratesExpo');
Route::post('customersExpo', 'ReportController@customersExpo')->name('customersExpo');
Route::post('branchesExpo', 'ReportController@branchesExpo')->name('branchesExpo');
Route::post('agentsExpo', 'ReportController@agentsExpo')->name('agentsExpo');
Route::post('cancledExpo', 'ReportController@cancledExpo')->name('cancledExpo');
Route::post('pendingExpo', 'ReportController@pendingExpo')->name('pendingExpo');
Route::post('bookingExpo', 'ReportController@bookingExpo')->name('bookingExpo');
Route::post('approvedExpo', 'ReportController@approvedExpo')->name('approvedExpo');

Route::post('userDateExpo', 'ReportController@userDateExpo')->name('userDateExpo');

// Socialite
Route::get('login/{service}', 'Auth\LoginController@redirectToProvider');
Route::get('login/{service}/callback', 'Auth\LoginController@handleProviderCallback');

// Dashboard
Route::post('delayedShipment', 'ShipmentController@delayedShipment')->name('delayedShipment');
Route::post('approvedShipment', 'ShipmentController@approvedShipment')->name('approvedShipment');
Route::post('waitingShipment', 'ShipmentController@waitingShipment')->name('waitingShipment');
Route::post('deriveredShipment', 'ShipmentController@deriveredShipment')->name('deriveredShipment');

// Chart
Route::post('getChartData', 'ShipmentController@getChartData')->name('getChartData');
