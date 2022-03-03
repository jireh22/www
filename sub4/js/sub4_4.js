$(function() {                                   

  
    var fragment = $('#content #Plantopia li a.current').attr('href');   //'data.html#Modeling'
       
    fragment = fragment.replace('#', ' #');            //'data.html #Modeling'    한칸띄우라는 말임  
    $('#details').load(fragment);    //$('선택자').load('파일명.html'); 
       
     $('#content #Plantopia li a').on('click', function(e) { 
       e.preventDefault();             //이거 주석걸면 링크가 걸림, 막아서 위에 # 한칸띄워주는 문자로만 사용 하려고 하는것임                         
       // fragment = this.href;             //자바스크립트 원문                  
       fragment = $(this).attr('href');     //제이쿼리로 짠거 위에랑 같은 뜻임
   
       fragment = fragment.replace('#', ' #');  
       $('#details').load(fragment);                          
   
       $('#Plantopia a.current').removeClass('current');    //커렌트있다면 커렌트 없에버리고 자기만 탭활성화 시켜라   
       $(this).addClass('current');
     });
   
   
   
   });