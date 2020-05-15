<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    // public function reviews()
    // {
    //     return $this->hasMany('App\Review');
    // }
 
    protected $fillable = [
        'itemName',
        'itemDescription',
        
    ];

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
