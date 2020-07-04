@extends('layouts.admin')


@section('content')


<div class="panel">
      
  

    <div class="header">افزودن گارانتی جدید </div>

    <div class="panel-content">
   
        {!! Form::open(['url' => 'admin/warranties']) !!}
        
       <div class="container-left">
               @include('include.breadcrumb',['data'=>[['title'=>'مدیریت گارانتی ها  ','url'=>url('admin/warranties')],
    
    ['title'=>'افزودن گارانتی جدید ','url'=>'admin/warranties/create']
    ]])  
       <div class="form-group">

        {{Form::label('name','نام گارانتی :') }}

       {{ Form::text('name',null,['class'=>'form-control']) }}

       @if($errors->has('name'))

       <span class="has_error">
           {{$errors->first('name')}}
       </span>

       @endif

       </div>
      
  

       <button class="btn btn-success">

       ثبت گارانتی
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection


@section('footer')


<script src="{{ asset('js/jscolor.js') }}" defer ></script>
@endsection