<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductWarranty extends Model
{
    use SoftDeletes;

    protected $table='product_warranties';

    
    protected $fillable=['product_id','offers_first_time','offers_last_time','offers_first_date','offers_last_date','offers', 'warranty_id','color_id','price1','price2','product_number','product_number','product_number_cart','send_time'];

public static function getData($request){

        $product_warranties = self::with('getColor','getWarranty')->orderBy('id', 'DESC');
        if (inTrashed($request)) {

            $product_warranties->onlyTrashed();
        }

        $product_warranties = $product_warranties->paginate(2);

        return $product_warranties;
}

public function getColor(){

return $this->belongsTo(Color::class,'color_id','id')->withDefault(['name'=>'','id'=>0]);

}
public function getWarranty(){

return $this->belongsTo(Warranty::class,'warranty_id','id')->withDefault(['name' => '', 'id' => 0]);

}
public function getProduct(){


    return $this->hasOne(Product::class,'id','product_id')->select(['id','title','image_url','cat_id','product_url']);
}
public function itemValue(){


    return $this->hasMany(ItemValue::class,'product_id','product_id');
}



}
