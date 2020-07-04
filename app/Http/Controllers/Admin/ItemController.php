<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;


class ItemController extends Controller
{
   
    public function index()
    {
        //
    }

    public function create()
    {
        //
    }

   
    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

   
    public function destroy($id)
    {
        //
    }

    public function items($id){

        $category=Category::findOrFail($id);

        return view('item.index',['category'=>$category]);
    } 

    public function add_items($cat_id,Request $request){

      // dd($request->all());

        $items=$request->get('item',array());

        $child_item= $request->get('child_item', array());

        $checked_item
        = $request->get('check_box_item', array());

        Item::addItem($items,$child_item,$checked_item,$cat_id);

        return redirect()->back()->with('message','ثبت اطلاعات با موفقیت انجام شد ');

    }
}
