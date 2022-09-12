<?php

namespace App\Http\Controllers\User;

use App\Apartment;
use App\ApartmentSponsorType;
use App\ExtraService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\SponsorType;
use App\Http\Controllers\User\Buy\BuySponsorController;

class ApartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('has_apartments')->except('create', 'store');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $apartments = Apartment::where('user_id', $user->id)->get();
        return view('user.apartment.index', compact('apartments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $extra_services = ExtraService::all();
        return view('user.apartment.create', compact('extra_services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $data = $request->all();
        // dd($data);
        
        $request->validate($this->getValidationRules());
        // dd($request->all());

        $new_apartment = new Apartment();
        $new_apartment->user_id = $user->id;
        $data['image'] = Storage::put('img', $data['image-cover']);
        $new_apartment->fill($data);
        $new_apartment->slug = Apartment::generateUniqueSlug($new_apartment->title);

        $new_apartment->save();

        $new_apartment->services()->sync($data['extra_services']);
        
        return redirect()->route('user.apartment.show', ['apartment' => $new_apartment->id])->with('message', 'Appartamento salvato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id, Request $request)
    {   
        $sponsors = SponsorType::all();
        $apartment = Apartment::findOrFail($id);

        $this->authorize('show', $apartment);
        // dd($apartment);
        return view('user.apartment.show', compact('apartment'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $apartment = Apartment::findOrFail($id);
        $this->authorize('edit', $apartment);

        $extra_services = ExtraService::all();

        // dd($apartment);
        return view('user.apartment.edit', compact('apartment','extra_services'));
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
        $request->validate($this->getValidationRules());

        $data = $request->all();
        
        $apartment = Apartment::findOrFail($id);

        $this->authorize('update', $apartment);
        
        $data['slug'] = Apartment::generateUniqueSlug($data['title']);
        
        if(isset($data['image-cover'])){
            if($apartment->image){
                Storage::delete($apartment->image);
            }
            $data['image'] = Storage::put('img', $data['image-cover']);
        }
        
        $apartment->update($data);

        if (isset($data['extra_services'])) {
            $apartment->services()->sync($data['extra_services']);
        }

        return redirect()->route('user.apartment.show', ['apartment' => $apartment->id])->with('message', 'Appartamento salvato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $apartment = Apartment::findOrFail($id);
        $this->authorize('destroy', $apartment);
        $apartment->services()->sync([]);

        $apartment->messages()->delete();
        $apartment->sponsorTypes()->delete();
        $apartment->views()->delete();
        $apartment->delete();

        return redirect()->route('user.apartment.index');
    }

    private function getValidationRules() {
        return [
            'title' => 'required|min:4|max:255',
            'price' => 'required|min:0.01|max:9999.99',
            'description' => 'nullable|max:20000',
            'rooms_number' => 'required|min:1|max:255',
            'bathrooms_number' => 'required|min:1|max:255',
            'beds_number' => 'required|min:1|max:255',
            'mqs' => 'required|integer|min:10|max:65535',
            'address' => 'required|min:4|max:255',
            'latitude' => 'required|min:-90|max:90',
            'longitude' => 'required|min:-180|max:180',
            'image' => 'mimes:jpg,jpeg,png,bmp,gif,svg,webp|max:1024',
            'extra_services' => 'required|exists:extra_services,id',
            'visibility' => 'nullable'
        ];
    }
}
