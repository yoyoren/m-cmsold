<?php

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
if($_REQUEST['act']=='list')
{
	$sql="select a.goods_id,a.sort,b.goods_name_style from goods_recommend as a,ecs_goods as b "
	."where a.goods_id=b.goods_id order by sort";
	$res=$db->getAll($sql);
	//var_dump($res);exit;
	$action_link=array("text"=>"添加产品推荐","href"=>"goods_recommend.php?act=add");
	$smarty->assign('ur_here',"产品推荐管理");
	$smarty->assign("action_link",$action_link);
	$smarty->assign("goods",$res);
	$smarty->display("goods_recommend.html");
}else if($_REQUEST['act']=='update'){
	$sql="update goods_recommend set sort={$_GET['order_id']} where goods_id={$_GET['goods_id']}";
	$res=$db->query($sql);
	if($res){echo $_GET['goods_id'];}else{echo "false";}
}else if($_REQUEST['act']=='add'){
	$sql="select goods_id,goods_name_style,left(goods_sn,2) as goods_sn from ecs_goods ".
	"where is_real=1 and goods_id not in(select goods_id from goods_recommend) order by goods_sn";
	$res=$db->getAll($sql);
	foreach($res as $val)
	{
		$goods[$val['goods_id']]=$val['goods_sn']."-".$val['goods_name_style'];
	}
	//var_dump($goods);exit;
    $action_link=array("text"=>"产品推荐","href"=>"goods_recommend.php?act=list");
	$smarty->assign('ur_here',"添加产品推荐");
	$smarty->assign("action_link",$action_link);
	$smarty->assign("goods",$goods);
	$smarty->display("goods_recommend_add.html");
}else if($_REQUEST['act']=='insert'){
    $sql="insert into goods_recommend(goods_id,sort) values({$_POST['goods_id']},{$_POST['order_id']})";
    $res=$db->query($sql);
    if($res){echo "<script type='text/javascript'>location.href='goods_recommend.php?act=list';</script>";}
    else{echo "<script type='text/javascript'>alert('添加失败！');location.href='goods_recommend.php?act=add';</script>";}
}else if($_REQUEST['act']=='delete'){
	$sql="delete from goods_recommend where goods_id={$_GET['goods_id']}";
	echo $db->query($sql);
}
else if($_REQUEST['act']=='init'){
	//初始化
	$sql="select goods_id from ecs_goods where is_best=1";
	$res=$db->getAll($sql);
	foreach($res as $key=>$val)
	{		
		$sql="insert into goods_recommend(goods_id,sort) values({$val['goods_id']},'0')";
		$db->query($sql);
	}
}