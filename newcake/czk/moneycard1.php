<?php
define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
require(ROOT_PATH . 'languages/' . $_CFG['lang'] . '/admin/moneycard.php');

$table_moneycards =$GLOBALS['db']->getAll("show tables like 'moneycards'");
$table_moneycard_type =$GLOBALS['db']->getAll("show tables like 'moneycard_type'");
$actionsql="SELECT count(*) as c FROM ".$GLOBALS['ecs']->table('admin_action')." where action_code='moneycard_manage' "  ;
$colarr=$GLOBALS['db']->getCol($actionsql);

if($colarr[0]==0)
{
   $GLOBALS['db']->query("insert into ".$GLOBALS['ecs']->table('admin_action')." (action_code,parent_id) select 'moneycard_manage',action_id from ".$GLOBALS['ecs']->table('admin_action')." where action_code='users_manage' and parent_id=0 LIMIT 1 ");
   
}
	
if(!(count($table_moneycards)>0 && count($table_moneycard_type)>0)) //创建表
{
	$querySQL="CREATE TABLE moneycards".
	"(`mcs_id` mediumint(8) unsigned NOT NULL auto_increment,".
	"  `cardid` varchar(255) NOT NULL,".
	"  `cardpassword` varchar(255) NOT NULL default '',".	
	"  `cardmoney` decimal(10,2) NOT NULL default '0.00',".
	"  `user_id` mediumint(8) unsigned NOT NULL,".
	"  `used_time` int(10) unsigned NOT NULL default '0',".
	"  `moneycard_type_id` int(10) unsigned NOT NULL default '0',".
	"  `sdate` int(10) unsigned NOT NULL default '0',".
	"  `edate` int(10) unsigned NOT NULL default '0',".
	"  `adate` int(10) unsigned NOT NULL default '0',".
	"  `aname` varchar(60) NOT NULL,".
	"  `flag` int(10) unsigned NOT NULL default '0',".
	"  PRIMARY KEY  (`mcs_id`)".
	") ENGINE=MyISAM DEFAULT CHARSET=utf8";
	$GLOBALS['db']->query($querySQL);
	$querySQL="CREATE TABLE moneycard_type".
	"(`mc_id` int(10) unsigned NOT NULL auto_increment,".
	"  `mc_name` varchar(255) NOT NULL,".	
	"  `mc_cdate` int(10) unsigned NOT NULL default '0',".
	"  `mc_cname` varchar(60) NOT NULL,".	
	"  `mc_scardid` int(10) unsigned NOT NULL default '0',".
	"  `mc_ecardid` int(10) unsigned NOT NULL default '0',".	
	"  PRIMARY KEY  (`mc_id`)".
	") ENGINE=MyISAM DEFAULT CHARSET=utf8";
	$GLOBALS['db']->query($querySQL);	
}

/* act操作项的初始化 */
if (empty($_REQUEST['act']))
{
    $_REQUEST['act'] = 'affirm';
}
else
{
    $_REQUEST['act'] = trim($_REQUEST['act']);
}
//----------------flag:0 未生效，1 已生效,2 已使用
/**
 * 储值卡维护
 */
if ($_REQUEST['act'] == 'maintain')
{
	$smarty->assign('ur_here',     $_LANG['moneycard_maintain']);
	$smarty->assign('action_link', array('text' => '储值卡生效', 'href' => 'moneycard1.php?act=affirm'));
    $smarty->assign('full_page',   1);
    $smarty->assign('admin_name',$_SESSION['admin_name']);
	$smarty->assign('lang',         $_LANG);
	
	$sql="select max(mcs_id) from moneycards";
	$cardnum_start=$db->getOne($sql)+1;
	//$cardnum_start=str_pad($cardnum_start, 12, '0', STR_PAD_LEFT);
	$smarty->assign('cardnum_start',$cardnum_start);
    $smarty->display("moneycard_maintain.html");
}
elseif($_REQUEST['act'] == 'check_mc_name')
{
	include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;

    //check_authz_json('moneycard_manage');
    $mc_name=$_GET['mc_name'];
    //$mc_name=$json->decode($_GET['mc_name']);
    $sql = "SELECT COUNT(*) FROM moneycard_type WHERE mc_name='".$mc_name."'";
    $res=$db->getOne($sql) ;
    $res = $json->encode($res);
    echo $res;
}
/**
 * 储值卡维护执行
 */
