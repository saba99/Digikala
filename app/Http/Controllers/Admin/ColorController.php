<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
   protected $model='Color';

     protected $title='رنگ';

     protected  $route_params='Colors';

    public function index(Request $request)
    {
        $color = Color::getData($request->all());

        $trash_color_count = Color::onlyTrashed()->count();


        return view('color.index', ['color' => $color, 'trash_color_count' => $trash_color_count, 'request' => $request]);
    }

    public function create()
    {
        return view('color.create');
    }
   

    public function store(Request $request)
    {   

        $this->validate($request,['name'=>'required','code'=>'required'],[],['name'=>'نام رنگ','code'=>'کد رنگ']);

        $color=new Color($request->all());

        $color->saveOrFail();

        return redirect('admin/colors')->with('message','ثبت رنگ با موفقیت انجام شد ');
    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $color=Color::findOrFail($id);

        return view('color.edit',['color'=>$color]);
    }

    public function update(Request $request, $id)
    {
        

        $color=Color::findOrFail($id);
        $color->update($request->all());

        return redirect('admin/colors')->With('message','ویرایش رنگ با موفقیت انجام شد ');
    }

    public function destroy($id)
    {
        $color = Color::findOrFail($id);

        $color->delete();


        return redirect('admin/colors')->With('message', 'حذف رنگ با موفقیت انجام شد  ');
    }
}
