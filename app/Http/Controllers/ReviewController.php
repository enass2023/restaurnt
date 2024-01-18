<?php

namespace App\Http\Controllers;
use App\Models\Review;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\traits\GeneralTrait;
use App\Models\Restaurant;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ReviewResource;

class ReviewController extends Controller
{
    use GeneralTrait;

    public function store(Request $request){
    { $validate=Validator::make($request->all(),[
      "restaurant_name"=>"required|string|max:10",
      "review"=>"required|min:0|max:5|integer"
      ]);
      if($validate->fails()){
        return $this->requiredField($validate->errors());}
            
            $res_name=$request->restaurant_name;
            
            $restaurant_id=Restaurant::where('name',$res_name)->value('id');

            $rev=Review::create(['restaurant_id'=>$restaurant_id,
             'user_id'=>Auth::id(),
            'review'=>$request->review,
             ]);
             return $this->apiResponse(ReviewResource::make($rev)) ;


            }}
         
        
       
    
    
    
       public function update(Request $request,$id)
       {
        if ($request->isMethod('post')) {
          $review  = Review::find($id);
          $validate=Validator::make($request->all(),[
    
            "review"=>"required|min:0|max:5|integer",
         
             ]);
             if($validate->fails()){
        return $this->requiredField($validate->errors()->first());}
          $res_name=$request->restaurant_name;
          $restaurant_id=Restaurant::where('name',$res_name)->value('id');
           if ($review) {
            $rev=$review->update([
            'review'=>$request->review
            
        ]);
         return $this->apiResponse(['review'=>$request->review]); 
           }
            else {
                return $this->requiredField('there is no review ');
           }
    
    
       }}
   
    
    
}

