
let Toggle=false;


 $('#sidebar-menu li').click(function(){   


   /* if(!$(this).hasClass('active')){*/

     $("#sidebar-menu li").removeClass('active');
   $(this).addClass('active');
   $('.child-menu', this).slideUp(500);
        $('.child-menu', this).slideDown(500);
        
        $('#sidebar-menu .fa-angle-down').removeClass('fa-angle-down');
        $('.fa-angle-left', this).addClass('fa-angle-down');

/*if(!Toggle){

    
$('.child-menu', this).slideDown(500);
    $('#sidebar-menu').find('.active .child-menu').css('display','block');
}

else{

    $('.child-menu', this).show();

}



    $('#sidebar-menu .fa-angle-down').removeClass('fa-angle-down');
$('.fa-angle-left',this).addClass('fa-angle-down');
   
}   /* 
    else if(Toggle){
    
        $('.child-menu', this).slideUp(500);
        $('.child-menu', this).show();


    }*/

});

$('#sidebarToggle').click(function(){

if($('.page-sidebar').hasClass('toggled')){


    Toggle=false;

    $('.page-sidebar').removeClass('toggled');
    $('.page-content').css('margin-right', '240px');

}
else{

    Toggle=true;
$('.page-sidebar').addClass('toggled');

$('.child-menu').hide();

$('.page-content').css('margin-right','50px');
}

//  $(window).resize(function(){

//  set_sidebar_width();


//  });

//  $(document).ready(function(){

//  set_sidebar_width();
const url=window.location.href.split('?')[0];

$('#sidebar_menu a [href="'+url+'"]').parent().parent().addClass('active');
  
    $('#sidebar_menu a [href="' + url + '"]').parent().parent().find('a .fa-angle-left').addClass('fa-angle-down');

    $('#sidebar_menu a [href="' + url + '"]').parent().parent().find('a .fa-angle-left').show();
//  });

// set_sidebar_width=function(){

//     const width = document.body.offsetWidth;

//     this.console.log(width);
//     if (width < 850) {

//         $('page_sidebar').addClass('toggled');

//         $('.page-content').css('margin-right', '50px');

//         $('child.menu').hide();
//     }
//     else {

//         if (Toggle == false) {


//             $('.page-sidebar').removeClass('toggled');
//             $('.page-content').css('margin-right', '240px');

//         }
// }
//};

});

select_file=function(){


    $("#pic").click();
};
//  s_mobile = function () {


//      $("#mobile_pic").click();
//  };

loadFile=function(){

const render=new FileReader();

render.onload=function(event){

const output=document.getElementById('output');

output.src=render.result;


};
// l_mobile = function () {

//       const render = new FileReader();

//      render.onload = function (event) {

//       const output = document.getElementById('output2');

//           output.src = render.result;


//   };

render.readAsDataURL(event.target.files[0]);
};

let delete_url;
let token;  
let _method = 'DELETE';
del_row=function(url,token,message_text){

     _method='DELETE';
   delete_url=url;

   token=1;
  

   $("#msg").text(message_text);

   $(".message-div").show();


};

delete_row=function(){


    if(send_array_data){
        $("#data_form").submit();

    }else{
        let form = document.createElement('form');

        form.setAttribute('method', 'POST');

        form.setAttribute('action', delete_url);


        const hiddenField1 = document.createElement('input');

        hiddenField1.setAttribute('name', '_method');

        hiddenField1.setAttribute('value', _method);

        form.appendChild(hiddenField1);

        const hiddenField2 = document.createElement('input');

        hiddenField2.setAttribute('name', '_token');

        hiddenField2.setAttribute('value', 'token');

        form.appendChild(hiddenField2);


        document.body.appendChild(form);

        form.submit();

        document.body.removeChild(form);


    }



}

hide_box=function(){

    token='';

    del_url='';

    $(".message-div").hide();
}
$('.check_box').click(function(){

    send_array_data=false;

const $checkbox=$('table tr td input[type="checkbox"]');

const count=$checkbox.filter(':checked').length;

//alert(count)

if(count>0){


   $("#remove_items").removeClass('off');
    $("#restore_items").removeClass('off');
   
   
}
else{
    $("#remove_items").addClass('off');
    $("#restore_items").addClass('off');
}

});

let send_array_data=false;
$('.item_form').click(function(){

    send_array_data = true;
    const $checkbox = $('table tr td input[type="checkbox"]');

    const count = $checkbox.filter(':checked').length;

    //alert(count)

    if (count > 0) {

     const href=window.location.href.split('?');

     //console.log(href);

     const action=href[0]+ "/"+this.id+href[1];
     if(href.length==2){

// action=action+"?"+href[1];
        action = action  + href[1];

     }

     $("#data_form").attr('action',action);

     $("#msg").text($(this).attr('msg'));

     $('.message-div').show();
    }

});



$('span').tooltip();
restore_row=function(url,token,message_text){

 _method='post';

 delete_url=url;

 token=token;
 $("#msg").text(message_text);

 $('message_div').show();

}

add_tag=function(){
const tag_list=document.getElementById('tag_list').value;

const t=tag_list.split(',');

const keywords=document.getElementById('keywords').value;

let string=keywords;

let count=document.getElementsByClassName('tag_div').length+1;

for(let i=0;i<t.length;i++){

    if(t[i].trim() !=''){

        //alert(t[i]);

        const n=keywords.search(t[i]);

        if(n==-1){
          const r="''"+t[i]+"'"; 
           string=string+","+t[i];

           var tag='<div class="tag_div" id="tag_div_'+count+'">'+
               '<span  class="fa fa-remove" onclick="remove_tag(' + count + ',' + r +')"></span>'+t[i]+
           '</div>';
             count++;
           $("#tag_box").append(tag);

        }
    }
}
document.getElementById('keywords').value=string;

    document.getElementById('tag_list').value='';
}
remove_tag=function(id,text){

$("#tag_div_"+id).hide();

const  keywords=document.getElementById('keywords').value;

const t1=text+",";

const t2=","+text;

let a =keywords.replace(t1,'');

let b=a.replace(t2,'');

document.getElementById('keywords').value=b;

}

add_item_input=function(){

    const id=document.getElementsByClassName('item_input').length+1;

const html='<div class="form-group item_groups"  id="item_-'+id+'">'+

'<input type="text" class="form-control item_input" name="item[-'+id+']" placeholder="نام گروه ویژگی">'+
'<span class="fa fa-plus-circle" onclick="add_child_input(-'+id+')"></span>'+
'<div class="child_item_box" ></div>'
'</div>';

$("#item_box").append(html);

};
add_child_input=function(id){

const child_count=document.getElementsByClassName('child_input_item').length+1;

    const count = document.getElementsByClassName('child_'+id).length + 1;

    const html='<div class="form-group child_'+id+'">'+

   count+'- '+'<input type="checkbox" name="check_box_item['+id+'][-'+child_count+']">'+

        '<input type="text" name="child_item[' + id + '][-' + child_count +']" class="form-control child_input_item" placeholder="نام ویژگی ">'
    '</div>';

    $("#item_"+id).find('.child_item_box').append(html);
};



