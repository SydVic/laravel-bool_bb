<?php

namespace App\Http\Controllers\Api;

use App\Message;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    public function store(Request $request) {

        $data = $request->all();
        
        $request->validate([
            'apartment_id' => 'required|integer',
            'email' => 'required|string|email|max:255',
            'text' => 'required|string|max:20000'
        ]);

        $message = new Message();

        $message->fill($data);

        $message->save();
    }
}