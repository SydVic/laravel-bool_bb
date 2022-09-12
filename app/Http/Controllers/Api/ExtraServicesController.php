<?php

namespace App\Http\Controllers\Api;

use App\ExtraService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ExtraServicesController extends Controller
{
    public function index (){
        $extraServices = ExtraService::all();
        return response()->json($extraServices);
    }
}
