<?php

/**
 * ECSHOP 管理中心商品相关函数
 * ============================================================================
 * 版权所有 (C) 2005-2008 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；http://www.comsenz.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * $Author: testyang $
 * $Id: lib_goods.php 14481 2008-04-18 11:23:01Z testyang $
 */

if (!defined('IN_ECS'))
{
    die('Hacking attempt');
}

/**
 * 取得推荐类型列表
 * @return  array   推荐类型列表
 */
function get_intro_list()
{
    return array(
        'is_best'    => $GLOBALS['_LANG']['is_best'],
        'is_new'     => $GLOBALS['_LANG']['is_new'],
        'is_hot'     => $GLOBALS['_LANG']['is_hot'],
        'is_promote' => $GLOBALS['_LANG']['is_promote'],
    );
}

/**
 * 取得重量单位列表
 * @return  array   重量单位列表
 */
function get_unit_list()
{
    return array(
        '1'     => $GLOBALS['_LANG']['unit_kg'],
        '0.001' => $GLOBALS['_LANG']['unit_g'],
    );
}

/**
 * 取得会员等级列表
 * @return  array   会员等级列表
 */
function get_user_rank_list()
{
    $sql = "SELECT * FROM " . $GLOBALS['ecs']->table('user_rank') .
           " ORDER BY min_points";

    return $GLOBALS['db']->getAll($sql);
}

/**
 * 取得某商品的会员价格列表
 * @param   int     $goods_id   商品编号
 * @return  array   会员价格列表 user_rank => user_price
 */
function get_member_price_list($goods_id)
{
    /* 取得会员价格 */
    $price_list = array();
    $sql = "SELECT user_rank, user_price FROM " .
           $GLOBALS['ecs']->table('member_price') .
           " WHERE goods_id = '$goods_id'";
    $res = $GLOBALS['db']->query($sql);
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        $price_list[$row['user_rank']] = $row['user_price'];
    }

    return $price_list;
}

/**
 * 插入或更新商品属性
 * @param   int     $goods_id       商品编号
 * @param   array   $id_list        属性编号数组
 * @param   array   $is_spec_list   是否规格数组 'true' | 'false'
 * @param   array   $value_price_list   属性值数组
 */
function handle_goods_attr($goods_id, $id_list, $is_spec_list, $value_price_list)
{
    /* 循环处理每个属性 */
    foreach ($id_list AS $key => $id)
    {
        $is_spec = $is_spec_list[$key];
        if ($is_spec == 'false')
        {
            $value = $value_price_list[$key];
            $price = '';
        }
        else
        {
            $value_list = array();
            $price_list = array();
            if ($value_price_list[$key])
            {
                $vp_list = explode(chr(13), $value_price_list[$key]);
                foreach ($vp_list AS $v_p)
                {
                    $arr = explode(chr(9), $v_p);
                    $value_list[] = $arr[0];
                    $price_list[] = $arr[1];
                }
            }
            $value = join(chr(13), $value_list);
            $price = join(chr(13), $price_list);
        }

        // 插入或更新记录
        $sql = "SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('goods_attr') . " WHERE goods_id = '$goods_id' AND attr_id = '$id'";
        if ($GLOBALS['db']->getOne($sql) > 0)
        {
            $sql = "UPDATE " . $GLOBALS['ecs']->table('goods_attr') . " SET " .
                    "attr_value = '$value', " .
                    "attr_price = '$price' " .
                    "WHERE goods_id = '$goods_id' " .
                    "AND attr_id = '$id' LIMIT 1";
        }
        else
        {
            $sql = "INSERT INTO " . $GLOBALS['ecs']->table('goods_attr') . " (goods_id, attr_id, attr_value, attr_price) " .
                    "VALUES ('$goods_id', '$id', '$value', '$price')";
        }
        $GLOBALS['db']->query($sql);
    }
}

/**
 * 保存某商品的会员价格
 * @param   int     $goods_id   商品编号
 * @param   array   $rank_list  等级列表
 * @param   array   $price_list 价格列表
 * @return  void
 */
