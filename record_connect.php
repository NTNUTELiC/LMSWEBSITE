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
	echo '<meta http-equiv="refresh" content="1;url=record.php">';
	exit;
}
else
{
$id = $_SESSION['id'];
$pw = $_SESSION['pw'];
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
		
		<?php
			/*if (!$row) { // add this check.  帳密符合才抓資料出來，否則重新登入
				echo "<h3>帳號或密碼錯誤，請重新輸入</h3>";
        		echo '<meta http-equiv=REFRESH CONTENT=2;url=record.php>';
			}
			else {*/ /*分別選擇accout的record欄位、reading的name欄位、
			         record的time欄位、record的comments欄位*/
				include("mysql_connect.php");
				$sql = "SELECT record.account, reading.name, record.time, record.comments FROM record JOIN reading ON reading.serial=record.serial WHERE record.account='$id'";
				$result = mysql_query($sql);
											
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				
				echo "<table class='showall' border=1>";
				echo "<tr align=center><td>姓名</td><td>資料名</td><td>次數</td><td>評論</td></tr>";		
					
				while($row = mysql_fetch_array($result)){ //用表格呈現在網頁上
					echo "<tr align=center><td>".$row['account']."</td>";
					echo "<td>".$row['name']."</td>";
					echo "<td>".$row['time']."</td>";
					echo "<td>".$row['comments']."</td>";
					echo "</tr>";
				}
				echo "</table>";
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


