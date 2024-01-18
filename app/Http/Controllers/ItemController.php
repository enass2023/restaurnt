<?php

namespace App\Http\Controllers;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
  



    public function store(Request $request){
        if ($request->isMethod('post')) {
            $item=Item::firstOrCreate($request->all());
           
          }
          else {echo"error";}
        
       }
    
    
    
       public function update(Request $request,$id)
       {
           $item = Item::find($id);
    
           if ($item) {
               $item->update($request->all());
              
           } else {
               echo "error update";
           }
    
    
       }
    
       public function destory($id)
       {
           $item = Item::find($id);
    
           if ($item) {
               $item->delete();
              
           } else {
               echo "error delet";
           }
    
    
}
}