function handle_member_price($goods_id, $rank_list, $price_list)
{
    /* 循环处理每个会员等级 */
    foreach ($rank_list AS $key => $rank)
    {
        /* 会员等级对应的价格 */
        $price = $price_list[$key];

        // 插入或更新记录
        $sql = "SELECT COUNT(*) FROM " . $GLOBALS['ecs']->table('member_price') .
               " WHERE goods_id = '$goods_id' AND user_rank = '$rank'";
        if ($GLOBALS['db']->getOne($sql) > 0)
        {
            /* 如果会员价格是小于0则删除原来价格，不是则更新为新的价格 */
            if ($price < 0)
            {
                $sql = "DELETE FROM " . $GLOBALS['ecs']->table('member_price') .
                       " WHERE goods_id = '$goods_id' AND user_rank = '$rank' LIMIT 1";
            }
            else
            {
                $sql = "UPDATE " . $GLOBALS['ecs']->table('member_price') .
                       " SET user_price = '$price' " .
                       "WHERE goods_id = '$goods_id' " .
                       "AND user_rank = '$rank' LIMIT 1";
            }
        }
        else
        {
            if ($price == -1)
            {
                $sql = '';
            }
            else
            {
                $sql = "INSERT INTO " . $GLOBALS['ecs']->table('member_price') . " (goods_id, user_rank, user_price) " .
                       "VALUES ('$goods_id', '$rank', '$price')";
            }
        }

        if ($sql)
        {
            $GLOBALS['db']->query($sql);
        }
    }
}

/**
 * 保存某商品的扩展分类
 * @param   int     $goods_id   商品编号
 * @param   array   $cat_list   分类编号数组
 * @return  void
 */
function handle_other_cat($goods_id, $cat_list)
{
    /* 查询现有的扩展分类 */
    $sql = "SELECT cat_id FROM " . $GLOBALS['ecs']->table('goods_cat') .
            " WHERE goods_id = '$goods_id'";
    $exist_list = $GLOBALS['db']->getCol($sql);

    /* 删除不再有的分类 */
    $delete_list = array_diff($exist_list, $cat_list);
    if ($delete_list)
    {
        $sql = "DELETE FROM " . $GLOBALS['ecs']->table('goods_cat') .
                " WHERE goods_id = '$goods_id' " .
                "AND cat_id " . db_create_in($delete_list);
        $GLOBALS['db']->query($sql);
    }

    /* 添加新加的分类 */
    $add_list = array_diff($cat_list, $exist_list, array(0));
    foreach ($add_list AS $cat_id)
    {
        // 插入记录
        $sql = "INSERT INTO " . $GLOBALS['ecs']->table('goods_cat') .
                " (goods_id, cat_id) " .
                "VALUES ('$goods_id', '$cat_id')";
        $GLOBALS['db']->query($sql);
    }
}

/**
 * 保存某商品的关联商品
 * @param   int     $goods_id
 * @return  void
 */
function handle_link_goods($goods_id)
{
    $sql = "UPDATE " . $GLOBALS['ecs']->table('link_goods') . " SET " .
            " goods_id = '$goods_id' " .
            " WHERE goods_id = '0'" .
            " AND admin_id = '$_SESSION[admin_id]'";
    $GLOBALS['db']->query($sql);

    $sql = "UPDATE " . $GLOBALS['ecs']->table('link_goods') . " SET " .
            " link_goods_id = '$goods_id' " .
            " WHERE link_goods_id = '0'" .
            " AND admin_id = '$_SESSION[admin_id]'";
    $GLOBALS['db']->query($sql);
}

/**
 * 保存某商品的配件
 * @param   int     $goods_id
 * @return  void
 */
function handle_group_goods($goods_id)
{
    $sql = "UPDATE " . $GLOBALS['ecs']->table('group_goods') . " SET " .
            " parent_id = '$goods_id' " .
            " WHERE parent_id = '0'" .
            " AND admin_id = '$_SESSION[admin_id]'";
    $GLOBALS['db']->query($sql);
}

/**
 * 保存某商品的关联文章
 * @param   int     $goods_id
 * @return  void
 */
function handle_goods_article($goods_id)
{
    $sql = "UPDATE " . $GLOBALS['ecs']->table('goods_article') . " SET " .
            " goods_id = '$goods_id' " .
            " WHERE goods_id = '0'" .
            " AND admin_id = '$_SESSION[admin_id]'";
    $GLOBALS['db']->query($sql);
}

/**
 * 保存某商品的相册图片
 * @param   int     $goods_id
 * @param   array   $image_files
 * @param   array   $image_descs
 * @return  void
 */
