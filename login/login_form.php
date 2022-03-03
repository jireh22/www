<?
	session_start();
    @extract($_GET); 
    @extract($_POST); 
    @extract($_SESSION);  
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>로그인</title>
	<link  rel="stylesheet" href="../common/css/common.css">
	<link  rel="stylesheet" href="./css/login.css">
</head>
<body>
	<div class="wrap">
<header>
	<h1 class="logo"><a href="../index.html">에버랜드로고</a></h1>
</header>

<article id="content">
<form  name="member_form" method="post" action="login.php"> 
		<h2>로그인</h2>
		<div id="id_pw_input">
			<ul>
				
				<li><label for="id" class="hidden">아이디</label>
					<input type="text" name="id" class="login_input" id="id" placeholder="아이디를 입력하세요"></li>

				<li><label for="pass" class="hidden">비밀번호</label>
					<input type="password" name="pass" class="login_input" id="pass" placeholder="비밀번호를 입력하세요"></li>
			</ul>						
		</div>
		<div id="login_button">
			<button class="login_button" type="submit">로그인</button>
		</div>

		<ul class="find">
			<li><a href="./id_find.php">아이디 찾기</a></li>
			<li><a href="./pw_find.php">비밀번호 찾기</a></li>
		</ul>

		<div id="join_button">
            <p>아직 회원이 아니신가요?</p>
            <a class="joinUs" href="../member/member_check.html">회원가입</a>
        </div>

</form>

</article>
	</div>
</body>
</html>



