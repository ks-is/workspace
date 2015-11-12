<?php
$conn = new mysqli("localhost","root", "","score");
if ($conn->connect_error) 
{
    die("Connection failed: " . $conn->connect_error);
}	
$f=fopen("info.txt","rb");
while (!feof($f))
{
	#/^freesss$/
	$url=fgets($f);
	#echo bin2hex($url)."<br />";
	$url=pack("H*",str_replace("0a","",bin2hex($url)));
	#echo bin2hex($url);
	$page = file_get_contents($url);
	$i = strpos($page,"<div id=\"page\">");
	$j = strpos($page,"<table class=\"cl\">",$i);
	$page= substr($page,$i,$j-$i);
	#echo explode("/",$url)[count(explode("/",$url))-1];
	$name = explode("/",$url)[count(explode("/",$url))-1];

	$CanYouHackIt_i= strpos($page,"http://canyouhack.it\" title=\"Ranked\">");
	$CanYouHackIt_j =strpos($page,"</a>",$CanYouHackIt_i);
	if ($CanYouHackIt_i===false)
		goto over;
	else
		$CanYouHackIt_i+=strlen("http://canyouhack.it\" title=\"Ranked\">");
	$CanYouHackIt_score_i=strpos($page,"<td class=\"gwf_num\">",$CanYouHackIt_j)+strlen("<td class=\"gwf_num\">");
	$CanYouHackIt_score_j=strpos($page,"</td>",$CanYouHackIt_score_i);
	$CanYouHackIt = substr($page, $CanYouHackIt_score_i,$CanYouHackIt_score_j-$CanYouHackIt_score_i);

over:
	$OverTheWire_i = strpos($page,"http://www.overthewire.org/wargames/\" title=\"Ranked\">");
	$OverTheWire_j = strpos($page,"</a>",$OverTheWire_i);
	if ($OverTheWire_i === false)
		goto HackThis;
	else
		$OverTheWire_i+=strlen("http://www.overthewire.org/wargames/\" title=\"Ranked\">");
	$OverTheWire_score_i = strpos($page,"<td class=\"gwf_num\">",$OverTheWire_j)+strlen("<td class=\"gwf_num\">");
	$OverTheWire_score_j = strpos($page,"</td>",$OverTheWire_score_i);
	$OverTheWire = substr($page, $OverTheWire_score_i,$OverTheWire_score_j-$OverTheWire_score_i);

HackThis:
	$HackThis_i = strpos($page,"https://www.hackthis.co.uk\" title=\"Ranked\">");
	$HackThis_j = strpos($page,"</a>",$HackThis_i);
	if ($HackThis_i===false)
		goto HackThisSite;
	else
		$HackThis_i+=strlen("https://www.hackthis.co.uk\" title=\"Ranked\">");
	$HackThis_score_i = strpos($page,"<td class=\"gwf_num\">",$HackThis_j)+strlen("<td class=\"gwf_num\">");
	$HackThis_score_j = strpos($page,"</td>",$HackThis_score_i);
	$HackThis = substr($page, $HackThis_score_i,$HackThis_score_j-$HackThis_score_i);

HackThisSite:
	$HackThisSite_i = strpos($page,"http://www.hackthissite.org\" title=\"Ranked\">");
	$HackThisSite_j = strpos($page,"</a>",$HackThisSite_i);
	if ($HackThisSite_i===false)
		goto out;
	else
		$CanYouHackIt_i+=strlen("http://www.hackthissite.org\" title=\"Ranked\">");
	$HackThisSite_score_i = strpos($page,"<td class=\"gwf_num\">",$HackThisSite_j)+strlen("<td class=\"gwf_num\">");
	$HackThisSite_score_j = strpos($page,"</td>",$HackThisSite_score_i);
	$HackThisSite = substr($page, $HackThisSite_score_i,$HackThisSite_score_j-$HackThisSite_score_i);
out:

	if($HackThis != "" or $CanYouHackIt!="" or $HackThisSite !="" or $OverTheWire!= "")
	{	
		$HackThis = ($HackThis == "") ? 0 : (int)$HackThis;
		$CanYouHackIt = ($CanYouHackIt == "") ? 0 : (int)$CanYouHackIt;
		$HackThisSite = ($HackThisSite == "") ? 0 : (int)$HackThisSite;
		$OverTheWire = ($OverTheWire == "") ? 0 : (int)$OverTheWire;

		$query="Select * from score_board where Name = '".$name."'";
		$result = $conn->query($query);
		echo $name."--";
		if ($result->num_rows == 1) 
		{
			echo "$name in  $HackThis   $CanYouHackIt   $HackThisSite   $OverTheWire  <br />";
			$conn->query("Update score_board set HackThis =".(int)$HackThis." where Name = '".$name."';");
			$conn->query("Update score_board set CanYouHackIt =".(int)$CanYouHackIt." where Name = '".$name."';");
			$conn->query("Update score_board set HackThisSite =".(int)$HackThisSite." where Name = '".$name."';");
			$conn->query("Update score_board set OverTheWire =".(int)$OverTheWire." where Name = '".$name."';");
			$conn->query("Update score_board set Sum =".((int)$HackThis+(int)$CanYouHackIt+(int)$HackThisSite+(int)$OverTheWire)." where Name = '".$name."';");
			echo "Updated !!!<br />";
			$HackThis= 0;
			$CanYouHackIt = 0;
			$HackThisSite =  0;
			$OverTheWire =  0;
			
		}
		else
		{
			echo "not found"."<br />";
		}
	}
	else
	{
		$conn->query("Update score_board set HackThis =".(int)$HackThis." where Name = '".$name."';");
		$conn->query("Update score_board set CanYouHackIt =".(int)$CanYouHackIt." where Name = '".$name."';");
		$conn->query("Update score_board set HackThisSite =".(int)$HackThisSite." where Name = '".$name."';");
		$conn->query("Update score_board set OverTheWire =".(int)$OverTheWire." where Name = '".$name."';");
		$conn->query("Update score_board set Sum =".((int)$HackThis+(int)$CanYouHackIt+(int)$HackThisSite+(int)$OverTheWire)." where Name = '".$name."';");
		echo "$name Can not update";
	}
	
	
}
fclose($f);
$f=fopen("update_time.txt","w");
date_default_timezone_set('Asia/Ho_Chi_Minh');
fwrite($f,date('d-m-Y H:i:s'));
fclose($f);
$conn->close();
?>