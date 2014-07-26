
	<!--<select id="seladdr" name="consignee_address" style="width:450px;">
			<option value="">请选择历史地址</option>
			<?php $_from = $this->_var['consignee_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'con');if (count($_from)):
    foreach ($_from AS $this->_var['con']):
?>
			<option value="<?php echo $this->_var['con']['address_id']; ?>"><?php echo $this->_var['con']['consignee']; ?>-<?php echo $this->_var['con']['address']; ?></option>
			<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
			</select>
	-->
<div class="shipping1">
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js,region.js')); ?>	
<table border="0" width="910" style="line-height:25px;">
	<tr style="line-height:50px;text-align:center;">
		<td colspan="4"><font size='6'>送货信息 SHIPPING INFORMATION</font></td>
	</tr>
	<tr>
		<td colspan="4"><hr/></td>
	</tr>
	<tr>
		<td width="100">收件人：</td>
		<td><input name="consignee" type="text" class="name" id="shipping_consignee" value="<?php echo $this->_var['accepter']['consignee']; ?>"  readonly  style="border:none;"  /></td>
		<td width="100">电话：</td>
		<td><input name="mobile" id="shipping_tel" type="text" class="telephone" value="<?php echo $this->_var['accepter']['mobile']; ?>"  readonly style="border:none;"  /></td>
	</tr>
	<tr>
		<td>送货地址：</td>
		<td><input type="text" name="addressxu" id="addressxu" value="<?php echo $this->_var['address0']; ?>" readonly style="border:none;width:82px;"  />
			<input type="text" name="address" class="address" id="shipping_address" value="<?php echo $this->_var['accepter']['address']; ?>"   readonly  style="border:none;"  />
			<input name="address_id" type="hidden" value="<?php echo $this->_var['accepter']['address_id']; ?>" id="shipping_address_id" />
			<select name="country" id="shipping_city" class="city" style="display:none;" >
					<option value="441" selected>北京</option>
				</select>&nbsp;&nbsp;&nbsp;
				<input type="text" name="city" class="district" id="shipping_district" value="<?php echo $this->_var['accepter']['city']; ?>" style="display:none;"  />
			
		</td>
		<td>送货时间：</td>
		<td width="220"><div class='btime'>
			<?php echo $this->smarty_insert_scripts(array('files'=>'region.js,datepicker/WdatePicker.js')); ?>
			  <input type="text" value=""  onClick="javascript:WdatePicker({minDate:'%y-%M-{%d}'})" size="11" readonly="true" name="bdate" id="bdate" style="background:white;font-size:12px;font-weight:normal;color:black;" />
			  <select name="hour" id="hour">
				<option value="10">10</option>
				<option value="11">11</option>
				<option value="12">12</option>
				<option value="13">13</option>
				<option value="14">14</option>
				<option value="15">15</option>
				<option value="16">16</option>
				<option value="17">17</option>
				<option value="18">18</option>
				<option value="19">19</option>
				<option value="20">20</option>
				<option value="21">21</option>
				<option value="22">22</option>
			  </select>
			  <select name="minute" id="minute">
				<option value="00">00</option>
				<option value="30">30</option>
			  </select>
			  
			</div> 
		</td>
	</tr>
	<tr>
		<td colspan="4" align="center" style="padding-top:10px;"><p href="#" id="dp" onClick="check_login('fromCart');" ><img src="themes/default/images/savechange.png"/></p>
		<div id="meg" style="color:red;height:15px;"></div></td>
	</tr>	
</table>			

</div>
<script type="text/javascript">
function update_consignee(formCart)
{  
   var consignee=$("#shipping_consignee");
   var city=$("#shipping_district");
   var address=$("#shipping_address");
   var mobile=$("#shipping_tel");
   var bdate=$("#bdate");
   consignee.css("border","0px solid #1B100C");
   city.css("border","1px solid #1B100C");
   address.css("border","0px solid #1B100C");
   mobile.css("border","0px solid #1B100C");
   bdate.css("border","1px solid #1B100C");
   
   if (consignee && consignee.val() == "")
   {
       consignee.css("border","1px solid red");
	   return false;
   }
    if (city && city.val() == 0)
   {
       city.css("border","1px solid red");
	   return false;
   }
    if (address && Utils.isEmpty(address.val()))
  {
       address.css("border","1px solid red");
	   return false;
   }
   
  if (Utils.isEmpty(mobile.val()) || mobile.val().length < 8 || (!Utils.isTel(mobile.val()))){
       mobile.css("border","1px solid red");
	   return false;
   }
    if (bdate && Utils.isEmpty(bdate.val()))
  {
       bdate.css("border","1px solid red");
	   bdate.val("请点击选择日期");
	   return false;
   }
  
   
	   var str = "is_ajax=1&address_id=" + document.getElementById("shipping_address_id").value;
	   str +="&consignee=" + document.getElementById("shipping_consignee").value;
	   str +="&country=" + document.getElementById("shipping_city").value; 
	   str +="&city=" + document.getElementById("shipping_district").value; 
	   str +="&address=" + document.getElementById("shipping_address").value; 
	   str +="&mobile=" + document.getElementById("shipping_tel").value; 
	   str +="&bdate=" + document.getElementById("bdate").value;
	   str +="&hour=" + document.getElementById("hour").value;
	   str +="&minute=" + document.getElementById("minute").value;
	   Ajax.call('flow.php?step=consignee', str, update_consignee_Response, 'POST', 'JSON');
   
}
function update_consignee_Response(result)
{
  if (result.error > 0)
  {
     document.getElementById('meg').innerHTML=result.message;
	 document.getElementById('save').value="0";
  }else{
	  document.getElementById('meg').innerHTML='信息保存成功，请点击下一步';
	  document.getElementById('save').value="1";
  }
}
function check_login(formCart)
{
	 var login=document.getElementById('login').value;
	 if(login>0){
		 
		update_consignee(formCart);
	}else{		
		showBg();
	}
	 
	 
}
</script>