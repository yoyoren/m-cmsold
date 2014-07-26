<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'datepicker/WdatePicker.js')); ?>
<div class="text_title">
	<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
	<?php if ($this->_var['action_link']): ?>
	<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
	<?php endif; ?>
	<div style="clear:both"></div>
</div>
<div class="form-div">
<form action="shipping_commission.php" name="searchForm" method="post">
    日期<input name="bdate" type="text" value="<?php echo $this->_var['filter']['bdate']; ?>" onClick="javascript:WdatePicker()" readonly="true" size="10">&nbsp;&nbsp;
	站点<select name="station">
		<?php $_from = $this->_var['stations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'sta');if (count($_from)):
    foreach ($_from AS $this->_var['sta']):
?>
		  <option value="<?php echo $this->_var['sta']['station_id']; ?>" <?php if ($this->_var['Current']): ?>selected="selected"<?php endif; ?>><?php echo $this->_var['sta']['station_name']; ?></option>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</select>
</div>

<div id="listDiv">
	&nbsp;复核理由&nbsp;<textarea name="reason" cols="30" rows="3"></textarea>
	<input type="hidden" name="act" value="reset" />&nbsp;&nbsp;&nbsp;
    <input type="submit" value="复核提成" class="button" class="button" />
  </form>
</div>
</body>
</html>