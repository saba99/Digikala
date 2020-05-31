@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    @include('include.breadcrumb',['data'=>[['title'=>'مدیریت رنگ ها ','url'=>url('admin/colors')]]]) 

    <div class="header">مدیریت رنگ ها 
        
        @include('include.item_table',['count'=>$trash_color_count,'route'=>'admin/colors','title'=>'رنگ'])
    
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
                <th>نام رنگ</th>
             <th>کد رنگ</th>
              <th>عملیات</th>
          </tr>
      </thead>

      <tbody>
          @foreach($color as $key=>$value)
@php  $i++; @endphp
<tr>
    <td>
        <input type="checkbox" name="brands_id[]" class="check_box" value="{{$value->id}}">
    </td>
    <td>{{replace_number($i)}}</td>

    <td>{{$value->name}}</td>

    <td><span class="color" style="background:{{$value->code}};" @if($value->name=='سفید ') style="color: black" @endif>{{$value->code}}</span></td>

   <td>
       @if(!$value->trashed())
   <a href="{{url('/admin/colors/'.$value->id.'/edit')}}">
    <span class="fa fa-edit"></span> 
    </a>
    @endif
    @if(!$value->trashed())

   <span    data-toggle="tooltip" data-placement="bottom" title= "حذف رنگ" onclick="del_row('{{url('admin/colors/'.$value->id)}}','{{Session::token()}}','آیا از حذف این رنگ مطمئن هستید ؟')" class="fa fa-remove"></span>
@else 
   <span   data-toggle="tooltip" data-placement="bottom" title="آیا از حذف این رنگ برای همیشه اطمینان دارید ؟" onclick="restore_row('{{url('admin/colors/'.$value->id)}}','{{Session::token()}}','آیا از حذف دسته برای همیشه این برند مطمئن هستید ؟')" class="fa fa-remove"></span>
   @endif
    @if($value->trashed())
    
    <span   data-toggle="tooltip" data-placement="bottom" title="بازیابی رنگ " onclick="restore_row('{{url('admin/colors/'.$value->id)}}','{{Session::token()}}','آیا از بازیابی این رنگ مطمئن هستید ؟')" class="fa fa-remove"></span>
   </td>
   
       @endif 

</tr>

          @endforeach


          @if(sizeof($color)==0)

<tr>
    <td colspan="6">رکوردی برای نمایش وجود ندارد</td>
</tr>
          @endif
      </tbody>
        </table>
    </form>
        {{$color->links()}}
    </div>


</div>
</div>



@endsection