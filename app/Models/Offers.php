<?php  

namespace app;

use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;



class Offers{


public function add($request,$ProductWarranty){

       $Validator=Validator::make($request->all(),[

        'date1'=>'required',
        'date2'=>'required',
        'price1'=>'required|numeric',
            'product_number' => 'required|numeric',
            'product_number_cart' => 'required|numeric',

       ],[],[


         'price1'=>'هزینه محصول',
                         'price2'=>'هزینه محصول برای فروش ',
                        ' product_number'=>'تعداد موجودی محصول',
                         'product_number_cart'=>'تعداد قابل سفارش در سبد خرید ',



       ]);

if($Validator->fails()){

    return $Validator->errors();
}else{


            $date1 = $request->get('date1');

            $date2 = $request->get('date2');

            $offers_first_time = getTimestamp($date1, 'first');

            $offers_last_time = getTimestamp($date2, 'last');

            $row = DB::table('old_price')->where('warranty_id', $ProductWarranty)->first();

            if (!$row) {


                $this->addNewPriceRow($ProductWarranty, $request);
            } else {

                $this->updatePriceRow($row, $ProductWarranty, $request);
            }
            $ProductWarranty->offers_first_date = $date1;
            $ProductWarranty->offers_last_date = $date2;
            $ProductWarranty->offers_first_time = $offers_first_time;
            $ProductWarranty->offers_last_time = $offers_last_time;

            $ProductWarranty->offers = 1;


            if ($ProductWarranty->update($request->all())) {

                add_min_product_price($ProductWarranty);

                $product = Product::with('id', $ProductWarranty->product_id)->select(['price', 'id', 'status'])->first();

                update_product_price($product);
                return 'ok';
            } else {

                return ['error'=>true];
            }
}
}
          

public function addNewPriceRow($ProductWarranty,$request){

        $n = $ProductWarranty->product_number - $request->get('product_number');
        if ($n < 0) {

            $n = 0;
        }

        $insert_id = DB::table('old_price')->insertGetId([

            'warranty-id' => $ProductWarranty->id,
            'price1' => $ProductWarranty->price1,
            'price2' => $ProductWarranty->price2,
            'product_number' => $n,
            'product_number_cart' => $ProductWarranty->product_number_cart,
            'Number_product_sales' => $request->get('product_number'),



        ]);

}

public function updatePriceRow($request,$ProductWarranty,$row){


        $n = $row->product_number;
        if ($request->get('product_number') > 0) {
        }
        if ($row->Number_product_sales > $request->get('product_number')) {


            $n1 = $row->Number_product_sales - $request->get('product_number');


            $n = $n + $n1;
        } else {

            $n1 = $request->get('product_number') - $row->Number_product_sales;


            $n = $n - $n1;
        }

        DB::table('old_price')->where(['warranty_id' => $ProductWarranty->id])->update([

            'Number_product_sales' => $request->get('product_number'),

            'product_number' => $n,

        ]);
}
    public function remove($request, $productWarranty)
    {

        $old_price = DB::table('old_price')->where('warranty_id', $productWarranty->id)->first();


        if ($old_price) {


            $productWarranty->price1 = $old_price->price1;
            $productWarranty->price2 = $old_price->price2;

            if ($old_price->product_number > 0) {


                $productWarranty->product_number = $productWarranty->product_number + $old_price->product_number;
            }
        }

        $productWarranty->offers = 0;

        $productWarranty->update();

        DB::table('old_price')->where('warranty_id', $productWarranty->id)->delete();
         
        add_min_product_price($productWarranty);

        $product=Product::with('id',$productWarranty->product_id)->select(['price','id','status'])->first();

        update_product_price($product);


        return $productWarranty;
    }


}