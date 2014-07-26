<!-- $Id: about_us.htm 16654 2009-09-09 10:29:24Z liuhui $ -->
<?php echo $this->fetch('pageheader.htm'); ?>
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="2" class="group-title"><?php echo $this->_var['lang']['team_member']; ?></th>
  </tr>
  <tr>
    <td width="20%" class="first-cell"><?php echo $this->_var['lang']['director']; ?></td><td>
    KunPeng Liu,&nbsp; Kai Li
    </td>
  </tr>
  <tr>
    <td class="first-cell"><?php echo $this->_var['lang']['programmer']; ?></td><td>

      Robb Liu,&nbsp; Huaixiao Ye,&nbsp; Qinghua Dou,&nbsp; Lei Wang, Hui Liu
    </td>
  </tr>
  <tr>
    <td class="first-cell"><?php echo $this->_var['lang']['ui_designer']; ?></td><td>
      JianXi Wang,Dujuan Zhu,Qi Gao
    </td>
  </tr>

</table>
</div>
<br />
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="2" class="group-title"><?php echo $this->_var['lang']['special_thanks']; ?></th>
  </tr>
  <tr>
    <td class="first-cell" width="20%" rowspan="2"><?php echo $this->_var['lang']['before_team_member']; ?></td><td >Paul Gao,&nbsp; Weber Liu,&nbsp; Kelly Yang,&nbsp;DaMing Wen, &nbsp;Scott Ye <br/> Wenjin Zhang, &nbsp;Steven liu,  &nbsp;Xiaodong Sun,&nbsp;
  Xiaochuan Shi<br/>Yecior,&nbsp;Zhibin Li,&nbsp;Hua Change,&nbsp;ShaoFeng Qu</td>

  </tr>
  <tr>
    <td><a href="http://www.wooyun.org" target="_blank" > www.wooyun.org</a>, <a href="http://www.fengblog.org" target="_blank"> www.fengblog.org</a></td>
  </tr>
  <tr>

  </tr>
</table>
</div>
<br />
<div class="list-div">
<table cellspacing='1' cellpadding='3'>
  <tr>
    <th colspan="2" class="group-title"><?php echo $this->_var['lang']['official_site']; ?></th>
  </tr>
  <tr>
    <td class="first-cell" width="20%"><?php echo $this->_var['lang']['site_url']; ?></td><td><a href="http://www.ecshop.com" target="_blank">http://www.ecshop.com</a></td>
  </tr>
  <tr>
    <td class="first-cell" width="20%"><?php echo $this->_var['lang']['support_forum']; ?></td><td><a href="http://bbs.ecshop.com" target="_blank">http://bbs.ecshop.com</a></td>
  </tr>
</table>
</div>

<script type="Text/Javascript" language="JavaScript">
<!--
onload = function()
{
    // 开始检查订单
    startCheckOrder();
}
//-->
</script>

<?php echo $this->fetch('pagefooter.htm'); ?>