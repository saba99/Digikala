@extends('layouts.admin')


@section('content')


<div class="panel">

    <div class="header">  ویرایش محصول  {{$product->title}}</div>
  
    <div class="panel-content">
        
    
        {!! Form::model($product,['url' => 'admin/products/'.$product->id,'files'=>true]) !!}

        {{method_field('PUT')}}
        
       <div class="container-left">
           {{-- @include('include.breadcrumb',['data'=>[['title'=>'مدیریت محصول ','url'=>url('admin/products')],
    
    ['title'=>'ویرایش محصول ','url'=>'admin/products/'.$product->id.'/edit']
    ]]) --}}
       <div class="form-group">

        {{Form::label('title','عنوان محصول :') }}

       {{ Form::text('title',null,['class'=>'form-control']) }}

       @if($errors->has('title'))

       <span class="has_error">
           {{$errors->first('title')}}
       </span>

       @endif
    
       </div>
       <div class="form-group">

        {{Form::label('ename','نام لاتین: ') }}

       {{ Form::text('ename',null,['class'=>'form-control']) }}

       </div>
       <div class="form-group" >
    <lable>
        انتخاب رنگ های محصول:
    </lable>
    <select class="selectpicker"   data-live-search="true" multiple="multiple" name="product_color[]">
             
        @foreach($colors as $key=>$value)

            <option value="{{$value->id}}" data-content="<span style='background:#{{$value->code}};
                @if($value->name=='سفید') color:#000 @endif' class='color_option' ></span>">
                 {{$value->name}}
            </option>
        @endforeach
    </select>

</div>
 <div class="form-group">

        {{Form::label('cat_id','انتخاب دسته : ') }}

       {{ Form::select('cat_id',$catList,null,['class'=>'form-control ']) }}
         @if($errors->has('cat_id'))

       <span class="has_error">
           {{$errors->first('cat_id')}}
       </span>

       @endif

        </div>
      <div class="form-group">

        {{Form::label('description','  توضیحات محصول: ') }}

       {{ Form::textarea('description',null,['class'=>'form-control ckeditor']) }}
         @if($errors->has('description'))

       <span class="has_error">
           {{$errors->first('description')}}
       </span>

       @endif
       </div>
  <div class="form-group">

        {{Form::label('tozihat','توضیحات مختصر در مورد محصول: ',['style'=>'color:red ']) }}

       {{ Form::textarea('tozihat',null,['class'=>'form-control','id'=>'tozihat']) }}
         @if($errors->has('tozihat'))

       <span class="has_error">
           {{$errors->first('tozihat')}}
       </span>

       @endif
       </div>
       <div class="form-group">
    {{Form::label('brand_id','انتخاب برند : ') }}

       {{ Form::select('brand_id',$brand,null,['class'=>'form-control ']) }}
         @if($errors->has('brand'))

       <span class="has_error">
           {{$errors->first('brand_id')}}
       </span>

       @endif

       </div>
       <div class="form-group">
      {{Form::label('status','وضعیت محصول : ') }}

        {{ Form::select('status',$status,null,['class'=>'form-control ']) }}
         @if($errors->has('status'))

       <span class="has_error">
           {{$errors->first('status')}}
       </span>

         @endif

       </div>
        
        
<div class="form-group" >
    <lable>
        انتخاب رنگ های محصول:
    </lable>
    <select class="selectpicker"   data-live-search="true" multiple="multiple" name="product_color[]">
             
        @foreach($colors as $key=>$value)

            <option value="{{$value->id}}" data-content="<span style='background:#{{$value->code}};
                @if($value->name=='سفید') color:#000 @endif' class='color_option' ></span>">
                 {{$value->name}}
            </option>
        @endforeach
    </select>

</div>
<div class="form-group" style="margin-right: 200px;">

  
<input type="file" name="pic" id="pic" onchange="loadFile(event)" style="display:none;">
    <div class="choice_pic_box" onclick="select_file()">
        <span class="title">
            انتخاب تصویر محصول :
        </span>
            
            <img id="output"  class="pic_tag" onchange="select_file()">

             @if($errors->has('pic'))

       <span class="has_error">
           {{$errors->first('pic')}}
       </span>

       @endif  
    </div>
</div> 


    <div class="form-group" style="margin-top: 100px;">
            
             {{-- {{Form::label('status','بر چسب محصول : ') }} --}}
               <p class="message_text">   برچسب ها با استفاده از کاما از هم جدا شوند</p>
            <input type="text" name="tag_list"   id="tag_list" class="form-control" placeholder="برچسب های محصول">
            <div class="btn btn-success" onclick="add_tag()">افزودن</div>

            <input type="hidden" name="keywords" value="{{$product->keywords}}" id="keywords">
           
          </div>
           <div id="tag_box">
              @php  $keywords=$product->keywords;

              $e=explode(',',$keywords);
     $i=1;         
              @endphp

              @if(is_array($e))
                  @foreach($e as $key=>$value)
@if(!empty($value))
<div class="tag_div" id="tag_div_{{$i}}">
    <span class="fa fa-remove" onclick="remove_tag({{$i}},{{$value}})" ></span>
{{$value}}
</div>
                     @php  $i++; @endphp

                     @endif
                  @endforeach

              @endif
            </div>
       <button class="btn btn-primary">

        ویرایش دسته 
       </button>

        {!! Form::close() !!}
</div>
    </div>
</div>





@endsection