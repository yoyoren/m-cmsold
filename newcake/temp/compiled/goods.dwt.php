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

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,transport.js,utils.js')); ?>
<script type="text/javascript">
function $id(element) {
  return document.getElementById(element);
}

function pic()
{
	document.getElementById('bgimg').height=document.body.offsetHeight+40;

}
</script>
</head>
<body>
<div id="div_bg" style="margin-top:20px;">
<img src="themes/default/images/bg.jpg"  id="bgimg" style="z-index:-1;position:absolute;left:0;top:0;width:100%;" >
<?php echo $this->fetch('library/page_header.lbi'); ?>
<div class="blank20"></div>
<div class="blank5"></div>
<div class="cmain clearfix">
  
  <div class="AreaL"> 
   
   <div id="goodsInfo" class="clearfix">
     
     <div class="imgInfo">
     
     </div>
     
	 <div class="buy"><a href="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)"><img src="themes/default/images/cartbuy.png"></a></div>
	 <div id="ECS_GOODS_AMOUNT"></div>
     <div class="textInfo">
     <form action="javascript:addToCart(<?php echo $this->_var['goods']['goods_id']; ?>)" method="post" name="ECS_FORMBUY" id="ECS_FORMBUY" >
      <ul  class="goodsattr" id="goodsattr">
      
      <?php $_from = $this->_var['specification']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('spec_key', 'spec');if (count($_from)):
    foreach ($_from AS $this->_var['spec_key'] => $this->_var['spec']):
?>
      <li>
              <?php $_from = $this->_var['spec']['values']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'value');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['value']):
?>
              <label for="spec_value_<?php echo $this->_var['value']['id']; ?>">
               <b><?php echo $this->_var['value']['label']; ?>&nbsp;&nbsp;&nbsp;[<?php echo $this->_var['value']['format_price']; ?>]</b> </label>
              <input  type="radio" name="spec_<?php echo $this->_var['spec_key']; ?>"  value="<?php echo $this->_var['value']['id']; ?>" id="spec_value_<?php echo $this->_var['value']['id']; ?>" <?php if ($this->_var['key'] == 1): ?>checked<?php endif; ?> onclick="changePrice()" /><!--<class="hide1">*-->
			  <label1  id="_<?php echo $this->_var['value']['id']; ?>" ></label1>
              <br />
              <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
              <input type="hidden" name="spec_list" value="<?php echo $this->_var['key']; ?>" />                                 
      </li>    
      <?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
      
      </ul>
     </div>
	 <div class="plus"></div>
	 <div class="num">
        <img src="themes/default/images/minus.png" onclick="changenumber1(0)">&nbsp;<input name="number" type="text" id="number" value="1" size="2"   onchange="changePrice()" />&nbsp;<img src="themes/default/images/plus.png" onclick="changenumber1(1)">
     </div>
	 <div class="minus"></div>  
      </form>
   </div>
   <div class="blank660"></div>
    <div class="more"><img src="themes/default/images/more.png" /></div>
   <div class="blank20"></div>
   <div class="more1" onmouseover="showlanmeibg(50)"  onmouseout="showlanmei(50)">
   <img src="themes/default/images/50.jpg" id="50" usemap="#50Map" />
   <map name="50Map" id="50Map">
   <area shape="rect" coords="124,124,176,151" href="goods.php?id=33" />
   <area shape="rect" coords="143,153,179,177" href="javascript:addToCart(33)" />  
   </map>
   </div>
   <div class="more" onmouseover="showlanmeibg(51)"  onmouseout="showlanmei(51)"><img src="themes/default/images/51.jpg" id="51" usemap="#51Map"/>
   <map name="51Map" id="51Map">
   <area shape="rect" coords="143,153,179,177" href="javascript:addToCart(34)" />
   <area shape="rect" coords="124,124,176,151" href="goods.php?id=36" />
   </map>
   </div>
   <div class="more" onmouseover="showlanmeibg(52)"  onmouseout="showlanmei(52)"><img src="themes/default/images/52.jpg" border="0" usemap="#52Map" id="52" />
	<map name="52Map" id="52Map">
	<area shape="rect" coords="143,153,179,177" href="javascript:addToCart(35)" />
	<area shape="rect" coords="124,124,176,151" href="goods.php?id=36" /></map></div>
   <div class="more"  onmouseover="showlanmeibg(53)"  onmouseout="showlanmei(53)"><img src="themes/default/images/53.jpg" id="53" usemap="#53Map"/>
   <map name="53Map" id="53Map"><area shape="rect" coords="143,153,179,177" href="javascript:addToCart(36)" />
   <area shape="rect" coords="124,124,176,151" href="goods.php?id=36" /></map></div>
   
   <div class="blank"></div>
   
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
  
