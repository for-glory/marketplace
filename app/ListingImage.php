<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ListingImage extends Model
{
    protected $fillable = ['listing_id', 'filename'];
 
    public function listing()
    {
        return $this->belongsTo('App\Listing');
    }
}
