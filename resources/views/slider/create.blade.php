@extends('layouts.admin')


@section('content')


<div class="panel">
      
  

    <div class="header">افزودن اسلایدر جدید</div>

    <div class="panel-content">
   
        {!! Form::open(['url' => 'admin/sliders','files'=>true]) !!}
        
       <div class="container-left">
             {{--  @include('include.breadcrumb',['data'=>[['title'=>'مدیریت دسته ها ','url'=>url('admin/brands')],
    
    ['title'=>'افزودن برند جدید ','url'=>'admin/brands/create']
    ]])   --}}
       <div class="form-group">

        {{Form::label('title','عنوان :') }}

       {{ Form::text('title',null,['class'=>'form-control']) }}

       @if($errors->has('title'))

       <span class="has_error">
           {{$errors->first('title')}}
       </span>

       @endif

       </div>
       <div class="form-group">

        {{Form::label('url','url آدرس: ') }}

       {{ Form::text('url',null,['class'=>'form-control left total_width_input']) }}
         @if($errors->has('url'))

       <span class="has_error">
           {{$errors->first('url')}}
       </span>

       @endif
       </div>
        
       <div class="form-group">

        {{Form::label('pic','تصویر:') }}

       <input type="file" name="pic"  id="pic" onchange="loadFile(event)" style="display: none">
        <div onclick="select_file()" class="btn btn-primary"> انتخاب تصویر اسلایدر </div>
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
{{--      
        <div class="form-group">

        {{Form::label('mobile_pic','تصویر:') }}

       <input type="file" name="mobile_pic"  id="mobile_pic" onchange="l_mobile(event)" style="display: none">
        <div onclick="s_mobile()" class="btn btn-primary">انتخاب تصویر اسلایدر برای موبایل  </div>
         @if($errors->has('mobile_pic'))

       <span class="has_error">
           {{$errors->first('mobile_pic')}}
       </span>

       @endif
       </div>
         <div class="form-group">

    
        <img  onclick="s_mobile()" width="150px;" style="margin-top:0 px;" id="output2">

         @if($errors->has('mobile_pic'))

       <span class="has_error">
           {{$errors->first('mobile_pic')}}
       </span>

       @endif
       </div> --}}
       <button class="btn btn-success">

        ثبت اسلایدر 
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection