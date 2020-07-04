<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{   

    protected $table='product_Price';

    protected $fillable=['warranty_id'	,'time'	,'year'	,'mount',	'day',	'price',	'product_id'	,'color_id']
}