elseif($_REQUEST['act'] == 'insert')
{
	 /* 去掉储值卡类型名称前后的空格 */
    $type_name   = !empty($_POST['type_name']) ? trim($_POST['type_name']) : '';
    //$mc_enable = !empty($_POST['type_enable']) ? intval($_POST['type_enable']) : 0;

    /* 检查类型是否有重复 */
    $sql = "SELECT COUNT(*) FROM moneycard_type WHERE mc_name='$type_name'";
    if ($db->getOne($sql) > 0)
    {
        $link[] = array('text' => $_LANG['go_back'], 'href' => 'javascript:history.back(-1)');
        sys_msg($_LANG['type_name_exist'], 0, $link);
    }

    /* 获得日期信息 */
    $create_date = local_strtotime(date("Y-m-d"));
    //$use_startdate  = local_strtotime($_POST['use_start_date']);
    //$use_enddate    = local_strtotime($_POST['use_end_date']);
    $create_name=$_SESSION['admin_name'];
    
    /*计算生成储值卡卡号*/
    $type_sum=empty($_POST['type_num'])?1:$_POST['type_num'];
    $cardnum_start=$_POST['cardnum_start'];
    $cardnum_end=$_POST['cardnum_end'];
    /* 插入数据库。 */
    $sql = "INSERT INTO moneycard_type (mc_name,mc_cdate,mc_cname,mc_scardid,mc_ecardid)
    VALUES ('$type_name',
            '$create_date',
            '$create_name',
            '$cardnum_start',
            '$cardnum_end')";

    $db->query($sql);
    $moneycard_typeid=mysql_insert_id();
        
    /* 记录管理员操作 */
    admin_log($_POST['type_name'], 'add', 'moneycardtype');
 
    $num = $db->getOne("SELECT MAX(mcs_id) FROM moneycards");
    $cidxx=0;
    for ($i = 0, $j = 0; $i < $type_sum; $i++)
    {
		$cidxx=$num + $i+1;
		
        $cardid = str_pad($cidxx, 14, '0', STR_PAD_LEFT);		
		$cardid="21".$cardid; 
		$cardpassword = RandPassword(10,'ALL');
        $db->query("INSERT INTO moneycards (moneycard_type_id, cardid,cardpassword) VALUES('$moneycard_typeid', '$cardid','$cardpassword')");

        $j++;
    }

    /* 清除缓存 */
    clear_cache_files();

    /* 提示信息 */
    $link[0]['text'] = "到储值卡类型列表";
    $link[0]['href'] = 'moneycard1.php?act=edit';
    
    $link[1]['text'] = "继续添加";
    $link[1]['href'] = 'moneycard1.php?act=maintain';    

    sys_msg($_LANG['add'] . "&nbsp;" .$_POST['type_name'] . "&nbsp;" . $_LANG['attradd_succed'],0, $link);
	
}
/**
 * 储值卡生效显示
 */
elseif($_REQUEST['act']=='affirm')
{	
    //admin_priv('moneycard_manage');
    $smarty->assign('ur_here',     '储值卡生效');
    $smarty->assign('action_link', array('text' => '储值卡维护', 'href' => 'moneycard1.php?act=maintain'));
    $smarty->assign('admin_name',$_SESSION['admin_name']);    
    $smarty->assign('full_page',   1);
    $smarty->assign('admin_name',$_SESSION['admin_name']);
	$smarty->assign('lang',         $_LANG);
    
	$sql="select mc.mc_id,mc.mc_name,count(mcs_id) from moneycard_type as mc,moneycards".
	" as mcs where mc.mc_id=mcs.moneycard_type_id and flag<>2 group by moneycard_type_id";
	$res=$db->getAll($sql);
	
	//var_dump($res);exit;
	$smarty->assign('mct_list',$res);
    
	$smarty->display("moneycard_affirm.html");
}
elseif($_REQUEST['act']=='get_mct_info')
{
	include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;

    //check_authz_json('moneycard_manage');

    $id = $json->decode($_GET['tid']);
    
    $sql="select *  from moneycard_type where mc_id=".$id;
    $res=$db->getRow($sql);
    $res = $json->encode($res);
    echo $res;
}
elseif($_REQUEST['act']=='check_affirm_cardid')
{
	include_once(ROOT_PATH . 'includes/cls_json.php');
    $json = new JSON;
    
    $scardid=$json->decode($_GET['scardid']);
    $ecardid=$json->decode($_GET['ecardid']);
    $sql="select count(*) from moneycards where mcs_id>=".$scardid." and mcs_id<=".$ecardid." and flag=1";
    $res=$db->getOne($sql);
    $res = $json->encode($res);
    echo $res;
}
/**
 * 储值卡生效执行
 */
