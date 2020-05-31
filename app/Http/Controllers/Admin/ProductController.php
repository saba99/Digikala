<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{  

    protected $model='Product';
    protected $title='محصولات';

   protected $route_params='products';

    public function index()
    {
        //
    }

   
    public function create()
    {
        $colors=Color::get();
        $brand['']='انتخاب برند';

        $brand=$brand+Brand::pluck('brand_name','id')->toArray();

      // dd($brand);
      $catList=Category::get_parent2();
        $status = Product::ProductStatus();

      //dd($catList);

      return view('product.create',['colors'=>$colors,'brand'=>$brand,'catList'=>$catList,'status'=>$status]);


    }

    public function store(ProductRequest $request)
    {
        $product_color=$request->get('product_color',array());

        $product=new Product($request->all());

        $product_url=get_url($request->get('title'));

        $image_url=upload_file($request,'pic','products');
        $product->image_url=$image_url;

        $product->saveOrFail();

        foreach($product_color as $key=>$value){

             DB::table('product_color')->insert([
                  
                'product_id'=>$product->id,
                'color_id'=>$value,
                'cat_id'=>$product->cat_id


             ]);
        }
        return redirect('admin/product')->with('message','ثبت محصول با موفقیت انجام شد ');
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
}
