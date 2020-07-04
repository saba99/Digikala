<!-- Default dropright button -->
<div class="btn-group dropright" >
  <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    گزینه ها
  </button>
  @php 
  $create_param='';
  $trash_param='';
  if(isset($queryString) && is_array($queryString)){

$create_param='?'.$queryString['param'].'='.$queryString['value'];

$trash_param='&'.$queryString['param'].'='.$queryString['value'];



  }  @endphp
  <div class="dropdown-menu">
   <a class="dropdown-item" href="{{url($route.'/create'.$create_param)}}">
<span class="fa fa-pencil"></span>
<span>افزودن {{$title}} جدید</span>
   </a>

    <a class="dropdown-item" href="{{url($route.'?trashed=true'.$trash_param)}}">
<span class="fa fa-trash"></span>
<span>سطل زباله {{$count}}</span>
   </a>

   <a class="dropdown-item off item_form" id="remove_items" msg="آیا از حذف {{$title}} ها مطمئن هستید ؟">
<span class="fa fa-remove"></span>
<span>حذف {{$title}} ها</span>
   </a>

   {{--  @if($_GET(['trashed']) && $_GET(['trashed']=='true'))  --}}
    <a class="dropdown-item off item_form" id="restore_items" msg="آیا از بازیابی {{$title}} ها مطمئن هستید ؟">
<span class="fa fa-refresh"></span>
<span>بازیابی {{$title}} </span>
   </a>
   {{--  @endif  --}}
  </div>
</div>

