<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Validator;
use App\Http\traits\GeneralTrait;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class UserController extends Controller
{   use GeneralTrait;
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:4',
        ]);

        if($validator->fails()) {
            return $this->requiredField($validator->errors()->first());
        }
        
           
            $input = $request->all();
            $input['password'] = bcrypt($input['password']);
            $user = User::create($input);
         
            $token = $user->createToken('MyApp')->plainTextToken;
            $data['name']=$user->name;
            $data['email']=$user->email;
            $data['token']=$token;
           //  $user->notify(new welcom());
           return $this->apiResponse($data) ;       
        
       
    
          }
      public function login(Request $request)
       {
        $validator =Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string'
        ]);
        if($validator->fails()) {
            return $this->errorResponse($validator->errors(), 422);
        }

    
            $user = User::where('email', $request['email'])->first();

            $data['name'] = $user->name;
            $data['token'] = $user->createToken('apiToken')->plainTextToken;
          
            return $this->apiResponse($data) ;   
}
         public function logout(Request $request)
       {
           auth('sanctum')->user()->tokens()->delete();
           return $this->apiResponse(['data:'=>'User has logged out successfully.']) ;
  
}

    public function user_order($id)
       {
      $user=User::find($id);
      if($user){
      $user_order=$user->orders;
      return $this->apiResponse(OrderResource::collection($user_order)) ;
      }
      else{
        return $this->notFoundResponse('id not avalible');


      }


       }






}