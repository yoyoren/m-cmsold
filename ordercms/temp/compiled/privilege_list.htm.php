

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js')); ?>
<div class="text_title">
<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
<div style="clear:both"></div>
</div>

<div class="list-div" id="listDiv">
<?php endif; ?>

<table cellspacing='1' cellpadding='3' id='list-table' width="100%">
  <tr>
    <th>用户名</th>
    <th>最后登录时间</th>
    <th>最后登录IP</th>
    <th>城市</th>
    <th>真实姓名</th>
    <th>操作</th>
  </tr>
  <?php $_from = $this->_var['admin_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['list']):
?>
  <tr bgcolor="#ffffff" onMouseover="this.style.backgroundColor='#e9f6f8'" onMouseout="this.style.backgroundColor=''">
    <td class="first-cell" ><?php echo $this->_var['list']['user_name']; ?></td>
    <td align="center"><?php echo date("Y-m-d H:i:s",$this->_var['list']['last_time']); ?></td>
    <td align="center"><?php echo $this->_var['list']['last_ip']; ?></td>
    <td align="center"><?php echo $this->_var['list']['city_group']; ?></td>
    <td align="center"><?php echo $this->_var['list']['sname']; ?></td>
    <td align="center">
      <a href="privilege.php?act=allot&id=<?php echo $this->_var['list']['id']; ?>&user=<?php echo $this->_var['list']['user_name']; ?>" title="<?php echo $this->_var['lang']['allot_priv']; ?>"><img src="images/icon_priv.gif" border="0" height="16" width="16"></a>&nbsp;&nbsp;
      <a href="privilege.php?act=edit&id=<?php echo $this->_var['list']['id']; ?>" title="<?php echo $this->_var['lang']['edit']; ?>"><img src="images/icon_edit.gif" border="0" height="16" width="16"></a>&nbsp;&nbsp;
      <a href="privilege.php?act=remove&id=<?php echo $this->_var['list']['id']; ?>" onclick="listTable.remove(<?php echo $this->_var['list']['user_id']; ?>, '<?php echo $this->_var['lang']['drop_confirm']; ?>')" title="<?php echo $this->_var['lang']['remove']; ?>"><img src="images/icon_drop.gif" border="0" height="16" width="16"></a></td>
  </tr>
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</table>

<?php if ($this->_var['full_page']): ?>
</div>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>
