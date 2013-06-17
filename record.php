<?php
	session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if (isset($_POST['id']) && isset($_POST['pw']))
{
if (!get_magic_quotes_gpc()) {
    $_POST['id'] = addslashes($_POST['id']);
  }
  if (!get_magic_quotes_gpc()) {
    $_POST['pw'] = addslashes($_POST['pw']);
  }
include("mysql_connect.php");//將連接資料庫的設定引入
$id = $_POST['id'];
$pw = $_POST['pw'];
$sql = "SELECT * FROM member where account='$id' and password='$pw'";//比對帳密
$result = mysql_query($sql);
$row = mysql_fetch_object($result);
  if (mysql_num_rows($result) >0 )
  {
    $_SESSION['normal_user'] = $id; 
	$_SESSION['id'] = $id;
	$_SESSION['pw']=$pw;
  }
}
if (isset($_SESSION['normal_user']))
	{
	echo '<meta http-equiv="refresh" content="1;url=record_connect.php">';
	exit;
	}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TELiC學習管理系統</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
<script language="javascript">
function autoFocus() {
	if (document.forms.length > 0) {
		var field = document.forms[0];
		for (i = 0; i < field.length; i++) {
			if ((field.elements[i].value.length == 0)) {
				document.forms[0].elements[i].focus();
				break;
			}
		}
	}
}

	function login_check(){
		if (form.id.value.length==0){
			alert("尚未輸入使用者帳號!!!");
			form.id.focus();
		} else if (form.pw.value.length==0){
			alert("尚未輸入使用者密碼!!!");
			form.pw.focus();
		} else {
			return true;
		}
		return false;
	}

function confirm_action(message) {
	if (confirm(message)) {
	return true;
	}
	return false;
}


</script>
</head>

<body onLoad="autoFocus();">
	
<h2>TELiC學習管理系統</h2>
	<br>
	<div id="main">

	<div id="HEADER">
	
	</div>
	<div id="menu">
	<nav><!--網站四個主要功能的連結-->
	<ul>
		<li><a href="reading.php">開始閱讀</a></li>
		<li><a href="record.php">歷史紀錄</a></li>
		<li><a href="honor.php">查看榮譽榜</a></li>
		<li><a href="login.php">會員資料修改</a></li>
		<li><a href="manager_login.php">管理者專區</a></li>
	</ul>
	</nav>
	</div>
<div id="CONTENT">
	<p>
		<center>
		<h2>閱讀紀錄查詢<br/></h2>
		<br/>
		<br/>
		<h3>

		<form name="form" method="post" action=" record.php" onSubmit="return login_check()"><!--作用到record_connect.php這個網頁-->
			<p>
			帳號：<input type="text" name="id" /> <br>
			密碼：<input type="password" name="pw" /> <br>
			</p>
			<input type="submit" name="button" value="送出" />
			<p>
			</p>
		</form>
		
		</center>
		</h3>
	</p>
	</div>
	<div id="FOOTER">	
	
		<nav>
		<center><ul><li>原創：高翊展&nbsp;&nbsp;修改：廖宜志、陳光禧、林淑微</li></ul></center>
		</nav>
	</div>
</div>
</body>
</html>
