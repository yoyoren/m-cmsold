<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js')); ?>
<div class="text_title">
	<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
	<?php if ($this->_var['action_link']): ?>
	<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
	<?php endif; ?>
	<div style="clear:both"></div>
</div>
</div>

<div class="list-div" id="listDiv">

<form action="" method="post" name="form1">
<table width="100%" bgcolor="#ffffff">
 <tr>
    <td class="label">城市名</td>
    <td>
      <input type="text" name="city_name" value="<?php echo $this->_var['city']['city_name']; ?>" /></td>
  </tr>
  <tr>
    <td class="label">代号</td>
    <td>
      <input type="text" name="city_code" value="<?php echo $this->_var['city']['city_code']; ?>" /></td>
  </tr>
  <tr>
    <td class="label">组别</td>
    <td>
    	<select name="city_group" >
    		<option value="0" >新组</option>
    		<?php $_from = $this->_var['city_group']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'c');if (count($_from)):
    foreach ($_from AS $this->_var['c']):
?>
		 	<option value ="<?php echo $this->_var['c']['city_code']; ?>" <?php if ($this->_var['city']['city_group'] == $this->_var['c']['city_code']): ?> selected="selected" <?php endif; ?> ><?php echo $this->_var['c']['city_name']; ?>组</option>
		 	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    	</select>
    </td>
  </tr>
<tr>
    <td class="label">共有批次</td>
    <td>
      <input type="text" name="turn" value="<?php echo $this->_var['city']['turn']; ?>" /></td>
  </tr>
  <tr>
    <td colspan="2" align="center">
      <input type="submit" value="确定" name="sub" class="button" />&nbsp;&nbsp;&nbsp;
      <input type="reset" value="重置" class="button" />
      <input type="hidden" value="<?php echo $this->_var['actions']; ?>" name="act" />
      <input type="hidden" value = "<?php echo $this->_var['city']['id']; ?>" name="id" />
  </tr>
</table>
</form>
</div>


<script language="JavaScript"><!--



--></script>

<?php echo $this->fetch('pagefooter.htm'); ?>
