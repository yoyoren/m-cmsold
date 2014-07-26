<!-- $Id: bonus_type_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->


<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?></h1>
<div class="main-div">
<form action="bonus.php?act=insert" method="post" name="theForm" onsubmit="return validate()">

<table width="100%">
  <tr>
    <td class="label">红包描述</td>
    <td>
      <input type='text' name='type_name'  id='type_name' maxlength="30" value="<?php echo $this->_var['moneycard_arr']['mc_name']; ?>" size='20' onblur="check_mc_name(this.value)"/><span id="bonus_name_msg" style="color:red;"></span>    </td>
  </tr>
  <tr id="create_num">
    <td class="label">数量</td>
    <td><input type='text' name='type_num' id='type_num' maxlength="30" value="" size='20' onblur="show(this)"/><br/></td>
  </tr>
  <tr>
    <td class="label">&nbsp;</td>
    <td>
      <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
    </td>
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
  validator.required("type_name",      "请输入红包描述"););
  validator.isNumber("type_num",     "数量必须为数字格式", true);
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
	Ajax.call("bonus.php", "act=check_bonus_name&bonus_name="+val, callback, "GET", "JSON");
}
function callback(result)
{
	if(result>0)
	{document.getElementById('mc_name_msg').innerHTML="红包类型已存在，请重新输入";
	document.getElementById('type_name').focus();
	}else{document.getElementById('bonus_name_msg').innerHTML='';}
}

--></script>

<?php echo $this->fetch('pagefooter.htm'); ?>
