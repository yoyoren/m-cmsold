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
<div class="form-div" >
<form action="javascript:searchOrder()" name="searchForm" method="post" >
 <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
 组别
 <select name="city_group">
 	<option value="0" >请选择</option>
 	<?php $_from = $this->_var['city_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'c');if (count($_from)):
    foreach ($_from AS $this->_var['c']):
?>
 	<option value ="<?php echo $this->_var['c']['city_code']; ?>" ><?php echo $this->_var['c']['city_name']; ?>组</option>
 	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
 </select>
 <input type="submit" name="sub" class="button" value="搜索" />
</form>
</div>

<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellspacing='1' cellpadding='3' id='list-table' width="100%">
  <tr>
   	<th width="15%">ID</th>
   	<th width="30%">城市</th>
   	<th width="30%">组别</th>
   	<th width="">操作</th>
   	

  </tr>
  <?php $_from = $this->_var['city_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
<tr bgcolor="#ffffff" title="<?php echo $this->_var['list']['address']; ?>" onMouseover="this.style.backgroundColor='#e9f6f8'" onMouseout="this.style.backgroundColor=''" id="trList">
  	<td align="center"><?php echo $this->_var['list']['id']; ?></td>
  	<td align="center"><?php echo $this->_var['list']['city_name']; ?></td>
  	<td align="center"><?php echo $this->_var['list']['city_group']; ?>组</td>
  	<td align="center"><a href='city.php?act=editcity&id=<?php echo $this->_var['list']['id']; ?>' >编辑 </a>　<a href='javascript:;' onclick="listTable.remove('<?php echo $this->_var['list']['id']; ?>','确认删除吗？','deletecity')" >删除 </a></td>

  </tr>
  <?php endforeach; else: ?>
  <tr bgcolor="#ffffff"><td class="no-records" colspan="11">没有记录！</td></tr>
  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<table id="page-table" bgcolor="#ffffff" cellspacing="0" width="100%">
  <tr >
    <td align="center"  nowrap="true">
    <?php echo $this->fetch('page.htm'); ?>
    </td>
  </tr>
</table>
<?php if ($this->_var['full_page']): ?>
  </div>


<script language="JavaScript"><!--
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;



function searchOrder(){
	listTable.filter['city_group'] = Utils.trim(document.forms['searchForm'].elements['city_group'].value);
	listTable.filter['page'] = 1;
	listTable.loadList();
}
--></script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>