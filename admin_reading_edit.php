<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	include("mysql_connect.php");
	$serial = $_POST['select']; 
	$button = $_POST['button'];
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
			/* reading */  //管理者管理reading新增、修改的功能並作用到admin_reading_done.php頁面
			if($button === "新增"){
		?>
				<form name="form" method="post" action="admin_reading_done.php">
					<p>
					序號：<input type="text" name="serial" /> <br>
					類型：</h1><input type="text" name="type" /> <br>
					材料名：</h1><input type="text" name="name" /> <br>
					檔名：</h1><input type="text" name="content" /> <br>
					</p>
					<input type="submit" name="button" value="新增" />
					<p>
					</p>
				</form>
		<?php
			}
			else if($button === "修改"){
				$sql = "SELECT * FROM reading WHERE serial='$serial'";
				$result = mysql_query($sql);
											
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				else{
					$row = mysql_fetch_array(mysql_query($sql));
		?>
					<form name="form" method="post" action="admin_reading_done.php">
						<p>
						序號：<input type="text" name="serial" value="<?php echo $row['serial']; ?>" /> <br>
						類型：</h1><input type="text" name="type" value="<?php echo $row['type']; ?>" /> <br>
						材料名：</h1><input type="text" name="name" value="<?php echo $row['name']; ?>" /> <br>
						檔名：</h1><input type="text" name="content" value="<?php echo $row['content']; ?>" /> <br>
						</p>
						<input type="submit" name="button" value="修改" />
						<p>
						</p>
					</form>
		<?php
				}
			}
			else if($button === "刪除"){//button值等於刪除的話，則從資料庫中將符合的資料刪除
				$sql = "DELETE FROM reading WHERE serial='$serial'";
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