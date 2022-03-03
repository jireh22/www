$(document).ready(function(){


    var visHeight, screenHeight, screenSize;
    var current=0;
    

    // 사이즈 받아오기
    function reSize(){
        visHeight = $('.videoBox').height(); // 비주얼의 높이
        screenHeight = $(window).height();  //스크린의 높이
        screenSize= $(window).width(); // 스크린의 가로값
    }
    reSize();

    // 창 사이즈 변경 시 사이즈 다시 받아오기
    $(window).resize(function(){
        reSize();
    });


    $('.menuOpen').toggle(function(){
        $('.menuOpen').addClass('open');
        $('#headerArea #gnb').slideDown();
        current=1;
    },function(){
        $('.menuOpen').removeClass('open');
        $('#headerArea #gnb').slideUp();
        current=0;
    });


    function navirespon(){
        if( screenSize > 1024){ // 클때
            $('#headerArea').removeClass('respon');
            $('#headerArea #gnb').show();
        }
        
        if(current==1 && screenSize > 1024){  // 닫혀있고 클때
            $('#headerArea #gnb').show();
        } else if(current == 0 && screenSize <= 1024){
            $('#headerArea #gnb').hide();
        }
        if(screenSize <= 1024){  // 작을때
            $('#headerArea').addClass('respon');
            //$('#headerArea #gnb').show();
        }
    }
    navirespon();
    

    
    $(window).resize(function(){
        navirespon();
    });


    

    /* 헤더 스티키 */
    $(document).scroll(function(){
        var windowTop = $(window).scrollTop();

        //if( screenSize > 1024){ // 가로값이 1024 이하일때만 아래 if문 실행

            if(windowTop > visHeight-150){
                $('#headerArea').addClass('on');
            } else {
                $('#headerArea').removeClass('on');
            }
        //}
    });



    
    
    // $('.menuOpen').toggle(function(){
        
    //     $('#headerArea').addClass('top0');
    //     $('#headerArea #gnb').slideDown();
    //     $('.menuOpen').addClass('open');
        
    // },function(){
    //     $('#headerArea').removeClass('top0');
    //     $('#headerArea #gnb').slideUp();
    //     $('.menuOpen').removeClass('open');
        
    // });
    
        
    // var current=0;
    // $(window).resize(function(){
    //    var screenSize= $(window).width(); 
    //    if( screenSize > 1024){  
    //     $('#headerArea #gnb').show();
    //     $('#headerArea').removeClass('top0');
    //     $('.menuOpen').removeClass('open');
    //      current=1;
    //     }
    //     if(current==1 && screenSize <= 1024){
    //         $('#headerArea').removeClass('top0');
    //         $('#headerArea #gnb').hide();
    //         current=0;
    //     }
       
    // });






    




    // if(current==1 && screenSize <= 1024){
    //     $('#headerArea').addClass('top0');
    //     $('#headerArea ul').hide();
        
    //      current=0;
    // }
    // if( screenSize > 1024){
    //     $('#headerArea').removeClass('top0');
    //     $('#headerArea ul').show();
    //     $('.menuOpen').removeClass('open');
    //     current=1;
    // }

    //Sticky Header
    // var screenSize = $(window).width(); 
    // var winHeight = $(window).height();
    // var headHeight = $('#headerArea').height();

    // if(screenSize > 1024){
    //     $(window).on("scroll", function(){
    //         var headerH = $(this).scrollTop();
    //         if(headerH > winHeight - headHeight){
    //             $('#headerArea').css({ top: 0 });
    //         }else{
    //             $('#headerArea').css({ top: -126 });
    //         }
    //     });
    // }else{
    //     $('#headerArea').css({ top: 0 });
    // }














});

 