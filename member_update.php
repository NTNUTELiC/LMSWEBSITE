<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	include("mysql_connect.php");
	$id = $_POST['account']; 
	$pw = $_POST['pw'];
	$pwconfirm = $_POST['pwconfirm'];
	$username = $_POST['username'];
	$email = $_POST['email'];
	$country = $_POST['country'];
	$age = $_POST['age'];
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
		<h2>會員資料修改<br/></h2>
		<br/>
		<br/>
		<center>
		<?php
			if($username == null){
				echo "<h3>使用者名稱為空白，請重新輸入</h3>";
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';//如果是空白，就刷新網頁回到login.php頁面(需重新登入)
			}
			else if($email == null){
				echo "<h3>Email為空白，請重新輸入</h3>";
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
			}
			else if($country == null){
				echo "<h3>城市為空白，請重新輸入</h3>";
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
			}
			else if($age == null){
				echo "<h3>年齡為空白，請重新輸入</h3>";
				echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
			}
			else{
				if($pw == null){
					$sql = "UPDATE member SET username='$username', email='$email', country='$country', age='$age' WHERE account='$id'";
					$result = mysql_query($sql);
				
					if (!$result) { // add this check.
						die('Invalid query: ' . mysql_error());
					}
					echo "<h3>修改成功!</h3>";
					echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';//修改成功就刷新網頁回到login.php頁面(需重新登入)
				}
				else{
					if($pw != $pwconfirm){//檢查密碼是否相符
						echo "<h3>密碼輸入有誤，請重新輸入</h3>";
						echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
					}
					else{//密碼相符即做更新到資料庫的動作
						$sql = "UPDATE member SET password='$pw', username='$username', email='$email', country='$country', age='$age' WHERE account='$id'";
						$result = mysql_query($sql);
						
						if (!$result) { // add this check.
							die('Invalid query: ' . mysql_error());
						}
						echo "<h3>修改成功!</h3>";
						echo '<meta http-equiv=REFRESH CONTENT=2;url=login.php>';
					}
				}
			}		
		?>
		</center>
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