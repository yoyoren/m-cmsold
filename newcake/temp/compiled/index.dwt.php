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

<?php echo $this->smarty_insert_scripts(array('files'=>'common.js,index.js,jQuery-1.7.1.js,jquery.jflip-0.4.js,excanvasX.js')); ?>
<script language="javascript" type="text/javascript"> 
$(function(){
	document.getElementById('bgimg').height=document.body.offsetHeight+20+20;
	$("#demo1").jFlip(954,401,{background:"white",cornersTop:true,scale:"fill"});
});

</script>
</head>
<body>
<div id="div_bg" style="margin-top:20px">
<img src="themes/default/images/bg.jpg"  id="bgimg" style="z-index:-1;position:absolute;left:0;top:0;width:100%;" >
<?php echo $this->fetch('library/page_header.lbi'); ?>
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

<?php echo $this->fetch('library/page_footer.lbi'); ?>
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
