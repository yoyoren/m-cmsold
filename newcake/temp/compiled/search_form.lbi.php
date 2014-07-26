
<div class="searchblankTit">
  <script type="text/javascript">

<!--
function checkSearchForm()
{
if(document.getElementById('keyword').value)
{
    return true;
}
else
{
    alert("<?php echo $this->_var['lang']['no_keywords']; ?>");
    return false;
}
}
function kuang(id){
  labels = document.getElementById(id).getElementsByTagName('span');
  radios = document.getElementById(id).getElementsByTagName('input');
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
     try{
        document.getElementById(this.getAttribute('name')).checked = true;
     } catch (e) {}
    }
   }
  }
}

function blur_stxt(obj)
{
  var sobj = document.getElementById('keyword');
  if(sobj.value =="")
  {
     sobj.className = 'keywords keywords_bg'; 
  }
  else
  {
     sobj.className = 'keywords';	  
  }	
}

function focus_stxt()
{
  var sobj = document.getElementById('keyword');
  sobj.className = 'keywords';	
}

-->

</script>
<form id="searchForm" name="searchForm" method="get" action="search.php">
  <input name="keywords" type="text" id="keyword" value="<?php echo htmlspecialchars($this->_var['search_keywords']); ?>"  class="keywords<?php if ($this->_var['search_keywords'] == ''): ?> keywords_bg<?php endif; ?>" onblur="blur_stxt();" onfocus="focus_stxt();"/>
   <input name="imageField" type="submit" value="" class="go" style="cursor:pointer;"  />		   
</form>
</div>
