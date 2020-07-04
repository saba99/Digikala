@extends('layouts.admin')


@section('content')


<div class="panel">

    <div class="header">  ویرایش اسلایدر   {{$slider->title}}</div>
  
    <div class="panel-content">
        
    
        {!! Form::model($slider,['url' => 'admin/sliders/'.$slider->id,'files'=>true]) !!}

        {{method_field('PUT')}}
        
       <div class="container-left">
           {{--  @include('include.breadcrumb',['data'=>[['title'=>'مدیریت برند ','url'=>url('admin/brands')],
    
    ['title'=>'ویرایش برند ','url'=>'admin/brands/'.$brand->id.'/edit']
    ]])  --}}
       <div class="form-group">

        {{Form::label('title','عنوان:') }}

       {{ Form::text('title',null,['class'=>'form-control']) }}

       @if($errors->has('title'))

       <span class="has_error">
           {{$errors->first('title')}}
       </span>

       @endif

       </div>
       <div class="form-group">

        {{Form::label('url','آدرس url: ') }}

       {{ Form::text('url',null,['class'=>'form-control']) }}

       </div>
        
       <div class="form-group">

        {{Form::label('pic','تصویر:') }}

       <input type="file" name="pic"  id="pic" onchange="loadFile(event)" style="display: none">
        <img @if(!empty($slider->image_url)) src="{{url('files/slider/'.$slider->image_url)}}" @endif onclick="select_file()" width="150px;" id="output">

         @if($errors->has('pic'))

       <span class="has_error">
           {{$errors->first('pic')}}
       </span>

       @endif
       </div>
      

       <button class="btn btn-primary">

        ویرایش اسلایدر  
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection