<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductColor extends Model
{
    protected $table='product_color';


    protected $fillable=['name','color'];

   public function getColor(){


     return $this->hasOne(Color::class,'id','color_id');
   }

}
