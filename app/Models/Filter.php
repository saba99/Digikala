<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Filter extends Model
{
    protected $table='filter';


    protected $fillable=['category_id','position','title','item_id','parent_id'];

    public static function add_filter($filter,$child_filter,$cat_id,$itemValue){

        $parent_position = 0;

        self::where(['category_id' => $cat_id, 'parent_id' => 0])->update(['position' => 0]);

        foreach($filter as $key=>$value){

             if(!empty($value)){
               
                $parent_position ++;

                $item_id=array_key_exists($key,$itemValue)? $itemValue[$key]:0;

                if ($key < 0) {

                    $id = self::insertGetId(['title' => $value, 'category_id' => $cat_id, 'parent_id' => 0, 'position' => $parent_position,'item_id'=>$item_id]);
                    self::add_child_filter($key, $child_filter, $id,  $cat_id);
                } else {

                    self::where('id', $key)->update(['title' => $value, 'position' => $parent_position,'item_id'=>$item_id]);

                    self::add_child_filter($key, $child_filter, $key, $cat_id);
                }



             }

        }
    }

    public static function add_child_filter($key, $child_filter, $filter_id, $cat_id){

        if (array_key_exists($key, $child_filter)) {

            $child_position = 0;

            self::where(['parent_id' => $filter_id])->update(['position' => 0]);

            foreach ($child_filter[$key] as $key2 => $value2) {


                if (!empty($value2)) {

                    $child_position++;
                    if ($key2 < 0) {


                        self::insert(['title' => $value2, 'parent_id' => $filter_id, 'category_id' => $cat_id, 'position' => $child_position]);
                    } else {

                        self::where('id', $key2)->where(['title' => $value2, 'position' => $child_position]);
                    }
                }
            }
        }

    }
    public function getChild(){

        return $this->hasMany(Filter::class,'parent_id','id')->orderBy('position','ASC');
    }

    public static function getProductFilter($product){
       

define('product_id',$product->id);

        $category = Category::find($product->cat_id);

   $cat_id[0]= $product->cat_id;

   if($category){

    $cat_id[1]=$category->parent_id;
   }
   
   $filters=self::with(['getChild','getValue'])->where(['parent_id'=>0])->whereIn('category_id',$cat_id)->orderBy('position','ASC')->get();


  return $filters;

    }

    public function getValue()
    {


        return $this->hasMany(ProductFilter::class, 'filter_id', 'id')->where('product_id', product_id);
    }

}
