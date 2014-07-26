<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js,region.js')); ?>
<div class="blank20"></div>
<div class="right_my_info">
<form id="form1" name="form1" method="post" action="" class="name">
  	<input name="consignee" type="text" class="name" id="shipping_consignee" value="<?php echo $this->_var['consignee']['consignee']; ?>"/>
    <input name="" type="button" value="" class="save_btn" onClick="update_consignee();"/>
  </form>
  <form id="form2" name="form2" method="post" action="" class="address">
    <select name="city" id="shipping_city" class="city" >
        <option value="441" selected>北京</option>      
    </select>
    <select name="district" class="part" id="shipping_district">
    <option value="0">请选择</option>
    <?php $_from = $this->_var['district_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'district');if (count($_from)):
    foreach ($_from AS $this->_var['district']):
?>
        <option value="<?php echo $this->_var['district']['region_id']; ?>" <?php if ($this->_var['consignee']['city'] == $this->_var['district']['region_id']): ?>selected<?php endif; ?>><?php echo $this->_var['district']['region_name']; ?></option>
        <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </select>
    <textarea name="address" rows="3" class="address" id="shipping_address"><?php echo $this->_var['consignee']['address']; ?></textarea>
    <input name="" type="button" value="" class="save_btn" onClick="update_consignee();"/>
  </form>
  <form id="form3" name="form3" method="post" action="" class="tel">
  	<input name="tel" id="shipping_tel" type="text" class="telephone" value="<?php echo $this->_var['consignee']['tel']; ?>"/>
  	<input name="" type="button" value="" class="save_btn" onClick="update_consignee();"/>
  </form>
  <input name="address_id" type="hidden" value="<?php echo $this->_var['consignee']['address_id']; ?>" id="shipping_address_id" />
</div>
<div class="blank20"></div>
<script type="text/javascript">
function update_consignee()
{
   var str = "is_ajax=1&address_id=" + document.getElementById("shipping_address_id").value;
   str +="&consignee=" + document.getElementById("shipping_consignee").value;
   str +="&contry=" + document.getElementById("shipping_city").value; 
   str +="&city=" + document.getElementById("shipping_district").value; 
   str +="&address=" + document.getElementById("shipping_address").value; 
   str +="&tel=" + document.getElementById("shipping_tel").value; 
   Ajax.call('flow.php?step=consignee', str, update_consignee_Response, 'POST', 'JSON');
}
function update_consignee_Response(result)
{
  if (result.error > 0)
  {
    alert(result.message);
  }
}
</script>
