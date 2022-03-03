// JavaScript Document
$(document).ready(function() {
    var position=0;  //최초위치
    var movesize=200; //이미지 하나의 너비
    //var timeonoff;
   
    $('.slide_gallery ul').after($('.slide_gallery ul').clone());

    /*
    timeonoff= setInterval(function () {
           position-=movesize;  // 150씩 감소
       $('.slide_gallery').stop().animate({left:position}, 'fast',
            function(){							
           if(position==-750){
              $('.slide_gallery').css('left',0);
              position=0;
           }
       });
   }, 2000);
   */
    
    
        //슬라이드 겔러리를 한번 복제
 
  $('.button').click(function(e){
     e.preventDefault();

     //clearInterval(timeonoff);
     
     if($(this).is('.p1')){   //이전버튼을 클릭
          if(position==-1200){
              $('.slide_gallery').css('left',0);
               position=0;
           }
         
          position-=movesize;  // 150씩 감소
              $('.slide_gallery').stop().animate({left:position}, 'fast',
                function(){							
                    if(position==-1200){
                        $('.slide_gallery').css('left',0);
                        position=0;
                    }
                });
     }else if($(this).is('.p2')){   //다음 버튼 클릭 
           if(position==0){
                $('.slide_gallery').css('left',-1200);
                position=-1200;
            }
 
            position+=movesize; // 150씩 증가
            $('.slide_gallery').stop().animate({left:position}, 'fast',
                function(){							
                    if(position==0){
                        $('.slide_gallery').css('left',-1200);
                        position=-1200;
                    }
                });
      }
   });
});
