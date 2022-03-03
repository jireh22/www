<? 
	session_start(); 
    @extract($_POST);
    @extract($_GET);
    @extract($_SESSION);
	//$table, $num, $page(get)

	include "../lib/dbconn.php";

	$sql = "select * from $table where num=$num";
	$result = mysql_query($sql, $connect);

    $row = mysql_fetch_array($result);       
      // 하나의 레코드 가져오기
	
	$item_num     = $row[num];
	$item_id      = $row[id];
	$item_name    = $row[name];
  	$item_nick    = $row[nick];
	$item_hit     = $row[hit];

	$image_name[0] = $row[file_name_0];
	$image_name[1] = $row[file_name_1];
	$image_name[2] = $row[file_name_2];


	$image_copied[0] = $row[file_copied_0];  //data방에 들어가는 이미지
	$image_copied[1] = $row[file_copied_1];
	$image_copied[2] = $row[file_copied_2];

    $item_date    = $row[regist_day];
	$item_subject = str_replace(" ", "&nbsp;", $row[subject]);

	$item_content = $row[content];
	$is_html      = $row[is_html];

	if ($is_html!="y")
	{
		$item_content = str_replace(" ", "&nbsp;", $item_content);
		$item_content = str_replace("\n", "<br>", $item_content);
	}
	
	for ($i=0; $i<3; $i++)
	{
		if ($image_copied[$i]) //업로드한 파일이 존재하면 0 1 2
		{
			$imageinfo = GetImageSize("./data/".$image_copied[$i]);
            //GetImageSize(서버에 업로드된 파일 경로 파일명) => 파일의 크기(너비x높이), 종류(type)
			$image_width[$i] = $imageinfo[0];  //파일너비
			$image_height[$i] = $imageinfo[1]; //파일높이
			$image_type[$i]  = $imageinfo[2];  //파일종류

        if ($image_width[$i] > 785)  //785px => 레이아웃의 너비
				$image_width[$i] = 785;
		}
		else
		{
			$image_width[$i] = "";
			$image_height[$i] = "";
			$image_type[$i]  = "";
		}
	}

	$new_hit = $item_hit + 1;

	$sql = "update $table set hit=$new_hit where num=$num";   // 글 조회수 증가시킴
	mysql_query($sql, $connect);
?>
<!DOCTYPE html>
<html lang="ko">
<head>
<meta charset="UTF-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>상담센터-뉴스공지-게시글보기</title>
<link rel="stylesheet" href="../common/css/common.css">
<link rel="stylesheet" href="./css/view.css">
<link rel="stylesheet" href="../sub6/common/css/sub1common.css">


<script>
    function del(href) 
    {
        if(confirm("삭제한 자료는 복구할 수 없습니다.\n\n정말 삭제하시겠습니까?")) {
                document.location.href = href;
        }
    }
</script>
</head>
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
	
	<article id="content">
		<div class="title_area">
			<div class="line_map">home &gt; 상담센터 &gt; <strong>뉴스공지</strong></div>
            	<h2>뉴스공지</h2>
        </div>

		<div class="content_area"> 
			<p>에버랜드 <span>새로운 소식</span>을 알려드립니다.</p>    
			<div id="con_inner">
				<ul id="view_title">
					<li id="view_title1"><b><?= $item_subject ?></b></li>
					<li id="view_title2">
						<span><?= $item_nick ?></span>
						<span><?= $item_date ?>&nbsp;&nbsp;|&nbsp;&nbsp;조회 : <?= $item_hit ?></span>
					</li>	
				</ul>

				<div id="view_content">
					<?
						for ($i=0; $i<3; $i++)  //업로드된 이미지를 출력한다
						{
							if ($image_copied[$i])  //첨부된 파일이 있다면
							{
								$img_name = $image_copied[$i];
								$img_name = "./data/".$img_name; 
					             // ./data/2022_02_22_10_07_15_0.jpg
								$img_width = $image_width[$i];

								echo "<img src='$img_name' width='$img_width'>"."<br><br>";
							}
						}
					?>
					<div class="item_content"><?= $item_content ?></div>
				</div>

				<div id="view_button">
					<a href="list.php?table=<?=$table?>&page=<?=$page?>">목록</a>&nbsp;
<? 
	if($userid==$item_id || $userlevel==1 || $userid=="jo0572")  //세션변수id==글에저장되어있는id || 관리자 || 관리자
	{
?>
					<a href="write_form.php?table=<?=$table?>&mode=modify&num=<?=$num?>&page=<?=$page?>">수정</a>&nbsp;
					<a href="javascript:del('delete.php?table=<?=$table?>&num=<?=$num?>')">삭제</a>&nbsp;
<?
	}
?>
<? 
	if($userid)  //로그인이 되면 글쓰기 보여주기
	{
?>
					<a href="write_form.php?table=<?=$table?>">글쓰기</a>
<?
	}
?>
				</div>
			</div> <!-- end of con_inner -->
        </div> <!-- end of list content -->
	</article>
	<? include "../common/sub_footer.html" ?>
</body>
</html>
