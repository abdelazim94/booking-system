<?php

use App\Models\Place;
use Illuminate\Support\Facades\Route;

use Grimzy\LaravelMysqlSpatial\Types\Point;
use Grimzy\LaravelMysqlSpatial\Types\Polygon;
use Grimzy\LaravelMysqlSpatial\Types\LineString;
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
    $place1 = new Place();
    $place1->name = 'Empire State Building';

    // saving a point
    // $place1->location = new Point(40.7484404, -73.9878441);	// (lat, lng)
    // $place1->save();

    // saving a polygon
    $place1->area = new Polygon([new LineString([
        new Point(40.74894149554006, -73.98615270853043),
        new Point(40.74848633046773, -73.98648262023926),
        new Point(41.74848633046773, -72.98648262023926),
        new Point(40.747925497790725, -73.9851602911949),
        new Point(40.74837050671544, -73.98482501506805),
        new Point(40.74894149554006, -73.98615270853043)
    ])]);
    $place1->save();
});
