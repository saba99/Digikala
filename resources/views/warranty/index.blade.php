@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    @include('include.breadcrumb',['data'=>[['title'=>'مدیریت گارانتی ها  ','url'=>url('admin/warranties')]]]) 

    <div class="header">مدیریت گارانتی ها  
        
        @include('include.item_table',['count'=>$trash_warranty_count,'route'=>'admin/warranties','title'=>'گارانتی'])
    
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
                <th>نام گارانتی</th>
          
              <th>عملیات</th>
          </tr>
      </thead>

      <tbody>
          @foreach($warranty as $key=>$value)
@php  $i++; @endphp
<tr>
    <td>
        <input type="checkbox" name="warranties_id[]" class="check_box" value="{{$value->id}}">
    </td>
    <td>{{replace_number($i)}}</td>

    <td>{{$value->name}}</td>

   <td>
       @if(!$value->trashed())
   <a href="{{url('/admin/warranties/'.$value->id.'/edit')}}">
    <span class="fa fa-edit"></span> 
    </a>
    @endif
    @if(!$value->trashed())

   <span    data-toggle="tooltip" data-placement="bottom" title= "حذف گارانتی" onclick="del_row('{{url('admin/warranties/'.$value->id)}}','{{Session::token()}}','آیا از حذف این گارانتی مطمئن هستید ؟')" class="fa fa-remove"></span>
@else 
   <span   data-toggle="tooltip" data-placement="bottom" title="آیا از حذف این گارانتی برای همیشه اطمینان دارید ؟" onclick="restore_row('{{url('admin/warranties/'.$value->id)}}','{{Session::token()}}','آیا از حذف دسته برای همیشه این گارانتی مطمئن هستید ؟')" class="fa fa-remove"></span>
   @endif
    @if($value->trashed())
    
    <span   data-toggle="tooltip" data-placement="bottom" title="بازیابی گارانتی " onclick="restore_row('{{url('admin/warranties/'.$value->id)}}','{{Session::token()}}','آیا از بازیابی این گارانتی مطمئن هستید ؟')" class="fa fa-remove"></span>
   </td>
   
       @endif 

</tr>

          @endforeach


          @if(sizeof($warranty)==0)

<tr>
    <td colspan="4">رکوردی برای نمایش وجود ندارد</td>
</tr>
          @endif
      </tbody>
        </table>
    </form>
        {{$warranty->links()}}
    </div>


</div>
</div>



@endsection