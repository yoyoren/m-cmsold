<?php

/**
 * ECSHOP 程序说明
 * ===========================================================
 * * 版权所有 2005-2012 上海商派网络科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；
 * ----------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ==========================================================
 * $Author: liubo $
 * $Id: flashplay.php 17217 2011-01-19 06:29:08Z liubo $
 */

define('IN_ECS', true);

require(dirname(__FILE__) . '/includes/init.php');
$uri = $ecs->url();
$allow_suffix = array('gif', 'jpg', 'png', 'jpeg', 'bmp');
$_LANG['schp_imgsrc'] = '轮播图片地址';
$_LANG['schp_imgurl'] = '轮播图片链接';
$_LANG['schp_imgdesc'] = '图片说明';
$_LANG['schp_sort'] = '排序';
$_LANG['trash_img_confirm'] = '您要删除这张轮播图片么？';
$_LANG['custom_del_confirm'] = '您确定删除此广告吗？';
$_LANG['tab_change_alert'] = '请先将自定义广告全部"关闭",\n\n然后才可以点击系统默认。';
$_LANG['trash_img'] = '删除这张轮播图片';
$_LANG['custom_drop_img'] = '删除此广告';
$_LANG['custom_change_img'] = '修改状态';
$_LANG['add_new'] = '添加图片';
$_LANG['add_flash'] = '添加播放器';
$_LANG['add_ad'] = '自定义添加广告';
$_LANG['add_picad'] = '添加图片广告';
$_LANG['edit_picad'] = '编辑图片广告';
$_LANG['edit_ad'] = '自定义编辑广告';
$_LANG['title_flash_name'] = '广告名称';
$_LANG['title_flash_type'] = '广告类型';
$_LANG['title_flash_time'] = '添加时间';
$_LANG['title_flash_status'] = '状态';
$_LANG['title_upload_notice'] = '上传该广告的图片文件,或者你也可以指定一个远程URL地址为广告的图片';

$_LANG['img_src'] = '图片地址';
$_LANG['img_url'] = '图片链接';
$_LANG['form_none'] = '表单信息不全,添加失败';
$_LANG['web_url_no'] = '远程地址错误。请填写完整的 URL 地址！';
$_LANG['src_empty'] = '地址错误。';
$_LANG['back_custom_set'] = '返回自定义设置页';
$_LANG['edit_ok'] = '操作成功';
$_LANG['edit_no'] = '操作失败';
$_LANG['id_error'] = '没有指定的轮播图片！';
$_LANG['src_empty'] = '请填写轮播图片地址';
$_LANG['link_empty'] = '请填写链接地址';
$_LANG['go_url'] = '轮播图片列表';
$_LANG['ad_play_url'] = '广告轮播列表';
$_LANG['return_edit'] = '返回编辑页';
$_LANG['width_height'] = '此模板的图片标准宽度为：%s 标准高度为：%s';
$_LANG['invalid_type'] = '您上传的图片格式不正确！';
$_LANG['flash_template'] = '可用Flash轮播图片样式';
$_LANG['current_theme'] = '当前样式';
$_LANG['install_success'] = '启用Flash样式成功。';
$_LANG['ad_img'] = '图片';
$_LANG['ad_flash'] = 'Flash';
$_LANG['ad_html'] = '代码';
$_LANG['ad_text'] = '文字';


/* 内容页标签 */
$_LANG['lable_flash_name'] = '广告名称：';
$_LANG['lable_flash_type'] = '广告类型：';
$_LANG['lable_flash_status'] = '状态：';
$_LANG['lable_upload'] = '上传：';
$_LANG['lable_url'] = '链接地址：';
$_LANG['lable_from_web'] = '或者远程URL地址：';
$_LANG['lable_content'] = '内容：';

