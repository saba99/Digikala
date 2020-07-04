@extends('layouts.admin')


@section('head')


<link href="{{asset('css/dropzone.min.css')}}" rel="stylesheet">
@endsection

@section('content')

<div class="panel">
      
  

    <div class="header">گالری تصاویر {{$product->title}} </div>

    <div class="panel-content">
   
        
       <div class="container-left">
   {{-- @include('include.breadcrumb',['data'=>[['title'=>'مدیریت محصولات ','url'=>url('admin/products')],
    

    ['title'=>'گالری تصاویر  ','url'=>'admin/products/gallery/'.$product->id],
    ]])   --}}

<div class="panel_content">

@include('include.alert')


<form method="post" id="upload-file" action="{{url('admin/products/gallery_upload/'.$product->id)}}" class="dropzone">

@csrf
    <input style="display:none;" name="file" type="file" multiple>


</form>
<table class="table table-bordered" id="gallery_table" style="margin-top:40px;">


    <thead>
       <tr>
              <th> ردیف</th>

              <th> تصویر </th>
              <th>عملیات</th>
       </tr>
    </thead> 

    <tbody>
        @php  $i=1;  @endphp
       @foreach($product_gallery as $gallery)

        <tr id="{{$gallery->id}}">
            <td>{{ $i }}</td>
            <td>
                <img src="{{url('files/gallery/'.$gallery->image_url)}}" style="width:120px;">
                </td> 
            <td>
                <span    data-toggle="tooltip" data-placement="bottom" title= "حذف محصول" onclick="del_row('{{url('admin/products/gallery'.$gallery->id)}}','{{Session::token()}}','آیا از حذف این محصول مطمئن هستید ؟')" class="fa fa-remove"></span>
           
            </td>
        </tr>
          @php  $i++;   @endphp 
       @endforeach
    </tbody>
</table>
</div>
       </div>
    </div> 
</div>








@endsection


@section('footer')

<script src="{{asset('js/dropzone.min.js')}}"></script>
<script src="http://code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js"></script>
<script>

    Dropzone.options.uploadFile={

        acceptedFiles: '.png,.jpg,.jpeg',

        addRemoveLinks:true,

        init:function(){

            this.options.dictRemoveFile='حذف';

            this.options.dictInvalidFileType='امکان آپلود این فایل وجود ندارد ';

            this.on('success',function(file,response){
                  
                if(response ==1){

                    file.previewElement.ClassList.add('dz-success');


                }
                else{
                  file.previewElement.ClassList.add('dz-error');

                  $(file.previewElement).find('.dz-error-message').text('خطا در آپلود فایل ');


                }

            });

            this.on('error',function(file,response){

                      file.previewElement.ClassList.add('dz-error');
                $(file.previewElement).find('.dz-error-message').text('');
            });
        }
    };

    const $sortable=$("#gallery_table > tbody");

    $sortable.sortable({
   
        stop:function(event,ui){

     $("#loading_box").show();

             const parameters=$sortable.sortable("toArray");

            // console.log(parameters);
               $.ajaxSetup({

                   headers:{

                    'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
                   }

               });
               $.ajax({
                         url:'{{ url('admin/products/change_images_status/'.$product->id)}}',
                         type:'POST',
                         data:'parameters='+parameters,
                         success:function(data){

                            //alert(data);

                            $("#loading_box").hide();
                         }

               });

        }
      
    });
</script>

@endsection