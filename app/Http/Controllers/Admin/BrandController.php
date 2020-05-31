<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use Illuminate\Http\Request;

use App\Models\Brand;


class BrandController extends Controller
{
    protected $model='Brand';

    protected $title='برند';

    protected $route_params='brands';
    public function index(Request $request)
    { 
        $brand=Brand::getData($request->all());

        $trash_brand_count=Brand::onlyTrashed()->count();


       return view('brand.index',['brand'=>$brand,'trash_brand_count'=>$trash_brand_count,'request'=>$request]);
    }

    public function create()
    {
        return view('brand.create');
    }

  
    public function store(Request $request)
    {
        $brand=new Brand($request->all());

        $img_url=upload_file($request,'pic','upload');

        $brand->brand_icon=$img_url;

        $brand->saveOrFail();

        return redirect('admin/brands')->with('message','ثبت برند با موفقیت انجام شد ');
    }

    public function show($id)
    {
        //
    }

  
    public function edit($id)
    {
       $brand=Brand::findOrFail($id);

       return view('brand.edit',['brand'=>$brand]);
    }

    public function update(Request $request, $id)
    {
        $brand=Brand::findOrFail($id);

        
        $img_url = upload_file($request, 'pic', 'upload');

         if($img_url){

            $brand->brand_icon=$img_url;
         }
         $brand->update($request->all());

        return redirect('admin/brands')->with('message','به روز رسانی برند با موفقیت انجام شد ');
    }

   
    public function destroy($id)
    {
        $model_name = "App\\" . $this->model;

        // echo $model_name;
        //$row = $model_name::withTrashed()->findOrFail($id);
        $param_name=$this->route_params.'_id';
        $row = Brand::withTrashed()->findOrFail($id);



        if ($row->deleted_at == null) {

            $message = "$this->title به سطل زباله انتقال یافت";

            $row->delete();
        } else {
            $row->forceDelete();
        }

    return redirect('admin/'.$this->route_params)->with('message', "حذف $this->title با موفقیت انجام شد ");
       
    }

    public function remove_items(Request $request)
    {

        //dd($request->all());
        $model_name = "App\\" . $this->model;
        $param_name = $this->route_params . '_id';
        $ids = $request->get($param_name, array());

        foreach ($ids as $key => $value) {

            $row = Brand::withTrashed()->where('id', $value)->firstOrFail();

            if ($row->deleted_at == null) {

                $row->delete();
            } else {

                $row->forceDelete();
            }
        }
        return redirect('admin/'.$this->route_params.'?trashed=true')->with('message', "$this->title به سطل زباله منتقل شد ");
       
    }

    public function restore_items(Request $request)
    {


        $ids = $request->get('brands_id', array());

        foreach ($ids as $key => $value) {

            $row = Brand::withTrashed()->where('id', $value)->firstOrFail();

            $row->restore();
        }
        return redirect('admin/brands?trashed=true')->with('message', 'بازیابی دسته ها با موفقیت انجام شد  ');
    }

    public function restore($id)
    {

        $row =Brand::withTrashed()->where('id', $id)->firstOrFail();

        $row->restore();

        return redirect('admin/brands?trashed=true')->with('message', 'بازیابی دسته ها با موفقیت انجام شد  ');
    }
}