elseif($_REQUEST['act']=='affirmaction')
{
	//var_dump($_REQUEST);exit;
	$adate = local_strtotime(date("Y-m-d"));
	$aname=$_SESSION['admin_name'];
	$cardmoney=$_REQUEST['type_money'];
	$use_startdate  = local_strtotime($_REQUEST['use_start_date']);
    $use_enddate    = local_strtotime($_REQUEST['use_end_date']);
	$sql="update moneycards set flag=1,adate='{$adate}',aname='{$aname}',cardmoney='{$cardmoney}',sdate='{$use_startdate}',edate='{$use_enddate}' where flag<>2 and moneycard_type_id=".$_REQUEST['mc_id'].
	     " and mcs_id>=".$_REQUEST['scardid']." and mcs_id<=".$_REQUEST['ecardid'];
	$db->query($sql);
	
	/* 提示信息 */
    $link[0]['text'] = "到储值卡类型列表";
    $link[0]['href'] = 'moneycard1.php?act=edit';
   

    sys_msg("储值卡生效成功",0, $link);
}

/**
 * 导出显示
 */
elseif($_REQUEST['act']=='gen_excel')
{
	//admin_priv('moneycard_manage');
    $smarty->assign('ur_here',     '储值卡导出');
    $smarty->assign('action_link', array('text' => '储值卡类型列表', 'href' => 'moneycard1.php?act=edit'));
    $smarty->assign('full_page',   1);
    $smarty->assign('admin_name',$_SESSION['admin_name']);
    
	$mc_id  = !empty($_GET['tid']) ? intval($_GET['tid']) : 0;
	$sql="select * from moneycard_type where mc_id=".$mc_id;
	$type=$db->getRow($sql);
	$sql = "SELECT COUNT(*) AS sent_count".
            " FROM moneycards" .
            " where moneycard_type_id=".$mc_id;
    $sent_count = $db->getOne($sql);
    $type['sent_count']=$sent_count;
    $type['print_date'] = date("Y-m-d");
    
    $type['mc_sdate'] = $type['mc_sdate'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $type['mc_sdate']);
	$type['mc_edate'] = $type['mc_edate'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $type['mc_edate']);
	$type['mc_cdate'] = $type['mc_cdate'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $type['mc_cdate']);
    
            
	$smarty->assign("type",$type);
	
	$type_list=array();
	$sql="select * from moneycards WHERE moneycard_type_id = '$mc_id' and flag<>2 ORDER BY mcs_id DESC";
	$result=$db->query($sql);
	$i=1;
	while($row=$db->fetchRow($result))
	{   $row['id']=$i;$i++;
		$row['sdate'] = $row['sdate'] == 0 ?
            '' : local_date($GLOBALS['_CFG']['date_format'], $row['sdate']);
	    $row['edate'] = $row['edate'] == 0 ?
            '' : local_date($GLOBALS['_CFG']['date_format'], $row['edate']);
        $row['adate'] = $row['adate'] == 0 ?
            '' : local_date($GLOBALS['_CFG']['date_format'], $row['adate']);
		$row['used_time'] = $row['used_time'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $row['used_time']);
        if($row['user_id'])
        {
        	$sql="select user_name from ".$ecs->table('users')." where user_id=".$row['user_id'];
        	$row['user_name']=$db->getOne($sql);
        }else{$row['user_name']='';}
        $type_list[]=$row;
	}
	
	$smarty->assign("type_list",$type_list);
	$smarty->display("show_excel.html");
}
/**
 * 导出操作
 */
