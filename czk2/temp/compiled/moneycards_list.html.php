<!-- $Id: bonus_list.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<form method="POST" action="" name="listForm">
<!-- start user_bonus list -->
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th width="50">编号</th> 
      <th>礼金卡描述</th>
      <th>面值</th>
      <th>卡片序列号</th>
      <th>卡片密码</th>
      <th>使用起始日期</th>
      <th>使用失效日期</a></th>
      <th>状态</th>
      <th>生效人</th>
      <th>生效日期</th>
      <th>使用会员</th>
      <th>会员电话</th>
      <th>使用时间</th>
      <th>操作</th>
    </tr>
    <?php $_from = $this->_var['moneycards_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'moneycard');if (count($_from)):
    foreach ($_from AS $this->_var['moneycard']):
?>
    <tr>
      <td><?php echo $this->_var['moneycard']['mcs_id']; ?></td>       
      <td><?php echo $this->_var['moneycard']['mc_name']; ?></td>
      <td><?php echo $this->_var['moneycard']['cardmoney']; ?></td>
      <td><?php echo $this->_var['moneycard']['cardid']; ?></td>
      <td><?php echo $this->_var['moneycard']['cardpassword']; ?></td>
      <td><?php echo $this->_var['moneycard']['sdate']; ?></td>
      <td><?php echo $this->_var['moneycard']['edate']; ?></td>
      <td><?php if ($this->_var['moneycard']['flag'] == 0): ?>待生效<?php else: ?>已生效<?php endif; ?></td>
      <td><?php echo $this->_var['moneycard']['aname']; ?></td>
      <td><?php echo $this->_var['moneycard']['adate']; ?></td>
      <td><?php echo $this->_var['moneycard']['user_name']; ?></td> 
      <td><?php echo $this->_var['moneycard']['mobile_phone']; ?></td> 
      <td align="center"><?php echo $this->_var['moneycard']['used_time']; ?></td> 
      <td align="center"><?php if ($this->_var['admin_name'] == "caiwu"): ?>----<?php else: ?><?php if ($this->_var['moneycard']['flag'] == 0): ?><input type="button" id="del_card" onclick="delCard(<?php echo $this->_var['moneycard']['mcs_id']; ?>)" value="作废"><?php else: ?>----<?php endif; ?><?php endif; ?></td>
    </tr>
    <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="14"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
    <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
  </table>

  <table cellpadding="4" cellspacing="0">
    <tr>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table>
<?php if ($this->_var['full_page']): ?>
</div>
<!-- end user_bonus list -->
</form>
 
<script type="text/javascript" language="JavaScript">
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "query_moneycards";

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
 /* onload = function()
  {
    // 开始检查订单
    startCheckOrder();
    document.forms['listForm'].reset();
  }*/
  function delCard(mcs_id)
	{
		 if(confirm("确定要删除礼金卡"+mcs_id+"?"))
		 {
			  Ajax.call("moneycard1.php", "act=del&mcs_id="+mcs_id, del_check, "GET", "JSON");
		 }
	
	}
	
	function del_check(result){
	if(result)
	{
		listTable.gotoPage($('#gotoPage').value);
		}
		else{
			alert("礼金卡作废失败！");
		}
	}
  
</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>