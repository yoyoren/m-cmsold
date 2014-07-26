<!-- $Id: bonus_type_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?></h1>
<div class="main-div">
<form action="moneycard1.php?act=insert" method="post" name="theForm" onsubmit="return validate()">

<table width="100%">
  <tr>
    <td class="label">礼金卡描述</td>
    <td>
      <input type='text' name='type_name'  id='type_name' maxlength="30" value="<?php echo $this->_var['moneycard_arr']['mc_name']; ?>" size='20' onblur="check_mc_name(this.value)"/><span id="mc_name_msg" style="color:red;"></span>    </td>
  </tr>
  <!-- <tr>
    <td class="label">
      <a href="javascript:showNotice('Type_money_a');" title="<?php echo $this->_var['lang']['form_notice']; ?>">
      <img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a>面值金额</td>
    <td>
    <input type="text" name="type_money" value="<?php echo $this->_var['moneycard_arr']['mc_money']; ?>" size="20" />
    <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="Type_money_a"><?php echo $this->_var['lang']['type_money_notic']; ?></span>    </td>
  </tr>  -->

  
  <tr id="create_num">
    <td class="label">数量</td>
    <td><input type='text' name='type_num' id='type_num' maxlength="30" value="" size='20' onblur="show(this)"/><br/>
    <div>编号起始：<span id="cardnum_start"><?php echo $this->_var['cardnum_start']; ?></span><br/><span id="cardnum_end" style="display:none;">编号截止：</span><input type="hidden" value="<?php echo $this->_var['cardnum_start']; ?>" name="cardnum_start"/><input type="hidden" value="<?php echo $this->_var['cardnum_end']; ?>" name="cardnum_end" id="cardnum_end2"/></div></td>
  </tr>
  
  <!-- <tr>
    <td class="label">
	  <a href="javascript:showNotice('Use_start_a');" title="<?php echo $this->_var['lang']['form_notice']; ?>">
      <img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a>
	起始日期</td>
    <td>
      <input name="use_start_date" type="text" id="use_start_date" size="22" value='<?php echo $this->_var['moneycard_arr']['use_start_date']; ?>' readonly="readonly" /><input name="selbtn3" type="button" id="selbtn3" onclick="return showCalendar('use_start_date', '%Y-%m-%d', false, false, 'selbtn3');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
	  <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="Use_start_a"><?php echo $this->_var['lang']['use_startdate_notic']; ?></span>    </td>
  </tr>
  <tr>
    <td class="label">失效日期</td>
    <td>
      <input name="use_end_date" type="text" id="use_end_date" size="22" value='<?php echo $this->_var['moneycard_arr']['use_end_date']; ?>' readonly="readonly" /><input name="selbtn4" type="button" id="selbtn4" onclick="return showCalendar('use_end_date', '%Y-%m-%d', false, false, 'selbtn4');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>    </td>
  </tr> -->
  <tr>
    <td class="label">&nbsp;</td>
    <td>
      <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
      <input type="hidden" name="type_id" value="<?php echo $this->_var['moneycard_arr']['mc_id']; ?>" />    </td>
  </tr>
</table>
</form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="javascript"><!--

document.forms['theForm'].elements['type_name'].focus();
/**
 * 检查表单输入的数据
 */
function validate()
{
  validator = new Validator("theForm");
  validator.required("type_name",      "请输入礼金卡描述");
  //validator.required("type_money",     "请输入礼金卡面值");
  //validator.isNumber("type_money",     "面值金额必须为数字格式", true);
  validator.isNumber("type_num",     "数量必须为数字格式", true);
  //validator.islt('send_start_date', 'send_end_date', send_start_lt_end);
  //validator.required("use_start_date",     "请选择礼金卡使用起始日期");
  //validator.required("use_end_date",     "请选择礼金卡使用失效日期");
  //validator.islt('use_start_date', 'use_end_date', use_start_lt_end);
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
  
/* 红包类型按订单金额发放时才填写 */
/**function gObj(obj)
{
  var theObj;
  if (document.getElementById)
  {
    if (typeof obj=="string") {
      return document.getElementById(obj);
    } else {
      return obj.style;
    }
  }
  return null;
}*/
/*检查类型名是否已存在*/
function check_mc_name(val)
{		
	Ajax.call("moneycard1.php", "act=check_mc_name&mc_name="+val, callback, "GET", "JSON");
}
function callback(result)
{
	if(result>0)
	{document.getElementById('mc_name_msg').innerHTML="礼金卡描述已存在，请重新输入";
	//document.getElementById('type_name').value='';
	document.getElementById('type_name').focus();
	}else{document.getElementById('mc_name_msg').innerHTML='';}
}

/*输入数量显示卡号截止*/
function show(a)
{
	var cardnum_start=document.getElementById("cardnum_start").innerHTML;
	var cardnum_end=document.getElementById("cardnum_end");
	var cardnum_end2=document.getElementById("cardnum_end2");
	if(a.value && a.value>0){
		var r,i,j;	
		j=parseInt(cardnum_start)+parseInt(a.value-1,10);	
		cardnum_end.innerHTML="卡号截止："+j;
		cardnum_end.style.display='';
		cardnum_end2.value=j;
	}else{
		cardnum_end.innerHTML="";
		cardnum_end.style.display='none';
		cardnum_end2.value='';
		}
}
//
--></script>

<?php echo $this->fetch('pagefooter.htm'); ?>