function handle_gallery_image($goods_id, $image_files, $image_descs)
{
    foreach ($image_descs AS $key => $img_desc)
    {
        /* 是否成功上传 */
        $flag = false;
        if (isset($image_files['error']))
        {
            if ($image_files['error'][$key] == 0)
            {
                $flag = true;
            }
        }
        else
        {
            if ($image_files['tmp_name'][$key] != 'none')
            {
                $flag = true;
            }
        }

        if ($flag)
        {
            // 生成缩略图
            $thumb_url = $GLOBALS['image']->make_thumb($image_files['tmp_name'][$key], $GLOBALS['_CFG']['thumb_width'],  $GLOBALS['_CFG']['thumb_height']);
            $thumb_url = is_string($thumb_url) ? $thumb_url : '';

            $upload = array(
                'name' => $image_files['name'][$key],
                'type' => $image_files['type'][$key],
                'tmp_name' => $image_files['tmp_name'][$key],
                'size' => $image_files['size'][$key],
            );
            if (isset($image_files['error']))
            {
                $upload['error'] = $image_files['error'][$key];
            }
            $img_original = $GLOBALS['image']->upload_image($upload);
            $img_url = $img_original;

            // 如果服务器支持GD 则添加水印
            if (gd_version() > 0)
            {
                $pos        = strpos(basename($img_original), '.');
                $newname    = dirname($img_original) . '/' . $GLOBALS['image']->random_filename() . substr(basename($img_original), $pos);
                copy('../' . $img_original, '../' . $newname);
                $img_url    = $newname;

                $GLOBALS['image']->add_watermark('../'.$img_url,'',$GLOBALS['_CFG']['watermark'], $GLOBALS['_CFG']['watermark_place'], $GLOBALS['_CFG']['watermark_alpha']);
            }

            $sql = "INSERT INTO " . $GLOBALS['ecs']->table('goods_gallery') . " (goods_id, img_url, img_desc, thumb_url, img_original) " .
                    "VALUES ('$goods_id', '$img_url', '$img_desc', '$thumb_url', '$img_original')";
            $GLOBALS['db']->query($sql);
        }
    }
}

/**
 * 修改商品某字段值
 * @param   string  $goods_id   商品编号，可以为多个，用 ',' 隔开
 * @param   string  $field      字段名
 * @param   string  $value      字段值
 * @return  bool
 */
function update_goods($goods_id, $field, $value)
{
    if ($goods_id)
    {
        /* 清除缓存 */
        clear_cache_files();

        $sql = "UPDATE " . $GLOBALS['ecs']->table('goods') .
                " SET $field = '$value' , last_update = '". gmtime() ."' " .
                "WHERE goods_id " . db_create_in($goods_id);

        return $GLOBALS['db']->query($sql);
    }
    else
    {
        return false;
    }
}

/**
 * 从回收站删除多个商品
 * @param   mix     $goods_id   商品id列表：可以逗号格开，也可以是数组
 * @return  void
 */
function delete_goods($goods_id)
{
    if (empty($goods_id))
    {
        return;
    }

    /* 取得有效商品id */
    $sql = "SELECT DISTINCT goods_id FROM " . $GLOBALS['ecs']->table('goods') .
            " WHERE goods_id " . db_create_in($goods_id) . " AND is_delete = 1";
    $goods_id = $GLOBALS['db']->getCol($sql);
    if (empty($goods_id))
    {
        return;
    }

    /* 删除商品图片和轮播图片文件 */
    $sql = "SELECT goods_thumb, goods_img, original_img " .
            "FROM " . $GLOBALS['ecs']->table('goods') .
            " WHERE goods_id " . db_create_in($goods_id);
    $res = $GLOBALS['db']->query($sql);
    while ($goods = $GLOBALS['db']->fetchRow($res))
    {
        if (!empty($goods['goods_thumb']))
        {
            @unlink('../' . $goods['goods_thumb']);
        }
        if (!empty($goods['goods_img']))
        {
            @unlink('../' . $goods['goods_img']);
        }
        if (!empty($goods['original_img']))
        {
            @unlink('../' . $goods['original_img']);
        }
    }

    /* 删除商品 */
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('goods') .
            " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);

    /* 删除商品相册的图片文件 */
    $sql = "SELECT img_url, thumb_url, img_original " .
            "FROM " . $GLOBALS['ecs']->table('goods_gallery') .
            " WHERE goods_id " . db_create_in($goods_id);
    $res = $GLOBALS['db']->query($sql);
    while ($row = $GLOBALS['db']->fetchRow($res))
    {
        if (!empty($row['img_url']))
        {
            @unlink('../' . $row['img_url']);
        }
        if (!empty($row['thumb_url']))
        {
            @unlink('../' . $row['thumb_url']);
        }
        if (!empty($row['img_original']))
        {
            @unlink('../' . $row['img_original']);
        }
    }

    /* 删除商品相册 */
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('goods_gallery') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);

    /* 删除相关表记录 */
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('collect_goods') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('goods_article') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('goods_attr') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('goods_cat') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('member_price') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('group_goods') . " WHERE parent_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('group_goods') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('link_goods') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('link_goods') . " WHERE link_goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('tag') . " WHERE goods_id " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('comment') . " WHERE comment_type = 0 AND id_value " . db_create_in($goods_id);
    $GLOBALS['db']->query($sql);

    /* 删除相应虚拟商品记录 */
    $sql = "DELETE FROM " . $GLOBALS['ecs']->table('virtual_card') . " WHERE goods_id " . db_create_in($goods_id);
    if (!$GLOBALS['db']->query($sql, 'SILENT') && $GLOBALS['db']->errno() != 1146)
    {
        die($GLOBALS['db']->error());
    }

    /* 清除缓存 */
    clear_cache_files();
}