/* 标签 */
$_LANG['system_set'] = '系统默认';
$_LANG['custom_set'] = '自定义';
/*------------------------------------------------------ */
//-- 系统
/*------------------------------------------------------ */
if ($_REQUEST['act']== 'list')
{
   

    $playerdb = get_flash_xml();
    foreach ($playerdb as $key => $val)
    {
        if (strpos($val['src'], 'http') === false)
        {
            $playerdb[$key]['src'] = $uri . $val['src'];
        }
    }
    assign_query_info();
    $flash_dir = ROOT_PATH . 'images/afficheimg/flashdata/';

    $smarty->assign('current', 'sys');
    $smarty->assign('group_list', $group_list);
    $smarty->assign('group_selected', $_CFG['index_ad']);
    $smarty->assign('uri', $uri);
    $smarty->assign('ur_here', $_LANG['flashplay']);
    $smarty->assign('action_link_special', array('text' => $_LANG['add_new'], 'href' => 'indeximg.php?act=add'));
    //$smarty->assign('flashtpls', get_flash_templates($flash_dir));
    $smarty->assign('current_flashtpl', '1');
    $smarty->assign('playerdb', $playerdb);
    $smarty->display('indeximg_list.htm');
}
elseif($_REQUEST['act']== 'del')
{
   //admin_priv('flash_manage');

    $id = (int)$_GET['id'];
    $flashdb = get_flash_xml();
    if (isset($flashdb[$id]))
    {
        $rt = $flashdb[$id];
    }
    else
    {
        $links[] = array('text' => $_LANG['go_url'], 'href' => 'indeximg.php?act=list');
        sys_msg($_LANG['id_error'], 0, $links);
    }

    if (strpos($rt['src'], 'http') === false)
    {
        @unlink(ROOT_PATH . $rt['src']);
    }
    $temp = array();
    foreach ($flashdb as $key => $val)
    {
        if ($key != $id)
        {
            $temp[] = $val;
        }
    }
    put_flash_xml($temp);
    //set_flash_data('1', $error_msg = '');
    ecs_header("Location: indeximg.php?act=list\n");
    exit;
}
elseif ($_REQUEST['act'] == 'add')
{
    //admin_priv('flash_manage');

    if (empty($_POST['step']))
    {
        $url = isset($_GET['url']) ? $_GET['url'] : 'http://';
        $src = isset($_GET['src']) ? $_GET['src'] : '';
        $sort = 0;
        $rt = array('act'=>'add','img_url'=>$url,'img_src'=>$src, 'img_sort'=>$sort);
        //$width_height = get_width_height();
		$width_height['width']=954;
		$width_height['height']=521;
        assign_query_info();
        if(isset($width_height['width'])|| isset($width_height['height']))
        {
            $smarty->assign('width_height', sprintf($_LANG['width_height'], $width_height['width'], $width_height['height']));
        }

        $smarty->assign('action_link', array('text' => $_LANG['go_url'], 'href' => 'indeximg.php?act=list'));
        $smarty->assign('rt', $rt);
        $smarty->assign('ur_here', $_LANG['add_picad']);
        $smarty->display('indeximg_add.htm');
    }
    elseif ($_POST['step'] == 2)
    {
        if (!empty($_FILES['img_file_src']['name']))
        {
            if(!get_file_suffix($_FILES['img_file_src']['name'], $allow_suffix))
            {
                sys_msg($_LANG['invalid_type']);
            }
            $name = date('Ymd');
            for ($i = 0; $i < 6; $i++)
            {
                $name .= chr(mt_rand(97, 122));
            }
            $name .= '.' . end(explode('.', $_FILES['img_file_src']['name']));
            $target = ROOT_PATH . 'images/afficheimg/' . $name;
            if (move_upload_file($_FILES['img_file_src']['tmp_name'], $target))
            {
                $src = 'images/afficheimg/' . $name;
            }
        }
        elseif (!empty($_POST['img_src']))
        {
            $src = $_POST['img_src'];

            if(strstr($src, 'http') && !strstr($src, $_SERVER['SERVER_NAME']))
            {
                $src = get_url_image($src);
            }
        }
        else
        {
            $links[] = array('text' => $_LANG['add_new'], 'href' => 'indeximg.php?act=add');
            sys_msg($_LANG['src_empty'], 0, $links);
        }

        if (empty($_POST['img_url']))
        {
            $links[] = array('text' => $_LANG['add_new'], 'href' => 'indeximg.php?act=add');
            sys_msg($_LANG['link_empty'], 0, $links);
        }
		if (empty($_POST['sdate']))
        {
            $_POST['sdate']='2012-01-01 00:00:00';
        }
		if(empty($_POST['edate'])) $_POST['edate']='2019-12-30 23:59:59';
        // 获取flash播放器数据
        $flashdb = get_flash_xml();

        // 插入新数据
        array_unshift($flashdb, array('src'=>$src, 'url'=>$_POST['img_url'], 'text'=>$_POST['img_text'] ,'sort'=>$_POST['img_sort'],'sdate'=>$_POST['sdate'],'edate'=>$_POST['edate']));
        // 实现排序
        $flashdb_sort   = array();
        $_flashdb       = array();
        foreach ($flashdb as $key => $value)
        {
            $flashdb_sort[$key] = $value['sort'];
        }
        asort($flashdb_sort, SORT_NUMERIC);
        foreach ($flashdb_sort as $key => $value)
        {
            $_flashdb[] = $flashdb[$key];
        }
        unset($flashdb, $flashdb_sort);

        put_flash_xml($_flashdb);
        //set_flash_data('1', $error_msg = '');
        $links[] = array('text' => $_LANG['go_url'], 'href' => 'indeximg.php?act=list');
        sys_msg($_LANG['edit_ok'], 0, $links);
    }
}
elseif ($_REQUEST['act'] == 'edit')
{
    //admin_priv('flash_manage');

    $id = (int)$_REQUEST['id']; //取得id
    $flashdb = get_flash_xml(); //取得数据
    if (isset($flashdb[$id]))
    {
        $rt = $flashdb[$id];
    }
    else
    {
        $links[] = array('text' => $_LANG['go_url'], 'href' => 'flashplay.php?act=list');
        sys_msg($_LANG['id_error'], 0, $links);
    }
    if (empty($_POST['step']))
    {
        $rt['act'] = 'edit';
        $rt['img_url'] = $rt['url'];
        $rt['img_src'] = $rt['src'];
        $rt['img_txt'] = $rt['text'];
		$rt['sdate'] = $rt['sdate'];
		$rt['edate'] = $rt['edate'];
        $rt['img_sort'] = empty($rt['sort']) ? 0 : $rt['sort'];

        $rt['id'] = $id;
        $smarty->assign('action_link', array('text' => $_LANG['go_url'], 'href' => 'indeximg.php?act=list'));
        $smarty->assign('rt', $rt);
        $smarty->assign('ur_here', $_LANG['edit_picad']);
        $smarty->display('indeximg_add.htm');
    }
    elseif ($_POST['step'] == 2)
    {
        if (empty($_POST['img_url']))
        {
            //若链接地址为空
            $links[] = array('text' => $_LANG['return_edit'], 'href' => 'indeximg.php?act=edit&id=' . $id);
            sys_msg($_LANG['link_empty'], 0, $links);
        }

        if (!empty($_FILES['img_file_src']['name']))
        {
            if(!get_file_suffix($_FILES['img_file_src']['name'], $allow_suffix))
            {
                sys_msg($_LANG['invalid_type']);
            }
            //有上传
            $name = date('Ymd');
            for ($i = 0; $i < 6; $i++)
            {
                $name .= chr(mt_rand(97, 122));
            }
            $name .= '.' . end(explode('.', $_FILES['img_file_src']['name']));
            $target = ROOT_PATH .'images/afficheimg/' . $name;

            if (move_upload_file($_FILES['img_file_src']['tmp_name'], $target))
            {
                $src ='images/afficheimg/' . $name;
            }
        }
        else if (!empty($_POST['img_src']))
        {
            $src =$_POST['img_src'];

            if(strstr($src, 'http') && !strstr($src, $_SERVER['SERVER_NAME']))
            {
                $src = get_url_image($src);
            }
        }
        else
        {
            $links[] = array('text' => $_LANG['return_edit'], 'href' => 'indeximg.php?act=edit&id=' . $id);
            sys_msg($_LANG['src_empty'], 0, $links);
        }

        if (strpos($rt['src'], 'http') === false && $rt['src'] != $src)
        {
            @unlink(ROOT_PATH . $rt['src']);
        }
        $flashdb[$id] = array('src'=>$src,'url'=>$_POST['img_url'],'text'=>$_POST['img_text'],'sort'=>$_POST['img_sort'],'sdate'=>$_POST['sdate'],'edate'=>$_POST['edate']);

        // 实现排序
        $flashdb_sort   = array();
        $_flashdb       = array();
        foreach ($flashdb as $key => $value)
        {
            $flashdb_sort[$key] = $value['sort'];
        }
        asort($flashdb_sort, SORT_NUMERIC);
        foreach ($flashdb_sort as $key => $value)
        {
            $_flashdb[] = $flashdb[$key];
        }
        unset($flashdb, $flashdb_sort);

        put_flash_xml($_flashdb);
        //set_flash_data($_CFG['flash_theme'], $error_msg = '');
        $links[] = array('text' => $_LANG['go_url'], 'href' => 'indeximg.php?act=list');
        sys_msg($_LANG['edit_ok'], 0, $links);
    }
}
elseif ($_REQUEST['act'] == 'install')
{
    check_authz_json('flash_manage');
    $flash_theme = trim($_GET['flashtpl']);
    if ($_CFG['flash_theme'] != $flash_theme)
    {
        $sql = "UPDATE " .$GLOBALS['ecs']->table('shop_config'). " SET value = '$flash_theme' WHERE code = 'flash_theme'";
        if ($db->query($sql, 'SILENT'))
        {
            clear_all_files(); //清除模板编译文件

            $error_msg = '';
            if (set_flash_data($flash_theme, $error_msg))
            {
                make_json_error($error_msg);
            }
            else
            {
                make_json_result($flash_theme, $_LANG['install_success']);
            }
        }
        else
        {
            make_json_error($db->error());
        }
    }
    else
    {
        make_json_result($flash_theme, $_LANG['install_success']);
    }
}