elseif($_REQUEST['act']=='gen_excelaction')
{
    @set_time_limit(0);

    /* 获得此线下红包类型的ID */
    $mc_id  = !empty($_GET['tid']) ? intval($_GET['tid']) : 0;
    $type_name = $db->getOne("SELECT mc_name FROM moneycard_type WHERE mc_id = '$mc_id'");

    /* 文件名称 */
    $bonus_filename = $type_name .'_moneycard_list';
    if (EC_CHARSET != 'gbk')
    {
        $bonus_filename = ecs_iconv('UTF8', 'GB2312',$bonus_filename);
    }

    header("Content-type: application/vnd.ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=$bonus_filename.xls");
    
    $sql="select * from moneycard_type where mc_id=".$mc_id;
	$type=$db->getRow($sql);
	$sql = "SELECT COUNT(*) AS sent_count".
            " FROM moneycards" .
            " where moneycard_type_id=".$mc_id;
    $sent_count = $db->getOne($sql);
    $type['sent_count']=$sent_count;
    $type['print_date'] = date("Y-m-d");
    
    $type['mc_sdate'] = $type['mc_sdate'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $type['mc_sdate']);
	$type['mc_edate'] = $type['mc_edate'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $type['mc_edate']);
	$type['mc_cdate'] = $type['mc_cdate'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $type['mc_cdate']);
    
    
    
    /* 文件标题 */
    if (EC_CHARSET != 'gbk')
    {
    	echo ecs_iconv('UTF8', 'GB2312', '储值卡描述：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['mc_name']) ."\t";
    	//echo ecs_iconv('UTF8', 'GB2312', '面值：') ."\t";
    	//echo ecs_iconv('UTF8', 'GB2312', price_format($type['mc_money'])) ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', '导出数量：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['sent_count']) ."\t\n";
    	
    	echo ecs_iconv('UTF8', 'GB2312', '起始编号：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['mc_scardid']) ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', '截止编号：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['mc_ecardid']) ."\t\n";
    	/*echo ecs_iconv('UTF8', 'GB2312', '使用起始日期：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['mc_sdate']) ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', '使用失效日期：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['mc_edate']) ."\t\n";*/
    	
    	echo ecs_iconv('UTF8', 'GB2312', '维护人：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['mc_cname']) ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', '维护日期：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['mc_cdate']) ."\t\n";
    	
    	echo ecs_iconv('UTF8', 'GB2312', '导出人：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $_SESSION['admin_name']) ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', '导出日期：') ."\t";
    	echo ecs_iconv('UTF8', 'GB2312', $type['print_date']) ."\t\n";
    	echo "\n";
    	
        echo ecs_iconv('UTF8', 'GB2312', $_LANG['bonus_excel_file']) . "\t\n";
        /* 红包序列号, 红包金额, 类型名称(红包名称), 使用结束日期 */
        echo ecs_iconv('UTF8', 'GB2312', '储值卡描述') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '面值金额') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '卡号') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '密码') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '使用起始日期') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '使用失效日期') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '状态') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '生效人') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '生效日期') ."\t";
        echo ecs_iconv('UTF8', 'GB2312', '使用会员') ."\t";
		echo ecs_iconv('UTF8', 'GB2312', '使用时间') ."\t\n";
    }
    else
    {
    	echo "储值卡描述：\t";echo $type['mc_name']."\t";
    	//echo "面值：\t";echo price_format($type['mc_money'])."\t";
    	echo "导出数量：\t";echo $type['sent_count']."\t\n";
    	
    	echo "起始编号：\t";echo $type['mc_scardid']."\t";
    	echo "截止编号：\t";echo $type['mc_ecardid']."\t\n";
    	/*echo "使用起始日期：\t";echo $type['mc_sdate']."\t";
    	echo "使用失效日期：\t";echo $type['mc_edate']."\t\n";*/
    	
    	echo "维护人：\t";echo $type['mc_cname']."\t";
    	echo "维护日期：\t";echo $type['mc_cdate']."\t\n";
    	
    	echo "导出人：\t";echo $_SESSION['admin_name']."\t";
    	echo "导出日期：\t";echo $type['print_date']."\t\n";
    	echo "\n";
    	
        echo $_LANG['bonus_excel_file'] . "\t\n";
        /* 红包序列号, 红包金额, 类型名称(红包名称), 使用结束日期 */
		
		echo "储值卡描述" ."\t";
		echo "面值金额" ."\t";
        echo "卡号" ."\t";
        echo "密码" ."\t";
        echo "使用起始日期" ."\t";
        echo "使用失效日期" ."\t";
        echo "状态" ."\t";
        echo "生效人" ."\t";
        echo "生效日期" ."\t";
        echo "使用会员" ."\t";
        echo "使用时间" ."\t\n";
    }

    $sql = "SELECT * from moneycards WHERE moneycard_type_id = '$mc_id' and flag<>2 ORDER BY mcs_id DESC";
    $res = $db->query($sql);

    $code_table = array();
    while ($val = $db->fetchRow($res))
    {
    	$val['mc_name']=$type['mc_name'];
        if($val['user_id'])
        {
        	$sql="select user_name from ".$ecs->table('users')." where user_id=".$val['user_id'];
        	$val['user_name']=$db->getOne($sql);
        }else{$val['user_name']='';}
            if (EC_CHARSET != 'gbk')
            {
                $val['mc_name'] = ecs_iconv('UTF8', 'GB2312', $val['mc_name']);
                $val['user_name'] = ecs_iconv('UTF8', 'GB2312', $val['user_name']);
                $val['aname'] = ecs_iconv('UTF8', 'GB2312', $val['aname']);
                //$val['mc_money'] = ecs_iconv('UTF8', 'GB2312', price_format($type['mc_money']));
                $val['mc_money'] = ecs_iconv('UTF8', 'GB2312', price_format($val['cardmoney']));
            }
            else
            {
                $val['mc_name'] = $val['mc_name'];
                $val['user_name'] = $val['user_name'];
                $val['aname'] = $val['aname'];
                //$val['mc_money'] = price_format($type['mc_money']);
                $val['mc_money'] = price_format($val['cardmoney']);
            }
        $val['sdate'] = $val['sdate'] == 0 ?''
            : local_date($GLOBALS['_CFG']['date_format'], $val['sdate']);
        $val['edate'] = $val['edate'] == 0 ?''
            : local_date($GLOBALS['_CFG']['date_format'], $val['edate']);
        $val['adate'] = $val['adate'] == 0 ?
            '' : local_date($GLOBALS['_CFG']['date_format'], $val['adate']);
        $val['used_time'] = $val['used_time'] == 0 ?ecs_iconv('UTF8', 'GB2312',  $GLOBALS['_LANG']['no_use'])
            : local_date($GLOBALS['_CFG']['date_format'], $val['used_time']);
        $val['flag'] = $val['flag'] == 0 ?ecs_iconv('UTF8', 'GB2312',  '待生效')
            : ecs_iconv('UTF8', 'GB2312',  '已生效');
		echo $val['mc_name'] . "\t";
		echo $val['mc_money'] . "\t";
		echo $val['cardid'] . "\t";
		echo $val['cardpassword'] . "\t";
		echo $val['sdate'] . "\t";
		echo $val['edate'] . "\t";
		echo $val['flag'] . "\t";
		echo $val['aname'] . "\t";
		echo $val['adate'] . "\t";
		echo $val['user_name'] . "\t";
        echo $val['used_time'];
        echo "\t\n";
    }
}
/**
 * 储值卡编辑
 */
