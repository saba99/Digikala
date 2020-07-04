<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;



class SliderController extends Controller
{

    protected $model = 'Slider';
    protected $title = 'اسلایدر';

    protected $route_params = 'sliders';

   
    public function index(Request $request)
    {

        $sliders = Slider::getData($request);
        

        $trash_slider_count = Slider::onlyTrashed()->count();

        return view('slider.index', ['sliders' => $sliders, 'trash_slider_count' => $trash_slider_count, 'request' => $request]);  
    }

    public function create()
    {
        return view('slider.create');
    }

    public function store(SliderRequest $request)
    {
        $slider=new Slider($request->all());

        $image_url=upload_file($request,'pic','slider','desktop');

        // $mobile_image_url = upload_file($request, 'mobilepic', 'slider', 'mobile');

        $slider->image_url=$image_url;

        // $slider->mobile_image_url= $mobile_image_url;

        $slider->saveOrFail();

        return redirect('admin/sliders')->with('message','ثبت اسلایدر با موفقیت انجام شد ');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $slider=Slider::findOrFail($id);

        return view('slider.edit',['slider'=>$slider]);



    }

  
    public function update(Request $request, $id)
    {
        $slider = Slider::findOrFail($id);

        $image_url = upload_file($request, 'pic', 'slider', 'desktop');

        $mobile_image_url = upload_file($request, 'mobilepic', 'slider', 'mobile');

         if($image_url !=null){


            $slider->image_url=$image_url;
         }
         if($mobile_image_url !=null){

            $slider->mobile_image_url=$image_url;
         }

         $slider->update($request->all());


        return redirect('admin/sliders')->with('message', 'ویرایش اسلایدر با موفقیت انجام شد ');


    }

    public function destroy($id)
    {
        //
    }
}
