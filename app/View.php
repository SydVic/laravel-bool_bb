<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class View extends Model
{
    public function apartment() {
        return $this->belongsTo('App\Apartment');
    }

    protected $fillable = [
        'apartment_id',
        'ip',
        'date'
    ];
}
