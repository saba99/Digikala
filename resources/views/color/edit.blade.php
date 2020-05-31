@extends('layouts.admin')


@section('content')


<div class="panel">

    <div class="header">  ویرایش رنگ {{$color->name}}</div>
  
    <div class="panel-content">
        
    
        {!! Form::model($color,['url' => 'admin/colors/'.$color->id]) !!}

        {{method_field('PUT')}}
        
       <div class="container-left">
           {{--  @include('include.breadcrumb',['data'=>[['title'=>'مدیریت برند ','url'=>url('admin/brands')],
    
    ['title'=>'ویرایش برند ','url'=>'admin/brands/'.$brand->id.'/edit']
    ]])  --}}
       <div class="form-group">

        {{Form::label('name','نام رنگ:') }}

       {{ Form::text('name',null,['class'=>'form-control']) }}

       @if($errors->has('name'))

       <span class="has_error">
           {{$errors->first('name')}}
       </span>

       @endif

       </div>
       <div class="form-group">

        {{Form::label('code','کد رنگ: ') }}

       {{ Form::text('code',null,['class'=>'form-control']) }}

       </div>
        
       

       <button class="btn btn-primary">

        ویرایش دسته 
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection