<!-- $Id: bonus_by_print.htm 14216 2008-03-10 02:27:21Z testyang $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<div class="main-div">
<form action="bonus.php" method="post" name="theForm" enctype="multipart/form-data" onsubmit="return validate()">
<table width="100%">
  <tr>
    <td class="label"><?php echo $this->_var['lang']['bonus_type_id']; ?></td>
    <td>
    <select name="bonus_type_id">
      <?php echo $this->html_options(array('options'=>$this->_var['type_list'],'selected'=>$_GET['id'])); ?>
    </select>
    </td>
  </tr>
   <tr>
      <td class="label"><?php echo $this->_var['lang']['send_bonus_count']; ?></td>
      <td>
      <input type="text" name="bonus_sum" size="30" maxlength="6" />
      </td>
    </tr>
    <td class="label">&nbsp;</td>
    <td><?php echo $this->_var['lang']['bonus_sn_notic']; ?></td>
   </tr>
   <tr>
   <td class="label">&nbsp;</td>
   <td>
    <input type="submit" value="<?php echo $this->_var['lang']['button_submit']; ?>" class="button" />
    <input type="reset" value="<?php echo $this->_var['lang']['button_reset']; ?>" class="button" />
  </td>
 </tr>
</table>
<input type="hidden" name="act" value="send_by_print" />
</form>
</div>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,validator.js')); ?>

<script language="JavaScript">
<!--
document.forms['theForm'].elements['bonus_sum'].focus();
/**
 * 检查表单输入的数据
 */
function validate()
{
    validator = new Validator("theForm");
    validator.required("bonus_type_id",   bonus_type_empty);
    validator.required("bonus_sum",   bonus_sum_empty);
    validator.isNumber("bonus_sum",   bonus_sum_number, true);
    return validator.passed();
}

onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>