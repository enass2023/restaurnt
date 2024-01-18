<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use App\Http\Traits\GeneralTrait;
use App\Http\Resources\RestaurantResource;
use App\Http\Resources\RestResource;
class RestaurantController extends Controller
{  
    use GeneralTrait;
    
    
    public function index(){
       
     $restaurants=Restaurant::all();
     return RestaurantResource::collection($restaurants) ;      
    }

   
      public function search(Request $request){

        $validate=Validator::make($request->all(),[
            'cusine_type'=>'required|string',
            'location'=>'required|string',
            ]);
            if($validate->fails()){
       return $this->requiredField($validate->errors());}

       $res=Restaurant::where('cusine_type',$request->cusine_type)
       ->where('location',$request->location)->get();
       if(!$res)
       {return $this->notFoundResponse('there is no data');}
       
       return $this->apiResponse( RestaurantResource::collection($res)) ;      

        

}

   public function show($id){

  $restaurant=Restaurant::find($id);
  if($restaurant)
  {
  return $this->apiResponse( RestResource::make($restaurant)) ;
  }
  else{return $this->notFoundResponse('not found');}
   }



      public function store(Request $request){

         try{


     if ($request->isMethod('post')) {
     $validator=Validator::make($request->all(),[
     'name'=>"required|string|max:10",
     'cusine_type'=>"required",
     'location'=>"required|string",
     'phone'=>"required|string"
      ]);
      if($validator->fails()){
       return $this->notFoundResponse('notfound');}
         else{
        $res= Restaurant::firstOrCreate($request->all());
          $ress=RestaurantResource::make($res);
           return $this->apiResponse($ress,true,null,201);}}
        }catch(\Exception $ex){
       return $this->apiResponse(null,false,$ex->getMessage(),500);
        }
    
    }



   public function update(Request $request,$id)
   { 
    try{
    if ($request->isMethod('post')) {
    $res = Restaurant::find($id);
    $validator=Validator::make($request->all(),[
    'name'=>"required|string|max:10",
    'cusine_type'=>"required",
    'location'=>"required|string",
    'phone'=>"required|string"
    
     ]);
      if($validator->fails()){
       return $this->notFoundResponse('notfound');}
         else{
           $res->update($request->all());
           $ress=RestaurantResource::make($res);
           return $this->apiResponse($ress,true,null,201);}}
        }catch(\Exception $ex){
       return $this->apiResponse(null,false,$ex->getMessage(),500);
        }
   }
          
    

   public function destory($id)
   {
       $res = Restaurant::find($id);

       if ($res) {
           $res->delete();
           return $this->apiResponse(["sucssifull delete"],true,null,201);}
       else {
        return $this->notFoundResponse('notfound');
        //    echo "error update";
       }


   }




}
