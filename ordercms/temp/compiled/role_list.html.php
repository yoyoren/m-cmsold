<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js,datepicker/WdatePicker.js')); ?>
<div class="text_title">
<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
<div style="clear:both"></div>
</div>
<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellspacing='1' cellpadding='3' id='list-table' width="100%">
  <tr>
    <th>角色名</th>
    <th>角色描述</th>
    <th>操作</th>
  </tr>
  <?php $_from = $this->_var['admin_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
  <tr bgcolor="#ffffff" onMouseover="this.style.backgroundColor='#e9f6f8'" onMouseout="this.style.backgroundColor=''">
    <td class="first-cell" ><?php echo $this->_var['list']['role_name']; ?></td>
    <td class="first-cell" ><?php echo $this->_var['list']['role_describe']; ?></td>
    <td align="center">
      <a href="role.php?act=edit&id=<?php echo $this->_var['list']['role_id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>">编辑</a>&nbsp;&nbsp;
      <a href="javascript:;" onclick="listTable.remove(<?php echo $this->_var['list']['role_id']; ?>, '确实要删除吗？')" title="<?php echo $this->_var['lang']['remove']; ?>">删除</a></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<?php if ($this->_var['full_page']): ?>
</div>
<script type="text/javascript" language="JavaScript">
  
  onload = function()
  {
    
    //startCheckOrder();
  }
  
</script>
<?php echo $this->fetch('footer.html'); ?>
<?php endif; ?>
