<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    use SoftDeletes;

    protected $fillable=['title','ename','product_url','show','view','keywords','description','special','cat_id','img_url','tozihat','brand_id','status'];


    public static function ProductStatus(){

       $array=array();

       $array[-3]='رد شده';


       $array[-2]='در انتظار بررسی';


       $array[-1]='توقف تولید ';

       $array[0]='نا موجود ';

       $array[1]='منتشر شده';


       return $array;
    }

    public static function getData($request){

           
       $products=self::orderBy('id','DESC');
       if(inTrashed($request)){

        $products->onlyTrashed();
       }

       $products=$products->paginate(2);

       return $products;
    }
    public static function getProductStatus($status){

        $array=self::ProductStatus()[$status];

       if(array_key_exists($status,$array)){

return $array[$status] ;

       }
       else{

        return '';
       }
        
    }
   protected static function  boot()
   {

      parent::boot();

      static::deleting(function ($product) {

        if($product->isForceDeleting()){

        remove_file($product->image_url,'products');
        DB::table('product_color')->where('product_id',$product->id)->delete();

            DB::table('item_value')->where('product_id', $product->id)->delete();

        }
      });
      
   }
}
