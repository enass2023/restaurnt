<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'price',
        'descreption',
        
    ];


    protected $casts = [
        'name' => 'string',
        'price'=>'integer',
        'descreption'=>'string',
        
         

    ];

    public function restaurants()
    {
    return $this->belongsToMany(Restaurant::class,'Item_restaurants');

    }



}
