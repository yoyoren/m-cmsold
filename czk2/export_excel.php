<?php
//header("Pragma: no-cache");  
//header("Expires: 0");  
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
//print_r($_SESSION);
//exit;
$filename=$_REQUEST['odate']==""?$_REQUEST['adate']:$_REQUEST['odate'];
$filename.="报表";
$filename = iconv("UTF-8","GB2312",$filename);
//echo $filename;
header("Content-type: application/vnd.ms-excel; charset=UTF-8");
header("Content-Disposition: attachment; filename=$filename.xls");
$data="";
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
$encode = mb_detect_encoding($data, array("ASCII","UTF-8","GB2312","GBK","BIG5")); 
if ($encode =="UTF-8")
{ 
	$data =mb_convert_encoding($data,"GBK","UTF-8");
}
if ($encode =="GBK")
{ 
	$data = mb_convert_encoding($data,"GBK","GB2312");
}
echo $data. "\t";
?>


