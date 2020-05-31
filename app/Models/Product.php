<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;

    protected $fillable=['title','ename','product_url','show','view','keywords','description','special','cat_id','img_url','tozihat','brand_id'];


    public static function ProductStatus(){

       $array=array();

       $array[-3]='رد شده';


       $array[-2]='در انتظار بررسی';


       $array[-1]='توقف تولید ';

       $array[0]='نا موجود ';

       $array[1]='منتشر شده';


       return $array;
    }
}
