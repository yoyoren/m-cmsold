<?php echo $this->fetch('header.html'); ?>
<?php echo $this->smarty_insert_scripts(array('files'=>'utils.js,transport.js,validator.js')); ?>
<div class="text_title">
	<h3 style="float:left;display:inline;">--<?php echo $this->_var['ur_here']; ?></h3>
	<?php if ($this->_var['action_link']): ?>
	<div class="action-span"><a href="<?php echo $this->_var['action_link']['href']; ?>"><?php echo $this->_var['action_link']['text']; ?></a></div>
	<?php endif; ?>
	<div style="clear:both"></div>
</div>
<div class="main-div">
    <form name="theForm" method="post" enctype="multipart/form-data" onsubmit="return validate();">
        <table width="100%">
            <tr>
                <td class="label">部门：</td>
                <td>
                    <select name="dept">	  
                        <option value="1" <?php if ($this->_var['employee']['dept_id'] == '1'): ?>selected<?php endif; ?>>配送部</option>
                        <!-- <option value="2" <?php if ($this->_var['employee']['dept_id'] == '2'): ?>selected<?php endif; ?>>财务部</option> -->
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">站点：</td>
                <td>
                    <select name="station" id="station">
                    	<option value="" <?php if ($this->_var['sel'] == 1): ?> disabled="disabled" <?php endif; ?>>-请选择-</option>
                    	<?php $_from = $this->_var['stations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 's');if (count($_from)):
    foreach ($_from AS $this->_var['s']):
?>
                    	<option value="<?php echo $this->_var['s']['station_id']; ?>" <?php if ($this->_var['sel'] == 1 || $this->_var['employees']['station_id'] == $this->_var['s']['station_id']): ?> selected="selected" <?php endif; ?>><?php echo $this->_var['s']['station_name']; ?></option>
                    	<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">岗位：</td>
                <td>
                    <select name="posts">
                        <option value="1"<?php if ($this->_var['employees']['level'] == '1'): ?>selected ="selected"<?php endif; ?>>配送员</option>	  
                        <!-- <option value="2"<?php if ($this->_var['employees']['level'] == '2'): ?>selected ="selected"<?php endif; ?>>调度员</option>
                         <option value="3"<?php if ($this->_var['employees']['level'] == '3'): ?>selected ="selected"<?php endif; ?>>收银员</option>-->
                        <option value="4"<?php if ($this->_var['employees']['level'] == '4'): ?>selected ="selected"<?php endif; ?>>站长</option>
                        <option value="5"<?php if ($this->_var['employees']['level'] == '5'): ?>selected ="selected"<?php endif; ?>>副站长</option> 
                    </select>
                </td>
            </tr>
            <tr>
                <td class="label">姓名：</td>
                <td><input type="text" name="name" value="<?php echo $this->_var['employees']['name']; ?>" /></td>
            <tr>
                <td class="label">电话：</td>
                <td><input type="text" name="office_phone" value="<?php echo $this->_var['employees']['office_phone']; ?>" /></td>
            </tr>
            <tr>
                <td class="label">手机：</td>
                <td><input type="text" name="office_mobile" value="<?php echo $this->_var['employees']['office_mobile']; ?>" /></td>
            </tr>
            
            <tr>
                <td class="label"><input type="submit" value="提交内容" class="button" /></td>
                <td>
                	&nbsp;&nbsp;&nbsp;<input type="reset" value="重置" class="button" />
                    <input type="hidden" name="id" value="<?php echo $this->_var['id']; ?>" />
                    <input type="hidden" name="act" value="<?php echo $this->_var['form_act']; ?>" />
                </td>
            </tr>
        </table>
    </form>
</div>

<script type="text/javascript">
function switchSite(obj, station) { // Switch the site
	var city_code = obj.options[obj.selectedIndex].value;
	Ajax.call('employee.php?is_ajax=1&act=site', 'city_code=' + city_code + '&station=' + station, responseSwitchSite, 'GET', 'JSON');
}

function responseSwitchSite(result) { // The switchSite function callback method
	var sel = document.getElementById(result.target);
	sel.length = 1;
	sel.selectedIndex = 0;

	if (document.all) { // Processing onchange() event of compatibility
		sel.fireEvent('onchange');
	} else {
		var evt = document.createEvent('HTMLEvents');
		evt.initEvent('change', true, true); // Initializes the newly created evt object's properties
		sel.dispatchEvent(evt);
	}

	if (result.site) {
		for (var i = 0; i < result.site.length; i++) {
			var opt = document.createElement('OPTION');
			opt.value = result.site[i].station_id;
			opt.text = result.site[i].station_name;
			
//			if (<?php echo $this->_var['station_id']; ?> == result.site[i].station_id)			opt.selected = true;
			sel.options.add(opt);
		}
	}
}

function validate() { // Verify the form frame of data
	var validator = new Validator('theForm');
	validator.required('station', '站点不能为空！');
	validator.required('name', '姓名不能为空！');
	validator.required('office_mobile', '手机号不能为空！');
	return validator.passed();
}
</script><?php echo $this->fetch('pagefooter.htm'); ?>