elseif($_REQUEST['act']=='edit')
{
	//admin_priv('moneycard_manage');
    $smarty->assign('ur_here',     '储值卡查看');
    $smarty->assign('action_link', array('text' => '储值卡生效', 'href' => 'moneycard1.php?act=affirm'));
    $smarty->assign('full_page',   1);
    $smarty->assign('admin_name',$_SESSION['admin_name']);
    $smarty->assign('lang',         $_LANG);

    $list = get_type_list();

    $smarty->assign('type_list',    $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
	$smarty->display("moneycard_type_list.html");
}

/*
 * 对储值卡的查看
 */
else if($_REQUEST['act']=='get_moneycards_list')
{
	$smarty->assign('ur_here',     "储值卡列表");
	$smarty->assign('action_link', array('text' => "储值卡类型列表", 'href' => 'moneycard1.php?act=edit'));
    $smarty->assign('full_page',   1);
    $smarty->assign('admin_name',$_SESSION['admin_name']);
	$smarty->assign('lang',         $_LANG);
	
	
	$list = get_moneycards_list();

          
    $smarty->assign('moneycard_type_id', intval($_REQUEST['moneycard_type']));
    $smarty->assign('moneycards_list',   $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    assign_query_info();
	$smarty->display("moneycards_list.html");	
}

/*
 * 储值卡账户记录查询
 */
else if($_REQUEST['act']=='account')
{
	$smarty->assign('ur_here',     "储值卡账户记录查询");
	$smarty->assign('action_link', array('text' => "储值卡类型列表", 'href' => 'moneycard1.php?act=edit'));
    $smarty->assign('full_page',   1);
    $smarty->assign('admin_name',$_SESSION['admin_name']);
	$smarty->assign('lang',         $_LANG);
	
	$type=isset($_REQUEST['type'])?$_REQUEST['type']:0;
	$mobilephone=isset($_REQUEST['mobilephone'])?$_REQUEST['mobilephone']:'';
	$sdate=isset($_REQUEST['sdate'])?$_REQUEST['sdate']:'';
	$edate=isset($_REQUEST['edate'])?$_REQUEST['edate']:'';
	
	$where='';
	if($type)
	{
		$where.=" and al.change_type=".$type;		
	}
	if($mobilephone)
	{
		$where.=" and u.mobile_phone=".$mobilephone;
	}
	if($sdate)
	{
		$sdate  = local_strtotime($sdate);
		$where.=" and al.change_time>=".$sdate;
	}
    if($edate)
	{
		$edate  = local_strtotime(date("Y-m-d",local_strtotime($edate)+3600*48));
		$where.=" and al.change_time<=".$edate;
	}
	$lastmonth=strtotime("last month");
	
	$sql="select al.*,u.user_name from mcard_log as al,".$ecs->table('users').
	     " as u where u.user_id=al.user_id and al.user_money<>0 and al.change_time>='".$lastmonth."'".$where." order by al.change_time desc";
	$res=$db->getAll($sql);
	foreach($res as $key=>$val)
	{   
		$res[$key]['sn']=$key+1;
	    $res[$key]['change_time'] = $val['change_time'] == 0 ?
            '' : local_date($GLOBALS['_CFG']['date_format'],$val['change_time']);
	  
	    $res[$key]['format_user_money']=price_format($val['user_money']);
	}
	//var_dump($res);
	$smarty->assign('account_list',$res);
	
	$smarty->display('mc_account.html');
}

/*------------------------------------------------------ */
//-- 翻页、排序
/*------------------------------------------------------ */

if ($_REQUEST['act'] == 'query')
{   //check_authz_json('moneycard_manage');
    $flag=$_REQUEST['flag'];
    $list = get_type_list();
    
    $smarty->assign('flag',$flag);
    $smarty->assign('type_list',    $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('moneycard_type_list.html'), '',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
if ($_REQUEST['act'] == 'query_moneycards')
{
    $list = get_moneycards_list();

    $smarty->assign('moneycards_list',   $list['item']);
    $smarty->assign('filter',       $list['filter']);
    $smarty->assign('record_count', $list['record_count']);
    $smarty->assign('page_count',   $list['page_count']);

    $sort_flag  = sort_flag($list['filter']);
    $smarty->assign($sort_flag['tag'], $sort_flag['img']);

    make_json_result($smarty->fetch('moneycards_list.html'), '',
        array('filter' => $list['filter'], 'page_count' => $list['page_count']));
}
/**
 * 获取储值卡类型列表
 * @access  public
 * @return void
 */
function get_type_list()
{
    /* 获得所有储值卡类型的发放数量 */
    $sql = "SELECT moneycard_type_id, COUNT(*) AS sent_count".
            " FROM moneycards" .
            " where flag<>2 GROUP BY moneycard_type_id";
    $res = $GLOBALS['db']->query($sql);

    $sent_arr = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $sent_arr[$row['moneycard_type_id']] = $row['sent_count'];
    }

    /* 获得所有储值卡类型的使用数量 */
    $sql = "SELECT moneycard_type_id, COUNT(*) AS used_count".
            " FROM moneycards" .
            " WHERE used_time > 0 and flag<>2".
            " GROUP BY moneycard_type_id";
    $res = $GLOBALS['db']->query($sql);

    $used_arr = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $used_arr[$row['moneycard_type_id']] = $row['used_count'];
    }
    
    /*获得搜有储值卡类型的生效数量*/
     $sql = "SELECT moneycard_type_id, COUNT(*) AS affirm_count".
            " FROM moneycards" .
            " WHERE flag=1".
            " GROUP BY moneycard_type_id";
    $res = $GLOBALS['db']->query($sql);

    $affirm = array();
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
    	$affirm[$row['moneycard_type_id']] = $row['affirm_count'];
    }
    
    $result = get_filter();
    if ($result === false)
    {
        /* 查询条件 */
        $filter['sort_by']    = empty($_REQUEST['sort_by']) ? 'mc_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order'] = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
        
        
        $sql = "SELECT COUNT(*) FROM moneycard_type";
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        /* 分页大小 */
        $filter = page_and_size($filter);

        $sql = "SELECT * FROM moneycard_type ORDER BY $filter[sort_by] $filter[sort_order]";

        set_filter($filter, $sql);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }
    $arr = array();
    $res = $GLOBALS['db']->selectLimit($sql, $filter['page_size'], $filter['start']);
    $sn=1;
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
    	$row['sn']=$sn;$sn++;
        $row['send_by'] = $GLOBALS['_LANG']['send_by'][$row['send_type']];
        $row['send_count'] = isset($sent_arr[$row['mc_id']]) ? $sent_arr[$row['mc_id']] : 0;
        $row['use_count'] = isset($used_arr[$row['mc_id']]) ? $used_arr[$row['mc_id']] : 0;
        $row['affirm_count'] = isset($affirm[$row['mc_id']]) ? $affirm[$row['mc_id']] : 0;
        $row['mc_money'] = price_format($row['mc_money']);
		
        //$row['mc_sdate'] = $row['mc_sdate'] == 0 ?
           // $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $row['mc_sdate']);
		//$row['mc_edate'] = $row['mc_edate'] == 0 ?
           // $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $row['mc_edate']);
		$row['mc_cdate'] = $row['mc_cdate'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $row['mc_cdate']);
        $arr[] = $row;
    }

    $arr = array('item' => $arr, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}
