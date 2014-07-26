<?php
//header("Pragma: no-cache");  
//header("Expires: 0");  
session_start();
//print_r($_SESSION);
//exit;
$filename=$_REQUEST['odate']==""?$_REQUEST['adate']:$_REQUEST['odate'];
$filename.="报表";
$filename = iconv("UTF-8","GB2312",$filename);
header("Content-type: application/vnd.ms-excel; charset=utf-8");
header("Content-Disposition: attachment; filename=$filename.xls");
$data="";
/*$top=$_SESSION['ttop'];
$tablecontent=$_SESSION['tcontent'];*/
foreach($_SESSION['ttop'] as $value)
{
	$data.=$value."\t";
}
$data.="\n";
foreach($_SESSION['tcontent'] as $key=>$value)
{
	foreach($value as $k=>$val)
	{
		$data.=$val."\t";
	}
	$data.="\n";	
}
/*$encode = mb_detect_encoding($data, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if ($encode =="UTF-8")
{ 
	$data = iconv("UTF-8","GB2312",$data);
}
if ($encode =="GBK")
{ 
	$data = iconv("GBK","GB2312",$data);
}*/
echo $data. "\t";
?>


