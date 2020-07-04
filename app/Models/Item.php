<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
   protected $fillable=['category_id','title','position	','show_item','parent_id'];


   public static function addItem($items,$child_item,$checked_item,$cat_id){

   
     $parent_position=0;

    foreach($items as $key=>$value){


        if($key<0 && !empty($value)){
          
           $parent_position ++;

              $id=self::insertGetId(['title'=>$value,'category_id'=>$cat_id,'parent_id'=>0,'position'=>$parent_position]);

        }
    }

   }
}
