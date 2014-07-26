<?php
define('IN_ECS', true);
session_start();
require(dirname(__FILE__) . '/includes/init.php');
$_REQUEST['act']=empty($_REQUEST['act'])?'user_info':$_REQUEST['act'];


if($_REQUEST['act'] == 'user_info')
{
	$smarty->assign('ur_here',     '导出会员电话');
    $smarty->assign('full_page',   1);
    $smarty->assign('admin_name',$_SESSION['admin_name']);
	$sql="SELECT `mobile_phone` FROM ecs_users WHERE length( `mobile_phone` ) =11";
	$res=$GLOBALS['db']->getAll($sql);
	$_SESSION['tcontent']=$res;
	$_SESSION['ttop']=array("电话号码");
	$smarty->assign('action_link', array('text' => '会员电话导出', 'href' => 'export_excel.php?adate="会员电话号码"&odate=""'));
	$smarty->display('user_mobile_phone.html');
}