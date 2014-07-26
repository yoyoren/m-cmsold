<?php echo $this->fetch('header.html'); ?>
<div class="text_title">
<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
<div style="clear:both"></div>
</div>
<form method="POST" action="role.php" name="theFrom">
<div class="list-div">
<table width="100%" bgcolor="#ffffff" cellpadding="5">
  <tr>
    <td class="label">角色名</td>
    <td>
      <input type="text" name="user_name" maxlength="20" value="<?php echo htmlspecialchars($this->_var['user']['role_name']); ?>" size="34"/><?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  <tr>
    <td class="label">角色描述</td>
    <td>
    <textarea name="role_describe" cols="31" rows="6"><?php echo htmlspecialchars($this->_var['user']['role_describe']); ?></textarea>
<?php echo $this->_var['lang']['require_field']; ?></td>
  </tr>
  </table>
<table cellspacing='1' cellpadding="5" id="list-table" bgcolor="#ffffff">
<?php $_from = $this->_var['priv_arr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'priv');if (count($_from)):
    foreach ($_from AS $this->_var['priv']):
?>
 <tr>
  <td width="18%" valign="top" class="first-cell">
    <input name="chkGroup" type="checkbox" value="checkbox" onclick="check('<?php echo $this->_var['priv']['priv_list']; ?>',this);" class="checkbox"><?php echo $this->_var['lang'][$this->_var['priv']['action_code']]; ?>
  </td>
  <td>
    <?php $_from = $this->_var['priv']['priv']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('priv_list', 'list');if (count($_from)):
    foreach ($_from AS $this->_var['priv_list'] => $this->_var['list']):
?>
    <div style="width:200px;float:left;">
    <label for="<?php echo $this->_var['priv_list']; ?>"><input type="checkbox" name="action_code[]" value="<?php echo $this->_var['priv_list']; ?>" id="<?php echo $this->_var['priv_list']; ?>" class="checkbox" <?php if ($this->_var['list']['cando'] == 1): ?> checked="true" <?php endif; ?> onclick="checkrelevance('<?php echo $this->_var['list']['relevance']; ?>', '<?php echo $this->_var['priv_list']; ?>')" title="<?php echo $this->_var['list']['relevance']; ?>"/>
    <?php echo $this->_var['lang'][$this->_var['list']['action_code']]; ?></label>
    </div>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
</td></tr>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
  <tr>
    <td align="center" colspan="2" >
      <input type="checkbox" name="checkall" value="checkbox" onclick="checkAll(this.form, this);" class="checkbox" /><?php echo $this->_var['lang']['check_all']; ?>
      &nbsp;&nbsp;&nbsp;&nbsp;
      <input type="submit"   name="Submit"   value="保存" class="button" />&nbsp;&nbsp;&nbsp;
      <input type="reset" value="重置" class="button" />
      <input type="hidden"   name="id"    value="<?php echo $this->_var['user_id']; ?>" />
      <input type="hidden"   name="act"   value="<?php echo $this->_var['form_act']; ?>" />
    </td>
  </tr>
</table>
</div>
</form>


<script language="javascript">
function checkAll(frm, checkbox)
{
  for (i = 0; i < frm.elements.length; i++)
  {
    if (frm.elements[i].name == 'action_code[]' || frm.elements[i].name == 'chkGroup')
    {
      frm.elements[i].checked = checkbox.checked;
    }
  }
}

function check(list, obj)
{
  var frm = obj.form;

    for (i = 0; i < frm.elements.length; i++)
    {
      if (frm.elements[i].name == "action_code[]")
      {
          var regx = new RegExp(frm.elements[i].value + "(?!_)", "i");

          if (list.search(regx) > -1) {frm.elements[i].checked = obj.checked;}
      }
    }
}

function checkrelevance(relevance, priv_list)
{
  if(document.getElementById(priv_list).checked && relevance != '')
  {
    document.getElementById(relevance).checked=true;
  }
  else
  {
    var ts=document.getElementsByTagName("input");
    
    for (var i=0; i<ts.length;i++)
    {
      var text=ts[i].getAttribute("title");

      if( text == priv_list) 
      {
        document.getElementById(ts[i].value).checked = false;
      }
    }
  }
}
</script>

<?php echo $this->fetch('footer.html'); ?>
