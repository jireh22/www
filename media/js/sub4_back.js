$(document).ready(function(){
    //visual
        var screenSize = $(window).width();
        var screenHeight = $(window).height();
    
        $("#content").css('margin-top',screenHeight);
    
        if( screenSize > 768){
            $('#imgBG').attr('src','./images/sub_visual04.png');
        }
        if(screenSize <= 768){
            $('#imgBG').attr('src','./images/sub_visual04_640.jpg');
        }
        if(screenSize <= 375){
            $('#imgBG').attr('src','./images/sub_visual04_375.jpg');
        }
        
        $(window).resize(function(){   
        screenSize = $(window).width(); 
        screenHeight = $(window).height();
            
        $("#content").css('margin-top',screenHeight);
            
        if( screenSize > 768){
            $('#imgBG').attr('src','./images/sub_visual04.png');
        }
        if(screenSize <= 768){
            $('#imgBG').attr('src','./images/sub_visual04_640.jpg');
        }
        if(screenSize <= 375){
            $('#imgBG').attr('src','./images/sub_visual04_375.jpg');
        }
        }); 
    
        $('.down').click(function(){
            screenHeight = $(window).height();
            $('html,body').animate({'scrollTop':screenHeight}, 700);
        });
    });
    
    