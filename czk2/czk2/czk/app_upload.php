<?php
define('IN_ECS', true);
require(dirname(__FILE__) . '/includes/init.php');
if($_GET['act']=='add'){
	$action_link=array("text"=>"上传查看","href"=>"app_upload.php?act=list");
	$smarty->assign('ur_here',"上传文件");
	$smarty->assign('action_link',$action_link);
	$smarty->display("upload.html");
}elseif($_GET['act']=='addaction'){
	//echo ini_get('upload_max_filesize')."<br>";   
	//echo $_FILES["file"]["error"];
	if($_POST['app']=='a')
	{
	    if ($_FILES["file"]["error"]>0)
	    {
			 sys_msg("上传失败"); 
	    }else{
	      
		  $file_path=pathinfo($_FILES["file"]["name"], PATHINFO_EXTENSION); 
	      if($file_path<>"apk") 
	      {
	      	sys_msg("格式不正确");
	      }
	      
	      $time=time()+8*3600;
	      $a=date("Ymd",$time);
		 //$filename="download/21cake_".$a.".apk";
	    	$res=move_uploaded_file($_FILES["file"]["tmp_name"], ROOT_PATH ."download/21cake_".$a.".apk");
	      if($res){
			   $_POST['version']=strip_tags(dowith_sql($_POST['version']));
				 $sql="insert into version_log(app,version,admin,edittime) values('a',\"{$_POST['version']}\",\"{$_SESSION['admin_name']}\",{$time})";
				 $r1=$db->query($sql);
				 $sql="update version set version=\"{$_POST['version']}\" where app=\"a\"";
				 $r2=$db->query($sql);			
				$res= copy(ROOT_PATH ."download/21cake_".$a.".apk", ROOT_PATH ."download/21cake.apk");	
				 if($res){ 		
			  echo "<script type='text/javascript'>alert('文件上传成功！');window.location='app_upload.php?act=list';</script>";
				 }else{
			  echo "<script type='text/javascript'>alert('文件上传失败！');</script>";
					 }
		  }
	      
	     
	    }
	}elseif($_POST['app']=='i'){
		$time=time()+8*3600;
	      $_POST['version']=strip_tags(dowith_sql($_POST['version']));
	     $sql="insert into version_log(app,version,admin,edittime) values('i',\"{$_POST['version']}\",\"{$_SESSION['admin_name']}\",{$time})";
	     $r1=$db->query($sql);
	     $sql="update version set version=\"{$_POST['version']}\" where app=\"i\"";
	     $r2=$db->query($sql);
	     echo "<script type='text/javascript'>window.location='app_upload.php?act=list';</script>";
	}
}elseif($_GET['act']=='list'){
	$sql="select * from version_log order by edittime desc";
	$list=$db->getAll($sql);
	foreach($list as $key=>$val)
	{
		$list[$key]['edittime']=date("Y-m-d H:i:s",$val['edittime']);
	}
	$action_link=array("text"=>"上传文件","href"=>"app_upload.php?act=add");
	$smarty->assign('action_link',$action_link);
	$smarty->assign('ur_here',"app上传");
	$smarty->assign("list",$list);
	$smarty->display("version_list.html");
}
function dowith_sql($str)
{
   $str = str_replace("and","",$str);
   $str = str_replace("execute","",$str);
   $str = str_replace("update","",$str);
   $str = str_replace("count","",$str);
   $str = str_replace("chr","",$str);
   $str = str_replace("mid","",$str);
   $str = str_replace("master","",$str);
   $str = str_replace("truncate","",$str);
   $str = str_replace("char","",$str);
   $str = str_replace("declare","",$str);
   $str = str_replace("select","",$str);
   $str = str_replace("create","",$str);
   $str = str_replace("delete","",$str);
   $str = str_replace("insert","",$str);
   $str = str_replace("'","",$str);

   //echo $str;
   return $str;
}
?>
