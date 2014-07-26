<?php

/**
 * ECSHOP
 * ============================================================================
 * 版权所有 (C) 2005-2008 康盛创想（北京）科技有限公司，并保留所有权利。
 * 网站地址: http://www.ecshop.com；http://www.comsenz.com
 * ----------------------------------------------------------------------------
 * 这不是一个自由软件！您只能在不用于商业目的的前提下对程序代码进行修改和
 * 使用；不允许对程序代码以任何形式任何目的的再发布。
 * ============================================================================
 * @author:     wj                 <wjzhangq@126.com>
 * @version:    v2.x
 * ---------------------------------------------
 * $Author: testyang $
 * $Id: goods_export.php 14481 2008-04-18 11:23:01Z testyang $
*/


$_LANG['export_taobao'] = '导出淘宝助理支持数据格式';
$_LANG['good_cat'] = '商品分类';
$_LANG['select_please'] = '请选择要导出的分类';
$_LANG['select_charset'] = '请选择要导出的编码';

$_LANG['goods_class'] = '宝贝栏目ID';
$_LANG['tabobao_shipping'] = '淘宝配送';
$_LANG['post_express'] = '平邮价格';
$_LANG['express'] = '快递价格';
$_LANG['ems'] = 'EMS价格';
$_LANG['notice_goods_class'] = '宝贝栏目ID为淘宝分类的ID，如若不确定，请填写0';

$_LANG['post_express_not_null'] = '平邮价格必须大于0';
$_LANG['express_not_null'] = '快递价格必须大于0';
$_LANG['ems_not_null'] = 'EMS价格必须大于0';


/* 淘宝 */
$_LANG['taobao']['goods_name'] = '宝贝名称';
$_LANG['taobao']['goods_class'] = '宝贝类目';
$_LANG['taobao']['shop_class'] = '店铺类目';
$_LANG['taobao']['new_level'] = '新旧程度';
$_LANG['taobao']['province'] = '省';
$_LANG['taobao']['city'] = '城市';
$_LANG['taobao']['sell_type'] = '出售方式';
$_LANG['taobao']['shop_price'] = '宝贝价格';
$_LANG['taobao']['add_price'] = '加价幅度';
$_LANG['taobao']['goods_number'] = '宝贝数量';
$_LANG['taobao']['die_day'] = '有效期';
$_LANG['taobao']['load_type'] = '运费承担';
$_LANG['taobao']['post_express'] = '平邮';
$_LANG['taobao']['ems'] = 'EMS';
$_LANG['taobao']['express'] = '快递';
$_LANG['taobao']['pay_type'] = '付款方式';
$_LANG['taobao']['allow_alipay'] = '支付宝';
$_LANG['taobao']['invoice'] = '发票';
$_LANG['taobao']['repair'] = '保修';
$_LANG['taobao']['resend'] = '自动重发';
$_LANG['taobao']['is_store'] = '放入仓库';
$_LANG['taobao']['window'] = '橱窗推荐';
$_LANG['taobao']['add_time'] = '发布时间';
$_LANG['taobao']['story'] = '心情故事';
$_LANG['taobao']['goods_desc'] = '宝贝描述';
$_LANG['taobao']['goods_img'] = '宝贝图片';
$_LANG['taobao']['goods_attr'] = '宝贝属性';
$_LANG['taobao']['group_buy'] = '团购价';
$_LANG['taobao']['group_buy_num'] = '最小团购件数';
$_LANG['taobao']['template'] = '邮费模版ID';
$_LANG['taobao']['discount'] = '会员打折';
$_LANG['taobao']['modify_time'] = '修改时间';
$_LANG['taobao']['upload_status'] = '上传状态';
$_LANG['taobao']['img_status'] = '图片状态';


