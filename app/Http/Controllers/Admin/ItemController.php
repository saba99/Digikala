<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;


class ItemController extends Controller
{
   
   
    public function destroy($id)
    {
       $item=Item::findOrFail($id);

       $item->getChild()->delete();

       $item->delete();

       return redirect()->back()->with('message','حذف مشخصات فنی با موفقیت انجام شد ');
    }

    public function items($id){

        $category=Category::findOrFail($id);

        $items=Item::with('getChild')->where(['category_id'=>$id,'parent_id'=>0])->orderBy('position','ASC')->get();

        return view('item.index',['category'=>$category,'items'=>$items]);
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
