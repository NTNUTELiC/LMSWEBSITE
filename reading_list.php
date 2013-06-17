<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--此頁面功能為列出閱讀資料清單、使用者清單、閱讀紀錄清單，讓管理者作新增、修改、刪除的動作-->
<head>
<?php
include("mysql_connect.php");
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
		<h3>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="manager_connect.php">認真程度</a>&nbsp;&nbsp;&nbsp;<a href="reading_list.php">閱讀資料清單</a>&nbsp;&nbsp;&nbsp;<a href="member_list.php">使用者清單</a>&nbsp;&nbsp;&nbsp;<a href="record_list.php">閱讀紀錄清單</a>&nbsp;&nbsp;&nbsp;<a href="logout.php">登出</a><br/></h3>
		<br/>
		<center>
		<?php
			
				/* reading */
				$sql = "SELECT * FROM reading";//把所有資料從reading拿出來
				$result = mysql_query($sql);
											
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				//開始列出table，並作用到admin_reading_edit.php頁面
				echo "<form name='readingform' method='post' action='admin_reading_edit.php'>";
												
				echo "<table class='showall' border=1>";
				echo "<tr align=center>閱讀資料清單</tr>";
				echo "<tr align=center><td>選取</td><td>編號</td><td>類型</td><td>資料名</td></tr>";
					
				while($row = mysql_fetch_array($result)){
					
					echo "<tr align=center><td><input name='select' type='radio' value=".$row['serial']." checked ></td>";
					echo "<td>".$row['serial']."</td>";
					echo "<td>".$row['type']."</td>";
					echo "<td>".$row['name']."</td>";
					echo "</tr>";
				}
				echo "</table>";							
				echo "<input type='submit' name='button' value='新增' />";
				echo "<input type='submit' name='button' value='修改' />";
				echo "<input type='submit' name='button' value='刪除' />";
				echo "</form>";
				
				
				
			
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


