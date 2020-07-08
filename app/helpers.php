<?php

use App\Lib\Jdf;
use App\Models\ProductWarranty;
use App\Models\Warranty;
use Illuminate\Support\Facades\DB;


function get_url($string){
 

    $url=str_replace('-',' ',$string);
    $url = str_replace('/', ' ', $url);

    $url=preg_replace('/\s+/','-' ,$url);
return $url;

}
function upload_file($request,$name,$directory,$pix=''){


    if($request->hasFile($name)){

     $file_name=$pix.time().'.'.$request->file($name)->getClientOriginalExtension();

     if($request->file($name)->move('files/'.$directory,$file_name)){
   

        return $file_name;
       
     }
     else{

        return  null;
     }
    }
    else{

        return null;
    }
}

function replace_number($number){


    $number=str_replace("0",'0',$number);
    $number = str_replace("1", '1', $number);
    $number = str_replace("2", '2', $number);
    $number = str_replace("3", '3', $number);
    $number = str_replace("4", '4', $number);
    $number = str_replace("5", '5', $number);
    $number = str_replace("6", '6', $number);
    $number = str_replace("7", '7', $number);
    $number = str_replace("8", '8', $number);
    $number = str_replace("9", '9', $number);
    return $number;
}
function inTrashed($request){

    if(array_key_exists('trashed',$request) && $request['trashed']=='true'){

        return true;
    }
    else{

        return false;
    }
}

function create_paginate_url($string,$text){

if($string== '?'){


    $string=$string.$text;
}
else{


    $string=$string.'&'.$text;
}

return $string;

}
function create_crud_route($route_param,$controller,$show=false){

    if($show){

    Route::resource($route_param, 'Admin\\'.$controller);
    }else{

        Route::post($route_param.'/remove_items', 'Admin\\'.$controller.'@remove_items');

    Route::post($route_param.'/restore_items', 'Admin\\'.$controller.'@restore_items');

    

    Route::post($route_param.'/{$route_param}', 'Admin\\'.$controller.'@restore'); 
    }
   
}
function crete_fit_pic($pic_url,$pic_name){


$thum=Image::make($pic_url);

$thum->resize(350,350);

$thum->save('files/thumbnails/'.$pic_name);
}


function remove_file($file_name,$directory){

  if(!empty($file_name) && file_exists('files/'.$directory.'/'.$file_name)){

   unlink('files/' . $directory . '/' . $file_name);

   

  }

  function add_min_product_price($warranty){

$jdf=new Jdf();
$year=$jdf->tr_num($jdf->jdate('Y'));
        $mount = $jdf->tr_num($jdf->jdate('n'));
        $day = $jdf->tr_num($jdf->jdate('j'));

        $has_row=DB::table('product_price')->where(['Year'=>$year,'mount'=>$mount,'day'=>$day,'color_id'=>$warranty->color_id,'product_id'=>$warranty->product_id])->first();
        if($has_row){

             if($warranty->price2< $has_row->price || $has_row->price==0){


                DB::table('product_price')->where(['Year' => $year, 'mount' => $mount, 'day' => $day, 'color_id' => $warranty->color_id, 'product_id' => $warranty->product_id])->update(['price'=>$warranty->price2,'warranty_id'=>$warranty->id]);


             }
        }
        else{
            DB::table('product_price')->insert(
                [
                    'Year' => $year, 'mount' => $mount, 'day' => $day, 'color_id' => $warranty->color_id, 'product_id' => $warranty->product_id,
                    'price'=>$warranty->price2,'time'=>time(),'warranty_id'=>$warranty->id
                    
                    ]
                
                );

        }
  }

  function update_product_price($product){

  $warranty=ProductWarranty::where('product_id',$product->id)->where('product_number','>',0)->orderBy('price2','ASC')->first();
 if($warranty){
            $product->price=$warranty->price2;
            $product->status = 1;

            $product->update();

 }
 else{

    $product->status=0;

    $product->update();
 }

  }

  function check_has_product_warranty($warranty){


$jdf=new Jdf();
$year=$jdf->tr_num($jdf->jdate('Y'));
        $mount = $jdf->tr_num($jdf->jdate('n'));
        $day = $jdf->tr_num($jdf->jdate('j'));

        $row=ProductWarranty::where(['product_id'=>$warranty->product_id,'color_id'=>$warranty->color_id])->Where('product_number','>',0)->orderBy('price2','ASC')->first();


        $price=$row ?$row->price2 :0;

        $warranty_id=$row ? $row->id :0;

       $has_row=ProductPrice::where(['Year'=>$year,'mount'=>$mount,'day'=>$day,'color_id'=>$warranty->color_id,'product_id'=>$warranty->product_id])->first();

       if($has_row){

                  $has_row->price=$price;

                  $has_row->warranty_id=$warranty_id;

                  $has_row->update();
       }
       else{

         DB::table('product_price')->insert(
                [
                    'Year' => $year, 'mount' => $mount, 'day' => $day, 'color_id' => $warranty->color_id, 'product_id' => $warranty->product_id,
                    'price'=>$warranty->price2,'time'=>time(),'warranty_id'=>$warranty->id
                    
                    ]
                
                );
       }




  }
  function is_selected_filter($list,$filter_id){

    

    $result=false; 

    foreach($list as $key=>$value){

        if($value->filter_value==$filter_id){

                 $result=true;  
        }
    }

    return $result;
  }

  function getFilterArray($list){


$array=array();

foreach($list as $key=>$value){


    $array[$value->item_id]=$key;
}
return $array;

  }

  function getFilterItemValue($filter_id,$product_filters){

        $string='';

        foreach($product_filters as $key=>$value){

if($value==$filter_id){

    $string.='@'.$key;


}
return $string;

        }

  }
  function get_show_category_count($catList){

$n=0;
foreach($catList as $key=>$value){


    if($value->notShow==0){

        $n++;
    }
}
  }
}
?>