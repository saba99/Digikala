@extends('layouts.admin')


@section('content')


<div class="panel">
      
  

    <div class="header">افزودن تنوع قیمت جدید {{$product->title}} </div>

    <div class="panel-content">

       
   
        {!! Form::open(['url' => 'admin/product_warranties?product_id='.$product->id]) !!}
        
       <div class="container-left">
            @include('include.warning')
               {{-- @include('include.breadcrumb',['data'=>[['title'=>'مدیریت تنوع ها  ','url'=>url('admin/product_warranties?product_id='.$product->id)],
    
    ['title'=>'افزودن تنوع قیمت ','url'=>'admin/product_warranties/create?product_id='.$product->id]
    ]])   --}}
       <div class="form-group">

        {{Form::label('name','نام تنوع قیمت:') }}

       {{ Form::text('name',null,['class'=>'form-control']) }}

       @if($errors->has('name'))

       <span class="has_error">
           {{$errors->first('name')}}
       </span>

       @endif

       </div>
         <div class="form-group">

        {{Form::label('warranty_id','انتخاب گارانتی :') }}

        {{ Form::text('warranty_id',null,['class'=>'form-control']) }}

       </div>

       
  <div class="form-group" >
    <lable>
        انتخاب رنگ های محصول:
    </lable>
    <select class="selectpicker"   data-live-search="true" multiple="multiple" name="color_id">
             
        @foreach($colors as $key=>$value)

            <option value="{{$value->getColor->id}}" data-content="<span style='background:#{{$value->getColor->code}};
                @if($value->getColor->name=='سفید') color:#000 @endif' class='color_option' ></span>">
                 {{$value->getColor->name}}
            </option>
        @endforeach
    </select>

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

    ثبت تنوع قیمت 
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection


@section('footer')


<script src="{{ asset('js/cleave.min.js') }}" defer ></script>
<script>

   var cleave = new Cleave('.price_input', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});
 var cleave2 = new Cleave('.discount_price_input', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});
 var cleave3 = new Cleave('.product_number', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});
 var cleave4 = new Cleave('.product_number_cart', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});
 var cleave = new Cleave('#send_time', {
    numeral: true,
    numeralThousandsGroupStyle: 'thousand'
});
});
</script>
@endsection