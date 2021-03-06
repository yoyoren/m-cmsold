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
    日期<input name="sdate" type="text" id="sdate" value="<?php echo $this->_var['filter']['sdate']; ?>" onClick="javascript:WdatePicker()" readonly="true" size="10" />
    <input type="checkbox" name="twodate" value="2" />两天
    配送站<select name="station">
	       <option value="">全部</option>
	       <option value="100" >未分站</option>
		   <?php $_from = $this->_var['stations2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'sta');if (count($_from)):
    foreach ($_from AS $this->_var['sta']):
?>
		   <option value="<?php echo $this->_var['sta']['station_id']; ?>" ><?php echo $this->_var['sta']['station_name']; ?></option>
		   	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
	批次<select name="turn">
	       <option value="">全部</option>
		  <option value="1">第1批</option>
		  <option value="2">第2批</option>
		  <option value="3">第3批</option>
		  <option value="4">第4批</option>
	    </select>
	订单状态<select name="otatus">
	       <option value="100">全部</option>
		   <option value="1" selected="selected">确认</option>
		   <option value="2">取消</option>
		   <option value="3">无效</option>
		   <option value="4">退订</option>
	    </select>
	状态<select name="status">
	       <option value="">全部</option>
		   <option value="1" selected="selected">未审核</option>
		   <option value="2">已审核</option>
	    </select>
	订单号<input name="order_sn" type="text" value="<?php echo $this->_var['filter']['order_sn']; ?>" maxlength="22" id="order_sn" size="16">
	流水号<input name="print_sn" type="text" value="<?php echo $this->_var['filter']['print_sn']; ?>" maxlength="4" id="print_sn" size="6">
	电话 <input name="phone_number" type="text" value="<?php echo $this->_var['filter']['phone_number']; ?>" maxlength="11" id="phone_number" size="12">
	<input type="submit" value="搜索" class="button" />
  </form>
</div>
<form method="post" action="station_check.php?act=batch_operate" name="listForm" onSubmit="return check()">
<div class="list-div">
     &nbsp;<input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" id="ct" />&nbsp;&nbsp;全选&nbsp;
    <input name="checks" type="button"  value="批量结算"  onclick="return set_check();" class="button"/>&nbsp;&nbsp;&nbsp;&nbsp;
</div>
<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellspacing='1' cellpadding='3' id='list-table' width="100%">
  <tr>
   	<th width="4%">流水</th>
    <th width="4%">详情</th>
    <th width="13%">订单号</th>
    <th width="6%">付费方式</th>
	<th width="6%">已付金额</th>
    <th width="6%">到付金额</th>
	<th width="6%">支付方式</th>
	<th width="6%">代金额</th>
	<th width="36%">订单备注</th>
    <th width="4%">状态</th>
    <th width="6%">操作</th>
  </tr>
  <?php $_from = $this->_var['order_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('sn', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['sn'] => $this->_var['list']):
?>
<tr bgcolor="#ffffff" title="<?php echo $this->_var['list']['best_time']; ?>" onMouseover="this.style.backgroundColor='#e9f6f8'" onMouseout="this.style.backgroundColor=''" id="trList">
  	<td align="center"><?php echo empty($this->_var['list']['print_sn']) ? '1000' : $this->_var['list']['print_sn']; ?></td>
    <td align="center"><a href="http://124.65.70.18/cims/more_order_info.php?oid=<?php echo $this->_var['list']['order_id']; ?>" target="_blank">详情</a></td>
    <td align="left">
	   <input type="checkbox" name="checkboxes" value="<?php echo $this->_var['list']['order_id']; ?>" />
       <input type="hidden" name="order[<?php echo $this->_var['sn']; ?>][oid]" value="<?php echo $this->_var['list']['order_id']; ?>" />
	  <a href="more_order_info.php?order_id=<?php echo $this->_var['list']['order_id']; ?>" target="_blank"><?php echo $this->_var['list']['order_sn']; ?></a></td>
	<td align="center"><?php echo $this->_var['list']['pay_name']; ?></td>
	<td align="center"><?php echo $this->_var['list']['money_paid']; ?></td> 
    <td align="center"><?php echo $this->_var['list']['order_amount']; ?></td> 
	<td align="center"><?php echo $this->_var['list']['pay_note']; ?></td>
	<td align="center"><?php echo $this->_var['list']['bonus']; ?></td>
	<td align="left"><?php echo $this->_var['list']['asd']; ?><?php echo $this->_var['list']['to_buyer']; ?></td> 
    <td align="center" id="txt_<?php echo $this->_var['list']['order_id']; ?>"><?php if ($this->_var['list']['ctatus'] == '1'): ?>待审核<?php elseif ($this->_var['list']['ctatus'] == '2'): ?>已审核<?php elseif ($this->_var['list']['ctatus'] == '3'): ?>已结算<?php else: ?>未审核<?php endif; ?></td>
	<td align="center"><a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['list']['order_id']; ?>, '确认审核当前订单吗？', 'ud')">审核</a>
  </tr>
  <?php endforeach; else: ?>
  <tr bgcolor="#ffffff"><td class="no-records" colspan="14">没有记录！</td></tr>
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
</form>

<script language="JavaScript"><!--
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;

<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
	listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

function searchOrder()
{
        listTable.filter['sdate']    = Utils.trim(document.forms['searchForm'].elements['sdate'].value);
        listTable.filter['order_sn'] = Utils.trim(document.forms['searchForm'].elements['order_sn'].value);
        listTable.filter['print_sn'] = Utils.trim(document.forms['searchForm'].elements['print_sn'].value);
        listTable.filter['turn']     = Utils.trim(document.forms['searchForm'].elements['turn'].value);
        listTable.filter['status']   = Utils.trim(document.forms['searchForm'].elements['status'].value);
        listTable.filter['otatus']   = Utils.trim(document.forms['searchForm'].elements['otatus'].value);
        listTable.filter['station']   = Utils.trim(document.forms['searchForm'].elements['station'].value);
        listTable.filter['twodate']   = Utils.trim(document.forms['searchForm'].elements['twodate'].value);
        listTable.filter['phone_number']   = Utils.trim(document.forms['searchForm'].elements['phone_number'].value);
        listTable.filter['twodate']     = document.forms['searchForm'].elements['twodate'].checked ? 1 : 0;

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
     eles['sn'].value = snArray.toString();
     return true;
   }
}
function check_sg(id,sn)
{
	document.getElementById('txt_'+sn).innerHTML = '已审核';
	if(confirm('确认审核当前订单吗？'))
	{
		 Ajax.call('finan_check.php', "act=ud&id=" +id, null, "GET", "JSON");
	}

}
function show_response(result)
{
  var sel = document.getElementById('sender');
  sel.length = 1;

  if (document.all)
  {
    sel.fireEvent("onchange");
  }
  else
  {
    var evt = document.createEvent("HTMLEvents");
    evt.initEvent('change', true, true);
    sel.dispatchEvent(evt);
  }

  if (result)
  {
    for (i = 0; i < result.length; i ++ )
    {
      var opt = document.createElement("OPTION");
      opt.value = result[i].employee_id;
      opt.text  = result[i].employee_name;

      sel.options.add(opt);
    }
  }
}
function display(obj)
{
  var txt = document.getElementById(obj);
  txt.style.display = 'none';
	
}
function set_check()
{
   var eles_id = get_checked();
   
   var eles = document.forms['listForm'].elements;
   for (var i=0; i<eles.length; i++)
   {
     if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on')
     {
       var sn = eles[i].value;
	   document.getElementById('txt_'+sn).innerHTML = '已审核';
     }
   }

   if (eles_id == '')
   {
     return false;
   }
   else
   {
	 Ajax.call('finan_check.php', "act=batch_operate&order_id=" +eles_id, null, "GET", "JSON");
   }
   document.getElementById('ct').checked = '';  
}
function gfilter()
{
  var args ='';
  for (var i in listTable.filter)
  {
    
	if (typeof(listTable.filter[i]) != "function" && typeof(listTable.filter[i]) != "undefined")
    {
      args += "&" + i + "=" + encodeURIComponent(listTable.filter[i]);
    }
  }
  return args;
}
function Callback(result, txt)
{
  
  if (result.error > 0)
  {
    alert(result.message);

  }
  else
  {
	try
    {
      document.getElementById('listDiv').innerHTML = result.content;

      if (typeof result.filter == "object")
      {
        listTable.filter = result.filter;
      }

      listTable.pageCount = result.page_count;
    }
    catch (e)
    {
      alert(e.message);
    }
  }
}
function get_checked()
{
   var snArray = new Array();
   var res = '';
   var eles = document.forms['listForm'].elements;
   for (var i=0; i<eles.length; i++)
   {
     if (eles[i].tagName == 'INPUT' && eles[i].type == 'checkbox' && eles[i].checked && eles[i].value != 'on')
     {
       snArray.push(eles[i].value);
     }
   }
   if (snArray.length > 0)
   {
      res = snArray.toString();
   }
   return res;
}
--></script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>