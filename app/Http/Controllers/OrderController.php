<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Item_order;
use App\Models\Order;
use App\Models\Item;
use App\Http\Resources\OrderResource;
use Illuminate\Support\Facades\Auth;
use App\Models\Restaurant;
use App\Http\traits\GeneralTrait;
use Illuminate\Support\Facades\Validator;
class OrderController extends Controller
{
    use GeneralTrait;

     public function store(Request $request){
    
     $validate=Validator::make($request->all(),[
    'restaurant_name'=>"required|string|max:10", 
      'item_name'=>'array|required|exists:items,name',
      'order_type'=>"required|string",

          ]);

        if($validate->fails()){
        return $this->requiredField($validate->errors()->first());}
        $res_name=$request->restaurant_name;
        $item_name=$request->item_name;
        $restaurant_id=Restaurant::where('name',$res_name)->value('id');
        // $user_id=User::where('name', $user_name)->value('id');
        $item_id=Item::where('name',$item_name)->value('id');
        $order=Order::create(['restaurant_id'=>$restaurant_id,
        'user_id'=>Auth::id(),
        'order_type'=>$request->order_type,
        // 'total_cost'=>$request->total_cost 
          ]);
        //  echo json_encode(['status'=>'created']);
        //  return $this->apiResponse(['the opration succeeded in order shedule']); 
           foreach($item_name as $item)
          {
            $it=Item::where('name',$item)->value('id');
            Item_order::create(['item_id'=>$it,'order_id'=>$order->id]);
          }
          return $this->apiResponse(['the opration succeeded in order shedule&item_order shedule ']);
        //  echo json_encode(['status'=>'created']);

    }



    public function show($id){
        if(!$id){
            return $this->requiredField('id is required');

        }
        $order=Order::findOrFail($id);
        $orderr=OrderResource::make($order);
        return $this->apiResponse ($orderr);

    }


    public function destory($id){
        
      $ord = Order::find($id);
 
         if ($ord) {
            $ord->delete();
            $items=Item_order::where('order_id',$ord)->get();
            
            foreach( $items as $item){
             $it=Item_order::where('order_id',$ord)->value('id'); 
            $item->delete($it);

            }
            return $this->apiResponse('succssfull delete');
         } else {
             return $this->requiredField('id Not available');
         }

    }


}
