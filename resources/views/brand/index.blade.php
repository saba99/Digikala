@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    @include('include.breadcrumb',['data'=>[['title'=>'مدیریت برند ها ','url'=>url('admin/brands')]]]) 

    <div class="header">مدیریت برند ها
        
        @include('include.item_table',['count'=>$trash_brand_count,'route'=>'admin/brands','title'=>'برند'])
    
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
              <th>آیکون</th>
              <th>نام برند </th>
              <th>نام انگلیسی برند</th>
              <th>عملیات</th>
          </tr>
      </thead>

      <tbody>
          @foreach($brand as $key=>$value)
@php  $i++; @endphp
<tr>
    <td>
        <input type="checkbox" name="brands_id[]" class="check_box" value="{{$value->id}}">
    </td>
    <td>{{replace_number($i)}}</td>

    <td>
        @if(!empty($value->brand_icon))

          <img src="{{url('files/upload'.$value->brand_icon)}}">
        @endif
    </td>
    
    <td>{{$value->brand_name}}</td>

    <td>{{$value->brand_ename}}</td>

   <td>
       @if(!$value->trashed())
   <a href="{{url('/admin/brands/'.$value->id.'/edit')}}">
    <span class="fa fa-edit"></span> 
    </a>
    @endif
    @if(!$value->trashed())

   <span    data-toggle="tooltip" data-placement="bottom" title= "حذف برند" onclick="del_row('{{url('admin/brands/'.$value->id)}}','{{Session::token()}}','آیا از حذف این برند مطمئن هستید ؟')" class="fa fa-remove"></span>
@else 
   <span   data-toggle="tooltip" data-placement="bottom" title="آیا از حذف این برند برای همیشه اطمینان دارید ؟" onclick="restore_row('{{url('admin/brands/'.$value->id)}}','{{Session::token()}}','آیا از حذف دسته برای همیشه این برند مطمئن هستید ؟')" class="fa fa-remove"></span>
   @endif
    @if($value->trashed())
    
    <span   data-toggle="tooltip" data-placement="bottom" title="بازیابی برند " onclick="restore_row('{{url('admin/brands/'.$value->id)}}','{{Session::token()}}','آیا از بازیابی این برند مطمئن هستید ؟')" class="fa fa-remove"></span>
   </td>
   
       @endif 

</tr>

          @endforeach


          @if(sizeof($brand)==0)

<tr>
    <td colspan="6">رکوردی برای نمایش وجود ندارد</td>
</tr>
          @endif
      </tbody>
        </table>
    </form>
        {{$brand->links()}}
    </div>


</div>
</div>



@endsection