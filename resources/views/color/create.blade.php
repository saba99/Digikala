@extends('layouts.admin')


@section('content')


<div class="panel">
      
  

    <div class="header">افزودن رنگ جدید</div>

    <div class="panel-content">
   
        {!! Form::open(['url' => 'admin/colors']) !!}
        
       <div class="container-left">
             {{--  @include('include.breadcrumb',['data'=>[['title'=>'مدیریت دسته ها ','url'=>url('admin/brands')],
    
    ['title'=>'افزودن برند جدید ','url'=>'admin/brands/create']
    ]])   --}}
       <div class="form-group">

        {{Form::label('name','نام رنگ :') }}

       {{ Form::text('name',null,['class'=>'form-control']) }}

       @if($errors->has('name'))

       <span class="has_error">
           {{$errors->first('name')}}
       </span>

       @endif

       </div>
      
         <div class="form-group">

        {{Form::label('code','کد رنگ: ') }}

       {{ Form::text('code',null,['class'=>'form-control jscolor']) }}
         @if($errors->has('code'))

       <span class="has_error">
           {{$errors->first('code')}}
       </span>

       @endif
       </div>
  

       <button class="btn btn-success">

       ثبت  رنگ 
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection


@section('footer')


<script src="{{ asset('js/jscolor.js') }}" defer ></script>
@endsection