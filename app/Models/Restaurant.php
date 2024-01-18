<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'cusine_type',
        'location',
        'phone',
      
    ];


    protected $casts = [
        'name' => 'string',
        'cusine_type'=>'string',
        'location'=>'string',
         'phone'=>'string',
       

    ];
    protected $appends=['review'];

   public function getReviewAttribute()
   {
    $res=$this->reviews;
    if(!$res->isEmpty()){
    $total=0;
    $count=$this->reviews->count();
   
   foreach($this->reviews as $review){
    $total=$total+$review->review;

   }
   $avarege= $total/$count;
   return $avarege;}
   else {return 0;}
}



    public function items()
    {
    return $this->belongsToMany(Item::class,'Item_restaurants');

    }
    public function orders()
    {
    return $this->hasMany(Order::class);

    }
    public function reviews()
    {
    return $this->hasMany(Review::class);

    }






   }



