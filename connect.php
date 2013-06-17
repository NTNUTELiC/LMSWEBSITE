<?php
	session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
if (!isset($_SESSION['normal_user']))
{
	echo"帳號密碼錯誤";
	echo '<meta http-equiv="refresh" content="1;url=login.php">';
	exit;
}
else
{
include("mysql_connect.php");
$id = $_SESSION['id'];
$pw = $_SESSION['pw'];
//$b = $_POST['button'];

$sql = "SELECT * FROM member where account='$id' and password='$pw'";
$row = mysql_fetch_array(mysql_query($sql));
}
?>
<?php
/*include("mysql_connect.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
$b = $_POST['button'];

$sql = "SELECT * FROM member where account='$id' and password='$pw'";
$row = mysql_fetch_array(mysql_query($sql));*/
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
		<li><a href="manager_login.php">管理者專區</a></li>
	</ul>
	</nav>
	</div>
	<div id="CONTENT">
	<p>
	
		<center>
		<h2>會員資料修改<br/></h2>
		<br/>
		<br/>
		
		<?php
			/*if (!$row) { // add this check.
				echo "<h3>帳號或密碼錯誤，請重新輸入</h3>";
        		echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
			}
			else {*/ //先作帳密比對的動作，符合則顯示使用者資料讓他去作修改的動作
		?>
				<form name="form" method="post" action="member_update.php">
					<p>
					帳號：<input type="text" name="account" value="<?php echo $row['account']; ?>" disabled="true"/> <br><!--預設值直接先指定，disabled屬性讓使用者無法更改-->
					<input type="hidden" name="account" value="<?php echo $row['account']; ?>"/> 
					密碼(留空表示不修改)：</h1><input type="password" name="pw" /> <br>
					確認密碼：</h1><input type="password" name="pwconfirm" /> <br>
					使用者姓名：</h1><input type="text" name="username" value="<?php echo $row['username']; ?>" /> <br>
					Email：</h1><input type="text" name="email" value="<?php echo $row['email']; ?>" /> <br>
					城市：</h1><input type="text" name="country" value="<?php echo $row['country']; ?>" /> <br>
					年齡：</h1><input type="text" name="age" value="<?php echo $row['age']; ?>" /> <br>
					</p>
					<input type="submit" name="button" value="修改" />
					<input type="button" value="回上一頁" onclick="javascript:history.back(1)" />
					<p>
					</p>
				</form>
				
		<?php
			//}
		?>
		</center>
		<br/>
		<br/>
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


