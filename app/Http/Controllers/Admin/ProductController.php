<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Filter;
use App\Models\Item;
use App\Models\Product;
use App\Models\ProductFilter;
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

public function items($id){


$product=Product::where('id',$id)->select(['id','title','cat_id'])->firstOrFail();

 $data=Item::getProductItemWithFilter($product);

 $product_items=$data['items'];

 $filters=$data['filters'];

 $product_filters=ProductFilter::where('product_id',$product->id)->pluck('filter_id','filter_value')->toArray();


return view('product.items',['filters'=>$filters,'product'=>$product,'product_items'=>$product_items,'product_filters'=>$product_filters]);

}
public function add_items($id,Request $request){
             
    
        $product = Product::where('id', $id)->select(['id', 'title', 'cat_id'])->firstOrFail();
         $item_value=$request->get('item_value');
         $filter_value=$request->get('filter_value');
DB::table('item_value')->where(['product_id'=>$id])->delete();
        // dd($item_value);
        foreach($item_value as $key=>$value){

           foreach($value as $key2=>$value2){

            if(!empty($value2)){

                 DB::table('item_value')->insert([

                    'product_id'=>$id,
                    'item_id'=>$key,
                    'item_value'=>$value2
                 ]);

            }
           }

               Item::addFilter($key,$filter_value,$id);
        }

        return  redirect()->back()->with('message','ثبت مشخصات فنی با موفقیت انجام شد ');
}
    
public function filters($id){
        $filter = Product::where('id', $id)->select(['id', 'title', 'cat_id'])->firstOrFail();

       $product_filter=Filter::getProductFilter($filter);

        return view('product.filter', ['filter' => $filter,'product_filter'=>$product_filter]);

}
public function add_filters($id,Request $request){

//dd($request->all());

$filter=$request->get('filter');

        $filter = Product::where('id', $id)->select(['id', 'title', 'cat_id'])->firstOrFail();

DB::table('item_value')->where(['product_id'=>$id])->delete();

if(is_array($filter)){


foreach($filter as $key=>$value){


    if(is_array($value)){

        foreach($value as $key2=>$value2){

           DB::table('filter_product')->insert([
             
            'product_id'=>$id,
            'filter_id'=>$key,
            'filter_value'=>$value2

           ]);
        }
    }
}
}

return redirect()->back()->with('message','ثبت فیلتر ها با موفقیت انجام شد ');
}
}
