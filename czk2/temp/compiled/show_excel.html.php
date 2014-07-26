<!-- $Id: bonus_type.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?><span style="margin-left:900px;"><a href='export_excel.php?adate=""&odate=""'><font color="#FF0000">【导出到excel表格】</font></a></span></h1>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>
<div class="list-div">
  <table cellpadding="3" cellspacing="1">
    <tr><td>礼金卡描述：</td><td><?php echo $this->_var['type']['mc_name']; ?></td>
    	<td>导出数量：</td><td><?php echo $this->_var['type']['sent_count']; ?></td>
    </tr>
    <tr><td>起始编号：</td><td><?php echo $this->_var['type']['mc_scardid']; ?></td>
    	<td>截止编号：</td><td><?php echo $this->_var['type']['mc_ecardid']; ?></td>
    	
    </tr>
    <tr><td>维护人：</td><td><?php echo $this->_var['type']['mc_cname']; ?></td>
    	<td>维护日期：</td><td><?php echo $this->_var['type']['mc_cdate']; ?></td>
    	
    </tr>

    <tr><td>导出人：</td><td><?php echo $this->_var['admin_name']; ?></td>
    	<td>导出日期：</td><td><?php echo $this->_var['type']['print_date']; ?></td>
    	
    </tr>
  </table>  
</div>

<form method="post" action="moneycard1.php?act=gen_excelaction&tid=<?php echo $this->_var['type']['mc_id']; ?>" name="listForm">
<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>编号</th>
      <th>礼金卡描述</th>
      <th>面值金额</th>
      <th>卡号</th>
      <th>密码</th>
      <th>使用起始日期</th>
      <th>使用失效日期</th>
      <th>状态</th>
      <th>生效人</th>
      <th>生效日期</th>
      <th>使用会员</th>
      <th>使用时间</th>
    </tr>
    <?php $_from = $this->_var['type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'val');if (count($_from)):
    foreach ($_from AS $this->_var['val']):
?>
    <tr> 
      <td align="right"><?php echo $this->_var['val']['id']; ?></td>     
      <td align="right"><?php echo $this->_var['type']['mc_name']; ?></td>
      <td align="right">￥<?php echo $this->_var['val']['cardmoney']; ?></td>
      <td align="right"><?php echo $this->_var['val']['cardid']; ?></td>      
      <td align="right"><?php echo $this->_var['val']['cardpassword']; ?></td>
      <td align="right"><?php echo $this->_var['val']['sdate']; ?></td>
      <td align="right"><?php echo $this->_var['val']['edate']; ?></td>
      <td align="right"><?php if ($this->_var['val']['flag'] == 0): ?>待生效<?php else: ?>已生效<?php endif; ?></td>
      <td align="right"><?php echo $this->_var['val']['aname']; ?></td>
      <td align="right"><?php echo $this->_var['val']['adate']; ?></td>
      <td align="right"><?php echo $this->_var['val']['user_name']; ?></td>
      <td align="right"><?php echo $this->_var['val']['used_time']; ?></td>
    </tr>
      <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
      <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
       
    <tr><td><input type="submit" value="导出" name="a" id="a" class="button"/></td>
    </tr>
  </table>

<?php if ($this->_var['full_page']): ?>
</div>
</form>

<script type="text/javascript" language="JavaScript">

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>