<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    protected $fillable = ['title', 'description', 'price'];

    public function image()
    {
        return $this->hasOne('App\ListingImage');
    }
}
