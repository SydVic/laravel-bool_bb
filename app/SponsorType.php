<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SponsorType extends Model
{
   
    public function apartmentSponsorTypes() {
        return $this->hasMany('App\ApartmentSponsorType');
    }

    protected $fillable = [
        'price',
        'name',
        'duration_h'
    ];
}
