@extends('layouts.admin')


@section('content')


<div class="panel">

    <div class="header">  ویرایش گارانتی :{{$warranty->name}}</div>
  
    <div class="panel-content">
        
    
        {!! Form::model($warranty,['url' => 'admin/warranties'.$warranty->id]) !!}

        {{method_field('PUT')}}
        
       <div class="container-left">
            @include('include.breadcrumb',['data'=>[['title'=>'مدیریت گارانتی ','url'=>url('admin/warranties')],
    
    ['title'=>'ویرایش گارانتی ','url'=>'admin/warranties/'.$warranty->id.'/edit']
    ]]) 
       <div class="form-group">

        {{Form::label('name','نام گارانتی:') }}

       {{ Form::text('name',null,['class'=>'form-control']) }}

       @if($errors->has('name'))

       <span class="has_error">
           {{$errors->first('name')}}
       </span>

       @endif

       </div>
       
        
       

       <button class="btn btn-primary">

       ویرایش گارانتی
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection