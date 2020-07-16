@extends('layouts.shop')


@section('content')


<div class="row slider">

<div class="col-2">

</div>

<div class="col-10">


    @if(sizeof($sliders)>0)
       <div class="slider_box">

        <div style="position: relative" >
            @foreach($sliders as $key=>$value)
                <div class="slide_div an " id="slider_img_{{$key}}" @if($key==0) style="display:block"  @endif>

                    <a href="{{$value->url}}" style="background-image:url("<?=url('files/slider/'.$value->image_url)?>")">

                        <img src="{{url('files/slider/'.$value->image_url)}}">
                        
                     
                    </a>
                </div>

            @endforeach
        </div>

        <div id="right_slide" onclick="previous()">

        </div>
        <div id="left_slide" onclick="next()">

        </div>
        <div class="slider_box_footer">
        <div class="slider_bullet_div">
               
            @for($i=0;$i<sizeof($sliders) ;$i++)
                   
            <span id="slider_bullet_{{$i}}"  @if($i==0) class="active"  @endif>

            </span>
              @endfor
        </div>
    </div>
       </div>

    @endif
</div>


<div class="row incredible-offers">
    
    <div class="col-2">
<div class="col-10">

    <div class="discount-box">
        
        <div class="row">

            <div class="discount-box-content">

                @foreach($incredible_offers as $key=>$value)

                   <div  @if($key==1) style="display:block"  @endif class="item">
                       <div class="row">

                        <div class="col-6">
                            <div class="discount_bottom_bar">

               <a href="{{url('product/dkp-'.$value->getProduct->id .'/'.$value->getProduct->product_url)}}">
                                <img src="{{url('files/products/'.$value->getProduct->image_url)}}">
                            </a>
                            </div>
                        
                          

                        </div>
                        <div class="col-6">
                        
                             <a href="{{url('product/dkp-'.$value->getProduct->id .'/'.$value->getProduct->product_url)}}">
                             </a>
                             <div class="price_box">

                                    <del>

                                        {{replace_number(number_format($value->price1))}} تومان
                                    </del>
                                    <div class="incredible-offers-price">

                                  <lable>

                                    {{replace_number(number_format($value->price2))}} تومان 
                                  </lable>
                                      <span class="discount-badge">

                                        @php
                                        
                                        $a=($value->price2/$value->price1)*100;

                                        $a=100-$a;

                                        $a=round($a);

                                        @endphp  

                                        {{replace_number($a).'تخفیف'}}


                                      </span>
                                    </div>
                                    <div class="discount_title">
                                        {{$value->getProduct->title}}
                                    </div>
                                    <ul class="important_item_ul">
                                      @foreach($value->itemValue as $key=>$item)

                                      @if($key<2)
                                       <li>
                                           {{$item->important_item->title}}
                                               {{$item->item_value}}
                                         
                                       </li>
                                              @endif
                                      @endforeach

                                    </ul>
                                    @if($value->product_number>0)

                                    <counter second="<?= $value->offers_last_time-time() ?>">


                                    </counter>

                                               @else 



                                    @endif
                             </div>
                        </div>

                       </div>
                   </div>

                @endforeach
            </div>

        </div>

    </div>

</div>

    </div>
</div>
</div>


@endsection

@section('footer')

<script>
    load_slider('<?= sizeof($sliders) ?>')

    function load_slider(count){

    img_count=count;
    setInterval(next,5000)
 

}
function next(){

    $('.slider_bullet_div span').removeClass('active');


    if(img==(img_count-1)){

        img=-1;
    }
    img=img+1;
    $('.slide_div').hide();
    document.getElementById('slider_img_'+img).style.display='block';
      $("#slider_bullet_"+img).addClass('active');

function previous(){

    $('.slider_bullet_div span').removeClass('active');
        

    img=img-1;
    if(img==-1){

        img=(img_count-1);
    }
    $('.slide_div').hide();
    
      document.getElementById('slider_img_'+img).style.display='block';
      $("#slider_bullet_"+img).addClass('active');


}
}
</script>
@endsection
