@extends('layouts.admin')


@section('content')


<div class="panel">

    <div class="header">  ویرایش دسته بندی  {{$category->name}}</div>
  
    <div class="panel-content">
        
    
        {!! Form::model($category,['url' => 'admin/category/'.$category->id,'files'=>true]) !!}

        {{method_field('PUT')}}
        
       <div class="container-left">
           @include('include.breadcrumb',['data'=>[['title'=>'مدیریت دسته ها ','url'=>url('admin/category')],
    
    ['title'=>'ویرایش دسته بندی ','url'=>'admin/category/'.$category->id.'/edit']
    ]])
       <div class="form-group">

        {{Form::label('name','نام دسته :') }}

       {{ Form::text('name',null,['class'=>'form-control']) }}

       @if($errors->has('name'))

       <span class="has_error">
           {{$errors->first('name')}}
       </span>

       @endif

       </div>
       <div class="form-group">

        {{Form::label('ename','نام لاتین: ') }}

       {{ Form::text('ename',null,['class'=>'form-control']) }}

       </div>
       <div class="form-group">

        {{Form::label('search_url','دسته url :') }}

       {{ Form::text('search_url',null,['class'=>'form-control']) }}
        @if($errors->has('search_url'))

       <span class="has_error">
           {{$errors->first('search_url')}}
       </span>

       @endif
       </div>
       <div class="form-group">

        {{Form::label('parent_id','انتخاب سر دسته :') }}
        {{Form::select('parent_id',$parent_cat,null,['class'=>'selectpicker'])}}

       </div>
       <div class="form-group">

        {{Form::label('pic','تصویر:') }}

       <input type="file" name="pic"  id="pic" onchange="loadFile(event)" style="display: none">
        <img src="{{url('files/images/pic_2.jpg')}}" onclick="select_file()" width="150px;" id="output">

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