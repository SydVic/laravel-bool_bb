<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\SponsorType;
use App\Http\Resources\SponsorResource;
use Braintree\Gateway;
use App\Apartment;

class SponsorController extends Controller
{
    public function index($id, Gateway $gateway, Request $request) {
        $apartment = Apartment::findOrFail($id);

        $sponsor_types = SponsorType::all();
        // return SponsorResource::collection($sponsor_types);

        $token = $gateway->clientToken()->generate();

        return view('user.sponsor.index', compact('apartment', 'sponsor_types', 'token'));
    
    }
}