/**
 * 为某商品生成唯一的货号
 * @param   int     $goods_id   商品编号
 * @return  string  唯一的货号
 */
function generate_goods_sn($goods_id)
{
    $goods_sn = $GLOBALS['_CFG']['sn_prefix'] . str_repeat('0', 6 - strlen($goods_id)) . $goods_id;

    $sql = "SELECT goods_sn FROM " . $GLOBALS['ecs']->table('goods') .
            " WHERE goods_sn LIKE '" . mysql_like_quote($goods_sn) . "%' AND goods_id <> '$goods_id' " .
            " ORDER BY LENGTH(goods_sn) DESC";
    $sn_list = $GLOBALS['db']->getCol($sql);
    if (in_array($goods_sn, $sn_list))
    {
        $max = pow(10, strlen($sn_list[0]) - strlen($goods_sn) + 1) - 1;
        $new_sn = $goods_sn . mt_rand(0, $max);
        while (in_array($new_sn, $sn_list))
        {
            $new_sn = $goods_sn . mt_rand(0, $max);
        }
        $goods_sn = $new_sn;
    }

    return $goods_sn;
}

/**
 * 取得通用属性和某分类的属性，以及某商品的属性值
 * @param   int     $cat_id     分类编号
 * @param   int     $goods_id   商品编号
 * @return  array   规格与属性列表
 */
function get_attr_list($cat_id, $goods_id = 0)
{
    if (empty($cat_id))
    {
        $sql = "SELECT cat_id FROM " .$GLOBALS['ecs']->table('goods_type'). " LIMIT 1";
        $cat_id = $GLOBALS['db']->getOne($sql);
    }

    // 查询属性值及商品的属性值
    $sql = "SELECT a.attr_id, a.attr_name, a.attr_input_type, a.attr_type, a.attr_values, v.attr_value, v.attr_price ".
            "FROM " .$GLOBALS['ecs']->table('attribute'). " AS a ".
            "LEFT JOIN " .$GLOBALS['ecs']->table('goods_attr'). " AS v ".
            "ON v.attr_id = a.attr_id AND v.goods_id = '$goods_id' ".
            "WHERE a.cat_id = " . intval($cat_id) ." OR a.cat_id = 0 ".
            "ORDER BY a.attr_type, a.attr_id, a.sort_order, v.attr_price, v.goods_attr_id";

    $row = $GLOBALS['db']->GetAll($sql);

    return $row;
}

/**
 * 根据属性数组创建属性的表单
 *
 * @access  public
 * @param   int     $cat_id     分类编号
 * @param   int     $goods_id   商品编号
 * @return  string
 */
