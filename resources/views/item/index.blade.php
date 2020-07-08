@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    {{-- @include('include.breadcrumb',['data'=>[['title'=>'مدیریت ویژگی ها  ','url'=>url('admin/category/'.$category->id.'/items')]]]) --}}

    <div class="header">
        
       مدیریت ویژگی های دسته {{$category->name}}
    
    </div> 
 <div class="panel-content">

        @include('include.alert')

<form method="post" action="{{url('admin/category').'/'.$category->id .'/item'}}">

    @csrf 
    <div class="category_items">

        @foreach($items as $key=>$value)

       <div class="form-group item_groups"  id="item_{{$value->id}}">
         
        <input type="text" class="form-control item_input" value="{{$value->title}}" placeholder="نام گروه ویژگی">

        <span class="fa fa-plus-circle" onclick="add_child_input{{$value->id}}"></span>
        

        <span class="item_remove_message" onclick="del_row('{{url('admin/category/items/'.$value->id)}}','{{Session::token()}}','are you sure for deleting?')">      حذف کلی آیتم های گروه  {{$value->title}}


        </span>
        <div class="child_item_box" >

            @php        $i=1;        @endphp
            @foreach($value->getChild as $childItem)
             
            <div class="form-group child_{{$value->id}} ">

                    {{$i}}-<input type="checkbox" @if($childItem->show_item=1)  checked="checked" @endif name="check_box_item{{$value->id}}{{$childItem->id}}" value="{{$childItem->id}}">

                     
                        <span class="child_item_remove_message" onclick="del_row('{{url('admin/category/items/'.$childItem->id)}}','{{Session::token()}}','are you sure for deleting?')">     حذف آیتم  {{$value->title}}
                    @php  $i++;   @endphp
            </div>

            @endforeach
        </div>
       </div>
        @endforeach
    </div>
    <div id="item_box">

    </div>
<span class="fa fa-plus-square "  onclick="add_item_input()">

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

$('.category_items').sortable();

$('.child_item_box').sortable();

    });
</script>

@endsection