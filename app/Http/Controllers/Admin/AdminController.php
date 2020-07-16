<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductWarranty;
use app\Offers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
   public function index(){

    return view('admin.index');
   }

   public function incredible_offers(){

         return view('admin.incredible_offers');


   }

   public function getWarranty(Request $request){
    

      $search_text=$request->get('search_text','');


      $productWarranty=ProductWarranty::with(['getColor','getProduct','getWarranty'])->orderBy('id','DESC')->whereHas('getProduct')->whereHas('getWarranty')->paginate(10);

     

     // $productWarranty = $productWarranty; 
      
     
     if(empty(trim($search_text))){
      
$productWarranty=$productWarranty->whereHas('getProduct');
      

     }
     else{

      define('search_text',$search_text);

         $productWarranty = $productWarranty->whereHas('getProduct',function(\Illuminate\Database\Eloquent\Builder $query){


                 $query->where('title','like','%'.search_text.'%');


         });
     }

     
       return $productWarranty;
   }

   public function add_incredible_offers($id,Request $request ){
      

      $productWarranty=ProductWarranty::find($id);
  if($productWarranty){
 
       
        $offers=new Offers();

    $res= $offers->add($request,$productWarranty);



     return $res;

  }
  else{


return 'error';

  }

   }
   
   public function remove_incredible_offers($id,Request $request){

        $productWarranty=ProductWarranty::find($id);


        if($productWarranty){

                $offers=new Offers();

                $res=$offers->remove($request,$productWarranty);

                return $res;
        }
        else{

                     return 'error';

        }
   
  }

 

    
}
