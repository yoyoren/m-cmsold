<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js,datepicker/WdatePicker.js')); ?>

<div class="text_title">
	<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
	<?php if ($this->_var['action_link']): ?>
	<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
	<?php endif; ?>
	<div style="clear:both"></div>
</div>

<div class="form-div">
  <form action="javascript:searchOrder()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    日期<input name="bdate" type="text" value="<?php echo $this->_var['filter']['bdate']; ?>" onClick="javascript:WdatePicker()" readonly="true" size="10">&nbsp;&nbsp;
	城市<select name="city" >
		<option value="">全部</option>
			<?php echo $this->html_options(array('options'=>$this->_var['city_arr'])); ?>
		</select>
	配送批次<select name="turn">
	       <option value="">全部</option>
		   <?php echo $this->html_options(array('options'=>$this->_var['timeplan'])); ?>
	    </select>
    <input type="submit" value="搜索" class="button" class="button" />
  </form>
</div>

<div id="listDiv" class="list-div">
<?php endif; ?>
<table cellspacing='1' cellpadding='3' id="table" width="100%">
	<tr id="attr">
		<th>配送站</th>
		<th>蛋糕</th>

		<th>数量</th>
	</tr>

	
		
	   <?php $_from = $this->_var['list']['ch']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'clist');if (count($_from)):
    foreach ($_from AS $this->_var['clist']):
?>
		
	   <tr bgcolor="#ffffff">
		 <td width="25%" align="center"><?php if ($this->_var['clist']['station_name'] == ''): ?>未分站<?php endif; ?><?php echo $this->_var['clist']['station_name']; ?></td>
		  <td width="25%" align="center" ><?php echo $this->_var['clist']['goods_name']; ?></td>

		  <td align="center"><?php echo $this->_var['clist']['goods_sum']; ?></td>
	
		  
	   </tr>
	   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	   <tr bgcolor="#ffffff"><td colspan="2" align="right">合计</td><td align="center"><?php echo $this->_var['list']['totalc']; ?></td></tr>

	<tr bgcolor="#ffffff">
		<td colspan="3" align="left" style="font-size:16px; "><br />本处只提供即时的当日及今日以后的数据</td>
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
		listTable.filter['bdate']   = Utils.trim(document.forms['searchForm'].elements['bdate'].value);
		listTable.filter['city']   = Utils.trim(document.forms['searchForm'].elements['city'].value);
		//alert(listTable.filter['city']);
		listTable.filter['turn']    = Utils.trim(document.forms['searchForm'].elements['turn'].value);
        listTable.loadList();
}
function search_taihu(){

	listTable.query = "taihu";
	listTable.filter['bdate']   = Utils.trim(document.forms['searchForm'].elements['bdate'].value);
	listTable.filter['turn']    = Utils.trim(document.forms['searchForm'].elements['turn'].value);
    listTable.loadList();
	
}
</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>