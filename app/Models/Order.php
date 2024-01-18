<?php

namespace App\Models;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = [
        'restaurant_id',
        'user_id',
        'order_type',
        'total_cost'
    ];


    protected $casts = [
        'restaurant_id' => 'integer',
        'user_id'=>'integer',
        'order_type'=>'string',
         'total_cost'=>'double'
         

    ];

    public function user()
    {
    return $this->belongsTo(User::class);

    }
    public function restaurant()
    {
    return $this->belongsTo(Restaurant::class);

    }
    public function items()
    {
    return $this->belongsToMany(Item::class,'Item_orders');

    }

}
