<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="<?php echo $this->_var['keywords']; ?>" />
<meta name="Description" content="<?php echo $this->_var['description']; ?>" />

<title><?php echo $this->_var['page_title']; ?></title>

<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="<?php echo $this->_var['ecs_css_path']; ?>" rel="stylesheet" type="text/css" />
<?php if ($this->_var['cat_style']): ?>
<link href="<?php echo $this->_var['cat_style']; ?>" rel="stylesheet" type="text/css" />
<?php endif; ?>


<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,global.js')); ?>
<script language="javascript" type="text/javascript">
function pic()
{
	document.getElementById('bgimg').height=document.body.offsetHeight+40;
	var cat_id=<?php echo $this->_var['category']; ?>;
	if(document.getElementById('c'+cat_id))
	{
	document.getElementById('c'+cat_id).setAttribute('class','current1');
	}
}
</script>
</head>
<body onload="pic()">
<div id="div_bg" style="margin-top:20px">
<img src="themes/default/images/bg.jpg"  id="bgimg" style="z-index:-1;position:absolute;left:0;top:0;width:100%;" >
<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="catnav">
<?php if ($this->_var['cakenav']): ?>
<div class="catnav1">
	<a href="category.php?id=1"> 
        <img src="themes/default/images/allb.png"  id="c1" style="margin-left:15px"   />
    </a>
    <a href="category.php?id=4"><img src="themes/default/images/c4.png" id="c4" style="margin-left:20px" /></a>
    <a href="category.php?id=5"><img src="themes/default/images/c5.png" id="c5" style="margin-left:20px" /></a>
    <a href="category.php?id=6"><img src="themes/default/images/c6.png" id="c6" style="margin-left:20px" /></a>
</div>
<?php endif; ?>
<?php if ($this->_var['cakenav1']): ?>
<div class="catnav2">
	<a href="category.php?id=4"><img id="c4" src="themes/default/images/alls.png"  /></a>
    <a href="category.php?id=7"><img id="c7" src="themes/default/images/c78.png"  /></a>
    <a href="category.php?id=8"><img  id="c8" src="themes/default/images/c910.png"  /></a>
    <a href="category.php?id=9"><img id="c9" src="themes/default/images/c1112.png"  /></a>
