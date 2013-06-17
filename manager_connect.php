<?php
	session_start();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<!--此頁面功能為列出閱讀資料清單、使用者清單、閱讀紀錄清單，讓管理者作新增、修改、刪除的動作-->
<head>
<?php
if (!isset($_SESSION['admin_user']))
{
	echo"帳號密碼錯誤";
	echo '<meta http-equiv="refresh" content="1;url=login.php">';
	exit;
}
else
{
include("mysql_connect.php");
$id = $_SESSION['admin_id'];
$pw = $_SESSION['admin_pw'];
//$b = $_POST['button'];

$sql = "SELECT * FROM admin where account='$id' and password='$pw'";
$row = mysql_fetch_array(mysql_query($sql));
}
?>
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
		
		<center>
		<?php
			
				$sql = "SELECT * FROM member";
	$result=mysql_query($sql);
	$row_num=mysql_num_rows($result);
	$raw_data=array();
	for($x=0;$x<$row_num;$x++)
	{	
		$row = mysql_fetch_object($result);
		$raw_data[$x][0]=$row->read_num;
		$raw_data[$x][1]=$row->read_time;	
		}
	$clustered=(kmeans(($raw_data),3));
	
	for($y=0;$y<3;$y++)
	{	
		$num = count($clustered[$y]);
		switch ($y)
			{
				case 1:
					echo "中等";
					break;
				case 2:
					echo "最認真";
					break;
				default:
					echo "待加強";
					break;
				}
		echo "<table border='1' align='center' class='showall'> <tr><td>姓名</td></tr>";
		for($z=0;$z<$num;$z++)
		{
			$sql = "SELECT * FROM member where read_num={$clustered[$y][$z][0]} and read_time={$clustered[$y][$z][1]}";
			$result=mysql_query($sql);
			$row = mysql_fetch_array($result);
			echo "<tr><td>{$row['username']}</td>";

			}
			echo "</table>";
			echo "&nbsp;&nbsp;&nbsp;";
		}
	
/**
* This function takes a array of integers and the number of clusters to create.
* It returns a multidimensional array containing the original data organized
* in clusters.
*
* @param array $data
* @param int $k
*
* @return array
*/
function kmeans($data, $k)
{
        $cPositions = assign_initial_positions($data, $k);//positions表示mean，k表示分幾群
        $clusters = array();
 
        while(true)
        {
                $changes = kmeans_clustering($data, $cPositions, $clusters);//Function傳回$nChanges的值，changes檢查和上一次的分類是否一樣
                if($changes)//如果分類穩定沒改變了就return
                {
                        return kmeans_get_cluster_values($clusters, $data);
                }
                $cPositions = kmeans_recalculate_cpositions($cPositions, $data, $clusters);
        }
}
/**
*
*/
function kmeans_clustering($data, $cPositions, &$clusters)//$clusters傳址，第一次是空
{
	$nChanges = 0;
	$num=count($data);
    for ($i=0;$i<$num;$i++)
	{
		$minDistance = null;
        $cluster = null;
		for ($j=0;$j<2;$j++) 
		{
			$v1[$j]=$data[$i][$j]; 
			}
		for ($n=0;$n<3;$n++)
		{
			for ($m=0;$m<2;$m++)
                {
					$v2[$m]=$cPositions[$n][$m];}	
					
            $distance = distance($v1, $v2);
			if(is_null($minDistance) || $minDistance > $distance)//邊緣條件判斷，第一次一定要比
                {
					$minDistance = $distance;
					$cluster = $n;//要分在哪一類
					}  
                	
			}
			
		if(!isset($clusters[$i]) || $clusters[$i] != $cluster)
                {
                        $nChanges++;
                }
		$clusters[$i] = $cluster;
		}
	return $nChanges;
}

function kmeans_recalculate_cpositions($cPositions, $data, $clusters)
{	
       	$kValues = kmeans_get_cluster_values($clusters, $data);
		for ($i=0;$i<3;$i++)
		{
			for ($j=0;$j<2;$j++)
			{
		        $cPositions[$i][$j] = empty($kValues[$i]) ? 0 : kmeans_avg($kValues,$i,$j);
				}
			}
			
		
		return $cPositions;
}

function kmeans_get_cluster_values($clusters, $data)
{
        $values = array();
		$num=count($clusters);
		$num_zero=0;
		$num_one=0;
		$num_two=0;
		for ($i=0;$i<$num;$i++)//foreach($data as $dataColumn ) 
		{
			switch ($clusters[$i])
			{
				case 1:
					$values[$clusters[$i]][$num_one][0] = $data[$i][0];
					$values[$clusters[$i]][$num_one][1] = $data[$i][1];
					$num_one++;
					break;
				case 2:
					$values[$clusters[$i]][$num_two][0] = $data[$i][0];
					$values[$clusters[$i]][$num_two][1] = $data[$i][1];
					$num_two++;
					break;
				default:
					$values[$clusters[$i]][$num_zero][0] = $data[$i][0];
					$values[$clusters[$i]][$num_zero][1] = $data[$i][1];
					$num_zero++;
				
				}
			}	
		
        return $values;
}		
	
function assign_initial_positions($data, $k)
{
        $min_A =$data[0][0];
		$max_A=$data[0][0];
		$min_B =$data[0][1];
		$max_B=$data[0][1];
		foreach($data as $i => $position)
                {
					if($max_A<$data[$i][0])
                    {
                        $max_A=$data[$i][0];
                    }
                    if($min_A>$data[$i][0])
                    {
                        $min_A=$data[$i][0];
                    }
					if($max_B<$data[$i][1])
                    {
                        $max_B=$data[$i][1];
                    }
                    if($min_B>$data[$i][1])
                    {
                        $min_B=$data[$i][1];
                    }
					
                }
				
        $int_X = ceil(abs($max_A - $min_A) / $k);
		$int_Y = ceil(abs($max_B - $min_B) / $k);
        while($k-- > 0)
        {
                $cPositions[$k][0] = $min_A + $int_X * $k;
				$cPositions[$k][1] = $min_B + $int_Y * $k;
        }
		
		
		return $cPositions;
}

function kmeans_avg($values,$n,$m)//參數為3維陣列及第幾維度
{	
		$sum=0;
        $num = count($values[$n]);//統計陣列內元素的數量(組為單位)
		for ($i=0;$i<$num;$i++) 
		{
				$sum=$sum+$values[$n][$i][$m];			
								
				
			}
        return ($n == 0) ? 0 : $sum / $num;
}
 
/**
* Calculates the distance (or similarity) between two values. The closer
* the return value is to ZERO, the more similar the two values are.
*
* @param int $v1
* @param int $v2
*
* @return int
*/
function distance($v1, $v2)
{
  return sqrt(pow(($v1[0]-$v2[0]),2)+pow(($v1[1]-$v2[1]),2));//計算座標2點的距離
}
				
			
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


