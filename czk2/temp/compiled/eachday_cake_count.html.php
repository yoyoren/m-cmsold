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
<form action="eachday_count.php?act=cake_count" method="post" name="listForm" >
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;日期：<input type="text" name="date" id="date" value='<?php echo $this->_var['date']; ?>' size="20" onclick="return showCalendar('date', '%Y-%m-%d', false, false, 'date');">&nbsp;&nbsp;&nbsp;
      <input type="submit" value="搜索">
</div>
  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>交易方式</th>
      <th>礼金卡</th>
      <th>正常支付</th>
      <th>月结</th>
      <th>促销活动</th>
      <th>销售赠送</th>
      <th>公司赠送</th>
      <th>市场活动</th>
      <th>市场活动--mini</th>
    </tr>
    <?php if ($this->_var['count'] != ""): ?>
    <tr align="center">
      <td>各交易方式订购蛋糕数：</td>       
      <td><?php echo $this->_var['count']['ljk']; ?></td>
      <td><?php echo $this->_var['count']['normal']; ?></td>
      <td><?php echo $this->_var['count']['yuejie']; ?></td>
      <td><?php echo $this->_var['count']['cuxiao']; ?></td>
      <td><?php echo $this->_var['count']['xshd']; ?></td>
      <td><?php echo $this->_var['count']['gszs']; ?></td>
      <td><?php echo $this->_var['count']['schd']; ?></td>
      <td><?php echo $this->_var['count']['scmini']; ?></td>
    </tr>
    <?php else: ?>
    <tr align="center">
      <td colspan='9'>请输入时间进行查询！</td>  
    </tr>
    <?php endif; ?>
  </table>

  <!--/if-->
<?php if ($this->_var['full_page']): ?>
</div>
</form>
<!-- end user_bonus list -->
<!--/*<script type="text/javascript" language="JavaScript">
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
  
</script>*/-->
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>