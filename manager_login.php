<?php
	session_start();
	//session_destroy();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<?php
if (isset($_POST['admin_id']) && isset($_POST['admin_pw']))
{
if (!get_magic_quotes_gpc()) {
    $_POST['admin_id'] = addslashes($_POST['admin_id']);
  }
  if (!get_magic_quotes_gpc()) {
    $_POST['admin_pw'] = addslashes($_POST['admin_pw']);
  }
include("mysql_connect.php");//將連接資料庫的設定引入
$id = $_POST['admin_id'];
$pw = $_POST['admin_pw'];
$sql = "SELECT * FROM admin where account='$id' and password='$pw'";//比對帳密
$result = mysql_query($sql);
$row = mysql_fetch_object($result);
  if (mysql_num_rows($result) >0 )
  {
    $_SESSION['admin_user'] = $id; 
	$_SESSION['admin_id'] = $id;
	$_SESSION['admin_pw']=$pw;
  }
}
if (isset($_SESSION['admin_user']))
	{
	echo '<meta http-equiv="refresh" content="1;url=manager_connect.php">';
	exit;
	}

?>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TELiC學習管理系統</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
<h2>TELiC學習管理系統</h2>
	<br>
	<div id="main">

	<div id="HEADER">
	
	</div>
	<div id="menu">
	<nav><!--網站四個主要功能的連結-->
	<ul>
		<li><a href="reading_connect.php">開始閱讀</a></li>
		<li><a href="record_connect.php">歷史紀錄</a></li>
		<li><a href="honor.php">查看榮譽榜</a></li>
		<li><a href="connect.php">會員資料修改</a></li>
		<li><a href="manager_connect.php">管理者專區</a></li>
	</ul>
	</nav>
	</div>
<div id="CONTENT">
	<p>
		<center>
		<h2>管理者專區<br/></h2>
		<br/>
		<br/>
		<!--管理者登入帳號、密碼的頁面，會作用到manager_connect.php頁面-->
		<form name="form" method="post" action="manager_login.php">
			<p>
			帳號：<input type="text" name="admin_id" /> <br>
			密碼：</h1><input type="password" name="admin_pw" /> <br>
			</p>
			<input type="submit" name="button" value="送出" />
			<p>
			</p>
		</form>
		<center>
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
