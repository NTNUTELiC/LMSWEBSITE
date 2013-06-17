<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	include("mysql_connect.php");
	$account = $_POST['select1']; 
	$button = $_POST['button1'];//把botton的值也拿出來，讓它可以根據新增、修改、刪除分別做不同的動作
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
		<h2>管理者專區<br/></h2>
		<br/>
		<br/>
		<center>
		<?php
			
			if($button === "新增"){
		?>
				<form name="form" method="post" action="admin_member_done.php">
					<p>
					帳號：<input type="text" name="account" /> <br>
					密碼：</h1><input type="text" name="pw" /> <br>
					使用者姓名：</h1><input type="text" name="username" /> <br>
					Email：</h1><input type="text" name="email" /> <br>
					城市：</h1><input type="text" name="country" /> <br>
					年齡：</h1><input type="text" name="age" /> <br>
					</p>
					<input type="submit" name="button" value="新增" />
					<p>
					</p>
				</form>
		<?php
			}
			else if($button === "修改"){ //若等於則修改，則從member中取出資料並用table呈現在網頁上
				$sql = "SELECT * FROM member WHERE account='$account'";
				$result = mysql_query($sql);
											
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				else{
				$row = mysql_fetch_array(mysql_query($sql));
		?>
					<form name="form" method="post" action="admin_member_done.php">
						<p>
						帳號：<input type="text" name="account" value="<?php echo $row['account']; ?>" /> <br>
						密碼：</h1><input type="text" name="pw" value="<?php echo $row['password']; ?>"/> <br>
						使用者姓名：</h1><input type="text" name="username" value="<?php echo $row['username']; ?>" /> <br>
						Email：</h1><input type="text" name="email" value="<?php echo $row['email']; ?>" /> <br>
						城市：</h1><input type="text" name="country" value="<?php echo $row['country']; ?>" /> <br>
						年齡：</h1><input type="text" name="age" value="<?php echo $row['age']; ?>" /> <br>
						</p>
						<input type="submit" name="button" value="修改" />
						<p>
						</p>
					</form>
		<?php
				}
			}
			else if($button === "刪除"){
				$sql = "DELETE FROM member WHERE account='$account'";//刪除資料庫裡資料的動作
				$result = mysql_query($sql);
											
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				else{
					echo "<h3>資料已刪除.....</h3>";
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