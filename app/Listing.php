<?php

namespace App;

use Elasticquent\ElasticquentTrait;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use ElasticquentTrait;

    protected $fillable = ['title', 'description', 'price'];

    /**
     * ElasticSearch field mappings
     */
    protected $mappingProperties = [
       'title' => [
            'type' => 'string',
            'analyzer' => 'standard'
        ],
        'description' => [
            'type' => 'string',
            'analyzer' => 'standard'
        ]
    ];

    /**
     * Related image
     */
    public function image()
    {
        return $this->hasOne('App\ListingImage');
    }

    /**
     * Related author (user)
     */
    public function author()
    {
        return $this->belongsTo('App\User');   
    }
}
