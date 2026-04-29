<?php

namespace App\Http\Controllers;

use App\Models\pointsModel;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    protected $points;
    protected $polyline;
    protected $polygon;


    public function __construct() {
        $this->points = new pointsModel();
        $this->polyline = new \App\Models\polylineModel();
        $this->polygon = new \App\Models\polygonModel();
    }

    public function geojson_points()
    {
        $points = $this->points->geojson_points();
        return response()->json($points, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polyline()
    {
        $polyline = (new \App\Models\polylineModel())->geojson_polyline();
        return response()->json($polyline, 200, [], JSON_NUMERIC_CHECK);
    }

    public function geojson_polygon()
    {
        $polygon = (new \App\Models\polygonModel())->geojson_polygon();
        return response()->json($polygon, 200, [], JSON_NUMERIC_CHECK);
    }
}
