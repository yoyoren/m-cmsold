<style type="text/css">
body {margin:0;}
td{font-size:12px;}
</style>
<table height="84"><tr><td>&nbsp;&nbsp;&nbsp;</td></tr></table>
<table width="700" border="0" height="">
	<tr height="30">
      <td width="18%" valign="top" ><b>
	  <?php $_from = $this->_var['array']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'pack_0_50636000_1375666555');if (count($_from)):
    foreach ($_from AS $this->_var['pack_0_50636000_1375666555']):
?>
	  <font size="-1"><?php echo $this->_var['pack_0_50636000_1375666555']; ?></font><br/>
	  <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	  </b></td>
      <td width="17%"> <?php echo $this->_var['order']['add_date']; ?></td>
      <td width="65%"><font size="+1">&nbsp;&nbsp;<?php echo $this->_var['order']['order_sn']; ?></font>&nbsp;&nbsp;<B><font size="+1"><?php echo $this->_var['psn']; ?>&nbsp;</font></B></td>
	</tr>
</table>
<table width="700" border="0" height="50">
  <tr>
    <td></td>
	<td></td>
  </tr>
</table>
<table width="700" border="0" height="">
    <tr height="27">
      <td width="16%" colspan="2" style="overflow:hidden;">&nbsp;&nbsp;<?php echo $this->_var['order']['orderman']; ?></td>
	  <td width="20%">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['ordertel']; ?></td>
      <td width="7%">&nbsp;</td>
	  <td width="19%">&nbsp;</td>
      <td width="1%">&nbsp;</td>
	  <td width="38%"><?php echo $this->_var['order']['tel']; ?>&nbsp;</td>
    </tr>
    <tr height='28'>
    	<td width="16%" colspan="2">&nbsp;&nbsp;<?php echo $this->_var['order']['consignee']; ?></td>
        <td width="16%">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['mobile']; ?>&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['tel']; ?></td>
		<td width="7%">&nbsp;</td>
        <td width="19%"><?php echo $this->_var['order']['btime']; ?></td>
		<td width="1%">&nbsp;</td>
        <td width="38%"><?php if ($this->_var['order']['integral'] > 0): ?>-<?php echo $this->_var['order']['integral']; ?><?php endif; ?></td>
  </tr>
     <tr height="26">
	    <td width="2%">
    	<td colspan="6" width="98%"><?php echo $this->_var['order']['address']; ?></td>
     </tr>
     <tr height="26">
	    <td width="2%"></td>
    	<td colspan="6" height='25'><?php echo $this->_var['order']['money_address']; ?></td>
      </tr>
</table>
<table width="700" height="136" border="0">
	<tr height="38">
		<td colspan="7">&nbsp;</td>
  	</tr>
    <?php $_from = $this->_var['goods']['goods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods_0_50687800_1375666555');if (count($_from)):
    foreach ($_from AS $this->_var['goods_0_50687800_1375666555']):
?>
     <tr height="16" style="line-height:12px;">
          <td width="15%" align="left"><?php echo $this->_var['goods_0_50687800_1375666555']['goods_sn']; ?><?php echo $this->_var['goods_0_50687800_1375666555']['goods_name']; ?></td>
          <td width="5%" align="center"><?php echo $this->_var['goods_0_50687800_1375666555']['goods_attr']; ?></td>
           <td width="10%" align="center"><?php echo $this->_var['goods_0_50687800_1375666555']['goods_number']; ?></td>
           <td width="10%" align="center"><?php if ($this->_var['goods_0_50687800_1375666555']['goods_sn'] == 'D3'): ?>套<?php else: ?>个<?php endif; ?></td>
           <td width="12%" align="center"><?php echo $this->_var['goods_0_50687800_1375666555']['goods_price']; ?></td>
           <td width="10%" align="left"><?php echo $this->_var['goods_0_50687800_1375666555']['goods_discount']; ?></td>
           <td width="41%"><?php echo $this->_var['goods_0_50687800_1375666555']['goods_sub']; ?></td>
     </tr>
    <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
	<tr><td colspan="7"></td></tr>
 </table>
 <table width="700" height="96px" border="0">
   <tr>
     <td>
     <table width="210" height="94" style="float:left;" border="0">
       <tr>
	   <td width="70">&nbsp;</td>
	  <td width="70">&nbsp;</td>
	  <td width="70">&nbsp;</td>
      </tr>
      <tr height="28">
	  <td></td>
	  <td align="center"><?php echo $this->_var['goods']['canju']; ?></td>
	  <td align="center"><?php echo $this->_var['goods']['canju_sum']; ?></td>
     </tr>
    	   <tr height="30">
		      <td></td>
			  <td align="center"><?php echo $this->_var['goods']['candle']; ?></td>
			  <td align="center"><?php echo $this->_var['goods']['candle_sum']; ?></td>
		   </tr>
		</table>
	 </td>
	 <td>
		<table width="590" height="90" border="0">
		   <tr height="30">
			  <td colspan="4">&nbsp;</td>
		   </tr>
		   <tr height="58">
		      <td width="35"></td>
			  <td width="70" align="center"> <?php echo $this->_var['order']['pay_fee']; ?><br /><br /><?php echo $this->_var['order']['shipping_fee']; ?></td>
			  <td width="200" align="center"><?php echo $this->_var['order']['card_name']; ?><?php echo $this->_var['order']['card_message']; ?> </td>
			  <td></td>
				</tr>
			</table>
	   </td>
	</tr>
