<!-- $Id: bonus_type_info.htm 14216 2008-03-10 02:27:21Z testyang $ -->


<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />

<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?></h1>
<div class="main-div">
<form action="bonus.php?act=affirmaction" method="post" name="theForm" onsubmit="return validate()">

<table width="100%">
  <tr>
    <td class="label">红包类型</td>
    <td>
      <select name="mc_name" onchange="get(this)">
      <option value='0'>--请选择--</option>
      <?php $_from = $this->_var['type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
      <option value="<?php echo $this->_var['val']['type_id']; ?>"><?php echo $this->_var['val']['type_name']; ?></option>
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?></select>    </td>
  </tr>
    
  <tr id="create_num"  style="display:none;">
    <td class="label">编号范围</td>
    <td><span id="scardnum1"></span>-<span id="ecardnum1"></span></td>
  </tr>
  
  <tr id="affirm_num" style="display:none;">
    <td class="label">生效范围</td>
    <td><input type="text" name="scardid" id="scardid" size="5"/>-<input type="text" name="ecardid" id="ecardid"  size="5" onblur="countnum()"/><span id='totalnum' style="margin-left:20px;"></span></td>
  </tr>
  
  <tr>
    <td class="label">
      <a href="javascript:showNotice('Type_money_a');" title="<?php echo $this->_var['lang']['form_notice']; ?>">
      <img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a>面值金额</td>
    <td>
    <input type="text" name="type_money" value="" size="20" id="type_money"/>
    <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="Type_money_a"><?php echo $this->_var['lang']['type_money_notic']; ?></span>    </td>
  </tr>
  <tr>
    <td class="label">活动名称</td>
    <td><input type="text" name="activity_name" value="" size="20" id="activity_name"/></td>
  </tr> 
  <tr>
    <td class="label">发放地点</td>
    <td><input type="text" name="aaddress" value="" size="20" id="aaddress"/></td>
  </tr> 
 <tr>
    <td class="label">
	  <a href="javascript:showNotice('Use_start_a');" title="<?php echo $this->_var['lang']['form_notice']; ?>">
      <img src="images/notice.gif" width="16" height="16" border="0" alt="<?php echo $this->_var['lang']['form_notice']; ?>"></a>
	生效日期</td>
    <td>
      <input name="use_start_date" type="text" id="use_start_date" size="22" value='<?php echo $this->_var['moneycard_arr']['use_start_date']; ?>' readonly="readonly" /><input name="selbtn3" type="button" id="selbtn3" onclick="return showCalendar('use_start_date', '%Y-%m-%d', false, false, 'selbtn3');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>
	  <br /><span class="notice-span" <?php if ($this->_var['help_open']): ?>style="display:block" <?php else: ?> style="display:none" <?php endif; ?> id="Use_start_a"><?php echo $this->_var['lang']['use_startdate_notic']; ?></span>    </td>
  </tr>
  <tr>
    <td class="label">失效日期</td>
    <td>
      <input name="use_end_date" type="text" id="use_end_date" size="22" value='<?php echo $this->_var['moneycard_arr']['use_end_date']; ?>' readonly="readonly" /><input name="selbtn4" type="button" id="selbtn4" onclick="return showCalendar('use_end_date', '%Y-%m-%d', false, false, 'selbtn4');" value="<?php echo $this->_var['lang']['btn_select']; ?>" class="button"/>    </td>
  </tr>
  <tr>
    <td class="label">&nbsp;</td>
    <td>
      <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
      <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />  </td>
  </tr>
</table>
<input type="hidden" name="scardnum" id="scardnum"/>
<input type="hidden" name="ecardnum" id="ecardnum"/>
<input type="hidden" name="type_id" id="type_id"/>
</form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="javascript">


/**
 * 检查表单输入的数据
 */
function validate()
{
 var type_id=document.getElementById('type_id');
 var ecardid=document.getElementById('ecardid');//生效截止编号	
 var ecardnum=document.getElementById('ecardnum');	//编号范围最大值
 var scardid=document.getElementById('scardid');	//生效起始编号
 var scardnum=document.getElementById('scardnum');//编号范围最小值
 var typemoney=document.getElementById('type_money').value;//面额
 var activity_name=document.getElementById('activity_name').value;
 var aaddress=document.getElementById('aaddress').value;
 var msg='';
 if(!typemoney){msg=msg+"请输入红包面值"+"\n";}
 if(!/^[0-9]*$/.test(typemoney)){msg=msg+"面值金额必须为数字格式"+"\n";}
 if(!scardid.value || !ecardid.value){msg=msg+"请填写生效范围"+"\n";}
 
 if(parseInt(scardnum.value) > parseInt(scardid.value)){msg=msg+"生效的起始编号要大于等于编号范围最小值"+"\n";};
  if(parseInt(ecardid.value) > parseInt(ecardnum.value)){msg=msg+"生效的截止编号要小于等于编号范围最大值"+"\n";};
  if(parseInt(scardid.value) > parseInt(ecardid.value)){msg=msg+"生效的起始编号要小于等于生效的截止编号"+"\n";};
if(!activity_name){msg=msg+"请填写活动名称"+"\n";};
if(!aaddress){msg=msg+"请填写发放地点"+"\n";};
  var sdate=document.getElementById('use_start_date').value;
  var edate=document.getElementById('use_end_date').value;
  if(!sdate || !edate){msg=msg+"请选择红包使用起始日期和失效日期";}
  if(edate<sdate){msg=msg+"红包使用失效日期必须大于等于起始日期";}
  if(msg){alert(msg);return false;}
  else{
	  Ajax.call("bonus.php", "act=check_affirm_cardid&scardid="+scardid.value+"&ecardid="+ecardid.value+"&type_id="+type_id.value, check_cardid, "GET", "JSON");
	  return false;
	  }

}

function check_cardid(result){
	
	if(result>0){alert("此范围内的部分礼金卡已生效，请重新输入生效范围！");}
	else{document.forms['theForm'].submit();}
}
/**onload = function()
{
  
  get_value = '<?php echo $this->_var['moneycard_arr']['send_type']; ?>';
  

  showunit(get_value)
  // 开始检查订单
  startCheckOrder();
}*/
function countnum()
{
	 var scardid=document.getElementById('scardid').value;	//生效起始编
	 var ecardid=document.getElementById('ecardid').value;//生效截止编号
	 if(!scardid)
	 {
	 	alert("请输入起始编号！");
	 }
	 else if(!ecardid)
	 {
	 	alert("请输入截止编号！");
	 }
	 else
	 {
		 var totalnum=ecardid-scardid+1;
		 document.getElementById('totalnum').innerHTML="共"+totalnum+"个";
	 }
	 
}
function get(a)
{
	var args = "act=get_mct_info&tid="+a.value;
    Ajax.call("bonus.php", args, callback, "GET", "JSON");
}
function callback(res)
{ 
	var createnum=document.getElementById('create_num');
	var affirmnum=document.getElementById('affirm_num');
  var scardnum1=document.getElementById('scardnum1');	
  var ecardnum1=document.getElementById('ecardnum1');

    createnum.style.display='';	
    affirmnum.style.display='';
  scardnum1.innerHTML=res['min_cardnum'];
  ecardnum1.innerHTML=res['max_cardnum'];

  document.getElementById('scardnum').value=res['min_cardnum'];
  document.getElementById('ecardnum').value=res['max_cardnum'];
  document.getElementById('type_id').value=res['bonus_type_id'];	
}


</script>

<?php echo $this->fetch('pagefooter.htm'); ?>
