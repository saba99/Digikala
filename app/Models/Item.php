<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Item extends Model
{
   protected $fillable=['category_id','title','position	','show_item','parent_id'];
   

   public static function addItem($items,$child_item,$checked_item,$cat_id){

   
     $parent_position=0;

     self::where(['category_id'=>$cat_id,'parent_id'=>0])->update(['position'=>0]);

    foreach($items as $key=>$value){
              if(!empty($value)){
         if($key<0 ){
          
           $parent_position ++;

              $id=self::insertGetId(['title'=>$value,'category_id'=>$cat_id,'parent_id'=>0,'position'=>$parent_position]);
               self::add_child_items($key,$child_item,$id,$checked_item,$cat_id);
        }
        else{

            self::where('id',$key)->update(['title'=>$value,'position'=>$parent_position]);

                    self::add_child_items($key, $child_item, $key, $checked_item, $cat_id);
        }

              }

       
    }

   }

   public static  function add_child_items($key, $child_item, $item_id, $checked_item, $cat_id){

       if(array_key_exists($key,$child_item)){

        $child_position=0;

            self::where([ 'parent_id' => $item_id])->update(['position' => 0]);

         foreach($child_item[$key] as $key2=>$value2){


                    if(!empty($value2)){
                          

                        $show_item=self::getShowItemValue($checked_item,$key,$key2);

                        $child_position ++;
                            if($key2<0){

                            
                                self::insert(['title'=>$value2,'parent_id'=>$item_id,'category_id'=>$cat_id,'position'=>$child_position,'show_item'=>$show_item]);

                            }
                         else{

                            self::where('id',$key2)->where(['title'=>$value2,'position'=>$child_position,'show_item'=>$show_item]);
                         }   
                    }

         }

       }

   }

   public static function getShowItemValue($checked_item,$key,$key2){
  

    if(array_key_exists($key,$checked_item)){

      if(array_key_exists($key2,$checked_item[$key])){

             return 1;

      }
      else{

        return 0;
      }
    }
    else{

        
        return 0;
    }

   }

   public function getChild(){

      return $this->hasMany(Item::class,'parent_id','id')->orderBy('position','ASC');


   }

    public static function  getProductItem($product){

        define('product_id',$product->id);
   $category=Category::find($product->cat_id);

   $cat_id[0]= $product->cat_id;

   if($category){

    $cat_id[1]=$category->parent_id;
   }

   $items=self::with('getChild.getValue')->where(['parent_id'=>0])->whereIn('category_id',$cat_id)->orderBy('position','ASC')->get();

return $items;  


   }
public function getValue(){


    return $this->hasMany(ItemValue::class,'item_id','id')->where('product_id',product_id);
}

public static function getCategoryItem($id){


       
        $category = Category::find($id);

        $cat_id[0] = $id;

        if ($category) {

            $cat_id[1] = $category->parent_id;
        }

        $items = self::with('getChild')->where(['parent_id' => 0])->whereIn('category_id', $cat_id)->orderBy('position', 'ASC')->get();

        return $items;  
}
public static function getProductItemWithFilter($product){


        define('product_id', $product->id);
        $category = Category::find($product->cat_id);

        $cat_id[0] = $product->cat_id;

        if ($category) {

            $cat_id[1] = $category->parent_id;
        }

        $items = self::with('getChild.getValue')->where(['parent_id' => 0])->whereIn('category_id', $cat_id)->orderBy('position', 'ASC')->get();
           

        $filters=Filter::whereIn('category_id',$cat_id)->where(['parent_id'=>0])->whereNotNull('item_id')->with('getChild')->get();



        return ['items'=>$items,'filters'=>$filters]; 

}

public static function addFilter($key,$filter_value,$product_id){

if(array_key_exists($key,$filter_value)){


foreach($filter_value[$key] as $k=>$v){

    $filter_id=$k;

    DB::table('filter_product')->where(['product_id'=>$product_id,'filter_id'=>$filter_id])->delete();
    

    $e=explode('@',$v);

    foreach($e as $k2=>$v2){

if(!empty($v2)){

    DB::table('filter_product')->insert([

              'product_id'=>$product_id,
              'filter_id'=>$filter_id,
              'filter_value'=>$v2

    ]);
}

    }
}
}

}

}
