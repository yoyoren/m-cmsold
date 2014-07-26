<?php
/**
 * ECSHOP 管理中心菜单数组
 * ============================================================================
 * 版权所有 (C) 2005-2008 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；http://www.comsenz.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: testyang $
 * $Id: inc_menu.php 14481 2008-04-18 11:23:01Z testyang $
*/

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}


$modules['18_moneycard_manage']['01_moneycard_maintain']='moneycard1.php?act=maintain';
$modules['18_moneycard_manage']['02_moneycard_affirm']='moneycard1.php?act=affirm';
$modules['18_moneycard_manage']['03_moneycard_edit']='moneycard1.php?act=edit';
$modules['18_moneycard_manage']['04_moneycard_account']='moneycard1.php?act=account';
$modules['19_eachday_count']['01_order_list']='eachday_count.php?act=order_list';
$modules['19_eachday_count']['02_cake_count']='eachday_count.php?act=cake_count';
?>
