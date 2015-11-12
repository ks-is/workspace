<!DOCTYPE html>
<html>
<head>
	<title>KSIS-Register</title>
</head>
<body>
	<form method="post">
		Url:	<input type="url" name="acc" placeholder="Add Your Url">	
		<input type="submit" value="Regist">
	</form>
	<?php
		$conn = new mysqli("localhost","root", "","score");
		if ($conn->connect_error) 
		{
	   		die("Connection failed: " . $conn->connect_error);
		}	
		if(isset($_POST['acc']))
		{
			$url=$_POST['acc'];
			if(substr($url,0,32)=="https://www.wechall.net/profile/")
			{
				$name = explode("/",$url)[count(explode("/",$url))-1];
				$query="Select * from score_board where Url = '".$url."'";
				$result = $conn->query($query);
				if ($result->num_rows == 0)
				{
					echo "Registed Succes";
					$conn->query("INSERT INTO score_board VALUES ('".$name."',0,0,0,0,0,'".$url."')");
					$f=fopen("info.txt","a");
					fwrite($f,$url."\n");
					fclose($f);
				}
				else
					echo "You are registed";
			}
			else
			{
				echo "Url not accept";
			}
		}
		$conn->close();
	?>
</body>
</html>