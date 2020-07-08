@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    {{-- @include('include.breadcrumb',['data'=>[['title'=>'مدیریت ویژگی ها  ','url'=>url('admin/products/'.$filter->id.'/filters')]]])  --}}

    <div class="header">
        
      مدیریت فیلتر های محصول  {{$filter->title}}
    
    </div> 

    <div class="panel-content" id="product_filter_box">

        @include('include.alert')

 {{-- @if(sizeof($product_filter >0)) --}}
    <form method="post" id="product_filters_form" action="{{url('admin/products/'.$filter->id.'/filters')}}">
                @csrf 

@foreach($product_filter as $key=>$value)

<div class="item_groups" style="margin-bottom:20px;">

<p class="title">{{$value->title}}</p>

@foreach($value->getChild as $key2=>$value2)

<div class="form-group">
{{-- @if(is_selected_filter($value->getValue,$value2->id))  checked="checked"@endif --}}
    <input type="checkbox"  name="filter[{{$value->id}}][]" value="{{$value2->id}}">


    <lable>{{$value2->title}}</lable>


</div>


@endforeach 
</div>

@endforeach
<button class="btn btn-primary">ثبت اطلاعات </button>

    </form>
    {{-- @endif --}}
    </div> 

</div> 
</div> 


@endsection