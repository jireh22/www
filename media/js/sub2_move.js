$(document).ready(function(){

    $(window).on('scroll',function(){
       var scroll = $(window).scrollTop();
        if(scroll>600){
            $('.woody img').css('right','1%');
        }
        else{
            $('.woody img').css('right',-450);
        }
    });
    $('.top_btn').click(function(e){
        e.preventDefault();
      
        $("html,body").stop().animate({"scrollTop":0},1500); 
    });
});




$(document).ready(function(){
   
    $(window).on('scroll',function(){
       var scroll = $(window).scrollTop();
        if(scroll>1200){
            $('.buzz img').css('left','1%');
        }
        else{
            $('.buzz img').css('left',-450);
        }
    });

});

$(document).ready(function(){
   
    $(window).on('scroll',function(){
       var scroll = $(window).scrollTop();
        if(scroll>2085){
            $('.bopeep img').css('right','1%');
        }
        else{
            $('.bopeep img').css('right',-450);
        }
    });

});

$(document).ready(function(){
   
    $(window).on('scroll',function(){
       var scroll = $(window).scrollTop();
        if(scroll>3300){
            $('.forky img').css('left','1%');
        }
        else{
            $('.forky img').css('left',-450);
        }
    });

});