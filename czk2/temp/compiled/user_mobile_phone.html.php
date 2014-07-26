<!-- $Id: eachday_count.htm  2013-11-30 02:27:21Z testxufengli $ -->
<?php if ($this->_var['full_page']): ?>
<script type="text/javascript" src="../js/calendar.php?lang=<?php echo $this->_var['cfg_lang']; ?>"></script>
<link href="../js/calendar/calendar.css" rel="stylesheet" type="text/css" />
<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?></h1>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<!-- start user_bonus list -->
<div class="list-div" id="listDiv">
<?php endif; ?>
<div style="text-align:center; font-size:16px;height:60px;line-height:60px;">
请点击右上角【会员电话导出】导出会员电话<font size="+5">&nbsp;&nbsp;:)</font>
<?php if ($this->_var['full_page']): ?>
</div>
</div>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>