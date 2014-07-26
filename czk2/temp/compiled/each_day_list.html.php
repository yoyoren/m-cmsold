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
<div>
<form action="" method="post" name="listForm" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;订购日期：<input type="text" name="odate" id="odate" value='<?php echo $this->_var['odate']; ?>' size="20" onfocus="clearadate()"  onclick="return showCalendar('odate', '%Y-%m-%d', false, false, 'odate');">&nbsp;&nbsp;&nbsp;配送日期：<input type="text" name="adate" id="adate" value='<?php echo $this->_var['adate']; ?>' size="20" onfocus="clearodate()" onclick="return showCalendar('adate', '%Y-%m-%d', false, false, 'adate');"  >&nbsp;&nbsp;&nbsp;
      <input type="submit" value="搜索">

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th width="50">订单号</th>
      <th>客服工号</th>
      <th>订货人</th>
      <th>订货电话</th>
      <th>收货人</th>
      <th>收货电话</th>
      <th>送货地址</th>
      <th>商品名称</th>
      <th>商品磅重</th>
      <th>商品数量</th>
      <th>应收金额</th>
      <th>支付类型</th>
      <th>支付备注</th>
      <th>备注</th>
      <th>订购日期</th>
      <th>时间</th>
      <th>配送日期</th>
      <th>时间</th>
    </tr>
    <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'order');if (count($_from)):
    foreach ($_from AS $this->_var['order']):
?>
    <tr>
      <td><?php echo $this->_var['order']['order_sn']; ?></td> 
      <td><?php echo $this->_var['order']['kfgh']; ?></td>  
      <td><?php echo $this->_var['order']['orderman']; ?></td>
      <td><?php echo $this->_var['order']['ordertel']; ?></td>
      <td><?php echo $this->_var['order']['consignee']; ?></td>
      <td><?php echo $this->_var['order']['mobile']; ?></td>
      <td><?php echo $this->_var['order']['address']; ?></td>     
      <td><?php echo $this->_var['order']['goods_name']; ?></td>
      <td><?php echo $this->_var['order']['goods_attr']; ?></td>
      <td><?php echo $this->_var['order']['goods_number']; ?></td>
      <td><?php echo $this->_var['order']['order_amount']; ?></td>
      <td><?php echo $this->_var['order']['pay_name']; ?></td>
      <td><?php echo $this->_var['order']['pay_note']; ?></td>
      <td><?php echo $this->_var['order']['wsts']; ?></td>
      <td><?php echo $this->_var['order']['confirmtime']; ?></td> 
      <td><?php echo $this->_var['order']['confirmtime1']; ?></td> 
      <td><?php echo $this->_var['order']['best_time2']; ?></td> 
      <td><?php echo $this->_var['order']['best_time1']; ?></td> 
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="17"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>
<?php if ($this->_var['full_page']): ?>

</form>
</div>
</div>
<!-- end user_bonus list -->
<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "eachquery";
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
<script type="text/javascript" language="JavaScript">

function clearodate()
{ 
		document.getElementById("odate").value="";
}
function clearadate()
{ 
		document.getElementById("adate").value="";
}
 
 </script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>