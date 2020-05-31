<?php


function get_url($string){
 

    $url=str_replace('-',' ',$string);
    $url = str_replace('/', ' ', $url);

    $url=preg_replace('/\s+/','-' ,$url);
return $url;

}
function upload_file($request,$name,$directory){


    if($request->hasFile($name)){

     $file_name=time().'.'.$request->file($name)->getClientOriginalExtension();

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

?>