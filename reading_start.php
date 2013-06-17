<?php
session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
include("mysql_connect.php");
$id = $_POST['id'];
$pw = $_POST['pw'];
$serial = $_POST['select'];

$sql = "SELECT * FROM member where account='$id' and password='$pw'"; //比對帳密
$row = mysql_fetch_array(mysql_query($sql));
?>
<script language="javascript" src="jquery-1.10.1.min.js"></script>
<script language="javascript">

function enter_time() {
	enter = new Date();
	enter_hour = enter.getHours();
	enter_minute = enter.getMinutes();
	enter_second = enter.getSeconds();
	
}

function calculate_check(){
	leave = new Date();
	leave_hour = leave.getHours();
	leave_minute = leave.getMinutes();
	leave_second = leave.getSeconds();
	
	if (leave_minute ==enter_minute)
	{
	stay_time=60-enter_second;
	stay_time=60*((enter_minute-1)-leave_minute)+leave_second+stay_time
		}
	else
	{
		stay_time=60-enter_second;
		stay_time=60*(leave_minute-(enter_minute+1))+leave_second+stay_time
		
		}	
	$.post('reading_connect.php', { title: stay_time },function(title){alert("您已閱讀此教材"+stay_time+"秒，請記得休息一下哦!!!"),location.replace("reading_connect.php?stay_time="+stay_time);});   


	}
	
	
</script>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>TELiC學習管理系統</title>
<link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body onLoad="enter_time();">
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
	
		<center>
		<h2><?php echo $id; ?>，開始閱讀<br/></h2> <!--秀出id-->
		<br/>
		<br/>
		
		<?php
			if (!$row) { // add this check.
				echo "<h3>帳號或密碼錯誤，請重新輸入</h3>";
        		echo '<meta http-equiv=REFRESH CONTENT=2;url=reading.php>';
			}
			else {
				$serial_array = explode("+",$serial); // serial+type 拆成序號和型態
				$serial_number = $serial_array[0];
				$type = $serial_array[1];
				
				$sql = "SELECT content FROM reading WHERE serial=".$serial_number."";// 從reading中選出符合序號的
				$result = mysql_query($sql);
											
				if (!$result) { // add this check.
					die('Invalid query: ' . mysql_error());
				}		
					
				$f = mysql_fetch_array($result);
				echo "<table class='showall' border=1>";
				echo "<tr><td>";
				//文章和圖片分開處理
				if($type === "article"){//處理文章
					$arrText = file ("meterial/".$f['content']);
					for ($i = 0 ; $i < count($arrText) ; $i++){
						echo "$arrText[$i]"."<br/>";
					}
				}
				else if ($type === "figure"){//處理圖片
					echo "<img src='meterial/".$f['content']."' alt='Figure not found'>";
				}
				echo "</td></tr></table>";
				
				$sql = "SELECT * FROM record where account='$id' and serial='$serial_number'";
				$record_result = mysql_query($sql);
				
				if( mysql_num_rows($record_result)>0) 
					{
					$sql = "UPDATE  `lms`.`record` SET  `time` =`time`+1  WHERE  `record`.`account` =  '$id' AND  `record`.`serial` ='$serial_number'";
					$result = mysql_query($sql);
					$sql = "UPDATE  `lms`.`member` SET  `read_num` =`read_num`+1  WHERE  `member`.`account` =  '$id'";
					$result = mysql_query($sql);
					$sql = "UPDATE  `lms`.`material_record` SET  `click_number` =`click_number`+1  WHERE  `material_record`.`serial` ='$serial_number'";
					$result = mysql_query($sql);
					}
				else
					{
					$sql = "INSERT INTO record (account, serial, time, comments) VALUES ('$id', '$serial_number', 1, '')";
					$result = mysql_query($sql);
					$sql = "UPDATE  `lms`.`member` SET  `read_num` =`read_num`+1  WHERE  `member`.`account` =  '$id'";
					$result = mysql_query($sql);
					$sql = "SELECT * FROM material_record where serial='$serial_number'";
					$record_result = mysql_query($sql);
					if( mysql_num_rows($record_result)>0)
						{
						$sql = "UPDATE  `lms`.`material_record` SET  `click_number` =`click_number`+1  WHERE  `material_record`.`serial` ='$serial_number'";
						$result = mysql_query($sql);
						}
					else
						{
						$sql = "INSERT INTO material_record (serial, click_number) VALUES ('$serial_number', 1)";
						$result = mysql_query($sql);
						}
					}
			}
		?>
		<br/><br/><br/><br/><br/><br/><br/><br/><br/>
		
			<input type="button" value="回上一頁"  onclick="calculate_check()" />
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