function build_attr_html($cat_id, $goods_id = 0)
{
    $attr = get_attr_list($cat_id, $goods_id);
    $html = '<table width="100%" id="attrTable">';
    $spec = 0;

    foreach ($attr AS $key => $val)
    {
        $html .= "<tr><td class='label'>";
        if ($val['attr_type'] == 1)
        {
            $html .= ($spec != $val['attr_id']) ?
                "<a href='javascript:;' onclick='addSpec(this)'>[+]</a>" :
                "<a href='javascript:;' onclick='removeSpec(this)'>[-]</a>";
            $spec = $val['attr_id'];
        };

        $html .= "$val[attr_name]</td><td><input type='hidden' name='attr_id_list[]' value='$val[attr_id]' />";

        if ($val['attr_input_type'] == 0)
        {
            $html .= '<input name="attr_value_list[]" type="text" value="' .htmlspecialchars($val['attr_value']). '" size="40" /> ';
        }
        elseif ($val['attr_input_type'] == 2)
        {
            $html .= '<textarea name="attr_value_list[]" rows="3" cols="40">' .htmlspecialchars($val['attr_value']). '</textarea>';
        }
        else
        {
            $html .= '<select name="attr_value_list[]">';
            $html .= '<option value="">' .$GLOBALS['_LANG']['select_please']. '</option>';

            $attr_values = explode("\n", $val['attr_values']);

            foreach ($attr_values AS $opt)
            {
                $opt    = trim(htmlspecialchars($opt));

                $html   .= ($val['attr_value'] != $opt) ?
                    '<option value="' . $opt . '">' . $opt . '</option>' :
                    '<option value="' . $opt . '" selected="selected">' . $opt . '</option>';
            }
            $html .= '</select> ';
        }

        $html .= ($val['attr_type'] == 1) ?
            $GLOBALS['_LANG']['spec_price'].' <input type="text" name="attr_price_list[]" value="' . $val['attr_price'] . '" size="5" maxlength="10" />' :
            ' <input type="hidden" name="attr_price_list[]" value="0" />';

        $html .= '</td></tr>';
    }

    $html .= '</table>';

    return $html;
}

/**
 * 获得指定商品相关的商品
 *
 * @access  public
 * @param   integer $goods_id
 * @return  array
 */
function get_linked_goods($goods_id)
{
    $sql = "SELECT lg.link_goods_id AS goods_id, g.goods_name, lg.is_double " .
            "FROM " . $GLOBALS['ecs']->table('link_goods') . " AS lg, " .
                $GLOBALS['ecs']->table('goods') . " AS g " .
            "WHERE lg.goods_id = '$goods_id' " .
            "AND lg.link_goods_id = g.goods_id ";
    if ($goods_id == 0)
    {
        $sql .= " AND lg.admin_id = '$_SESSION[admin_id]'";
    }
    $row = $GLOBALS['db']->getAll($sql);

    foreach ($row AS $key => $val)
    {
        $linked_type = $val['is_double'] == 0 ? $GLOBALS['_LANG']['single'] : $GLOBALS['_LANG']['double'];

        $row[$key]['goods_name'] = $val['goods_name'] . " -- [$linked_type]";

        unset($row[$key]['is_double']);
    }

    return $row;
}

/**
 * 获得指定商品的配件
 *
 * @access  public
 * @param   integer $goods_id
 * @return  array
 */
function get_group_goods($goods_id)
{
    $sql = "SELECT gg.goods_id, CONCAT(g.goods_name, ' -- [', gg.goods_price, ']') AS goods_name " .
            "FROM " . $GLOBALS['ecs']->table('group_goods') . " AS gg, " .
                $GLOBALS['ecs']->table('goods') . " AS g " .
            "WHERE gg.parent_id = '$goods_id' " .
            "AND gg.goods_id = g.goods_id ";
    if ($goods_id == 0)
    {
        $sql .= " AND gg.admin_id = '$_SESSION[admin_id]'";
    }
    $row = $GLOBALS['db']->getAll($sql);

    return $row;
}

/**
 * 获得商品的关联文章
 *
 * @access  public
 * @param   integer $goods_id
 * @return  array
 */
function get_goods_articles($goods_id)
{
    $sql = "SELECT g.article_id, a.title " .
            "FROM " .$GLOBALS['ecs']->table('goods_article') . " AS g, " .
                $GLOBALS['ecs']->table('article') . " AS a " .
            "WHERE g.goods_id = '$goods_id' " .
            "AND g.article_id = a.article_id ";
    if ($goods_id == 0)
    {
        $sql .= " AND g.admin_id = '$_SESSION[admin_id]'";
    }
    $row = $GLOBALS['db']->getAll($sql);

    return $row;
}

/**
 * 获得商品列表
 *
 * @access  public
 * @params  integer $isdelete
 * @params  integer $real_goods
 * @return  array
 */
