<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ProductController extends Controller
{  

    protected $model='Product';
    protected $title='محصولات';

   protected $route_params='products';

    public function index(Request $request)
    {
        $product=Product::getData($request);
      $status=Product::ProductStatus();  

        $trash_product_count=Product::onlyTrashed()->count();

        return view('product.index',['product'=>$product,'trash_product_count'=>$trash_product_count,'request'=>$request,'status'=>$status]);
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

        $product->product_url=$product_url;

        $product->view=0;

        $image_url=upload_file($request,'pic','products');
        $product->image_url=$image_url;

        //create_fit_pic('files/products/'.$image_url,$image_url);

        $product->saveOrFail();

        foreach($product_color as $key=>$value){

             DB::table('product_color')->insert([
                  
                'product_id'=>$product->id,
                'color_id'=>$value,
                'cat_id'=>$product->cat_id


             ]);
        }
        return redirect('admin/products')->with('message','ثبت محصول با موفقیت انجام شد ');
    }

    public function show($id)
    {
        //
    }

   
    public function edit($id)
    {
        $product=Product::findOrFail($id);
        $colors = Color::get();
        $brand[''] = 'انتخاب برند';

        $brand = $brand + Brand::pluck('brand_name', 'id')->toArray();

        // dd($brand);
        $catList = Category::get_parent2();
        $status = Product::ProductStatus();

        $product_colors=DB::table('product_color')->where('product_id',$product->id)->get();

        return view('product.edit',['colors'=>$colors,'brand'=>$brand,'catList'=>$catList,'product'=>$product,'product_colors'=>$product_colors,'status'=>$status]);

    }

  
    public function update(Request $request, $id)
    {
        $product = Product::findOrFail($id);
        $product_color=$request->get('product_color',array());

        $product_url = get_url($request->get('title'));

        $product->product_url = $product_url;
        $image_url = upload_file($request, 'pic', 'products');
        if(!empty($image_url)){


        //  if(!empty($product->image_url && file_exists())){

           remove_file($product->image_url,'products');
            create_fit_pic('files/products/' . $image_url, $image_url);

            $product->image_url=$image_url;

        //  }
                }
                $product->update($request->all());
DB::table('product_color')->where('product_id',$product->id)->delete();
        foreach ($product_color as $key => $value) {

            DB::table('product_color')->insert([

                'product_id' => $product->id,
                'color_id' => $value,
                'cat_id' => $product->cat_id,
                 

            ]);
        }
        return redirect('admin/products')->with('message', 'ویرایش محصول با موفقیت انجام شد  ');
        


    }

    public function destroy($id)
    {
        //
    }

    public function gallery($id){

  $product=Product::where('id',$id)->select(['id','title'])->firstOrFail();

  $product_gallery=ProductGallery::where('product_id',$id)->orderBy('position','ASC')->get();


  return view('product.gallery',['product'=>$product,'product_gallery'=>$product_gallery]);

    }

    public function upload($id,Request $request){

$product=Product::where('id',$id)->select(['id','title'])->firstOrFail();

if($product){

$count=DB::table('product_galleries')->where('product_id',$id)->count();

$image_url=upload_file($request,'file','gallery','image_'.$id.rand(1,100));

if($image_url !=null){

    $count++;
    DB::table('product_galleries')->insert([
     
        'product_id'=>$id,
        'image_url'=>$image_url,

        'position'=>$count


    ]);
return 1;

}
else{

    return 0;
}

}
else{
return 0;

}
        
    }
public function removeImageGallery($id){

$image=ProductGallery::findOrFail($id);

$image_url=$image->image_url;

$image->delete();

if(file_exists('files/galley/'.$image_url)){
  

    unlink('files/galley/'.$image_url);
    
}
return redirect()->back()->with('message','حذف تصویر با موفقیت انجام شد ');
}
public function change_images_status($id,Request $request){


   // return $id;
   sleep(2);
$n=1;
   $parameters=$request->get('parameters');
       
   $parameters=explode(',',$parameters);
   foreach($parameters as $key=>$value){

    if(!empty($value)){

        DB::table('product_gallery')->where('id',$value)->update(['position'=>$n]);

$n++;
    }
   }
   return 'ok';
}

}