</table>
<table width="700" height="70" border="0">
  <tr>
      <td colspan="7">&nbsp;</td>
  </tr>
   <tr>
      <td width="100"></td>

      <td height='20' width="60"><?php echo $this->_var['order']['goods_amount']; ?></td>
      <td width="60"><?php echo $this->_var['order']['fj_fee']; ?></td>
      <td width="60"><?php echo $this->_var['order']['fw_fee']; ?></td>
      <td width="60"><?php echo $this->_var['pay']['paid']; ?></td>
      <td width="70"><?php echo $this->_var['pay']['payname']; ?></td>
      <td width="60"><?php echo $this->_var['pay']['unpaid']; ?>	
	  <?php if ($this->_var['pay'] [ card_no ]): ?>(卡号:<?php echo $this->_var['pay']['card_no']; ?>)<?php endif; ?></td>
	  <td width="80">&nbsp;</td>
	  <td width="80">&nbsp;</td>
	 
  </tr>
</table>
<table width="600" height="68" border="0">
	<tr>
      <td width='80' rowspan="2" height='60'>&nbsp;</td>
      <td width="100" height="40"><?php echo $this->_var['order']['inv_payee']; ?>&nbsp;</td>
      <td width="50"><?php echo $this->_var['order']['inv_content']; ?>&nbsp;</td>
      <td width="180"><?php echo $this->_var['order']['to_buyer']; ?>&nbsp;</td>
  </tr>
</table>
<table width="700" height="75" border="0">
	<tr>
      <td width='120' height='75'>&nbsp;</td>
      <td width="580" height="75">
	  <table>
         <tr height="25">
		    <td width="140">&nbsp;</td>
			<td width="140">&nbsp;</td>
			<td width="300">&nbsp;</td>
		 </tr>	
	  </table>
      </td>
  </tr>
</table>
<table width="510" height="86" border="0">
	<tr>
   	  <td width="60" height='20'>&nbsp;</td>
      <td width="220">&nbsp;</td>
      <td width="160">&nbsp;</td>
      <td>&nbsp;</td>
  </tr>
    <tr>
    	<td height='55' align="center">0</td>
      	<td align="center"></td>
        <td>不办理</td>
        <td width="160"><?php echo $this->_var['order']['wsts']; ?>&nbsp;</td>
    </tr>
</table>

<table height="164" width="700"><tr><td width=157></td><td valign=bottom><H3></H3></td></tr></table>
<table width='700' height="22" border="0">
	<tr>
      <td width="25%"></td>
      <td width="32%"></td>
      <td width="43%"></td>
  </tr>
</table>
<table width='700' border="0" height="30">
	<tr height="30">
      <td width="40"></td>
      <td width="80"></td>
      <td width="100"></td>
	  <td width="80"></td>
      <td width="60"></td>
      <td></td>
  </tr>
</table>
<table width="700" height="56" border="0">
    <tr height='26'>
    	<td width="40">&nbsp;</td>
  		<td colspan='5' >&nbsp;	   
		</td>
    </tr>
	<tr>
	    <td width="40">&nbsp;</td>
        <td colspan='5' height='26'></td> 
	</tr>
</table>
<table height="164" width="700" border="0">
	<!--<tr><td align="left" valign="top"><!--&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_var['order']['other']; ?><?php if ($this->_var['order']['province'] <> '501'): ?><font size='+2'>环外</font><?php endif; ?></td></tr>-->
	<tr>
      <td height="22" width="45">&nbsp;</td>
      <td width="70">&nbsp;</td>
      <td width="60"></td>
      <td width="70">&nbsp;</td>
      <td width="80">&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
</table>
<table width="700" border="0">
    <tr>
    	<td height="22" width="45">&nbsp;</td>
        <td width="70">&nbsp;</td>
        <td width="60"></td>
        <td width="70">&nbsp;</td>
        <td width="80">&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
    <tr>
    	<td height="30" width="20">&nbsp;</td>
        <td width="170"><B></B>
		</td>
		<td>&nbsp;</td>
        <td colspan="3" align="left" style="padding-left:25px;"  width="170">&nbsp;&nbsp;<B></B></td>
    </tr>
</table>
