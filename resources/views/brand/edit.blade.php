@extends('layouts.admin')


@section('content')


<div class="panel">

    <div class="header">  ویرایش برند  {{$brand->brand_name}}</div>
  
    <div class="panel-content">
        
    
        {!! Form::model($brand,['url' => 'admin/brands/'.$brand->id,'files'=>true]) !!}

        {{method_field('PUT')}}
        
       <div class="container-left">
           {{--  @include('include.breadcrumb',['data'=>[['title'=>'مدیریت برند ','url'=>url('admin/brands')],
    
    ['title'=>'ویرایش برند ','url'=>'admin/brands/'.$brand->id.'/edit']
    ]])  --}}
       <div class="form-group">

        {{Form::label('brand_name','نام برند:') }}

       {{ Form::text('barnd_name',null,['class'=>'form-control']) }}

       @if($errors->has('brand_name'))

       <span class="has_error">
           {{$errors->first('brand_name')}}
       </span>

       @endif

       </div>
       <div class="form-group">

        {{Form::label('brand_ename','نام لاتین: ') }}

       {{ Form::text('brand_ename',null,['class'=>'form-control']) }}

       </div>
        
       <div class="form-group">

        {{Form::label('pic','تصویر:') }}

       <input type="file" name="pic"  id="pic" onchange="loadFile(event)" style="display: none">
        <img @if(!empty($brand->brand_icon)) src="{{url('files/upload/'.$brand->brand_icon)}}" @endif onclick="select_file()" width="150px;" id="output">

         @if($errors->has('pic'))

       <span class="has_error">
           {{$errors->first('pic')}}
       </span>

       @endif
       </div>
       <div class="form-group">

        {{Form::label('notShow','عدم نمایش در لیست اصلی:') }}

       {{  Form::checkbox('notShow', false) }}

       </div>

       <button class="btn btn-primary">

        ویرایش دسته 
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection