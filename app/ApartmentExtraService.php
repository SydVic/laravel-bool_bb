<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ApartmentExtraService extends Model
{
    protected $table = 'apartment_extra_service';
    
    protected $fillable = [
        'apartment_id',
        'service_id'
    ];
}
