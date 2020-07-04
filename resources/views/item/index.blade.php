@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    {{-- @include('include.breadcrumb',['data'=>[['title'=>'مدیریت ویژگی ها  ','url'=>url('admin/category/'.$category->id.'/items')]]]) --}}

    <div class="header">
        
       مدیریت ویژگی های دسته {{$category->name}}
    
    </div> 
 <div class="panel-content">

        @include('include.alert')

<form method="post" action="{{url('admin/category').'/'.$category->id .'/item'}}">

    @csrf 
    <div id="item_box">

    </div>
<span class="fa fa-plus-square "  onclick="add_item_input()">

</span>
<div class="form-group">
    <button class="btn btn-primary">
        ثبت اطلاعات 
    </button>
</div>
</form>
 </div>

</div> 
</div>


@endsection