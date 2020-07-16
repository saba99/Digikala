@extends('layouts.admin')


@section('content')
  

<div class="container-left" >
  
<div class="panel">
  
    @include('include.breadcrumb',['data'=>[['title'=>'مدیریت محصولات شگفت انگیز ','url'=>url('admin/incredible-offers')]]]) 

    <div class="header">مدیریت محصولات پیشنهاد شگفت انگیز
        

    
    </div>

    <div class="panel-content" id="app">
  
<incredible-offers>


  </incredible-offers>
  {{--  <example-component>

  </example-component>  --}}
    

</div>
</div>


@endsection

@section('footer')
<link rel="stylesheet" href="{{asset('css/persian.datepicker.css')}}"/>
  
  <script src="{{asset('js/persian.date.js')}}"></script> 
  <script src="{{asset('js/persian.datepicker.js')}}"></script>

<script>

  const pcal1=  new AMIB.persianCalender('pcal1');
    const pcal2= new AMIB.persianCalender('pcal2');
</script>
@endsection