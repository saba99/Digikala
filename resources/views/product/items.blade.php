@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    {{-- @include('include.breadcrumb',['data'=>[['title'=>'مدیریت محصولات ','url'=>url('admin/products/'.$product->id.'/items')]]])  --}}

    <div class="header">مدیریت محصولات
            
    </div>

    <div class="panel-content">

        {{-- @php       $filter_array=getFilterArray($filters);        @endphp  --}}

        @include('include.alert')

           {{-- @if(sizeof($product_items >0)) --}}
    <form method="post" id="product_items_form" action="{{url('admin/products/'.$product->id.'/items')}}">
        

        @csrf 

        @foreach($product_items as $key=>$value)

            <div class="item_groups" style="margin-bottom:20px;">
               

                <p class="title">{{$value->title}}</p>
                @foreach($value->getChild as $key2=>$value2)

                  <div class="form-group">

                    <lable>{{$value2->title}}</lable>

                    @if(sizeof($value2->getValue)>0)
<input type="text" class="form-control item_value" value="{{$value2->getValue[0]->item_value}}" name="item_value{{$value2->id}}[]">
                           
                    @else 

                     <input type="text" class="form-control item_value" name="item_value{{$value2->id}}[]">
                    @endif

                    @if(arrey_key_exists($value2->id,$filter_array))
                         
                    <div class="btn ntn-success show_filter_box">
                                انتخاب
                    </div>
                    <input type="hidden" value="{{getFilterItemValue($filters[$filter_array[$value2->id]->id],$product_filters)}}" name="filter_value{{$value2->id]}}{{$filters[$filter_array[$value2->id]->id]}}">

                   <div class="item_filter_box">

                         <ul>

                            @foreach($filters[$filter_array[$value2->id]]['getChild'] as $k=>$v)

                             
                                     <li>
                                         <input type="checkbox"  @if(array_key_exists($v->id,$product_filters)) checked @endif value={{$v->id}}>

                                           {{$v->title}}

                                     </li>
                            @endforeach
                         </ul>

                   </div>

                     @else 


                    @endif

                   
                    <sapn class="fa fa-plus-circle" onclick="add_item_value_input({{$value->id}})">

                  <div  calss="input_item_box" id="input_item_box_{{$value2->id}}">
                  @if(sizeof($value2->getValue)>1)

 @foreach($value2->getValue as $item_key=>$item_avlue)
                  
                    @if($item_key>0) 
                      <div class="form-group">

                    <lable></lable>
                    <input name="item_value{{$value2->id}}[]" value="{{$item_value->item_value}}" type="text" class="form-control">
                 </div>
                    @endif
               

                 @endforeach
                  @endif
                
                  </div>
                    </sapn>
                  </div>


                @endforeach
            </div>
        @endforeach
            <button class="btn btn-success">ثبت اطلاعات</button>
    </form>

    {{-- @else  --}}
    {{-- @endif --}}

      
    </div>


</div>
</div>



@endsection