<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class SiteController extends Controller
{
   public function index(){

      $catList=Category::where('parent_id',0)->get();


    return view('shop.index',['catList'=>$catList]);
   }
}
