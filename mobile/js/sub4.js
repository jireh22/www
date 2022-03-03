// JavaScript Document
$(document).ready(function () {
	var article = $('.faq_box .article');  //모든 li들.. (질문답변들..)

	article.find('span').html('<i class="fas fa-angle-down"></i>');
    $('.faq .article:first').find('.a').slideDown(100);
    $('.faq .article:first').find('span').html('<i class="fas fa-angle-up"></i>');
	
	
	$('.faq .article .trigger').click(function(e){
        e.preventDefault();                             //각각의 질문을 클릭하면
	var myArticle = $(this).parents('.article');   //클릭한 해당 메뉴에 li(리스트)
	
	if(myArticle.hasClass('hide')){   //클릭한 해당 리스트가 닫혀있냐??
	    article.find('.a').slideUp(100);  //모든 리스트의 답변을 닫아라
        article.removeClass('show').addClass('hide');  //모든 리스트의 클래스 hide로 바꾼다
        article.find('span').html('<i class="fas fa-angle-down"></i>');

	    myArticle.removeClass('hide').addClass('show');   //클래스를 show로 바꾼다
	    myArticle.find('.a').slideDown(100);   //해당 리스트의 답변을 열어라~~
        myArticle.find('span').html('<i class="fas fa-angle-up"></i>');
	 } else {      //클릭한 해당 리스트가 열려있냐?? (show)
	   myArticle.removeClass('show').addClass('hide');  //클래스 hide로 바꾼다
	   myArticle.find('.a').slideUp(100);  //해당 리스트의 답변을 닫아라~~
       myArticle.find('span').html('<i class="fas fa-angle-down"></i>');
	}  
  });      
  
  //모두여닫기
  $('.all').toggle(function(e){ 
	  e.preventDefault();
    article.find('.a').slideDown(100);              //홀수번째
    article.removeClass('hide').addClass('show');
	// $(this).text('모두닫기');
	$(this).html('<i class="fas fa-chevron-circle-up"></i><span class="hidden"></i></span>');
},function(e){ 
	e.preventDefault();
    article.find('.a').slideUp(100);                //짝수번째
    article.removeClass('show').addClass('hide');
	// $(this).text('모두열기');
    $(this).html('<i class="fas fa-chevron-circle-down"></i><span class="hidden"></i></span>');
});

}); 