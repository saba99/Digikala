@extends('layouts.admin')


@section('content')


<div class="panel">
      
  

    <div class="header">افزودن برند جدید</div>

    <div class="panel-content">
   
        {!! Form::open(['url' => 'admin/brands','files'=>true]) !!}
        
       <div class="container-left">
             {{--  @include('include.breadcrumb',['data'=>[['title'=>'مدیریت دسته ها ','url'=>url('admin/brands')],
    
    ['title'=>'افزودن برند جدید ','url'=>'admin/brands/create']
    ]])   --}}
       <div class="form-group">

        {{Form::label('brand_name','نام برند :') }}

       {{ Form::text('brand_name',null,['class'=>'form-control']) }}

       @if($errors->has('brand_name'))

       <span class="has_error">
           {{$errors->first('brand_name')}}
       </span>

       @endif

       </div>
       <div class="form-group">

        {{Form::label('brand_ename','نام لاتین: ') }}

       {{ Form::text('brand_ename',null,['class'=>'form-control']) }}
         @if($errors->has('brand_ename'))

       <span class="has_error">
           {{$errors->first('brand_ename')}}
       </span>

       @endif
       </div>
         <div class="form-group">

        {{Form::label('description','توضیحات: ') }}

       {{ Form::textarea('description',null,['class'=>'form-control brand_description']) }}
         @if($errors->has('description'))

       <span class="has_error">
           {{$errors->first('description')}}
       </span>

       @endif
       </div>
       
      
        
       
       <div class="form-group">

        {{Form::label('pic','تصویر:') }}

       <input type="file" name="pic"  id="pic" onchange="loadFile(event)" style="display: none">
        <div onclick="select_file()" class="btn btn-primary"> انتخاب آیکون برند</div>
         @if($errors->has('pic'))

       <span class="has_error">
           {{$errors->first('pic')}}
       </span>

       @endif
       </div>
         <div class="form-group">

    
        <img  onclick="select_file()" width="150px;" style="margin-top:0 px;" id="output">

         @if($errors->has('pic'))

       <span class="has_error">
           {{$errors->first('pic')}}
       </span>

       @endif
       </div>
     
        
       <button class="btn btn-success">

        ثبت برند
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection