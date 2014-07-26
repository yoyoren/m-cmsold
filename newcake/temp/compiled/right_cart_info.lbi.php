<div class="my_right_cart_info">
<div class="ct">
<span class="cn"><?php echo empty($this->_var['cart_goods_number']) ? '0' : $this->_var['cart_goods_number']; ?></span>
</div>
<div class="cl">

</div>
<div class="cline"></div>
<div class="cb">
<table width="90%" border="0" align="center" cellpadding="0" cellspacing="0">
<?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_10255200_1403744144');$this->_foreach['cart_goods_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['cart_goods_list']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_10255200_1403744144']):
        $this->_foreach['cart_goods_list']['iteration']++;
?>
  <tr>
    <td width="50" align="left" style="font-size:11px;"><?php echo $this->_var['goods_0_10255200_1403744144']['goods_name']; ?></td>
    <td width="35" align="center"><?php echo $this->_var['goods_0_10255200_1403744144']['goods_number']; ?></td>
    <td width="35" align="center"><?php echo price_format_new($this->_var['goods_0_10255200_1403744144']['goods_price']); ?></td>
    <td align="center"><a href="javascript:if (confirm('<?php echo $this->_var['lang']['drop_goods_confirm']; ?>')) location.href='flow.php?step=drop_goods&amp;id=<?php echo $this->_var['goods_0_10255200_1403744144']['rec_id']; ?>'; "><img src="themes/default/images/cancel_btn.gif" width="12" height="12" /></a></td>
  </tr>
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>  
  <tr>
    <td colspan="2" align="left" style="border-top:solid #d4d4d4 2px;">总计/Total：</td>
    <td colspan="2" align="right" style="border-top:solid #d4d4d4 2px;"><?php echo $this->_var['shopping_money']; ?></td>
    </tr>
</table>
</div>
<div class="cline"></div>
<div>
<img src="themes/default/images/btn_cart_clear_all.gif" class="f_l" onclick="location.href='flow.php?step=clear'" />
<img src="themes/default/images/btn_cart_next_step.gif" class="f_r" onclick="location.href='flow.php?step=cart'" />
</div>

</div>
