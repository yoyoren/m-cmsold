<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,listtable.js,transport.js,datepicker/WdatePicker.js,validator.js')); ?>
<style type="text/css">
.ul1{
	list-style:none;
	padding:5px;
	
}
.ul1 li{
	float:left;
	width:50px;
}
.ul2{
	list-style:none;
	padding:5px;
	clear:left;
}
.ul2 li{
	float:left;
	width:130px;
	margin-top:10px;

}
</style>
<div class="text_title">
	<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
	<?php if ($this->_var['action_link']): ?>
	<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
	<?php endif; ?>
	<div style="clear:both"></div>
</div>

<form action="javascript:getInfo();" name="getForm">
<div class="form-div">
    
        <img src="images/icon_search.gif" width="26" height="22" border="0" alt="SEARCH" />
        日期 <input type="text" name="date"  id="date" value="<?php echo $this->_var['date']; ?>" size="10" readonly onClick="javascript:WdatePicker()"   />
	
</div>
<div class="form-div">
	<ul class ="ul1">
		<li><input onclick="listTable.selectAll(this,'field')" type="checkbox" id="selectAll" value="getAll " /> 全选</li>
		<li><input type="checkbox" name="" onclick="reverseSelect()" value="invertAll" /> 反选</li>
	</ul>
	<ul class="ul2">
		<?php $_from = $this->_var['fields_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'f');if (count($_from)):
    foreach ($_from AS $this->_var['f']):
?>
		<li><input type="checkbox" name="field" <?php if ($this->_var['f'] == 'order_sn' || $this->_var['f'] == 'order_status' || $this->_var['f'] == 'country' || $this->_var['f'] == 'best_time' || $this->_var['f'] == 'shipping_id' || $this->_var['f'] == 'shipping_name' || $this->_var['f'] == 'pay_id' || $this->_var['f'] == 'pay_name' || $this->_var['f'] == 'card_name' || $this->_var['f'] == 'card_message' || $this->_var['f'] == 'goods_amount' || $this->_var['f'] == 'pay_note' || $this->_var['f'] == 'scts' || $this->_var['f'] == 'wsts' || $this->_var['f'] == 'goods_id' || $this->_var['f'] == 'goods_name' || $this->_var['f'] == 'goods_sn' || $this->_var['f'] == 'goods_number' || $this->_var['f'] == 'goods_price' || $this->_var['f'] == 'goods_attr'): ?> checked="checked" <?php endif; ?> value="<?php echo $this->_var['f']; ?>" />  <?php echo $this->_var['f']; ?></li>
		<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	</ul>
	
	<div class="clear"></div>
	
</div>


<div class="list-div" style="border:0px red solid">
<?php endif; ?>
<input name="sub" type="submit" class="button" value=">>导出"  />
<?php if ($this->_var['full_page']): ?>
</div>
</form>

<script language="JavaScript">


function getInfo(){
	var date = document.getElementById("date").value;
	var field = document.getElementsByName("field");
	var field_arr = new Array();
	for(var i=0; i<field.length; i++){
		if(field[i].checked == true){
			field_arr.push(field[i].value);
			
		}
	}
	if(field_arr.length != 0){
		var field_str = field_arr.toString();
		var args = "act=export&date="+date+"&field_str="+field_str;
		window.location.href="data_export.php?"+args;
	}
	
	//Ajax.call('data_export.php',args,callback,'GET','TEXT');
	
}
function reverseSelect(){
	var field = document.getElementsByName("field");
	for(var i=0; i<field.length; i++){
		if(field[i].checked == true){
			field[i].checked = false;
			
		}else{
			field[i].checked = true;
		}
	}
	document.getElementById('selectAll').checked=false;
}

function callback(re){

	alert(this)
}
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>