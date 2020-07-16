<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ProductWarranty;
use App\Models\Slider;
use Illuminate\Http\Request;

class SiteController extends Controller
{
   public function index(){

      

      // $catList=getCatList();
          $data=cache('actList');
          if($data){

            return $data;
          }
          else{
$catList=Category::with('getChild.getChild.getChild')->where('parent_id',0)->get();

$minutes=30*24*60*60;

cache()->put('catList',$catList,$minutes);
          } 

          $sliders=Slider::orderBy('id','DESC')->get();

          $incredible_offers=ProductWarranty::with('getProduct.getCat')->with(['itemValue'=>function($query){
           
            $query->whereHas('important_item')->with('important_item');

          }])->where(['offers'=>1])->limit(10)->get();



    return view('shop.index',['catList'=>$catList,'sliders'=>$sliders, 'incredible_offers'=> $incredible_offers]);
   }
}
