<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$sql="select goods_id from ecs_goods where cat_id=4 or cat_id=14";
$res=$db->getAll($sql);
include('../includes/global_set.php');
foreach($res as $val)
{   $time=time()+3600*8;
	if(in_array($val['goods_id'],$cake_no_bj))
	{
		$sql="insert into is_on_sale(goods_id,city,is_on_sale,last_update) values({$val['goods_id']},441,0,{$time})";
	}else{
		$sql="insert into is_on_sale(goods_id,city,is_on_sale,last_update) values({$val['goods_id']},441,1,{$time})";
	}
	$db->query($sql);
	if(in_array($val['goods_id'],$cake_no_sh))
	{
		$sql="insert into is_on_sale(goods_id,city,is_on_sale,last_update) values({$val['goods_id']},442,0,{$time})";
	}else{
		$sql="insert into is_on_sale(goods_id,city,is_on_sale,last_update) values({$val['goods_id']},442,1,{$time})";
	}
	$db->query($sql);
	if(in_array($val['goods_id'],$cake_no_hz))
	{
		$sql="insert into is_on_sale(goods_id,city,is_on_sale,last_update) values({$val['goods_id']},440,0,{$time})";
	}else{
		$sql="insert into is_on_sale(goods_id,city,is_on_sale,last_update) values({$val['goods_id']},440,1,{$time})";
	}
	$db->query($sql);
	if(in_array($val['goods_id'],$cake_no_tj))
	{
		$sql="insert into is_on_sale(goods_id,city,is_on_sale,last_update) values({$val['goods_id']},443,0,{$time})";
	}else{
		$sql="insert into is_on_sale(goods_id,city,is_on_sale,last_update) values({$val['goods_id']},443,1,{$time})";
	}
	$db->query($sql);
	
}