<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>پنل مدیریت  </title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <meta name="csrf-token" content="{{csrf_token()}}">
     @yield('head')
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet"> 
    <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" >

   
</head>
<body>
 
  <div class="container-fluid" >
   <div class="panel">

     @yield('content')
    </div>
    <div class="page-sidebar ">

        <span class="fa fa-bars" id="sidebarToggle"></span>
        <ul id="sidebar-menu">
            <li class="active">
                <a>
                    <span class="fa fa-shopping-cart"></span>
                    <span class="sidebar-menu-text">محصولات</span>
                    <span class="fa fa-angle-left"></span>
                </a>
                <div class="child-menu">

                    <a href="{{url('admin/products')}}">مدیریت محصولات</a>
                    <a href="{{url('admin/products/create')}}"> افزودن محصولات</a>
                    <a href="{{url('admin/category')}}"> مدیریت دسته بندی ها</a>
                </div>
            </li>
                 <li>
                <a>
                    <span class="fa fa-sliders"></span>
                    <span class="sidebar-menu-text">اسلایدر</span>
                    <span class="fa fa-angle-left"></span>
                </a>
                <div class="child-menu">

                    <a href="">مدیریت اسلایدر ها</a>
                    <a href=""> افزودن اسلایدر</a>
                   
                </div>
            </li>
        </ul>
        <div class="page-content">

            <div class="content-box" id="app">
                
               {{-- @yield('content') --}}
            </div>
        </div>
    </div>
   
    
    <div class="message-div">
        <div class="message-box">
            <p id="msg"></p>
            <a class="alert alert-success" onclick="delete_row()">
                بله
            </a>
            <a  class="alert alert-danger" onclick="hide_box()">
             خیر
            </a>
        </div>

    </div>
</div> 
<div id="loading_box">

    <div  class="loading_div"> 
        <span>
        در حال ارسال اطلاعات 
    </span>
   <div class="loading">
    
   
   </div>
    </div>
</div>

    <script src="{{ asset('js/jquery-3.5.1.js') }}" defer></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/admin.js') }}" defer ></script> 
       
    @yield('footer')
</body>
</html>