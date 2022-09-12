<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ExtraService extends Model
{
    public function apartments() {
        return $this->belongToMany('App\Apartments');
    }

    protected $fillable = [
        'name'
    ];
}
