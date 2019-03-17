<?php


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

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix'     => '/v1',
], function (\Illuminate\Routing\Router $router) {
    $router->get('/', function () {
        return ['API Version 1'];
    });

    $router->post('login', 'Auth\LoginController@login');

    $router->get('airlines', 'AirlineController@index');
    $router->get('airlines/{airline}', 'AirlineController@show');

    $router->get('airports', 'AirportController@index');
    $router->get('airports/{airport}', 'AirportController@show');

    $router->get('cities', 'CityController@index');
    $router->get('cities/{city}', 'CityController@show');

    $router->get('countries', 'CountryController@index');
    $router->get('countries/{country}', 'CountryController@show');

    $router->get('flights', 'FlightController@index');
    $router->get('flights/{flight}', 'FlightController@show');

    $router->get('regions', 'RegionController@index');
    $router->get('regions/{region}', 'RegionController@show');

    $router->get('trips', 'TripController@index');
    $router->get('trips/{trip}', 'TripController@show');
    $router->post('trips', 'TripController@store');

    $router->group(['middleware' => 'auth:api'], function ($router) {
        $router->post('logout', 'Auth\LoginController@logout');
        $router->post('airlines', 'AirlineController@store');
        $router->put('airlines/{airline}', 'AirlineController@update');
        $router->delete('airlines/{airline}', 'AirlineController@delete');


        $router->post('airports', 'AirportController@store');
        $router->put('airports/{airport}', 'AirportController@update');
        $router->delete('airports/{airport}', 'AirportController@delete');


        $router->post('cities', 'CityController@store');
        $router->put('cities/{city}', 'CityController@update');
        $router->delete('cities/{city}', 'CityController@delete');


        $router->post('countries', 'CountryController@store');
        $router->put('countries/{country}', 'CountryController@update');
        $router->delete('countries/{country}', 'CountryController@delete');

        $router->post('flights', 'FlightController@store');
        $router->put('flights/{flight}', 'FlightController@update');
        $router->delete('flights/{flight}', 'FlightController@delete');

        $router->post('regions', 'RegionController@store');
        $router->put('regions/{region}', 'RegionController@update');
        $router->delete('regions/{region}', 'RegionController@delete');

    });
});


