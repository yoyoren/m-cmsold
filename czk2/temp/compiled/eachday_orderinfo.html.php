<!-- $Id: eachday_count.htm  2013-11-30 02:27:21Z testxufengli $ -->
<?php if ($this->_var['full_page']): ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?></h1>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start user_bonus list -->
<div class="list-div" id="listDiv">
<?php endif; ?>
<!--if $act='order_list'-->
<div>
<form action="" method="post" name="listForm" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日期：<input type="text" name="date" id="date" value='<?php echo $this->_var['date']; ?>' size="20" onclick="return showCalendar('date', '%Y-%m-%d', false, false, 'date');">&nbsp;&nbsp;&nbsp;
      <input type="submit" value="搜索">
  <table cellpadding="3" cellspacing="1">
    <tr>
      <th width="50">订单号</th> 
      <th>商品名称</th>
      <th>商品磅重</th>
      <th>商品数量</th>
      <th>礼金卡</th>
      <th>现金券</th>
      <th>蛋糕折后金额</th>
      <th>已支付款额</th>
      <th>未支付款额</th>
      <th>支付类型</th>
      <th>备注</th>
      <th>配送日期</th>
    </tr>
    <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
    <tr>
      <td><?php echo $this->_var['order']['order_sn']; ?></td>       
      <td><?php echo $this->_var['order']['goods_name']; ?></td>
      <td><?php echo $this->_var['order']['goods_attr']; ?></td>
      <td><?php echo $this->_var['order']['goods_number']; ?></td>
      <td><?php echo $this->_var['order']['surplus']; ?></td>
      <td><?php echo $this->_var['order']['bonus']; ?></td>
      <td><?php echo $this->_var['order']['goods_amount']; ?></td>
      <td><?php echo $this->_var['order']['money_paid']; ?></td>
      <td><?php echo $this->_var['order']['order_amount']; ?></td>
      <td><?php echo $this->_var['order']['pay_name']; ?></td>
      <td><?php echo $this->_var['order']['pay_note']; ?></td>
      <td><?php echo $this->_var['order']['best_time']; ?></td> 
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="11"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>
  <!--/if-->
<?php if ($this->_var['full_page']): ?>


</form>
</div>
</div>
<!-- end user_bonus list -->
<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "query";
  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
    // 开始检查订单
    startCheckOrder();
    document.forms['listForm'].reset();
  }
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>