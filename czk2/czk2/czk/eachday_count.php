<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
$_REQUEST['act']=empty($_REQUEST['act'])?'order_list':$_REQUEST['act'];
$smarty->assign('admin_name',$_SESSION['admin_name']);
/**
 * 蛋糕统计
 */
if ($_REQUEST['act'] == 'order_list')
{
	$smarty->assign('ur_here',     '订单详情');
    $smarty->assign('full_page',   1);
	$date=empty($_REQUEST['date'])?"":$_REQUEST['date'];
	if($date)
	{
		$list=get_order_list();
	}
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
	$smarty->assign('order_list',$list['item']);
	$smarty->assign('date',$date);
	$smarty->assign('act','order_list');
	$smarty->assign('lang',         $_LANG);
	$smarty->assign('action_link', array('text' => '查看蛋糕统计结果', 'href' => 'eachday_count.php?act=cake_count&date='.$date));
	$smarty->display('eachday_orderinfo.html');
}
if ($_REQUEST['act'] == 'query')
{
    $list=get_order_list();

    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);
	$smarty->assign('order_list',$list['item']);

	$smarty->assign('date',$_REQUEST['date']);
	$smarty->assign('act','order_list');
    make_json_result($smarty->fetch('eachday_orderinfo.html'), '',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
function get_order_list()
{
	//查询条件
	$filter['date']=$_REQUEST['date'];
	$where=" AND best_time LIKE '".$filter['date']."%'";
	$sql="SELECT count(*) FROM `ecs_order_goods` AS a LEFT JOIN ecs_order_info AS b ON a.order_id = b.order_id WHERE b.order_status =1 
				AND a.goods_price >=45 ".$where."ORDER BY surplus desc,bonus desc,pay_note desc";
	$filter['record_count'] = $GLOBALS['db']->getOne($sql);
	/* 分页大小 */
    $filter = page_and_size($filter);
	$sql1= "SELECT  b.order_sn, a.goods_name,a.goods_attr, a.goods_number,b.surplus,b.bonus,b.goods_amount,b.money_paid,b.order_amount, b.pay_name,  
				b.pay_note,best_time FROM `ecs_order_goods` AS a LEFT JOIN ecs_order_info AS b ON a.order_id = b.order_id WHERE b.order_status =1 
				AND a.goods_price >=45 ".$where." ORDER BY surplus desc,bonus desc,pay_note desc LIMIT ".$filter[start].",". $filter[page_size];
	$row = $GLOBALS['db']->getAll($sql1);
	$arr = array('item' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}
if($_REQUEST['act'] == 'cake_count')
{
	$date=empty($_REQUEST['date'])?"":$_REQUEST['date'];
	if($date)
	{
		$sql="SELECT  b.order_sn, a.goods_name,a.goods_attr, a.goods_number,b.surplus,b.bonus,b.goods_amount,b.money_paid,b.order_amount, b.pay_name,  
			b.pay_note,best_time FROM `ecs_order_goods` AS a LEFT JOIN ecs_order_info AS b ON a.order_id = b.order_id WHERE b.order_status=1 
					AND a.goods_price >=45 and best_time like '%".$date."%' ORDER BY surplus desc,bonus desc,pay_note desc";
		$order_list=$GLOBALS['db']->getAll($sql);
		$ljk=0;
		$normal=0;
		$cuxiao=0;
		$yuejie=0;
		$xshd=0;
		$schd=0;
		$scmini=0;
		$total_cake=0;
		foreach($order_list as $val)
		{
			if($val['surplus']>0)
			{
				$ljk+=$val['goods_number'];
				$total_cake+=$val['goods_number'];
			}
			if($val['bonus']>0&&($val['money_paid']>0||$val['order_amount']>0)&&$val['bonus']<$val['goods_amount'])
			{
				$cuxiao+=$val['goods_number'];
				$total_cake+=$val['goods_number'];
			}
			if($val['surplus']==0&&$val['bonus']==0&&($val['money_paid']>0||$val['order_amount']>0)&&$val['pay_note']!='月结')
			{
				$normal+=$val['goods_number'];
				$total_cake+=$val['goods_number'];
			}
			if($val['pay_note']=='月结')
			{
				$yuejie+=$val['goods_number'];
				$total_cake+=$val['goods_number'];
			}
			if($val['pay_note']=='销售活动'||$val['pay_note']=='销售赠送'||$val['pay_note']=='公司赠送')
			{
				$xshd+=$val['goods_number'];
				$total_cake+=$val['goods_number'];
			}
			if((($val['pay_note']=='市场活动'||$val['pay_note']=='市场赠送')&&$val['goods_attr']!='1/9P')||($val['bonus']>0&&$val['money_paid']==0&&$val['order_amount']==0)||$val['bonus']>=$val['goods_amount'])
			{
				$schd+=$val['goods_number'];
				$total_cake+=$val['goods_number'];
			}
			if($val['goods_attr']=='1/9P')
			{
				$scmini+=$val['goods_number'];
			}
		}
	
		$count=array("total_cake"=>	$total_cake,"ljk"=>$ljk,"cuxiao"=>$cuxiao,"normal"=>$normal,"yuejie"=>$yuejie,"xshd"=>$xshd,"schd"=>$schd,"scmini"=>$scmini);
	}
	
	$smarty->assign('ur_here',     '蛋糕统计');
    $smarty->assign('full_page',   1);
	$smarty->assign('date',$date);
	$smarty->assign('count',$count);
	$smarty->assign('act','cake_count');
	$smarty->assign('lang',         $_LANG);
	$smarty->display('eachday_cake_count.html');
}