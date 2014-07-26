<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js,transport.js')); ?>
<div class="text_title">
	<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
	<?php if ($this->_var['action_link']): ?>
	<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
	<?php endif; ?>
	<div style="clear:both"></div>
</div>

<div class="form-div">
    <form action="javascript:searchAddr();" name="searchForm">
        <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
        城市：<select name="city_code" onchange="switchSite(this, 'stations');" <?php if ($this->_var['Current']): ?> disabled="disabled"<?php endif; ?>>
        	<option value="">-全部-</option><?php echo $this->html_options(array('options'=>$this->_var['city_list'],'selected'=>$this->_var['city'])); ?>
        </select>
   配送站<select name="stations"  id="stations">
	       <option value="" <?php if ($this->_var['Current']): ?> disabled="disabled"<?php endif; ?>>全部</option>
		   <?php $_from = $this->_var['stations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'sta');if (count($_from)):
    foreach ($_from AS $this->_var['sta']):
?>
		   <option value="<?php echo $this->_var['sta']['station_id']; ?>" <?php if ($this->_var['Current']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['sta']['station_name']; ?></option>
		   	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
        职工姓名：<input name="employee" type="text" id="employee" size="15">
        <input type="submit" value="搜索" class="button" />
    </form>
</div>



<div class="list-div" id="listDiv"><?php endif; ?>
	<table cellspacing='1' cellpadding='3' id='list-table' width="100%">
        <tr>
            <th width="8%">姓名</th>
            <th width="7%">部门名称</th>
            <th width="7%">部门分组</th>
            <th width="15%">职务岗位</th>
            <th width="5%">操作</th>
        </tr>
        <?php $_from = $this->_var['employee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
        <tr bgcolor="#ffffff" onMouseover="this.style.backgroundColor='#e9f6f8'" onMouseout="this.style.backgroundColor=''">
            <td align="center" ><?php echo $this->_var['list']['name']; ?></td>
            <td align="center"><?php if ($this->_var['list']['dept_id'] == '1'): ?>配送部<?php else: ?>财务部<?php endif; ?></td>
            <td align="center" ><?php echo $this->_var['list']['station_name']; ?></td>
            <td align="center" ><?php if ($this->_var['list']['level'] == '1'): ?>配送员<?php elseif ($this->_var['list']['level'] == '2'): ?>调度员<?php elseif ($this->_var['list']['level'] == '3'): ?>收银员<?php elseif ($this->_var['list']['level'] == '4'): ?>站长<?php else: ?>副站长<?php endif; ?></td>
            <td align="center">
                <a href="employee.php?act=edit&id=<?php echo $this->_var['list']['id']; ?>">修改</a>
                <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['list']['id']; ?>, '您确定要删除此人吗？', 'remove')">删除</a>
            </td>
        </tr>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</table>
	<table id="page-table" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td align="center" nowrap="true"><?php echo $this->fetch('page.htm'); ?></td></tr></table><?php if ($this->_var['full_page']): ?>
</div>


<script language="JavaScript">
listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
<?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
listTable.filter.<?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

function switchSite(obj, station) { // Switch the site
	var city_code = obj.options[obj.selectedIndex].value;
	Ajax.call('employee.php?is_ajax=1&act=site', 'city_code=' + city_code + '&station=' + station, responseSwitchSite, 'GET', 'JSON');
}

function responseSwitchSite(result) { // The switchSite function callback method
	var sel = document.getElementById(result.target);
	sel.length = 1;
	sel.selectedIndex = 0;

	if (document.all) { // Processing onchange() event of compatibility
		sel.fireEvent('onchange');
	} else {
		var evt = document.createEvent('HTMLEvents');
		evt.initEvent('change', true, true); // Initializes the newly created evt object's properties
		sel.dispatchEvent(evt);
	}

	if (result.site) {
		for (var i = 0; i < result.site.length; i++) {
			var opt = document.createElement('OPTION');
			opt.value = result.site[i].station_id;
			opt.text = result.site[i].station_name;
			sel.options.add(opt);
		}
	}
}

function searchAddr() { // Search address
	var frm = document.forms['searchForm'].elements;
	listTable.filter.employee = Utils.trim(frm['employee'].value);
	listTable.filter.stations = Utils.trim(frm['stations'].value);
	listTable.filter.city_code = frm['city_code'].value;
	listTable.filter.page = 1;
	listTable.loadList();
}
</script><?php echo $this->fetch('pagefooter.htm'); ?><?php endif; ?>