function get_flash_xml()
{
    $flashdb = array();
    if (file_exists(ROOT_PATH .'images/afficheimg/flash_data.xml'))
    {

        // 兼容v2.7.0及以前版本
        if (!preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"\ssort="([^"]*)"\ssdate="([^"]*)"\sedate="([^"]*)"/', file_get_contents(ROOT_PATH .  'images/afficheimg/flash_data.xml'), $t, PREG_SET_ORDER))
        {
            preg_match_all('/item_url="([^"]+)"\slink="([^"]+)"\stext="([^"]*)"\ssort="([^"]*)"\ssdate="([^"]*)\sedate="([^"]*)"/', file_get_contents(ROOT_PATH . 'images/afficheimg/flash_data.xml'), $t, PREG_SET_ORDER);
        }
        if (!empty($t))
        {
            foreach ($t as $key => $val)
            {
                $val[4] = isset($val[4]) ? $val[4] : 0;
                $flashdb[] = array('src'=>$val[1],'url'=>$val[2],'text'=>$val[3],'sort'=>$val[4],'sdate'=>$val[5],'edate'=>$val[6]);
            }
        }
    }
    return $flashdb;
}

function put_flash_xml($flashdb)
{
    if (!empty($flashdb))
    {
        $xml = '<?xml version="1.0" encoding="' . EC_CHARSET . '"?><bcaster>';
        foreach ($flashdb as $key => $val)
        {
            $xml .= '<item item_url="' . $val['src'] . '" link="' . $val['url'] . '" text="' . $val['text'] . '" sort="' . $val['sort'] . '" sdate="' . $val['sdate']. '" edate="' . $val['edate'].'"/>';
        }
        $xml .= '</bcaster>';
        file_put_contents(ROOT_PATH . 'images/afficheimg/flash_data.xml', $xml);
    }
    else
    {
        @unlink(ROOT_PATH . 'images/afficheimg/flash_data.xml');
    }
}

function get_url_image($url)
{
    $ext = strtolower(end(explode('.', $url)));
    if($ext != "gif" && $ext != "jpg" && $ext != "png" && $ext != "bmp" && $ext != "jpeg")
    {
        return $url;
    }

    $name = date('Ymd');
    for ($i = 0; $i < 6; $i++)
    {
        $name .= chr(mt_rand(97, 122));
    }
    $name .= '.' . $ext;
    $target = ROOT_PATH . DATA_DIR . '/afficheimg/' . $name;

    $tmp_file = DATA_DIR . '/afficheimg/' . $name;
    $filename = ROOT_PATH . $tmp_file;

    $img = file_get_contents($url);

    $fp = @fopen($filename, "a");
    fwrite($fp, $img);
    fclose($fp);

    return $tmp_file;
}

function get_width_height()
{
    $curr_template = $GLOBALS['_CFG']['template'];
    $path = ROOT_PATH . 'themes/' . $curr_template . '/library/';
    $template_dir = @opendir($path);

    $width_height = array();
	
    while($file = readdir($template_dir))
    {
        if($file == 'index_ad.lbi')
        {
            $string = file_get_contents($path . $file);
            $pattern_width = '/var\s*swf_width\s*=\s*(\d+);/';
            $pattern_height = '/var\s*swf_height\s*=\s*(\d+);/';
            preg_match($pattern_width, $string, $width);
            preg_match($pattern_height, $string, $height);
            if(isset($width[1]))
            {
                $width_height['width'] = $width[1];
            }
            if(isset($height[1]))
            {
                $width_height['height'] = $height[1];
            }
            break;
        }
    }

    return $width_height;
}





function set_flash_default($tplname, $flashdata)
{
    $data_file = ROOT_PATH .'images/afficheimg/flashdata/' . $tplname . '/data.xml';
    $xmldata = '<?xml version="1.0" encoding="' . EC_CHARSET . '"?><bcaster>';
    foreach ($flashdata as $data)
    {
        $xmldata .= '<item item_url="' . $data['src'] . '" link="' . $data['url'] . '" />';
    }
    $xmldata .= '</bcaster>';
    file_put_contents($data_file, $xmldata);
    return true;
}

?>