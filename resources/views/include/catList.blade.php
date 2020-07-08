
{{-- @inject('Category','App\Models\Category') --}}

<div class="index-cat-list container-fluid">

<ul>

@foreach($catList as $key=>$value)


<li class="cat_item">

    <a href="{{url('main/'.$value->url)}}">
        {{$value->name}}</a>
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
    
  <li>
                <a class="child_cat">
                    <span>
                        {{$value2->name}}
                    </span>
                    <span class="fa fa-angle-left">

                    </span>
                </a>
                @foreach($value2->getChild as $key3=>$value3)
            
                {{-- @if(get_show_category_count($value3->getChild)>=(14-$c))

                @php      $c=0;   @endphp

            </ul>
                @endif --}}

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
                 {{-- @foreach($value2->getChild as $key3=>$value3) --}}
                     
                 {{-- @if($value3->notShow==0) --}}
                
                
                 {{-- @else  --}}



                 {{-- @endif  --}}

                 {{-- @endforeach --}}
           
             @endif


        @endforeach
    
</ul>
        
</div>
</li>

@endforeach


</ul>
</div>