<?php
	session_start();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
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
		<li><a href='reading_connect.php'>開始閱讀</a></li>
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
		<h2>榮譽榜<br/></h2>
		<?php
			include("mysql_connect.php");
			$sql = "SELECT * FROM  `member` ORDER BY  `read_num` desc";
			$result=mysql_query($sql);
			if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				else{
				echo "<table border='1' align='center' class='showall'> <tr><td>名次</td><td>姓名</td><td>閱讀總次數</td><td>最關注教材</td></tr>"; 
				for ($i=1;$i<=3;$i++)
					{
					$row = mysql_fetch_object($result);
					echo "<tr><td>$i</td><td>$row->username</td><td>$row->read_num</td>";
					//$acc=$row->account;
					$sql_record = "SELECT * FROM  `record` WHERE  `account` ='$row->account'ORDER BY  `time` DESC LIMIT 0 , 1 ";
					$result_record=mysql_query($sql_record);
					$row_record =mysql_fetch_object($result_record);
					echo "<td>$row_record->serial</td></tr>";
					}
				echo "</table></br>";
				}
			$sql = "SELECT * FROM  `material_record` ORDER BY  `click_number` desc";
			$result=mysql_query($sql);
			if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}
				else{
				echo "<table border='1' align='center' class='showall'> <tr><td>名次</td><td>教材名稱</td><td>總點擊次數</td><td>閱讀次數最多者</td></tr>"; 
				
				for ($i=1;$i<=3;$i++)
					{
					$row = mysql_fetch_object($result);
					echo "<tr><td>$i</td><td>$row->serial</td><td>$row->click_number</td>";
					//以下將record資料庫裡符合序號的遞增排序挑選出來，再連結到member資料庫找出username
					$sql_record = "SELECT  `username` FROM  `member` WHERE  `member`.`account`= 
					( SELECT  `account` FROM  `record` WHERE  `serial` ='$row->serial' ORDER BY  `time` DESC LIMIT 0 , 1) ";
					$result_record=mysql_query($sql_record);
					$row_record =mysql_fetch_object($result_record);
					echo "<td>{$row_record->username}</td></tr>";
					}
				echo "</table></br>";
				}
		?>
		
		<br/><br/><br/><br/><br/><br/></h4>
		</center>
	</p>
	</div>
	<br/><br/><br/><br/><br/><br/>
	<div id="FOOTER">	
	
		<nav>
		<center><ul><li>原創：高翊展&nbsp;&nbsp;修改：廖宜志、陳光禧、林淑微</li></ul></center>
		</nav>
	</div>
</div>
</body>
</html>
