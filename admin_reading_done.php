<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	include("mysql_connect.php");
	$serial = $_POST['serial']; 
	$type = $_POST['type'];
	$name = $_POST['name'];
	$content = $_POST['content'];
	$button = $_POST['button'];//把botton的值也拿出來，讓它可以根據新增、修改分別做不同的動作
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
			if($button === "新增"){//若等於新增，則做插入的動作
				$sql = "INSERT INTO reading (serial, type, name, content) VALUES ('$serial', '$type', '$name', '$content')";
				$result = mysql_query($sql);
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				echo "<h3>資料已新增.....</h3>";
			}
			else if($button === "修改"){//若等於修改，則做更新資料的動作
				$sql = "UPDATE reading SET serial='$serial', type='$type', name='$name', content='$content' WHERE serial='$serial'";
				$result = mysql_query($sql);
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				echo "<h3>資料已修改.....</h3>";
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