</div>
<?php endif; ?>
</div>
<div class="cmain clearfix">
  
  <div class="AreaL"><?php echo $this->smarty_insert_scripts(array('files'=>'transport.js')); ?>
   <?php $_from = $this->_var['goods_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('', 'goods');if (count($_from)):
    foreach ($_from AS $this->_var['goods']):
?>

	<?php if ($this->_var['goods']['i'] == 4): ?> <div  class="f_l cimgb " onmouseover="showgoodsbg(<?php echo $this->_var['goods']['goods_id']; ?>)" onmouseout="showgoods(<?php echo $this->_var['goods']['goods_id']; ?>)"><?php if ($this->_var['cakenav1']): ?><img src="themes/default/images/c1.png"><?php endif; ?>
	<?php if ($this->_var['category'] == 2): ?><img src="themes/default/images/Dseeerts.png"><?php endif; ?></div>
	<div  class="cimg f_l cimgl goods1" onmouseover="showgoodsbg(<?php echo $this->_var['goods']['goods_id']; ?>)" onmouseout="showgoods(<?php echo $this->_var['goods']['goods_id']; ?>)"><img src="themes/default/images/cake.jpg" name="<?php echo $this->_var['goods']['goods_id']; ?>" usemap="#Map<?php echo $this->_var['goods']['goods_id']; ?>" id="<?php echo $this->_var['goods']['goods_id']; ?>" />
	  <map name="Map<?php echo $this->_var['goods']['goods_id']; ?>" id="Map<?php echo $this->_var['goods']['goods_id']; ?>">
        <area shape="rect" coords="193,185,244,212" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" />
        <area shape="rect" coords="196,215,243,243" href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" />
	  </map>
	</div>
	 <?php elseif ($this->_var['goods']['i'] == 1): ?><div  class="cimg f_l goods1" onmouseover="showgoodsbg(<?php echo $this->_var['goods']['goods_id']; ?>)" onmouseout="showgoods(<?php echo $this->_var['goods']['goods_id']; ?>)">
	 <img src="themes/default/images/cake.jpg" name="<?php echo $this->_var['goods']['goods_id']; ?>" usemap="#Map<?php echo $this->_var['goods']['goods_id']; ?>" id="<?php echo $this->_var['goods']['goods_id']; ?>" />
	 <map name="Map<?php echo $this->_var['goods']['goods_id']; ?>" id="Map<?php echo $this->_var['goods']['goods_id']; ?>">
            	<area shape="rect" coords="193,185,244,212" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" />
				 <area shape="rect" coords="196,215,243,243" href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" />
	 </map> 
	 </div> 
	 <?php elseif ($this->_var['goods']['i'] == 5): ?><div  class="cimg f_l goods1" onmouseover="showgoodsbg(<?php echo $this->_var['goods']['goods_id']; ?>)" onmouseout="showgoods(<?php echo $this->_var['goods']['goods_id']; ?>)">
	 <img src="themes/default/images/cake.jpg" name="<?php echo $this->_var['goods']['goods_id']; ?>" usemap="#Map<?php echo $this->_var['goods']['goods_id']; ?>" id="<?php echo $this->_var['goods']['goods_id']; ?>" />
	 <map name="Map<?php echo $this->_var['goods']['goods_id']; ?>" id="Map<?php echo $this->_var['goods']['goods_id']; ?>">
            	<area shape="rect" coords="193,185,244,212" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" />
				 <area shape="rect" coords="196,215,243,243" href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" />
	 </map> 
	 </div> 
	 <?php elseif ($this->_var['goods']['i'] == 8): ?><div  class="cimg f_l goods1" onmouseover="showgoodsbg(<?php echo $this->_var['goods']['goods_id']; ?>)" onmouseout="showgoods(<?php echo $this->_var['goods']['goods_id']; ?>)">
	 <img src="themes/default/images/cake.jpg" name="<?php echo $this->_var['goods']['goods_id']; ?>" usemap="#Map<?php echo $this->_var['goods']['goods_id']; ?>" id="<?php echo $this->_var['goods']['goods_id']; ?>" />
	 <map name="Map<?php echo $this->_var['goods']['goods_id']; ?>" id="Map<?php echo $this->_var['goods']['goods_id']; ?>">
         <area shape="rect" coords="193,185,244,212" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" />
		 <area shape="rect" coords="196,215,243,243" href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" />
	 </map> 
	 </div>
	 <?php else: ?><div  class="cimg f_l cimgl goods1" onmouseover="showgoodsbg(<?php echo $this->_var['goods']['goods_id']; ?>)" onmouseout="showgoods(<?php echo $this->_var['goods']['goods_id']; ?>)">
	 <img src="themes/default/images/cake.jpg" name="<?php echo $this->_var['goods']['goods_id']; ?>" usemap="#Map<?php echo $this->_var['goods']['goods_id']; ?>" id="<?php echo $this->_var['goods']['goods_id']; ?>" />
	 <map name="Map<?php echo $this->_var['goods']['goods_id']; ?>" id="Map<?php echo $this->_var['goods']['goods_id']; ?>">
            	<area shape="rect" coords="193,185,244,212" href="goods.php?id=<?php echo $this->_var['goods']['goods_id']; ?>" />
				 <area shape="rect" coords="196,215,243,243" href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" />
	 </map> </div>
	 <?php endif; ?>
   <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
   
  </div>  
  
  
  <div class="AreaR">
    
  	<div class="searchblank">
      <?php echo $this->fetch('library/search_form.lbi'); ?>
      <?php echo $this->fetch('library/search_form2.lbi'); ?>	
  		  
  	</div>
    
    <?php 
$k = array (
  'name' => 'right_my_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
    
    <?php 
$k = array (
  'name' => 'right_history',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
    
 
     
	 <?php 
$k = array (
  'name' => 'right_cart_info',
);
echo $this->_echash . $k['name'] . '|' . serialize($k) . $this->_echash;
?>
    
    
  </div>
  
<div class="blank20"></div>
<?php echo $this->fetch('library/pages.lbi'); ?>
<div class="blank20"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>
<script>
function showgoodsbg(id){
	 
	document.getElementById(id).setAttribute("src","themes/default/images/cakebg.jpg");
	
	//$(this).children(".new").hide();
		
}

function showgoods(id){
	document.getElementById(id).setAttribute("src","themes/default/images/cake.jpg");
    //$(this).children(".new").show();
	
}
var select_spe = "<?php echo $this->_var['lang']['select_spe']; ?>";
var btn_buy = "<?php echo $this->_var['lang']['btn_buy']; ?>";
var is_cancel = "<?php echo $this->_var['lang']['is_cancel']; ?>";
</script>
</body>
</html>