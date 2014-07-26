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
    <form action="javascript:searchRoute()" name="searchForm">
        <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
        编号：<input name="code" type="text" id="code" size="10">
        状态：<select name="flag" id="flag"><option value="">全部</option><option value="1">在用</option><option value="-1">未用</option></select>
        站点：<select name="station" id="station"><option value="0">全部</option><?php echo $this->html_options(array('options'=>$this->_var['station_list'])); ?></select>
        费用：<input type="text" name="fee" size="6" />
        <input type="submit" value="开始查询" class="button" />
    </form>
</div>



<form method="post" action="order.php?act=operate" name="listForm" onsubmit="return check()">
    <div class="list-div" id="listDiv"><?php endif; ?>
        <table cellpadding="3" cellspacing="1" width="100%">
            <tr>
                <th>
                    <input onclick='listTable.selectAll(this, "checkboxes")' type="checkbox" /><a href="javascript:listTable.sort('address_id', 'DESC'); ">ID</a>
                </th>
                <th>路区名称</th>
                <th>路区编号</th>
                <th>配送站</th>
                <th>状态</th>
                <th>费用</th>
                <th>操作</th>
            <tr>
            <?php $_from = $this->_var['route_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
            <tr bgcolor="#ffffff" onMouseover="this.style.backgroundColor='#e9f6f8'" onMouseout="this.style.backgroundColor=''">
            <td valign="top" nowrap="nowrap">&nbsp;&nbsp;<input type="checkbox" name="checkboxes" value="<?php echo $this->_var['list']['route_id']; ?>" /><?php echo $this->_var['list']['route_id']; ?></td>
            <td align="center" ><?php echo $this->_var['list']['route_name']; ?></td>
            <td align="center" ><?php echo $this->_var['list']['route_code']; ?></td>
            <td align="center" ><?php echo $this->_var['list']['station_name']; ?></td>
            <td align="center" valign="top" nowrap="nowrap" ><?php echo $this->_var['list']['flag']; ?></td>
            <td align="center" valign="top" nowrap="nowrap"><?php echo $this->_var['list']['fee']; ?></td>
            <td align="center" >
            	<a href="route.php?act=edit&id=<?php echo $this->_var['list']['route_id']; ?>">编辑</a>&nbsp;&nbsp;&nbsp;&nbsp;
                <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['list']['route_id']; ?>, '您确定要删除此路区吗？', 'remove')">删除</a>
			</td>
            </tr>
            <?php endforeach; else: ?>
            <tr><td align="center" colspan="7" style="color:#F0F">没有查询到任何记录！</td></tr>
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


function searchRoute() { // Search route
	frm = document.forms['searchForm'].elements;
	listTable.filter['code'] = Utils.trim(frm['code'].value);
	listTable.filter['flag'] = Utils.trim(frm['flag'].value);
	listTable.filter['station'] = Utils.trim(frm['station'].value);
	listTable.filter['fee'] = Utils.trim(frm['fee'].value);
	listTable.filter['page'] = 1;
	listTable.loadList();
}
</script><?php endif; ?>