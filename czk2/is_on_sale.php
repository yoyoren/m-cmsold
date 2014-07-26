<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$act=$_GET['act'];
if($act=='list'){
	$goods_id=$_POST['goods_id']?$_POST['goods_id']:'';
	$city=$_POST['city']?$_POST['city']:'';
	$is_listed=$_POST['is_listed']?($_POST['is_listed']=='a')?$_POST['is_listed']='0':'1':'';
		
	$sql="select a.id,a.goods_id,b.goods_name_style,a.city,a.is_on_sale,a.last_update from is_on_sale as a,ecs_goods as b where a.goods_id=b.goods_id";
	if($goods_id)
	{
		$sql.=" and a.goods_id={$goods_id} ";
	}
	if($city)
	{
		$sql.=" and a.city={$city} ";
	}
	if($is_listed==='0' ||$is_listed=='1')
	{
		$sql.=" and a.is_on_sale='{$is_listed}' ";
	}
	$res=$db->getAll($sql);
//echo "<pre>";print_r($res);exit;
	$result=array();

	$i=1;
	foreach($res as $val)
	{
		$k=0;
		foreach($result as $key=>$value)
		{
		    if($value['goods_id']== $val['goods_id']) {$k=$key;}	
		}
		if(!$k)
		{
            $result[$i]['goods_id']=$val['goods_id'];
			$result[$i]['goods_name_style']=$val['goods_name_style'];
			$result[$i]['id'][]=$val['id'];
			if($val['city']=='441'){$result[$i]['city'][]='北京';}
			elseif($val['city']=='442'){$result[$i]['city'][]='上海';}
		    elseif($val['city']=='443'){$result[$i]['city'][]='天津';}
		    elseif($val['city']=='440'){$result[$i]['city'][]='杭州';}
			$result[$i]['is_listed'][$val['id']]=$val['is_on_sale'];
			//if($val['is_on_sale']=='1'){$result[$i]['is_listed'][$val['id']]='已上市';}
			//elseif($val['is_on_sale']=='0'){$result[$i]['is_listed'][$val['id']]='未上市';}
			//$result[$i]['last_update'][]=date("Y-m-d H:i:s",$val['last_update']);
			$i++;
		}else{
			$result[$k]['id'][]=$val['id'];
		    if($val['city']=='441'){$result[$k]['city'][]='北京';}
			elseif($val['city']=='442'){$result[$k]['city'][]='上海';}
		    elseif($val['city']=='443'){$result[$k]['city'][]='天津';}
		    elseif($val['city']=='440'){$result[$k]['city'][]='杭州';}
			$result[$k]['is_listed'][$val['id']]=$val['is_on_sale'];
			//$result[$k]['last_update'][]=date("Y-m-d H:i:s",$val['last_update']);
		}
		
	}
	//echo "<pre>";print_r($result);exit;
	$smarty->assign('list',$result);
	$smarty->assign('goods',get_goods());
	$smarty->assign('sale',array('未上市','已上市'));
	$smarty->display('list.html');
}elseif($act=='update'){
	$time=time()+3600*8;
	$sql="update is_on_sale set is_on_sale={$_GET['is_listed']},last_update={$time} where id={$_GET['id']}";
	$res=$db->query($sql);	
	if($res) 
	{	echo "1";
	}else{
		echo "0";
	}
    
}elseif($act=="sale_log"){
    $sql="select a.goods_id,b.goods_name_style,a.city,a.is_on_sale,a.last_update from is_on_sale as a,ecs_goods as b where a.goods_id=b.goods_id order by last_update desc";
    $result=$db->getAll($sql);
    $res=array();
    foreach($result as $key=>$val)
    {
    	$res[$key+1]['goods_name_style']=$result[$key]['goods_name_style'];
    	$res[$key+1]['last_update']=date("Y-m-d H:i:s",$result[$key]['last_update']);
    	$res[$key+1]['city']=$result[$key]['city'];
    	$res[$key+1]['is_on_sale']=$result[$key]['is_listed'];
    	
    }
    $smarty->assign("res",$res);
    $smarty->display("sale_log.html");
}
function get_goods()
{
     $sql = "select goods_id,  goods_name_style from ecs_goods where cat_id=4 or cat_id=14 order by goods_id";//left()得到字符串左部指定个数的字符
     $rs = $GLOBALS['db']->getAll($sql);
     $res = array();
     foreach ($rs as $val) { $res[$val['goods_id']] =  $val['goods_name_style']; }
	 return $res;
}