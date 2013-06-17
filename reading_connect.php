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
	echo '<meta http-equiv="refresh" content="1;url=reading.php">';
	exit;
}
else
{
	include("mysql_connect.php");
	$id = $_SESSION['id'];
	$pw = $_SESSION['pw'];
	if (isset($_GET['stay_time']))
	{	
		$reading_time=$_GET['stay_time'];
		$sql = "SELECT * FROM member where account='$id' and password='$pw'"; //比對帳密
		$row = mysql_fetch_array(mysql_query($sql));
		$reading_time=$reading_time+$row['read_time'];
		$sql = "UPDATE member SET read_time='$reading_time' WHERE account='$id' and password='$pw'";
		$result = mysql_query($sql);
		if (!$result) 
			{
			die('Invalid query: ' . mysql_error());
				}
		}
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
		<h2><?php echo $id; ?>，請選擇閱讀材料<br/></h2>
		<br/>
		<br/>
		
		<?php
			/*if (!$row) { // add this check. 沒有撈出相符的資料就重新login
				echo "<h3>帳號或密碼錯誤，請重新輸入</h3>";
        		echo '<meta http-equiv=REFRESH CONTENT=2;url=reading.php>';
			}
			else {*/
				$sql = "SELECT * FROM reading"; //帳密相符的話就從reading抓資料
				$result = mysql_query($sql);
											
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				
				echo "<form name='form' method='post' action='reading_start.php'>";
				echo "<input type='hidden' name='id' value=".$id." />";//hidden屬性可隱藏傳輸內容，不讓使用者看到
				echo "<input type='hidden' name='pw' value=".$pw." />";
								
				echo "<table class='showall' border=1>";
				echo "<tr align=center><td>選取</td><td>編號</td><td>類型</td><td>資料名</td></tr>";		
					
				while($row = mysql_fetch_array($result)){ //一個個抓出來呈在網頁上
					
					echo "<tr align=center><td><input name='select' type='radio' value=".$row['serial']."+".$row['type']."></td>";//radio讓使用者只單選
					echo "<td>".$row['serial']."</td>";
					echo "<td>".$row['type']."</td>";
					echo "<td>".$row['name']."</td>";
					echo "</tr>";
				}
				echo "</table>";
				echo "<input type='submit' name='button' value='開始閱讀' />";	
				echo "</form>";
			//}
		?>
		<br/><br/><br/><br/><br/><br/><br/><br/><br/>
		
		
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


