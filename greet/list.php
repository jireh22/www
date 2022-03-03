<? 
	session_start(); 
     @extract($_POST);
     @extract($_GET);
     @extract($_SESSION);
?>

<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>공지사항</title>
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="./css/greet.css">
	<link rel="stylesheet" href="../sub6/common/css/sub1common.css">
    

	<?
	include "../lib/dbconn.php";

	
  if (!$scale)
    $scale=10;			// 한 화면에 표시되는 글 수

    if ($mode=="search")  //검색버튼을 통한 리스트 출력
	{
		if(!$search)
		{
			echo("
				<script>
				 window.alert('검색할 단어를 입력해 주세요!');
			     history.go(-1);
				</script>
			");
			exit;
		}

		$sql = "select * from greet where $find like '%$search%' order by num desc";
	}
	else   //일반 리스트 출력(페이지번호)
	{
		$sql = "select * from greet order by num desc";
	}

	$result = mysql_query($sql, $connect);

	$total_record = mysql_num_rows($result); // 전체 글 수

	// 전체 페이지 수($total_page) 계산 
	if ($total_record % $scale == 0)     
		$total_page = floor($total_record/$scale);      
	else
		$total_page = floor($total_record/$scale) + 1; 
 
	if (!$page)                 // 페이지번호($page)가 0 일 때
		$page = 1;              // 페이지 번호를 1로 초기화
 
	// 표시할 페이지($page)에 따라 $start 계산  
	$start = ($page - 1) * $scale;      

	$number = $total_record - $start;
?>

</head>
<body>
	<? include "../common/sub_header.html"?>
	<div class="visual">
        <img src="../sub6/common/images/visual.jpg" alt="비주얼이미지">
        <h3>상담센터</h3>
    </div>

	<div class="sub_menu">
            <ul>
                <li class="curent"><a href="../greet/list.php">뉴스공지</a></li>
                <li><a href="../sub6/sub6_2.html">FAQ</a></li>
                <li><a href="../sub6/sub6_3.html">방문전 이용 문의</a></li>
                <li><a href="../sub6/sub6_4.html">유실물 확인</a></li>
                
            </ul>
    </div>

	<article id="content">
		<div class="title_area">
            <div class="line_map">home &gt; 상담센터 &gt; <strong>뉴스공지</strong></div>
            <h2>뉴스공지</h2>
			<p>에버랜드<span>새로운 소식</span>을 알려드립니다.</p>
        </div>
        <div class="content_area">
			
		<form  name="board_form" method="post" action="list.php?mode=search"> 
			<div id="list_search">
						
				<ul id="list_search3">
					<li id="find">
						<select name="find">
							<option value='subject'>제목</option>
							<option value='content'>내용</option>
							<option value='nick'>별명</option>
							<option value='name'>이름</option>
						</select>
					</li>
					<li id="list_search4"><input type="text" name="search"></li>
					<li id="list_search5"><input type="submit" value="검색"></li>
				</ul>
			</div>			
		</form>
		
		<div class="total">
			<div id="list_search1">▷ 총 <?= $total_record ?> 개의 게시물이 있습니다.  </div>
			<div class="scale_list">
				<select name="scale" onchange="location.href='list.php?scale='+this.value">
					<option value=''>보기</option>
					<option value='5'>5</option>
					<option value='10'>10</option>
					<option value='15'>15</option>
					<option value='20'>20</option>
				</select>
			</div>    
		</div>

		<div id="list_top_title">			
			<ul>
				<li id="list_title1">번호</li>
				<li id="list_title2">제목</li>
				<li id="list_title3">글쓴이</li>
				<li id="list_title4">등록일</li>
				<li id="list_title5">조회</li>
			</ul>
		</div>
		

		<div id="list_content">
<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);       
      // 가져올 레코드로 위치(포인터) 이동  
      $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	  $item_num     = $row[num];  //num필드에 있는 게시번호를 가져온다
	  $item_id      = $row[id];
	  $item_name    = $row[name];
  	  $item_nick    = $row[nick];
	  $item_hit     = $row[hit];

      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  //2022-02-21

	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);

?>
			<div id="list_item">
				<div id="list_item1"><?= $number ?></div>
				<div id="list_item2"><a href="view.php?num=<?=$item_num?>&page=<?=$page?>"><?= $item_subject ?></a></div>
				<div id="list_item3"><?= $item_nick ?></div>
				<div id="list_item4"><?= $item_date ?></div>
				<div id="list_item5"><?= $item_hit ?></div>
			</div>
<?
   	   $number--;
   }
?>
			<div id="page_button">
				<div id="page_num"> ◀ 이전 &nbsp;&nbsp;&nbsp;&nbsp; 
<?
   // 게시판 목록 하단에 페이지 링크 번호 출력
   for ($i=1; $i<=$total_page; $i++)
   {
		if ($page == $i)     // 현재 페이지 번호 링크 안함
		{
			echo "<b> $i </b>";
		}
		else
		{ 
           if($mode=="search"){
             echo "<a href='list.php?page=$i&scale=$scale&mode=search&find=$find&search=$search'> $i </a>"; 
            }else{    
            
			  echo "<a href='list.php?page=$i&scale=$scale'> $i </a>";
           }
		}      
   }
?>			
			&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
				</div>
				<div id="button">
					<a href="list.php?page=<?=$page?>">목록</a>&nbsp;
<? 
	if($userid) //로그인이 되었으면
	{
?>
		<a href="write_form.php">글쓰기</a>
<?
	}
?>
				</div>
			</div> <!-- end of page_button -->
		
        </div> <!-- end of list content -->



			</div>	
	</article>		
        

	<? include "../common/sub_footer.html"?>	
</body>
</html>


