<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js,datepicker/WdatePicker.js')); ?>
<div class="text_title">
<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
<?php if ($this->_var['action']): ?>
<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
<?php endif; ?>
<div style="clear:both"></div>
</div>


<div class="form-div">
  <form action="javascript:searchOrder()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    日期<input name="bdate" type="text" value="<?php echo $this->_var['filter']['bdate']; ?>" onClick="javascript:WdatePicker()" readonly="true" size="10">&nbsp;&nbsp;
    <input type="submit" value="搜索" class="button" class="button" />
  </form>
</div>

<div id="listDiv" class="list-div">
<?php endif; ?>
<table cellspacing='1' cellpadding='3' id="table" width="100%">
	<tr id="attr">
		<th colspan="2">&nbsp;</th>
		<th>0.25磅</th>
		<th>1.0磅</th>
		<th>1.5磅</th>
		<th>2.0磅</th>
		<th>3.0磅</th>
		<th>5.0磅</th>
		<th>订单量</th>
		<th>商品量</th>
		<th>总磅重</th>
		<th>环外配送费</th>
	</tr>
	<tr bgcolor="#ffffff">
		<td rowspan="<?php echo $this->_var['list']['rowspan']; ?>" width="60px"><?php if ($this->_var['list']['station']): ?><?php echo $this->_var['list']['station']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<?php $_from = $this->_var['list']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'clist');if (count($_from)):
    foreach ($_from AS $this->_var['clist']):
?>
			<td width="50px"><?php if ($this->_var['clist']['name']): ?><?php echo $this->_var['clist']['name']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['p25']): ?><?php echo $this->_var['clist']['p25']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['p10']): ?><?php echo $this->_var['clist']['p10']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['p15']): ?><?php echo $this->_var['clist']['p15']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['p20']): ?><?php echo $this->_var['clist']['p20']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['p30']): ?><?php echo $this->_var['clist']['p30']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['p50']): ?><?php echo $this->_var['clist']['p50']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td  align="right"><?php if ($this->_var['clist']['orders']): ?><?php echo $this->_var['clist']['orders']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['goods']): ?><?php echo $this->_var['clist']['goods']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['sums']): ?><?php echo $this->_var['clist']['sums']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
			<td align="right"><?php if ($this->_var['clist']['fee'] > 0): ?><?php echo $this->_var['clist']['fee']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		</tr>
		<tr bgcolor="#ffffff">
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
		<td>小计</td>
		<td align="right"><?php if ($this->_var['list']['turn1_025_x']): ?><?php echo $this->_var['list']['turn1_025_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['turn1_1_x']): ?><?php echo $this->_var['list']['turn1_1_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['turn1_15_x']): ?><?php echo $this->_var['list']['turn1_15_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['turn1_2_x']): ?><?php echo $this->_var['list']['turn1_2_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['turn1_3_x']): ?><?php echo $this->_var['list']['turn1_3_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['turn1_5_x']): ?><?php echo $this->_var['list']['turn1_5_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['turn1_ocount_x']): ?><?php echo $this->_var['list']['turn1_ocount_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['turn1_gcount_x']): ?><?php echo $this->_var['list']['turn1_gcount_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['total_p_x']): ?><?php echo $this->_var['list']['total_p_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
		<td align="right"><?php if ($this->_var['list']['shipping_fee_x']): ?><?php echo $this->_var['list']['shipping_fee_x']; ?><?php else: ?>&nbsp;<?php endif; ?></td>
	</tr>
	<tr bgcolor="#ffffff">
		<td colspan="18" align="left" ><br />每日在结算完毕后把提成数据导入到数据库中，就可以在提成查询中查询时间段的提成数据
		<br /><span style="margin-left:700px">&nbsp;</span><a href="shipping_commission.php?act=list&reset=1">导入数据></a></td>
	</tr>
</table>
<?php if ($this->_var['full_page']): ?>
</div>
<script language="JavaScript">

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
/**
* 搜索订单
*/
function searchOrder()
{
		listTable.filter['bdate']    = Utils.trim(document.forms['searchForm'].elements['bdate'].value);
        listTable.loadList();
}
</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>