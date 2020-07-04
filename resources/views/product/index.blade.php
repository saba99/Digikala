@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    @include('include.breadcrumb',['data'=>[['title'=>'مدیریت محصولات ','url'=>url('admin/products')]]]) 

    <div class="header">مدیریت محصولات
        
        @include('include.item_table',['count'=>$trash_product_count,'route'=>'admin/products','title'=>'محصول'])
    
    </div>

    <div class="panel-content">

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
              <th>تصویر محصول</th>
              <th>عنوان</th>
              <th>فروشنده</th>
              <th> وضعیت محصول</th>
              <th>عملیات</th>
          </tr>
      </thead>

      <tbody>
          @foreach($product as $key=>$value)
@php  $i++; @endphp
<tr>
    <td>
        <input type="checkbox" name="products_id[]" class="check_box" value="{{$value->id}}">
    </td>
    <td>{{replace_number($i)}}</td>
    
    <td><img src="{{url('files/products/'.$value->image_url)}}" class="product_pic"></td>

    <td>{{$value->title}}</td>
    <td></td>
 <td style="width:120px;">

    @if(array_key_exists($value->status,$status))
       <span class="alert @if($value->status==1) alert-success @else  alert-warning @endif" style="font-size: 13px;padding:5px 7px;" >
           منتشر شده
    </span>  
    @endif
 </td>
   <td>
       @if(!$value->trashed())
   <a href="{{url('/admin/products/'.$value->id.'/edit')}}">
    <span class="fa fa-edit"></span> 
    </a>
    @endif
    @if(!$value->trashed())

   <span    data-toggle="tooltip" data-placement="bottom" title= "حذف محصول" onclick="del_row('{{url('admin/products/'.$value->id)}}','{{Session::token()}}','آیا از حذف این محصول مطمئن هستید ؟')" class="fa fa-remove"></span>
@else 
   <span   data-toggle="tooltip" data-placement="bottom" title="حذف محصول برای همیشه" onclick="restore_row('{{url('admin/products/'.$value->id)}}','{{Session::token()}}','آیااز حذف این محصول برای همیشه مطمئن هستید')" class="fa fa-remove"></span>
   @endif
    @if($value->trashed())
    
    <span   data-toggle="tooltip" data-placement="bottom" title="بازیابی محصول " onclick="restore_row('{{url('admin/products/'.$value->id)}}','{{Session::token()}}','آیا از بازیابی این محصول مطمئن هستید ؟')" class="fa fa-remove"></span>
   </td>
   
       @endif 

</tr>

          @endforeach


          @if(sizeof($product)==0)

<tr>
    <td colspan="6">رکوردی برای نمایش وجود ندارد</td>
</tr>
          @endif
      </tbody>
        </table>
    </form>
        {{$product->links()}}
    </div>


</div>
</div>



@endsection