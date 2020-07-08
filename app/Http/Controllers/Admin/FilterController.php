<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Filter;
use App\Models\Item;
use Illuminate\Http\Request;

class FilterController extends Controller
{
       public function destroy($id)
    {
        $filter =Filter::findOrFail($id);

        $filter->getChild()->delete();

        $filter->delete();

        return redirect()->back()->with('message', 'حذف فیلتر با موفقیت انجام شد ');

    }
    public function filters($id)
    {

        $category = Category::findOrFail($id);

        $items=Item::getCategoryItem($id);

        $filters = Filter::where(['category_id' => $id, 'parent_id' => 0])->orderBy('position', 'ASC')->get();
     

        
        return view('filter.index', ['items'=>$items,'category' => $category, 'filters' => $filters]);
    }

    public function add_filters($cat_id,Request $request){

                // dd($request->all());

                $filter=$request->get('filter');

                $child_filter=$request->get('child_filter');

                $itemValue=$request->get('item_id');

                Filter::add_filter($filter,$child_filter,$cat_id,$itemValue);


                return redirect()->back()->with('message','ثبت فیلتر ها با موفقیت انجام شد ');
    }

}
