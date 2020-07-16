<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>فروشگاه آنلاین </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{csrf_token()}}">
     @yield('head')
    <link href="{{ asset('css/shop.css') }}" rel="stylesheet"> 
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >

   
</head>
<body>
<div id="app">



    <div class="header">

       

        <a href="{{ url('')}}">
            <img src="{{asset('files/images/shop_icon.png')}}" class="shop_logo">
        </a>
<div class="header_row">


    <div class="input-group index_header_search"> 
        <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="جست و جو">
        <div class="input-group-prepend">
          <div class="input-group-text">
              
              <span class=" fa fa-search">


              </span>
          </div>
        </div>
       
      </div>

      <div class="header_action">
          
     
        <div class="dropdown">
            
           
            
          </div>
         
            <div  class="index_auth_div" role="button" data-toggle="dropdown">

                <span  >
                    ورود/ثبت نام 
                </span>
                <span class="fa fa-angle-down">

                </span>

            </div>

             <div class="header_divider">

            </div>
            <div class="cart-header-box">
                <div class="btn-cart">
                    <span id="cart-product-count" data-counter="0">
                        سبد خرید 

                    </span>
                </div>
            </div>

            <div class="dropdown-menu header-auth-box" aria-labelledby="dropdownMenuButton">
                
               
                   @if(Auth::check())

                      @if(Auth::user()->role_id || Auth::user()->role=='admin')

                   <a class="dropdown-item admin" href="{{url('admin')}}">

                             پنل مدیریت 
                   </a>
                @endif
                   @else 

                  <a  class="btn btn-primary" href="{{url('login')}}">

                    ورود به فروشگاه 
                  </a>
                  <div class="register-link">

<span>کاربر جدید هستید ؟</span>
<a href="{{ url('register')}}" class="link">ثبت نام </a>  


                  </div>
                  <div class="dropdown-divider">
                      
                   
                  </div>
                  
                   @endif
 <a class="dropdown-item profile" href="{{url('profile')}}">
                      
                        پروفایل 
                    </a>
                              <a class="dropdown-item orders" href="{{url('profile/orders')}}">
                        پیگیری سفارش 
                    </a>

                    @if(Auth::check())
                   
                    <div class="dropdown-divider">
                      
                   <a class="dropdown-item logout" >
                       خروج از حساب کاربری

                   </a>
                  </div>
                     
                    @endif

                    
         
  
  </div>
        </div>
      </div>

</div>


    </div>
</div>


 @include('include.catList',['catList'=>$catList])

<div class="container-fluid">
@yield('content')

</div>


       <script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
 
    <script src="{{ asset('js/js.js') }}"  type="text/javascript"defer ></script> 
    <script src="{{ asset('js/ShopVue.js') }}"  type="text/javascript"defer ></script> 
       
    @yield('footer')
</body>
</html>