@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    @include('include.breadcrumb',['data'=>[['title'=>'مدیریت اسلایدر ها  ','url'=>url('admin/sliders')]]]) 

    <div class="header">مدیریت اسلایدر ها 
        
        @include('include.item_table',['count'=>$trash_slider_count,'route'=>'admin/sliders','title'=>'اسلایدر'])
    
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
              <th>عنوان</th>
              <th>تصویر </th>
              
              <th>عملیات</th>
          </tr>
      </thead>

      <tbody>
          @foreach($sliders as $key=>$value)
@php  $i++; @endphp
<tr>
    <td>
        <input type="checkbox" name="sliders_id[]" class="check_box" value="{{$value->id}}">
    </td>
    <td>{{replace_number($i)}}</td>
         <td>{{$value->url}}</td>
    <td>
        @if(!empty($value->image_url))

          <img src="{{url('files/slider/'.$value->image_url)}}" class="slide_img">
        @endif
    </td>
    


    

   <td>
       @if(!$value->trashed())
   <a href="{{url('/admin/sliders/'.$value->id.'/edit')}}">
    <span class="fa fa-edit"></span> 
    </a>
    @endif
    @if(!$value->trashed())

   <span    data-toggle="tooltip" data-placement="bottom" title= "حذف اسلایدر" onclick="del_row('{{url('admin/sliders/'.$value->id)}}','{{Session::token()}}','آیا از حذف این اسلایدر  مطمئن هستید ؟')" class="fa fa-remove"></span>
@else 
   <span   data-toggle="tooltip" data-placement="bottom" title="آیا از حذف این اسلایدر برای همیشه اطمینان دارید ؟" onclick="restore_row('{{url('admin/sliders/'.$value->id)}}','{{Session::token()}}','آیا از حذف دسته برای همیشه این اسلایدر مطمئن هستید ؟')" class="fa fa-remove"></span>
   @endif
    @if($value->trashed())
    
    <span   data-toggle="tooltip" data-placement="bottom" title="بازیابی برند " onclick="restore_row('{{url('admin/brands/'.$value->id)}}','{{Session::token()}}','آیا از بازیابی این برند مطمئن هستید ؟')" class="fa fa-remove"></span>
   </td>
   
       @endif 

</tr>

          @endforeach


          @if(sizeof($sliders)==0)

<tr>
    <td colspan="6">رکوردی برای نمایش وجود ندارد</td>
</tr>
          @endif
      </tbody>
        </table>
    </form>
        {{$sliders->links()}}
    </div>


</div>
</div>



@endsection