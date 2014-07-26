<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js,datepicker/WdatePicker.js')); ?>
<div class="text_title">
<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
<div style="clear:both"></div>
</div>

<div class="form-div">
  <form action="javascript:searchOrder()" name="searchForm">
    <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
    起始日期<input name="sdate" type="text" id="sdate" value="<?php echo $this->_var['filter']['sdate']; ?>" onclick="javascript:WdatePicker()" readonly="true" size="10">
    截止日期<input name="edate" type="text" id="edate" value="<?php echo $this->_var['filter']['edate']; ?>" onclick="javascript:WdatePicker()" readonly="true" size="10">
	配送站<select name="station">
	       <option value="" <?php if ($this->_var['Current']): ?> disabled="disabled"<?php endif; ?>>全部</option>
		   <?php $_from = $this->_var['stations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'sta');if (count($_from)):
    foreach ($_from AS $this->_var['sta']):
?>
		   <option value="<?php echo $this->_var['sta']['station_id']; ?>" <?php if ($this->_var['Current']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['sta']['station_name']; ?></option>
		   	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
    <input type="submit" value="搜索" class="button" />
  </form>
</div>
<form method="post" action="delivery_plan.php?act=batch_operate" name="listForm" onsubmit="return check()">
<div class="list-div">&nbsp;&nbsp;&nbsp;<input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" />&nbsp;&nbsp;全选
    <input name="delete" type="submit" value="批量删除"  onclick="this.form.target = '_self' " class='button'/>
    <input name="plan_id" type="hidden" value="" />
</div>
<div class="list-div" id="listDiv" >
<?php endif; ?>
	<table width="100%" cellspacing="1">
	  <tr><th>序号</th>
		<th>配送站</th>
		<th>配送日期</th>
		<th>排班人数</th>
		<th>操作</th>
	  </tr>
	  <?php $_from = $this->_var['delivery_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['list']):
?>
	  <tr bgcolor="#ffffff">
	    <td align="center"><?php echo $this->_var['list']['i']; ?></td> 
		<td align="left">
		   <input type="checkbox" name="checkboxes" onclick="checkon(this,<?php echo $this->_var['sn']; ?>);" />
		   <input type="hidden" name="count" value="" /><?php echo $this->_var['list']['station_name']; ?></td>
		<td align="center"><?php echo $this->_var['list']['bdate']; ?></td> 
		<td align="center"><?php echo $this->_var['list']['deliveryplan_count']; ?></td>
        <td align="center"><a href='' onclick="removeBefore('<?php echo $this->_var['list']['bdate']; ?>','<?php echo $this->_var['list']['station_id']; ?>'); return false;">删除</a></td>
	  </tr>
	  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</table>
<hr />
	<table width="100%" cellspacing="1">
		<tr>
			<th colspan="5" align="left">详情</th>
		</tr>
	</table>
	<?php $_from = $this->_var['delivery_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['list']):
?> 
	<table name="tabs" id="<?php echo $this->_var['sn']; ?>" <?php if ($this->_var['sn'] == 0): ?> style="display:table;"<?php else: ?>style="display:none;"<?php endif; ?> width="100%">
		<?php $_from = $this->_var['list']['delivery']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'glist');if (count($_from)):
    foreach ($_from AS $this->_var['glist']):
?>
		<tr title="<?php echo $this->_var['glist']['date']; ?>" bgcolor="#ffffff">
				<td align="center" width="10%">
				   <input type="checkbox" name="checkboxes" key="<?php echo $this->_var['sn']; ?>" value="<?php echo $this->_var['glist']['id']; ?>" />
					<?php echo $this->_var['glist']['id']; ?></td>
				<td align="center" width="12%"><?php echo $this->_var['glist']['bdate']; ?></td>
				<td align="center" width="12%"><?php echo $this->_var['glist']['station_name']; ?></td>
				<td align="center" width="12%"><?php echo $this->_var['glist']['employee_name']; ?></td>
				<td align="center" width="10%">
			<a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['glist']['id']; ?>, '要删除这个排班吗？', 'remove')">删除</a></td>
		</tr>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</table>
	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
<?php if ($this->_var['full_page']): ?>
</div>
</form>
<script language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

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
        listTable.filter['sdate']    = Utils.trim(document.forms['searchForm'].elements['sdate'].value);
        listTable.filter['edate']    = Utils.trim(document.forms['searchForm'].elements['edate'].value);
        listTable.filter['station']  = Utils.trim(document.forms['searchForm'].elements['station'].value);
        listTable.filter['page']     = 1;
        listTable.loadList();
}
function check()
{
   var snArray = new Array();
   var eles = document.forms['listForm'].elements;
   for (var i=0; i<eles.length; i++)
   {
     if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on')
     {
       snArray.push(eles[i].value);
     }
   }
   if (snArray.length == 0)
   {
     return false;
   }
   else
   {
     eles['plan_id'].value = snArray.toString();
     return true;
   }
}
function show(tt,obj)
{
  document.getElementById('main_'+obj).style.backgroundColor='red';
  document.getElementById(obj).style.display = "table";
  var tab = document.getElementsByName('count');
  for(var i=0;i<tab.length;i++)
  {
     if(obj !=i )
	 {
       document.getElementById(i).style.display = "none";
       document.getElementById('main_'+i).style.backgroundColor='';
	 }
  }
}
function checkon(obj,status)
{
  var elems = document.getElementsByTagName("INPUT");
  var tb = document.getElementById(status);

  for (var i=0; i < elems.length; i++)
  {
    if (elems[i].key == status)
    {
      elems[i].checked = obj.checked;
    }
  }
  if(obj.checked == true)
  {
     tb.style.display = "table";  
  }
  else
  {
     tb.style.display = "none";   
  }
}
function removeBefore(dd,stn)
{
    var question = confirm("确定要删除该组排班吗？");  
	if (question != 0)
	{
	  window.location.href = "delivery_plan.php?act=delete&bdate=" + dd + "&station=" + stn;
	}
}
</script>


<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>