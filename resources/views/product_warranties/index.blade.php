@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    @include('include.breadcrumb',['data'=>[['title'=>'مدیریت گارانتی ها  ','url'=>url('admin/product_warranties?product_id='.$product->id)]]]) 

    <div class="header">مدیریت تنوع های قیمت {{$product->title}}
        
        @include('include.item_table',['count'=>$trash_product_warranties_count,'route'=>'admin/warranties','title'=>'تنوع قیمت','queryString'=>['param'=>'product_id','value'=>$product->id]])
    
    </div>

    <div class="panel-content" id="product_warranties">

        @include('include.alert')

      <?php $i=(isset($_GET['page']))? (($_GET['page']-1)*2): 0 ?>
      

      <form method="GET" class="search_form">
          @if(isset($_GET['trashed']) && ($_GET['trashed'])==true)
          
          <input type="hidden" name="trashed" value="true"> 
          @endif
          <input type="text" name="string" class="form-control" value="{{$request->get('string','')}}" placeholder="کلمه موردنظر ">
          <button class="btn btn-primary">جست و جو</button>
          
      </form>
      <form method="POST" id="data_form">
        @csrf
        <table class="table table-bordered table-striped">

      <thead>
          <tr>
              <th>*</th>
              <th>ردیف</th>
                <th>نام گارانتی</th>
          <th>قیمت محصول</th>
          <th>قیمت محصول برای فروش</th>
          <th>تعداد موجودی محصول</th>
          <th>رنگ</th>
          <th>فروشنده </th>
              <th>عملیات</th>
          </tr>
      </thead>

      <tbody>
          @foreach($product_warranties as $key=>$value)
@php  $i++; @endphp
<tr>
    <td>
        <input type="checkbox" name="product_warranties_id[]" class="check_box" value="{{$value->id}}">
    </td>
    <td>{{replace_number($i)}}</td>
  
    <td>{{$value->getWarranty->name}}</td>

<td style="min-width: 160px;"><span class="alert alert-success">{{replace_number(number_format($value->price1)).'تومان'}}</span></td>
<td style="min-width: 160px;"><span class="alert alert-warning">{{replace_number(number_format($value->price2)).'تومان'}}</span></td>

<td>{{replace_number($value->product_number)}}</td>
<td style="width:140px;">

   
</td>

<td></td>
   <td>
       @if(!$value->trashed())
   <a href="{{url('/admin/product_warranties/'.$value->id.'/edit?product_id='.$product->id)}}">
    <span class="fa fa-edit"></span> 
    </a>
    @endif
    @if(!$value->trashed())

   <span    data-toggle="tooltip" data-placement="bottom" title= "حذف گارانتی" onclick="del_row('{{url('admin/product_warranties/'.$value->id.'?product_id='.$product->id)}}','{{Session::token()}}','آیا از حذف این تنوع قیمت مطمئن هستید ؟')" class="fa fa-remove"></span>
@else 
   <span   data-toggle="tooltip" data-placement="bottom" title="آیا از حذف این تنوع قیمت  برای همیشه اطمینان دارید ؟" onclick="restore_row('{{url('admin/product_warranties/'.$value->id.'?product_id='.$product->id)}}','{{Session::token()}}','آیا از حذف دسته برای همیشه این تنوع قیمت مطمئن هستید ؟')" class="fa fa-remove"></span>
   @endif
    @if($value->trashed())
    
    <span   data-toggle="tooltip" data-placement="bottom" title="بازیابی تنوع قیمت " onclick="restore_row('{{url('admin/product_warranties/'.$value->id.'?product_id='.$product->id)}}','{{Session::token()}}','آیا از بازیابی این تنوع قیمت  مطمئن هستید ؟')" class="fa fa-remove"></span>
   </td>
   
       @endif 

</tr>

          @endforeach


          @if(sizeof($product_warranties)==0)

<tr>
    <td colspan="9">رکوردی برای نمایش وجود ندارد</td>
</tr>
          @endif
      </tbody>
        </table>
    </form>
        {{$product_warranties->links()}}
    </div>


</div>
</div>



@endsection

@section('footer')

<script>

    $("#sidbarToggle").click();
</script>

@endsection