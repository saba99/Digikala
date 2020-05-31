<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Color extends Model
{
   use SoftDeletes;
    protected $fillable=['name','code'];

    public static function getData($request)
    {

        $string = '?';
        $color = self::orderBy('id', 'DESC');
        if (inTrashed($request)) {


            $color = $color->onlyTrashed();
            $string = create_paginate_url($string, 'trashed=true');
        }

        if (array_key_exists('string', $request) && !empty($request['string'])) {


            $color= $color->where('name', 'like', '%' . $request['string'] . '%');

            $color = $color->orWhere('code', 'like', '%' . $request['string'] . '%');

            $string = create_paginate_url($string, 'string=' . $request['string']);
        }
        $color = $color->orderBy('id', 'DESC')->paginate(2);

        $color->withPath($string);
        return $color;
    } 

}