$_LANG['export_paipai'] = '导出到拍拍助理支持数据格式';
$_LANG['paipai']['id'] = 'id';
$_LANG['paipai']['tree_node_id'] = 'tree_node_id';
$_LANG['paipai']['old_tree_node_id'] = 'old_tree_node_id';
$_LANG['paipai']['title'] = 'title';
$_LANG['paipai']['id_in_web'] = 'id_in_web';
$_LANG['paipai']['auctionType'] = 'auctionType';
$_LANG['paipai']['category'] = 'category';
$_LANG['paipai']['shopCategoryId'] = 'shopCategoryId';
$_LANG['paipai']['pictURL'] = 'pictURL';
$_LANG['paipai']['quantity'] = 'quantity';
$_LANG['paipai']['duration'] = 'duration';
$_LANG['paipai']['startDate'] = 'startDate';
$_LANG['paipai']['stuffStatus'] = 'stuffStatus';
$_LANG['paipai']['price'] = 'price';
$_LANG['paipai']['increment'] = 'increment';
$_LANG['paipai']['prov'] = 'prov';
$_LANG['paipai']['city'] = 'city';
$_LANG['paipai']['shippingOption'] = 'shippingOption';
$_LANG['paipai']['ordinaryPostFee'] = 'ordinaryPostFee';
$_LANG['paipai']['fastPostFee'] = 'fastPostFee';
$_LANG['paipai']['paymentOption'] = 'paymentOption';
$_LANG['paipai']['haveInvoice'] = 'haveInvoice';
$_LANG['paipai']['haveGuarantee'] = 'haveGuarantee';
$_LANG['paipai']['secureTradeAgree'] = 'secureTradeAgree';
$_LANG['paipai']['autoRepost'] = 'autoRepost';
$_LANG['paipai']['shopWindow'] = 'shopWindow';
$_LANG['paipai']['failed_reason'] = 'failed_reason';
$_LANG['paipai']['pic_size'] = 'pic_size';
$_LANG['paipai']['pic_filename'] = 'pic_filename';
$_LANG['paipai']['pic'] = 'pic';
$_LANG['paipai']['description'] = 'description';
$_LANG['paipai']['story'] = 'story';
$_LANG['paipai']['putStore'] = 'putStore';
$_LANG['paipai']['pic_width'] = 'pic_width';
$_LANG['paipai']['pic_height'] = 'pic_height';
$_LANG['paipai']['skin'] = 'skin';
$_LANG['paipai']['prop'] = 'prop';

// 批量上传商品的字段
$_LANG['export_ecshop'] = '导出到ECShop数据格式';
$_LANG['ecshop']['goods_name'] = '商品名称';
$_LANG['ecshop']['goods_sn'] = '商品货号';
$_LANG['ecshop']['brand_name'] = '商品品牌';   // 需要转换成brand_id
$_LANG['ecshop']['market_price'] = '市场售价';
$_LANG['ecshop']['shop_price'] = '本店售价';
$_LANG['ecshop']['integral'] = '积分购买额度';
$_LANG['ecshop']['original_img'] = '商品原始图';
$_LANG['ecshop']['goods_img'] = '商品图片';
$_LANG['ecshop']['goods_thumb'] = '商品缩略图';
$_LANG['ecshop']['keywords'] = '商品关键词';
$_LANG['ecshop']['goods_brief'] = '简单描述';
$_LANG['ecshop']['goods_desc'] = '详细描述';
$_LANG['ecshop']['goods_weight'] = '商品重量（kg）';
$_LANG['ecshop']['goods_number'] = '库存数量';
$_LANG['ecshop']['warn_number'] = '库存警告数量';
$_LANG['ecshop']['is_best'] = '是否精品';
$_LANG['ecshop']['is_new'] = '是否新品';
$_LANG['ecshop']['is_hot'] = '是否热销';
$_LANG['ecshop']['is_on_sale'] = '是否上架';
$_LANG['ecshop']['is_alone_sale'] = '能否作为普通商品销售';
$_LANG['ecshop']['is_real'] = '是否实体商品';

?>