</div>
<div class="blank5"></div>
<div class="blank5"></div>

<div class="blank5"></div>
<div class="blank20"></div>
<?php echo $this->fetch('library/page_footer.lbi'); ?>
</div>
</body>
<script type="text/javascript">
var goods_id = <?php echo $this->_var['goods_id']; ?>;
var goodsattr_style = <?php echo empty($this->_var['cfg']['goodsattr_style']) ? '1' : $this->_var['cfg']['goodsattr_style']; ?>;
var gmt_end_time = <?php echo empty($this->_var['promote_end_time']) ? '0' : $this->_var['promote_end_time']; ?>;
<?php $_from = $this->_var['lang']['goods_js']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }; $this->push_vars('key', 'item');if (count($_from)):
    foreach ($_from AS $this->_var['key'] => $this->_var['item']):
?>
var <?php echo $this->_var['key']; ?> = "<?php echo $this->_var['item']; ?>";
<?php endforeach; endif; unset($_from); ?><?php $this->pop_vars();; ?>
var goodsId = <?php echo $this->_var['goods_id']; ?>;
var now_time = <?php echo $this->_var['now_time']; ?>;


onload = function(){
  changePrice();
  //fixpng();
  pic();
  attrkuang();
  try {onload_leftTime();}
  catch (e) {}
}

/**
 * 点选可选属性或改变数量时修改商品价格的函数
 */
function changePrice()
{
  var attr = getSelectedAttributes(document.forms['ECS_FORMBUY']);
  var qty = document.forms['ECS_FORMBUY'].elements['number'].value;

  Ajax.call('goods.php', 'act=price&id=' + goodsId + '&attr=' + attr + '&number=' + qty, changePriceResponse, 'GET', 'JSON');
}

/**
 * 接收返回的信息
 */
function changePriceResponse(res)
{
  if (res.err_msg.length > 0)
  {
    alert(res.err_msg);
  }
  else
  {
    document.forms['ECS_FORMBUY'].elements['number'].value = res.qty;

    if (document.getElementById('ECS_GOODS_AMOUNT'))
      document.getElementById('ECS_GOODS_AMOUNT').innerHTML = res.result;
  }
}
function changenumber1(way)
{
	if(way=="0"){
		 document.forms['ECS_FORMBUY'].elements['number'].value=parseInt(document.forms['ECS_FORMBUY'].elements['number'].value)-1;
		 if(document.forms['ECS_FORMBUY'].elements['number'].value==0) document.forms['ECS_FORMBUY'].elements['number'].value==1;
		 changePrice();	 
	}else{
	 	document.forms['ECS_FORMBUY'].elements['number'].value=parseInt(document.forms['ECS_FORMBUY'].elements['number'].value)+1;
		changePrice();	
	}
}
function showlanmei(id)
{
	document.getElementById(id).setAttribute("src","themes/default/images/"+id+".jpg");
}
function showlanmeibg(id)
{
	document.getElementById(id).setAttribute("src","themes/default/images/"+id+"bg.jpg");
}
function attrkuang(){
		  labels = document.getElementById('goodsattr').getElementsByTagName('label');
		  radios = document.getElementById('goodsattr').getElementsByTagName('input');
		  for(m=0;m<radios.length;m++){
		  	if(radios[m].checked == true) 
			{
				var aa=radios[m].id;
				document.getElementById(aa.substr(10)).className='checked';;
			}
		  }
		  for(i=0,j=labels.length ; i<j ; i++)
		  {
		   labels[i].onclick=function() 
		   {   
			if(this.className == '') {
			 for(k=0,l=labels.length ; k<l ; k++)
			 {
			  labels[k].className='';
			  radios[k].checked = false;
			 }
			 this.className='checked';
			 var s=this.id;	 
			 try{
				document.getElementById('spec_value'+s).checked = true;
				changePrice();
			 } catch (e) {}
			}
		   }
		  }
	}

</script>
</html>
