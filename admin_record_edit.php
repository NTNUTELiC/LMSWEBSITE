<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	include("mysql_connect.php");
	$serial = $_POST['select2']; 
	$button = $_POST['button2'];
	
	$serial_array = explode("+",$serial); // serial+account 將序號及帳號分割出來(以+號作切割)
	$serial_number = $serial_array[0];
	$account = $serial_array[1];
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
		<?php  //管理者將reading的資料依據新增、修改、刪除功能，實際作用到admin_record_done.php頁面去處理
			/* reading */
			if($button === "新增"){
		?>
				<form name="form" method="post" action="admin_record_done.php">
					<p>
						序號：<input type="text" name="serial" /> <br>
						帳號：</h1><input type="text" name="account" /> <br>
						時間：</h1><input type="text" name="time" /> <br>
						評論：</h1><input type="text" name="comments" /> <br>
					</p>
					<input type="submit" name="button" value="新增" />
					<p>
					</p>
				</form>
		<?php
			}
			else if($button === "修改"){
				
				$sql = "SELECT * FROM record WHERE serial='$serial_number' AND account='$account'";
				$result = mysql_query($sql);
											
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				else{
					$row = mysql_fetch_array(mysql_query($sql));
		?>
					<form name="form" method="post" action="admin_record_done.php">
						<p>
						序號：<input type="text" name="serial" value="<?php echo $row['serial']; ?>" /> <br>
						帳號：</h1><input type="text" name="account" value="<?php echo $row['account']; ?>" /> <br>
						時間：</h1><input type="text" name="time" value="<?php echo $row['time']; ?>" /> <br>
						評論：</h1><input type="text" name="comments" value="<?php echo $row['comments']; ?>" /> <br>
						</p>
						<input type="submit" name="button" value="修改" />
						<p>
						</p>
					</form>
		<?php
				}
			}//若botton的值等於刪除，則從資料庫中將符合的資料刪除
			else if($button === "刪除"){
				$sql = "DELETE FROM record WHERE serial='$serial_number' AND account='$account'";
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