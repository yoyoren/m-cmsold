<div class="box history" id='history_div'>
  <div class="history_title"></div>
  <div id='history_list'>    
    <ul>
        	<?php $_from = $this->_var['history_goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_10003900_1403744144');$this->_foreach['history_goods'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['history_goods']['total'] > 0):
    foreach ($_from AS $this->_var['goods_0_10003900_1403744144']):
        $this->_foreach['history_goods']['iteration']++;
?>
            <li>
            <span><?php echo $this->_foreach['history_goods']['iteration']; ?></span>
            <img src="<?php echo $this->_var['goods_0_10003900_1403744144']['goods_thumb']; ?>" width="40" height="30" />
            <img src="themes/default/images/price_name.gif" width="24" height="24" />
            <div>
            <p style="color:#000;"><?php echo price_format_new($this->_var['goods_0_10003900_1403744144']['goods_price']); ?></p>
			<p><?php echo $this->_var['goods_0_10003900_1403744144']['goods_name']; ?></p>
            </div>
            </li>
            <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
            
        </ul>    
  </div>
</div>
<script type="text/javascript">
if (document.getElementById('history_list').innerHTML.replace(/\s/g,'').length<1)
{
    document.getElementById('history_div').style.display='none';
}
else
{
    document.getElementById('history_div').style.display='block';
}
function clear_history()
{
Ajax.call('user.php', 'act=clear_history',clear_history_Response, 'GET', 'TEXT',1,1);
}
function clear_history_Response(res)
{
document.getElementById('history_list').innerHTML = '<?php echo $this->_var['lang']['no_history']; ?>';
}
</script>