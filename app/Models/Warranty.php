<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Warranty extends Model
{
    use SoftDeletes;

    protected $table='warranties';

    protected $fillable=['name'];

    public static function getData($request)
    {

        $string = '?';
        $warranty = self::orderBy('id','DESC');
        if (inTrashed($request)) {


            $warranty = $warranty->onlyTrashed();
            $string = create_paginate_url($string, 'trashed=true');
        }

        if (array_key_exists('string', $request) && !empty($request['string'])) {


            $warranty = $warranty->where('name', 'like', '%' . $request['string'] . '%');

            $warranty = $warranty->orWhere('ename', 'like', '%' . $request['string'] . '%');

            $string = create_paginate_url($string, 'string=' . $request['string']);
        }
        $warranty = $warranty->orderBy('id', 'DESC')->paginate(2);

        $warranty->withPath($string);
        return $warranty;
    } 
    public  static function boot(){

        parent::boot();

        static::restored(function($warranty){

         add_min_product_price($warranty);
          
         $product=Product::select(['id','price','status'])->where('id',$warranty->product_id)->withTrashed()->first();

         update_product_price($product);
        });

        static::deleted(function($warranty){
         

            check_has_product_warranty($warranty);
            $product=Product::select(['id','price','status'])->where('id',$warranty->product_id)->withTrashed()->first();

         update_product_price($product);
        });
    }

}
