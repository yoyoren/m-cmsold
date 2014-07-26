<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js')); ?>
<div class="text_title">
	<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
	<?php if ($this->_var['action_link']): ?>
	<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
	<?php endif; ?>
	<div style="clear:both"></div>
</div>

<div class="form-div">
    <form action="javascript:searchAddess();" name="searchForm">
        <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
        站点名称：<input name="code" type="text" id="code" size="10">
        状态：<select name="flag" id="flag"><option value="">全部</option><option value="1">在用</option><option value="-1">未用</option></select>
        自提：<select name="ziti" id="ziti" ><option value="">全部</option><option value="1">支持</option><option value="-1">不支持</option></select>
        <input type="submit" value="开始查询" class="button" />
    </form>
</div>



<form method="post" action="order.php?act=operate" name="listForm" onsubmit="return check()">
    <div class="list-div" id="listDiv"><?php endif; ?>
        <table cellpadding="3" cellspacing="1" width="100%">
        <tr>
        	<th><input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" /><a href="javascript:listTable.sort('address_id', 'DESC'); ">ID</a></th>
            <th>站点名称</th>
            <th>编号</th>
            <th>站点地址</th>
            <th>状态</th>
            <th>是否自提</th>
            <th>操作</th>
        <tr>
        <?php $_from = $this->_var['station_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
        <tr bgcolor="#ffffff" onMouseover="this.style.backgroundColor='#e9f6f8'" onMouseout="this.style.backgroundColor=''">
            <td valign="top" nowrap="nowrap"><input type="checkbox" name="checkboxes" value="<?php echo $this->_var['list']['order_sn']; ?>" /><?php echo $this->_var['list']['station_id']; ?></td>
            <td align="center" ><?php echo $this->_var['list']['station_name']; ?></td>
            <td align="center" ><?php echo $this->_var['list']['station_code']; ?></td>
            <td align="left" nowrap="nowrap"><?php echo $this->_var['list']['address']; ?></td>
            <td align="center" valign="top" nowrap="nowrap" ><?php if ($this->_var['list']['flag'] == '1'): ?>在用<?php else: ?>未用<?php endif; ?></td>
            <td align="center" valign="top" nowrap="nowrap" ><?php if ($this->_var['list']['ziti'] == '1'): ?>支持<?php else: ?>不支持<?php endif; ?></td>
            <td align="center">
            	<a href="station.php?act=edit&id=<?php echo $this->_var['list']['station_id']; ?>">编辑</a>
                <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['list']['station_id']; ?>, '您确定要删除此站点吗？', 'remove')">删除</a>
            </td>
        </tr>
        <?php endforeach; else: ?>
        <table><tr><td align="center" colspan="7">没有任何记录！</td></tr></table>
        <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
        </table>
        <table id="page-table" cellspacing="0" bgcolor="#ffffff" width="100%"><tr><td align="center" nowrap="true"><?php echo $this->fetch('page.htm'); ?></td></tr></table><?php if ($this->_var['full_page']): ?>
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

function searchAddess() { // Search address
	var frm = document.forms['searchForm'].elements;
	listTable.filter['code'] = Utils.trim(frm['code'].value);
	listTable.filter['flag'] = Utils.trim(frm['flag'].value);
	listTable.filter['ziti'] = Utils.trim(frm['ziti'].value);
	listTable.filter['page'] = 1;
	listTable.loadList();
}
</script><?php endif; ?>