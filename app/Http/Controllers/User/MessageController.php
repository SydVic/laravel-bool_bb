<?php

namespace App\Http\Controllers\User;

use App\Apartment;
use App\Http\Controllers\Controller;
use App\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user = Auth::user();

        $user_apartments = Apartment::where('user_id', $user->id)->get();
        // dd($user_apartments);

        $user_apartments_id = Apartment::where('user_id', $user->id)->pluck('id');

        $user_messages = Message::whereIn('apartment_id', $user_apartments_id)->orderBy('created_at','DESC')->get();
        // dd($user_messages);

        return view('user.message.index', compact('user_messages', 'user_apartments'));
    }

    /**
     * Display messages for a single apartment.
     *
     * @return \Illuminate\Http\Response
     */
    public function apartmentMessages($id)
    {

        $user = Auth::user();

        $user_apartments = Apartment::where('user_id', $user->id)->get();

        $messages = Message::where('apartment_id', $id)->orderBy('created_at','DESC')->get();

        return view('user.message.apartment-messages', compact('messages', 'user_apartments'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $message = Message::findOrFail($id);

        $this->authorize('show', $message);

        return view('user.message.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
