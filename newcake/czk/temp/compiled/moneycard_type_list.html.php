<!-- $Id: bonus_type.htm 14216 2008-03-10 02:27:21Z testyang $ -->

<?php if ($this->_var['full_page']): ?>
<?php echo $this->fetch('pageheader.htm'); ?>
<h1>管理员：<?php echo $this->_var['admin_name']; ?></h1>
<?php echo $this->smarty_insert_scripts(array('files'=>'../js/utils.js,listtable.js')); ?>

<form method="post" action="" name="listForm">
<!-- start bonus_type list -->

<div class="list-div" id="listDiv">
<?php endif; ?>

  <table cellpadding="3" cellspacing="1">
    <tr>
      <th>编号</th>
      <th>起始编号</th>
      <th>截止编号</th>
      <th><a href="javascript:listTable.sort('type_name'); ">储值卡昵称</a><?php echo $this->_var['sort_type_name']; ?></th>
      <!-- <th><a href="javascript:listTable.sort('type_money'); ">面值金额</a><?php echo $this->_var['sort_type_money']; ?></th> -->
      <th>发放数量</th>
      <th>生效数量</th>
      <th>使用数量</th>
     <!--  <th><a href="javascript:listTable.sort('mc_sdate'); ">起始日期</a></th>
      <th><a href="javascript:listTable.sort('mc_sdate'); ">失效日期</a></th>   -->      
      <th>维护人</th>
      <th>操作</th>
    </tr>
    <?php $_from = $this->_var['type_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'type');if (count($_from)):
    foreach ($_from AS $this->_var['type']):
?>
      
    <tr>
      <td align="right"><?php echo $this->_var['type']['sn']; ?></td>
      <td align="right"><?php echo $this->_var['type']['mc_scardid']; ?></td>
      <td align="right"><?php echo $this->_var['type']['mc_ecardid']; ?></td>
      <td class="first-cell"><?php echo htmlspecialchars($this->_var['type']['mc_name']); ?>(<?php echo $this->_var['type']['mc_cdate']; ?>)</td>
      <!-- <td align="right"><?php echo $this->_var['type']['mc_money']; ?></td> -->
      <td align="right"><span><?php echo $this->_var['type']['send_count']; ?></span></td>
      <td align="right"><?php echo $this->_var['type']['affirm_count']; ?></td>
      <td align="right"><?php echo $this->_var['type']['use_count']; ?></td>      
       <!--  <td align="right"><?php echo $this->_var['type']['mc_sdate']; ?></td>
      <td align="right"><?php echo $this->_var['type']['mc_edate']; ?></td>   -->          
      <td align="right"><?php echo $this->_var['type']['mc_cname']; ?></td>
      <td align="right">        
        <a href="moneycard1.php?act=gen_excel&tid=<?php echo $this->_var['type']['mc_id']; ?>">导出</a> 
        <a href="moneycard1.php?act=get_moneycards_list&moneycard_type=<?php echo $this->_var['type']['mc_id']; ?>">查看</a>
      </tr>
      
      <?php endforeach; else: ?>
    <tr><td class="no-records" colspan="10"><?php echo $this->_var['lang']['no_records']; ?></td></tr>
      <?php endif; unset($_from); ?><?php $this->pop_vars();; ?>
    </table>
    
      <table cellpadding="4" cellspacing="0">
    <tr>
      <td align="right"><?php echo $this->fetch('page.htm'); ?></td>
    </tr>
  </table> 

<?php if ($this->_var['full_page']): ?>
</div>
<!-- end bonus_type list -->
</form>

<script type="text/javascript" language="JavaScript">
<!--
  listTable.recordCount = <?php echo $this->_var['record_count']; ?>;
  listTable.pageCount = <?php echo $this->_var['page_count']; ?>;
  listTable.query = "query";

  <?php $_from = $this->_var['filter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
  listTable.filter.<?php echo $this->_var['key']; ?> = '<?php echo $this->_var['item']; ?>';
  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>

  
  onload = function()
  {
     // 开始检查订单
     startCheckOrder();
  }
  
//-->
function searchMoneycard()
{
	listTable.filter['mc_enable'] = document.forms['searchForm'].elements['type'].value;
	listTable.filter['flag']=document.forms['searchForm'].elements['flag'].value;
	listTable.loadList();
}

</script>
<?php echo $this->fetch('pagefooter.htm'); ?>
<?php endif; ?>