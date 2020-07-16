
{{-- @inject('Category','App\Models\Category') --}}

<div class="index-cat-list container-fluid">

<ul>

    <li class="cat_hover">
            <div>
                
            </div>
    </li>

@foreach($catList as $key=>$value)


<li class="cat_item">

    <a href="{{url('main/'.$value->url)}}">
        {{$value->name}}</a>

        @if(sizeof($value->getChild)>0)

<div class="li_div" @if($key==0)style="display:block;"  @endif>

    @php  $c=0;  @endphp

    @if(sizeof($value->getChild)>0)

        @if($c==0)

{{-- <ul  class="List-inline subList"> --}}
        @endif
    @endif
    <ul  class="List-inline subList">
        @foreach($value->getChild as $key2=>$value2)

        
            @if($value2->notShow==0)
            {{--  @if(get_show_category_count($value3->getChild)>=(14-$c))

                @php      $c=0;   @endphp

            </ul>
                @endif  --}} 
    
  <li>
                <a class="child_cat" href="">
                    <span class="fa fa-angle-left">

                    </span>
                    <span>
                        {{$value2->name}}
                    </span>
                    
                </a>
                  @foreach($value2->getChild as $key3=>$value3)
            
                {{--  @if(get_show_category_count($value3->getChild)>=(14-$c))

                @php      $c=0;   @endphp

            </ul>
                @endif  --}}  

                        @if($value3->notShow==0)

                          <li>
                              <a>{{$value3->name}}</a>
                          </li>
                        @endif 
                @endforeach
            </li>
            @php   $c++;  @endphp 

            @if($c==13)
        </ul>
               @php  $c=0; @endphp

               {{-- @php  echo $c; @endphp --}}

               <ul class="list-inline subList">
               
            @endif
             @else 
                 @foreach($value2->getChild as $key3=>$value3)
                   {{--  @if(get_show_category_count($value3->getChild)>=(14-c))   --}}
                   
                   @php  $c=0;  @endphp </ul><ul>
                 @if($value3->notShow==0)
                  <li>                       {{--  {{get_cat_url($value3)}}  --}}
                     <a class="child_cat" href="">
                         <sapn calss="fa fa-angle-left"></sapn>
                         <span>{{$value3->name}}</span>
                         
                     </a>
                 </li>
                <ul>
                    @foreach($value3->getChild as $key4=>$value4)
                   
                    @if($value4->notShow==0)
                    <li>
<a href="">{{$value4->name}}</a>
                    </li>
@php    $c++;   @endphp
                    @endif

                    @endforeach
                </ul>
                 {{-- @else  --}}



                 @endif

                 @endforeach
           
             @endif


        @endforeach
     
        {{--  @if($c!=0 >0)
            </ul>
        @endif  --}}
        <div clas="show-total-cat">

         <a href="">
             <span>
                    مشاهده تمام دسته های 
             </span>
             <sapn>
{{$value->name}}
             </sapn>
         </a>
        </div>
   
</ul>
     {{--  @if(!empty($value->img))  --}}
     {{--  {{get_cat_url($value)}}  --}}
        <a href="">
              <div class="sub-menu-pic">
                  {{--  <img src="{{url('files/upload/'.$value->img)}}">  --}}
                     <img src="{{url('files/upload/desktop.jpeg')}}">

              </div>
        </a>
     {{--  @endif  --}}
</div>
</li>
 @endif
@endforeach

<li class="cat_item left_item">
    <a href="">فروش ویژه </a>
</li>
</ul>
</div>