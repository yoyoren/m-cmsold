<!-- $Id: used_moneycards.htm  2013-11-30 02:27:21Z testxufengli $ -->
<?php if ($this->_var['full_page']): ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?></h1>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start used_moneycard list -->
<form action="moneycard1.php?act=used_card" method="post" name="listForm" >
<div class="list-div" id="listDiv">
<?php endif; ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;起始号段：<input type="text" name="scard" id="scard" value='<?php echo $this->_var['scard']; ?>' size="20">&nbsp;&nbsp;&nbsp;截止号段：<input type="text" name="ecard" id="ecard" value='<?php echo $this->_var['ecard']; ?>' size="20" >&nbsp;&nbsp;&nbsp;
      <input type="submit" value="搜索">

  <table cellpadding="3" cellspacing="1">
    <tr>		 		

      <th width="50">号段</th>
      <th>充值时间</th>
      <th>金额 </th>
      <th>姓名</th>
      <th>手机</th>
      <th>座机</th>
      <th>生效日期</th>
      <th>失效日期</th>
    </tr>
    <?php $_from = $this->_var['used_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'used');if (count($_from)):
    foreach ($_from AS $this->_var['used']):
?>
    <tr>
      <td><?php echo $this->_var['used']['cardid']; ?>&nbsp;</td> 
      <td><?php echo $this->_var['used']['usedtime1']; ?>&nbsp;</td>  
      <td><?php echo $this->_var['used']['cardmoney']; ?>&nbsp;</td>
      <td><?php echo $this->_var['used']['rea_name']; ?>&nbsp;</td>
      <td><?php echo $this->_var['used']['mobile_phone']; ?>&nbsp;</td>
      <td><?php echo $this->_var['used']['home_phone']; ?>&nbsp;</td>
      <td><?php echo $this->_var['used']['sdate1']; ?>&nbsp;</td>
      <td><?php echo $this->_var['used']['edate1']; ?>&nbsp;</td>     
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="7"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>
<?php if ($this->_var['full_page']): ?>

</div>
</form>
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
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>