function get_moneycards_list()
{
    /* 查询条件 */
    
    $filter['moneycard_type'] = empty($_REQUEST['moneycard_type']) ? 0 : intval($_REQUEST['moneycard_type']);

    $where = empty($filter['moneycard_type']) ? '' : " WHERE moneycard_type_id=".$filter['moneycard_type'];

    $sql = "SELECT COUNT(*) FROM moneycards ". $where." and flag<>2";
    $filter['record_count'] = $GLOBALS['db']->getOne($sql);

    /* 分页大小 */
    $filter = page_and_size($filter);

    $sql = "SELECT * FROM (SELECT ub.*, u.user_name,bt.mc_name".
          " FROM moneycards AS ub".
          " LEFT JOIN moneycard_type AS bt ON bt.mc_id=ub.moneycard_type_id ".
          " LEFT JOIN " .$GLOBALS['ecs']->table('users'). " AS u ON u.user_id=ub.user_id ". ")AS TAB where  moneycard_type_id=".$filter['moneycard_type'].
          " and flag<>2 LIMIT ". $filter['start'] .", $filter[page_size]";
		  
	  
    $row = $GLOBALS['db']->getAll($sql);

    foreach ($row AS $key => $val)
    {
        $row[$key]['used_time'] = $val['used_time'] == 0 ?
            $GLOBALS['_LANG']['no_use'] : local_date($GLOBALS['_CFG']['date_format'], $val['used_time']);
        $row[$key]['sdate'] = $val['sdate'] == 0 ?
            '' : local_date($GLOBALS['_CFG']['date_format'], $val['sdate']);
		$row[$key]['edate'] = $val['edate'] == 0 ?
            '' : local_date($GLOBALS['_CFG']['date_format'], $val['edate']);
        $row[$key]['adate'] = $val['adate'] == 0 ?
            '' : local_date($GLOBALS['_CFG']['date_format'], $val['adate']);
        $row[$key]['cardmoney']=price_format($val['cardmoney']);
    }

    $arr = array('item' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);

    return $arr;
}
/* 随即密码函数 */
function RandPassword($len=6,$format='ALL') {    

 switch($format) {    
 case 'ALL':   
 $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789'; break;   
 case 'CHAR':   
 $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz'; break;   
 case 'NUMBER':   
 $chars='0123456789'; break;   
 default :   
 $chars='ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';    
 break;   
 }   
 mt_srand((double)microtime()*1000000*getmypid());    
 $password="";   
 while(strlen($password)<$len)   
    $password.=substr($chars,(mt_rand()%strlen($chars)),1);   
 return $password;   
 }   

