<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item_order extends Model
{
    use HasFactory;
    protected $fillable = [
        'item_id',
        'number',
        'order_id',
        
    ];


    protected $casts = [
        'item_id' => 'integer',
        'number'=>'integer',
        'order_id'=>'integer',
        
         

    ];
}
