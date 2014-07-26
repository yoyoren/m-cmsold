<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$mobile=$_REQUEST['mobile'];
$result=$db->getRow("select * from ecs_users where mobile_phone=$mobile ");
if($result)
{
	echo 1;//已存在
}
else
{
	echo 2;//不存在
}
?>