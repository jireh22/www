<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);

	$table = "concert";
?>
<!DOCTYPE html>
<html lang="ko">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>상담센터-뉴스공지</title>
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
	<link rel="stylesheet" href="../common/css/common.css">
	<link rel="stylesheet" href="./css/list.css">
	<link rel="stylesheet" href="../sub6/common/css/sub1common.css">
	<script src="../common/js/prefixfree.min.js"></script>

</head>
<?
	include "../lib/dbconn.php";

    
   if (!$scale)
    $scale=6;			// 한 화면에 표시되는 글 수

    
    if ($mode=="search")
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

		$sql = "select * from $table where $find like '%$search%' order by num desc";
	}
	else
	{
		$sql = "select * from $table order by num desc";
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

	if(!$list){
	  $list="album";
	}
?>
<body>
<? include "../common/sub_header.html" ?>

<div class="visual">
    <img src="../sub6/common/images/visual.jpg" alt="비주얼이미지">
    <h3>상담센터</h3>
</div>

<div class="sub_menu">
        <ul>
            <li class="curent"><a href="../concert/list.php">뉴스공지</a></li>
            <li><a href="../sub6/sub6_2.html">FAQ</a></li>
            <li><a href="../sub6/sub6_3.html">방문전 이용 문의</a></li>
            <li><a href="../sub6/sub6_4.html">유실물 확인</a></li>       
        </ul>
</div>

<article id="content" class="<?=$list?>">
	<div class="title_area">
        <div class="line_map">home &gt; 상담센터 &gt; <strong>뉴스공지</strong></div>
            <h2>뉴스공지</h2>
        </div>

	<div class="content_area">
	<p>에버랜드 <span>새로운 소식</span>을 알려드립니다.</p>
	<form  name="board_form" method="post" action="list.php?table=<?=$table?>&mode=search&list=<?=$list?>"> 
		<ul id="list_search">
			<li id="list_search1">
				<select name="scale" onchange="location.href='list.php?scale='+this.value+'&list=<?=$list?>'">
					<option value=''>보기</option>
					<option value='3'>3</option>
					<option value='6'>6</option>
					<option value='9'>9</option>
					<option value='12'>12</option>
				</select>
				<b>전체게시물 :</b> <?= $total_record ?> 
			</li>
			<li id="list_search2">
				<a class="view1" href="list.php?list=album&scale=<?=$scale?>"><i class="fab fa-microsoft"></i><span class="hidden">앨범형보기</span></a>
				<a class="view2" href="list.php?list=list&scale=<?=$scale?>"><i class="fas fa-list"></i><span class="hidden">목록형보기</span></a>
			</li>
			<li id="list_search3">
				<select name="find">
					<option value='subject'>제목</option>
					<option value='content'>내용</option>
					<option value='nick'>닉네임</option>
					<option value='name'>이름</option>
				</select>
				<input type="text" name="search">
				<input class="search_btn" type="submit" value="검색">
			</li>
		</ul>
	</form>

	<ul id="list_top_title">
		<li id="list_title1">번호</li>
		<li id="list_title2">제목</li>
		<li id="list_title3">글쓴이</li>
		<li id="list_title4">등록일</li>
		<li id="list_title5">조회</li>
	</ul>		

	<div id="list_content">
	<?		
   for ($i=$start; $i<$start+$scale && $i < $total_record; $i++)                    
   {
      mysql_data_seek($result, $i);       
      // 가져올 레코드로 위치(포인터) 이동  
      $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	  $item_num     = $row[num];
	  $item_id      = $row[id];
	  $item_name    = $row[name];
  	  $item_nick    = $row[nick];
	  $item_hit     = $row[hit];
      $item_date    = $row[regist_day];
	  $item_date = substr($item_date, 0, 10);  
	  $item_subject = str_replace(" ", "&nbsp;", $row[subject]);
	  $item_content = str_replace(" ", "&nbsp;", $row[content]);
	  $item_content = str_replace("\\n", "<br>;", $row[content]);
        
      if($row[file_copied_0]){ //첨부된 첫번째 이미지가 있다면
        $item_img = './data/'.$row[file_copied_0];  //'./data/2022_02_22_10_43_06_0.jpg'
      }else{
        $item_img = './data/default.jpg'  ;
      }
      
?>

<ul id="list_item">
	<li id="list_item1"><?= $number ?></li>
	<li id="list_item2">
		<a href="view.php?table=<?=$table?>&num=<?=$item_num?>&page=<?=$page?>&list=<?=$list?>">	
			<img src="<?=$item_img?>" alt="<?=$item_img?>">
			<span><?= $item_subject ?></span>
		</a>
	</li>
	<li id="list_item3"><?= $item_content ?></li>
	<li id="list_item4"><?= $item_nick ?></li>
	<li id="list_item5"><?= $item_date ?></li>
	<li id="list_item6"><?= $item_hit ?></li>
</ul>
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
             echo "<a href='list.php?page=$i&scale=$scale&mode=search&find=$find&search=$search&list=$list'> $i </a>"; 
          }else{    
            
			  echo "<a href='list.php?page=$i&scale=$scale&list=$list'> $i </a>";
           }
            
          
		}      
   }
?>		
		&nbsp;&nbsp;&nbsp;&nbsp;다음 ▶
			</div>
			<div id="button">
			<a href="list.php?table=<?=$table?>&page=<?=$page?>&list=<?=$list?>">목록</a>&nbsp;
<? 
if($userid)  //로그인이 되었다면
{
?>
	<a href="write_form.php?table=<?=$table?>">글쓰기</a>
<?
}
?>
			</div>
		</div> <!-- end of page_button -->
	</div> <!-- end of list content -->
	</div>
</article>
<? include "../common/sub_footer.html" ?>
<!-- <script src="./js/view.js"></script> -->
</body>
</html>

