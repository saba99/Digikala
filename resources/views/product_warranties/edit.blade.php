@extends('layouts.admin')


@section('content')


<div class="panel">

    <div class="header">  ویرایش تنوع قیمت  :{{$product->title}}</div>
  
    <div class="panel-content">
        
    
        {!! Form::model($product_warranties,['url' => 'admin/product_warranties/'.$product_warranties->id.'?product_id='.$product->id]) !!}

        {{method_field('PUT')}}
        
       <div class="container-left">
            @include('include.breadcrumb',['data'=>[['title'=>'مدیریت تنوع قیمت  ','url'=>url('admin/product_warranties')],
    
    ['title'=>'ویرایش گارانتی ','url'=>'admin/product_warranties/'.$product_warranties->id.'/edit?product_id='.$product->id]
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
       <div class="form-group" >
    <lable>
        انتخاب رنگ های محصول:
    </lable>
    <select class="selectpicker"   data-live-search="true" multiple="multiple" name="color_id">
             
        @foreach($colors as $key=>$value)

            <option  @if($product_warranties->color_id==$value->getColor->id) selected="selected" @endif>
            </option>
        @endforeach
    </select>

</div>
 <div class="form-group">

        {{Form::label('warranty_id','انتخاب گارانتی :') }}

        {{ Form::text('warranty_id',null,['class'=>'form-control']) }}

       </div>

  <div class="form-group">

        {{Form::label('price1','هزینه محصول :') }}

       {{ Form::text('price1',null,['class'=>'form-control price_input']) }}

       </div>
<div class="form-group">

        {{Form::label('price2','قیمت محصول برای فروش  :') }}

       {{ Form::text('price2',null,['class'=>'form-control discount_price_input']) }}

       </div>
       <div class="form-group">

        {{Form::label('product_number','تعداد موجودی محصول :') }}

       {{ Form::text('product_number',null,['class'=>'form-control product_number']) }}

       </div>
       <div class="form-group">

        {{Form::label('product_number_cart','تعداد سفارش در سبد خرید  :') }}

       {{ Form::text('product_number_cart',null,['class'=>'form-control product_number_cart']) }}

       </div>
       <div class="form-group">

        {{Form::label('send_time','زمان ارسال محصول :') }}

       {{ Form::text('send_time',null,['class'=>'form-control']) }}

       </div>
       <button class="btn btn-success">

  ویرایش تنوع قیمت 
       </button>
    

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection