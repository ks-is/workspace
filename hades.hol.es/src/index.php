<!DOCTYPE html>
<html>
<head>
	<title>KSIS</title>
	<style>
		a:link {color:red;text-decoration:none}
		a:hover {color:pink}
		a:visited {color: red;text-decoration:none}
		h1{color:red; font-size:43px;}
		p.update{color:red; font-size:16px;text-align: left;font-weight:bold;}
		p.copy{color:red; font-size:16px;text-align: center;font-weight:bold;}
		table 
		{
		  border-collapse:collapse;
		  font:normal normal 11px Arial,Sans-Serif;
		  color:#ccc;
		  -webkit-box-shadow:0 1px 3px black;
		  -moz-box-shadow:0 1px 3px black;
		  box-shadow:0 1px 3px black;
		}
		table, tr {
		  background-color:#222;
		}
		table, th, table, td {
		  vertical-align:top;
		  padding:5px 20px;
		  font-size:13px;
		  border:1px solid #3c3c3c;
		}
		table, td:nth-child(even) {
		  	background-color:#1c1c1c;
		}
		table,td.tit{
		  background-color:#555;
		  filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#666',endColorstr='#555');
		  background-image:-webkit-gradient(linear,left top,left bottom,from(#666),to(#555));
		  background-image:-webkit-linear-gradient(top,#666,#555);
		  background-image:-moz-linear-gradient(top,#666,#555);
		  background-image:-ms-linear-gradient(top,#666,#555);
		  background-image:-o-linear-gradient(top,#666,#555);
		  background-image:linear-gradient(top,#666,#555);
		  color:red;
		  font-size:16px;
		  /*text-shadow:0 1px 0 rgba(255,255,255,.4);*/
		  font-weight:bold;
		}
	</style>
</head>
<body background="1.jpg" color="green">


<?php
echo "<meta charset='UTF-8'>";
$conn = new mysqli("localhost","root", "","score");
if ($conn->connect_error) 
{
	die("Connection failed: " . $conn->connect_error);
}
echo "<title>KSIS</title>";
echo "<center><h1>Scoreboard</h1></center>";
echo  "<center><table style='width:100%'>";
echo "<p class='update'>Last update: ".@fgets(fopen("update_time.txt","r"))."</p>";
echo "<tr><td class='tit'>STT</td><td class='tit'><a href='?sort=Name'>Name</a></td><td class='tit'><a href='?sort=HackThis'>HackThis</a></td><td class='tit'><a href='?sort=HackThisSite'>HackThisSite</a></td><td class='tit'><a href='?sort=OverTheWire'>OverTheWire</a></td><td class='tit'><a href='?sort=CanYouHackIt'>CanYouHackIt</a></td><td class='tit'><a href='?sort=Sum'>Tổng</a></td></tr>";

if(isset($_GET['sort']) && $_GET['sort']!="")
{
	$pattern = Array("HackThis","HackThisSite","CanYouHackIt","Sum","OverTheWire");
	for ($i=0;$i<count($pattern);$i++) 
		if(preg_match("/^".$pattern[$i]."$/",$_GET['sort']))
		{
			$query = "select * from score_board ORDER BY ".$_GET['sort']." DESC";
			break;
		}
		else
			$query = "select * from score_board ORDER BY Sum DESC";
}
	
else
	$query = $query = "select * from score_board ORDER BY Sum DESC";
$result = $conn->query($query);
if ($result->num_rows >0) 
{
	$i=1;
	while ($row=$result->fetch_assoc())
	{
		echo "<tr>";
		echo "<td>$i</td>";
		echo "<td>".$row['Name']."</td>";
		echo "<td>".$row['HackThis']."</td>";
		echo "<td>".$row['HackThisSite']."</td>";
		echo "<td>".$row['OverTheWire']."</td>";
		echo "<td>".$row['CanYouHackIt']."</td>";
		echo "<td>".$row['Sum']."</td>";
		echo "</tr>";
		$i++;
	}	
}
echo "</table>";
echo "<p class='copy'><a href='https://www.facebook.com/57b5536fe3f256bb7ce318d48df528ff'>&copy; KS.IS Hades</a></p>";
?>
</body>
</html>