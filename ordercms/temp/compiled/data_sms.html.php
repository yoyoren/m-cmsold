<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js,validator.js')); ?>
<style>
<!--
.button2{
background:#ddd;height:24px; border-top:0;border-left:0; border-bottom:1px solid #666; border-right:1px solid #666; padding:3px 6px; margin-right:5px
}
-->
</style>
<div class="text_title">
	<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
	<?php if ($this->_var['action_link']): ?>
	<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
	<?php endif; ?>
	<div style="clear:both"></div>
</div>

<div class="main-div">
<form name="form1" method="post" action="data_sms.php?act=sendSms" enctype="multipart/form-data" >
<table  width="520" align="center" cellpadding="3" border="0">
	<tr>
		<td align="right">手机号：</td>
		<td colspan="2">
		<input type="text" name="mobile" size ="50" value="" /><br/>
		(多个手机号用英文逗号","隔开)
		</td>
	</tr>
	<tr>
		<td align="right">批量发送：</td>
		<td colspan="2">
		<input name="upfile"  type="file" />
		</td>
	</tr>
	<tr>
		<td align="right">内容：</td>
		<td>
		<textarea rows="13" id="content" name="content" cols="50"></textarea>
		</td>
		<td valign="top">
		<input type="button" class="button2" onClick="javascript:insertText('[姓名]')" value="姓名" title=""/> <br /><br />
		<input type="button" class="button2" onClick="javascript:insertText('[卡号]')" value="卡号" title=""/>  <br /><br />
		<input type="button" class="button2" onClick="javascript:insertText('[密码]')" value="密码" title=""/><br />
		
		</td>
	</tr>
	<tr>
		<td align="right"></td>
		<td colspan="2">
		<input type="submit" name="sub" class="button" value="发送" />
		</td>
	</tr>
</table>
</form>
</div>
<script type="text/javascript">
function insertText(text)
{
	document.getElementById("content").focus();
	var str = document.selection.createRange();
	str.text = text;
}

</script>
</body>
</html>