@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    {{-- @include('include.breadcrumb',['data'=>[['title'=>'مدیریت فیلتر ها'  ','url'=>url('admin/category/'.$category->id.'/filters')]]]) --}}

    <div class="header">
        
       مدیریت فیلتر های دسته  {{$category->name}}
    
    </div> 
 <div class="panel-content">

        @include('include.alert')

<form method="post" action="{{url('admin/category').'/'.$category->id .'/filters'}}">

    @csrf 
    <div class="category_filters">

        @if(sizeof($filters)>0)

         @foreach($filters as $key=>$value)

       <div class="form-group" id="filter_{{$value->id}}">


        <select  name="item_id{{$value->id}}" class="selectpicker" data-live-search="true">

            <option value="0"> انتخاب ویژگی </option>

            @foreach($items as $itemkey=>$itemvalue)
             
<option value="0">{{$itemvalue->title}}</option>

        @foreach($itemvalue->getChild as $k=>$v)
             
<option  @if($v->id==$value->item_id) selected="selected"  @endif value="{{$v->id}}">{{$v->title}}</option>


            @endforeach
            @endforeach
        </select>

<input type="text" class="form-control filter_input" name="filter{{$value->id}}" value="{{$value->title}}" placeholder="نام گروه فیلتر">

<span class="fa fa-plus-circle" onclick="add_filter_child_input{{$value->id}}" ></span>

  <span class="item_remove_message" onclick="del_row('{{url('admin/category/filters/'.$value->id)}}','{{Session::token()}}','are you sure for deleting?')">      حذف کلی فیلترهای گروه  {{$value->title}}</span>

<div class="child_filter_box">
    @php       $i=1;  @endphp
@foreach($value->getChild as $childFilter)

<div class="form-group child_{{$value->id}}">
{{$i}}-<input type="text"  value="{{$childFilter->title}}"name="child_filter{{$value->id}}{{$childFilter->id}}" class="form-control child_input_filter" placeholder="نام فیلتر ">

 <span class="item_remove_message" onclick="del_row('{{url('admin/category/filters/'.$childFilter->id)}}','{{Session::token()}}','are you sure for deleting?')">    حذف فیلتر {{$value->title}}</span>
</div>
@php   $i++;  @endphp
@endforeach
</div>
       </div>

       @endforeach
        @else 
        
     <div class="form-group" id="filter_-1">

<input type="text" class="form-control filter_input" name="filter(-1)"  placeholder="نام گروه فیلتر">

<span class="fa fa-plus-circle" onclick="add_filter_child_input(-1)" ></span>

 <div class="child_filter_box">

</div>
       </div>

        @endif 
       
    </div>
    <div id="filter_box">

    </div>
<span class="fa fa-plus-square "  onclick="add_filter_input()">

</span>
<div class="form-group">
    <button class="btn btn-primary">
        ثبت اطلاعات 
    </button>
</div>
</form>
 </div>

</div> 
</div>


@endsection

@section('footer')

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" ></script>
<script>

    $(document).ready(function(){

$('.category_filters').sortable();

$('.child_filter_box').sortable();

    });
</script>

@endsection