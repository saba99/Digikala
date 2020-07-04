<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\WarrantyRequest;
use App\Models\Product;
use App\Models\ProductColor;
use App\Models\ProductWarranty;
use App\Models\Warranty;
use Illuminate\Http\Request;


class ProductWarrantyController extends Controller
{
    protected  $model = 'ProductWarranty';

    protected  $title = 'تنوع قیمت';

    protected $route_params = 'product_warranties';

    protected $product;

    protected $query_string;

    public function __construct(Request $request)
    {
        $product_id = $request->get('product_id');

        $this->product = Product::findOrFail($product_id);


        $this->query_string = 'product_id=' . $product_id;


    } 
    public function index(Request $request)
    {
        $product_warranties=ProductWarranty::getData($request->all());

        $trash_product_warranties_count=ProductWarranty::onlyTrashed()->count();

        return view('product_warranties.index',['product_warranties'=> $product_warranties, 'trash_product_warranties_count'=> $trash_product_warranties_count,'product'=>$this->product,'request'=>$request]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function create()
    {
        $warranty = Warranty::orderBy('id', 'DESC')->pluck('name')->toArray();

        $colors = ProductColor::with('getColor')->where('product_id', $this->product->id)->get();


        return view('product_warranties.create', [

            'warranty' => $warranty,
            'colors' => $colors,
            'product' => $this->product,

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request->all());

        $check=ProductWarranty::where([
              'seller_id'=>0,
              'warranty_id'=>$request->get('warranty_id'),
              'product_id'=>$request->get('product_id'),

              'color_id'=>$request->get('color_id')

        ])->first();
        if(!$check){

          $warranty=new ProductWarranty($request->all());

        $warranty->saveOrFail();

        // add_min_product_price($warranty);

        // update_product_price($this->product);


        return redirect('admin/product_warranties?product_id='.$this->product->id)->with('message','ثبت تنوع قیمت با موفقیت انجام شد ');

  
        }
        else{

            return redirect()->back()->withInput()->with('warning','تنوع قیمت با مشخصات انتخابی قبلا ثبت شده ');
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   

        $product_warranties=ProductWarranty::findOrFail($id);
         $warranty = Warranty::orderBy('id', 'DESC')->pluck('name')->toArray();

        $colors = ProductColor::with('getColor')->where('product_id', $this->product->id)->get();


        return view('product_warranties.edit', [

            'warranty' => $warranty,
            'colors' => $colors,
            'product' => $this->product,
             'product_warranties'=>$product_warranties
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {    
        
       
        $product_warranties=ProductWarranty::findOrFail($id);

         $product_warranties->update($request->all());

        // update_product_price($this->product);

        // add_min_product_price($product_warranties);

        

        return redirect('admin/product_warranties?product_id='.$this->product->id)->with('message','ویرایش تنوع قیمت با موفقیت انجام شد ');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
