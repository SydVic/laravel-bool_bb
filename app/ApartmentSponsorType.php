<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentSponsorType extends Model
{
    public function apartment() {
        return $this->belongsTo('App\Apartment');
    }
    public function sponsor() {
        return $this->belongsTo('App\SponsorType');
    }
    protected $table = 'apartment_sponsor';
    protected $fillable = [
        'apartment_id',
        'sponsor_type_id',
        'sponsor_start',
        'sponsor_end'
    ];
}