function goods_list($is_delete, $real_goods=1)
{
    /* 过滤条件 */
    $param_str = '-' . $is_delete . '-' . $real_goods;
    $result = get_filter($param_str);
    if ($result === false)
    {
        $day = getdate();
        $today = local_mktime(23, 59, 59, $day['mon'], $day['mday'], $day['year']);

        $filter['cat_id']           = empty($_REQUEST['cat_id']) ? 0 : intval($_REQUEST['cat_id']);
        $filter['intro_type']       = empty($_REQUEST['intro_type']) ? '' : trim($_REQUEST['intro_type']);
        $filter['is_promote']       = empty($_REQUEST['is_promote']) ? 0 : intval($_REQUEST['is_promote']);
        $filter['stock_warning']    = empty($_REQUEST['stock_warning']) ? 0 : intval($_REQUEST['stock_warning']);
        $filter['brand_id']         = empty($_REQUEST['brand_id']) ? 0 : intval($_REQUEST['brand_id']);
        $filter['keyword']          = empty($_REQUEST['keyword']) ? '' : trim($_REQUEST['keyword']);
        if ($_REQUEST['is_ajax'] == 1)
        {
            $filter['keyword'] = json_str_iconv($filter['keyword']);
        }
        $filter['sort_by']          = empty($_REQUEST['sort_by']) ? 'goods_id' : trim($_REQUEST['sort_by']);
        $filter['sort_order']       = empty($_REQUEST['sort_order']) ? 'DESC' : trim($_REQUEST['sort_order']);
        $filter['extension_code']   = empty($_REQUEST['extension_code']) ? '' : trim($_REQUEST['extension_code']);
        $filter['is_delete']        = $is_delete;
        $filter['real_goods']       = $real_goods;

        $where = $filter['cat_id'] > 0 ? " AND " . get_children($filter['cat_id']) : '';

        /* 推荐类型 */
        switch ($filter['intro_type'])
        {
            case 'is_best':
                $where .= " AND is_best=1";
                break;
            case 'is_hot':
                $where .= ' AND is_hot=1';
                break;
            case 'is_new':
                $where .= ' AND is_new=1';
                break;
            case 'is_promote':
                $where .= " AND is_promote = 1 AND promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today'";
        }

        /* 库存警告 */
        if ($filter['stock_warning'])
        {
            $where .= ' AND goods_number <= warn_number ';
        }

        /* 品牌 */
        if ($filter['brand_id'])
        {
            $where .= " AND brand_id='$filter[brand_id]'";
        }

        /* 扩展 */
        if ($filter['extension_code'])
        {
            $where .= " AND extension_code='$filter[extension_code]'";
        }

        /* 关键字 */
        if (!empty($filter['keyword']))
        {
            $where .= " AND (goods_sn LIKE '%" . mysql_like_quote($filter['keyword']) . "%' OR goods_name LIKE '%" . mysql_like_quote($filter['keyword']) . "%')";
        }

        if ($real_goods > -1)
        {
            $where .= " AND is_real='$real_goods'";
        }

        /* 记录总数 */
        $sql = "SELECT COUNT(*) FROM " .$GLOBALS['ecs']->table('goods'). " AS g WHERE is_delete='$is_delete' $where";
        $filter['record_count'] = $GLOBALS['db']->getOne($sql);

        /* 分页大小 */
        $filter = page_and_size($filter);

        $sql = "SELECT goods_id, goods_name, goods_sn, shop_price, is_on_sale, is_best, is_new, is_hot, goods_number, integral, " .
                    " (promote_price > 0 AND promote_start_date <= '$today' AND promote_end_date >= '$today') AS is_promote ".
                    " FROM " . $GLOBALS['ecs']->table('goods') . " AS g WHERE is_delete='$is_delete' $where" .
                    " ORDER BY $filter[sort_by] $filter[sort_order] ".
                    " LIMIT " . $filter['start'] . ",$filter[page_size]";

        $filter['keyword'] = stripslashes($filter['keyword']);
        set_filter($filter, $sql, $param_str);
    }
    else
    {
        $sql    = $result['sql'];
        $filter = $result['filter'];
    }
    $row = $GLOBALS['db']->getAll($sql);

    return array('goods' => $row, 'filter' => $filter, 'page_count' => $filter['page_count'], 'record_count' => $filter['record_count']);
}

?>