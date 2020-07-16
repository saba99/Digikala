$(document).ready(function(){

    $(".cat_item").mouseover(function () {
             
        const li_width=$(this).css('width');
           
        const ul_width=$(".index-cat-list").width();
        
        const a=li_width.replace('px','');

        $('.cat_hover').css('transform','scaleX(1)');

        const right=ul_width-$(this).offset().left-a+10;

        $('.cat_hover').css('width',li_width);
        $('.cat_hover').css('right', right);
          $('.li_div').hide();
        $('.li_div', this).show();



    });
    $('.index-cat-list').mouseleave(function(){

        $('.cat_hover').css('transform', 'scaleX(0)');

          $('li_div').hide();


    });



});
let  img_count=0;

let img=0;

function load_slider(count){

    img_count=count;
    setInterval(next,5000)
 

}
function next(){
    if(img==(img_count-1)){

        
    }
    img=img+1;
    $('.slide_div').hide();
    document.getElementById('slider_img_'+img).style.display='block';

}