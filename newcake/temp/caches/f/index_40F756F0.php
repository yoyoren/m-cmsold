<?php exit;?>a:3:{s:8:"template";a:3:{i:0;s:56:"/usr/local/httpd/htdocs/newcake/themes/default/index.dwt";i:1;s:70:"/usr/local/httpd/htdocs/newcake/themes/default/library/page_header.lbi";i:2;s:70:"/usr/local/httpd/htdocs/newcake/themes/default/library/page_footer.lbi";}s:7:"expires";i:1403747696;s:8:"maketime";i:1403744096;}<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="Generator" content="ECSHOP v2.7.3" />
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="Keywords" content="mes,每实,蛋糕" />
<meta name="Description" content="MES每实是一个食物,生活方式,艺术和文化的综合体,它钟情于创造任何让生活产生乐趣,品质和格调的食物产品.3大系列,38款产品,让你尽享美好." />
<title>MES每实-尽享美好 - Powered by ECShop</title>
<link rel="shortcut icon" href="favicon.ico" />
<link rel="icon" href="animated_favicon.gif" type="image/gif" />
<link href="themes/default/style.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/common.js"></script><script type="text/javascript" src="js/index.js"></script><script type="text/javascript" src="js/jQuery-1.7.1.js"></script><script type="text/javascript" src="js/jquery.jflip-0.4.js"></script><script type="text/javascript" src="js/excanvasX.js"></script><script language="javascript" type="text/javascript"> 
$(function(){
	document.getElementById('bgimg').height=document.body.offsetHeight+20+20;
	$("#demo1").jFlip(954,401,{background:"white",cornersTop:true,scale:"fill"});
});
</script>
</head>
<body>
<div id="div_bg" style="margin-top:20px">
<img src="themes/default/images/bg.jpg"  id="bgimg" style="z-index:-1;position:absolute;left:0;top:0;width:100%;" >
<script type="text/javascript">
var process_request = "正在处理您的请求...";
</script>
<div id="mainNav" class="clearfix">
<div style="height:118px;"></div>
<ul>
  <li><a href="index.php">&nbsp;</a></li>
  <li><a href="category.php?id=1">&nbsp;</a></li>
  <li><a href="category.php?id=2">&nbsp;</a></li>  
  <li><a href="category.php?id=3">&nbsp;</a></li>
  <li><a href="article.php?id=5">&nbsp;</a></li>
</ul>
</div>
<div class="block clearfix"> 
  
  <div class="indexR">
   
       <div>
          <ul id="demo1">
              <li><img src="themes/default/images/m1.jpg"></li>
              <li><img src="themes/default/images/m2.jpg"></li>
              <li><img src="themes/default/images/m3.jpg"></li>
          </ul>     
       </div>    
   
  </div>
  
</div>
<div  class="indexbox" id="bottomNav" >
 <div class="indexbox_1">
    <div  class="indeximg f_l cat"  ><img src="themes/default/images/index/4.jpg" usemap="#Map4" id="4"/><div class="new"><img src="themes/default/images/new.png" /></div>
     <map name="Map4" id="Map4">
            	<area shape="rect" coords="204,265,304,302" href="category.php?id=4" />
     </map>
    </div>
	<div  class="indeximg f_l indeximgl cat" ><img src="themes/default/images/index/5.jpg" border="0" usemap="#Map5"  id="5"/>
     <map name="Map5" id="Map5">
            	<area shape="rect" coords="204,265,304,302" href="category.php?id=5" />
     </map>
    </div>
    <div  class="indeximg f_l indeximgl cat" ><img src="themes/default/images/index/6.jpg" usemap="#Map6" id="6"/>
    <map name="Map6" id="Map6">
            	<area shape="rect" coords="204,265,304,302" href="category.php?id=6" />
     </map>
    </div>
	<div  class="indeximg1 f_l cat">
    		<img src="themes/default/images/index/2.jpg" width="630px" border="0" usemap="#Map2" id="2"/>
			<div class="new2"><img src="themes/default/images/new.png" /></div>
            <map name="Map2" id="Map2">
            	<area shape="rect" coords="511,262,631,304" href="category.php?id=2" />
            </map>
    </div>
	<div  class="indeximg f_l indeximgl cat" ><img src="themes/default/images/index/3.jpg" border="0" usemap="#Map3" id="3" />
      <map name="Map3" id="Map3" >
            	<area shape="rect" coords="204,265,304,302" href="category.php?id=3" />
       </map>
	</div>
  </div>
<div>
<div class="blank5"></div>
<div class="blank5"></div>
<div class="blank5"></div>
<div class="blank5"></div>
<div id="footer">
 <div class="text">
   订购专线：400 650 2121<br> 
    ICP备案证书号:     
  
    
 </div>
</div>
</div>
<script>
$(".cat").mouseenter(function(){
	 var id=$(this).children("img").attr("id");
  
    $("#"+id).attr("src","themes/default/images/index/"+id+"bg.jpg");
	$(this).children(".new").hide();
	$(this).children(".new2").hide();
	
});
$(".cat").mouseleave(function (){
	var id=$(this).children("img").attr("id");
	$("#"+id).attr("src","themes/default/images/index/"+id+".jpg");
    $(this).children(".new").show();
	$(this).children(".new2").show();
});
</script>
</body>
</html>
