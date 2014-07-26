﻿<!-- $Id: bonus_type_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?></h1>
<div class="main-div">
<form action="moneycard1.php?act=account" method="post" name="theForm" onsubmit="return validate()">

<table width="100%">
  <tr style="height:22px;line-height:22px;vertical-align:middle;">
    <td style="height:22px;line-height:22px;vertical-align:middle;">类型  ：  
      <select name="type" id="type">
      <option value='0' <?php if ($this->_var['type'] == ""): ?>selected<?php endif; ?>>--请选择--</option>      
      <option value='1' <?php if ($this->_var['type'] == "1"): ?>selected<?php endif; ?>>消费</option>
      <option value='2' <?php if ($this->_var['type'] == "2"): ?>selected<?php endif; ?>>充值</option>
      <option value='3' <?php if ($this->_var['type'] == "3"): ?>selected<?php endif; ?>>退款</option>
      </select>    </td>
    <td>手机号：<input type="text" name="mobilephone" id="mobilephone" maxlength="11" size="11"/></td>
    <td>搜索范围：
	      从<input name="sdate" type="text" id="sdate" size="22" value='<?php echo $this->_var['sdate']; ?>' readonly="readonly" /><input name="selbtn3" type="button" id="selbtn3" onclick="return showCalendar('sdate', '%Y-%m-%d', false, false, 'selbtn3');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
	      到<input name="edate" type="text" id="edate" size="22" value='<?php echo $this->_var['edate']; ?>' readonly="readonly" /><input name="selbtn4" type="button" id="selbtn4" onclick="return showCalendar('edate', '%Y-%m-%d', false, false, 'selbtn4');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/> 
	</td>
	<td colspan='4' align='center'>
      <input type="submit" value="搜索" class="button" /> </td>
  </tr>
  
</table>
<div class="list-div" id="listDiv">
	<table cellpadding="3" cellspacing="1">
	  <tr>
	    <th>编号</th>
	    <th>会员名</th>
	    <th>操作</th>
	    <th>金额</th>
	    <th>时间</th>
	    <th>备注</th>
	  </tr>
	  <?php $_from = $this->_var['account_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('k', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['k'] => $this->_var['val']):
?>
	  <tr>
	    <td align="center"><?php echo $this->_var['val']['sn']; ?></td>
	    <td align="center"><?php echo $this->_var['val']['user_name']; ?></td>
	    <td align="center"><?php if ($this->_var['val']['change_type'] == 1): ?>消费<?php elseif ($this->_var['val']['change_type'] == 2): ?>充值<?php elseif ($this->_var['val']['change_type'] == 3): ?>退款<?php endif; ?></td>
	    <td align="center"><?php if ($this->_var['val']['change_type'] > 1): ?><font color="green"><?php echo $this->_var['val']['format_user_money']; ?></font><?php elseif ($this->_var['val']['change_type'] == 1): ?><font color="red"><?php echo $this->_var['val']['format_user_money']; ?></font><?php endif; ?></td>
	    <td align="center"><?php echo $this->_var['val']['change_time']; ?></td>	    
	    <td align="left"><?php echo $this->_var['val']['change_desc']; ?></td>
	  </tr>
	  <?php endforeach; else: ?>
      <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
	  <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
	  <?php if ($this->_var['account_list']): ?>
	  <tr>
	    <td colspan="6" style="height:40px;line-height:40px;vertical-align:middle;padding-left:450px;color:red;">TOTAL：<?php echo $this->_var['total']; ?>元</td>
	  </tr>
	  <?php endif; ?>
	</table>
</div>
</form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="javascript"><!--


/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  
  var mp=document.getElementById("mobilephone");
  var RegCellPhone = /^([0-9]{11})?$/;
  falg=mp.value.search(RegCellPhone);
  if (falg==-1){
	  validator.addErrorMsg("手机号不合法！");
    }
  validator.islt('sdate', 'edate', "起始日期必须小于截止日期");
  /**if (document.getElementById(1).style.display == "")
  {
    var minAmount = parseFloat(document.forms['theForm'].elements['min_amount'].value);
    if (isNaN(minAmount) || minAmount <= 0)
    {
	  validator.addErrorMsg(invalid_min_amount);
    }	
  }*/
  return validator.passed();
	 
}

/**onload = function()
{
  
  get_value = '<?php echo $this->_var['moneycard_arr']['send_type']; ?>';
  

  showunit(get_value)
  // 开始检查订单
  startCheckOrder();
}*/


--></script>

<?php echo $this->fetch('pagefooter.htm'); ?>
