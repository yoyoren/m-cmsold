/*
 * 优生活办公系统首页
 ***************************************
 * version 1.0
 * $author Liuyuan
 *	2008.8.11
 * 北京优生活科技有限责任公司网络事业部
 * 狮屎胜于熊便
 * 8个金牌了，真强！
群之初，性本善，打打字，聊聊天 
斗地主，侃大山，加好友，视频见 
发表情，传图片，谈个情，赛初恋 
靓一点，不多见，丑一点，也有电 
见个面，吃顿饭，谁买单，都情愿 
好友多，有点乱，对上号，比较难 
辨网名，看资料，查纪录，想从前 
心不静，手不烦，天天聊，早到晚 
花网费，耗情感，像工作，不赚钱 
练潜水，玩闪电，拉帮套，把群建 
加入群，更方便，省话费，好经管 
呼新朋，唤旧友，竖群规，立论坛 
管理员，挺有权，不老实，腿上练 
人一多，嘴就乱，告状的，也得管 
伤心的，最危险，踢错了，不好办 
人气火，摆酒宴，A A 制，五十元 
老朋友，对上面，新朋友，名字签 
离开谁，都不难，戒 Q Q，有点难    
提前祝福群内所有朋友：国庆快乐
 */
var datediv=new Object();
var today=new Date();
datediv.odiv=null;
datediv.sdiv=null;
datediv.otxt=null;
datediv.osel=null;
datediv.content=null;
datediv.otd=null;
datediv.displaydate=function(name,con)
{		
		//
		this.otd=document.getElementById(name);
		this.content=document.getElementById(con);
		
		if(this.otd.contains(this.odiv))
			this.otd.removeChild(this.odiv);
	
		if(!(typeof(this.otd)=="object" && typeof(this.content)=='object'))
		{
			alert("传入参数有误！");
			return ;
		}
		
		this.odiv=document.createElement("DIV");
		this.odiv.id="datediv";
		this.odiv.style.position="absolute";
		this.odiv.style.background="#9999cc";
		this.odiv.style.width="140px";
		//this.odiv.onfocusout=this.dispear;
		this.otd.appendChild(this.odiv); 
		
		this.otxt=document.createElement("input");
		this.otxt.type="text";
		this.otxt.name="year";
		this.otxt.style.width="40px";
		this.otxt.value=today.getFullYear();
		this.odiv.appendChild(this.otxt);
		this.odiv.innerHTML+="<b>&nbsp;年&nbsp;</b>";
		
		this.osel=document.createElement("select");
		this.osel.name="mon";
		this.osel.id="mon";
		this.osel.attachEvent("onchange",this.writeDay);//;
		this.osel.add(new Option("一月","1"));
		this.osel.add(new Option("二月","2"));
		this.osel.add(new Option("三月","3"));
		this.osel.add(new Option("四月","4"));
		this.osel.add(new Option("五月","5"));
		this.osel.add(new Option("六月","6"));
		this.osel.add(new Option("七月","7"));
		this.osel.add(new Option("八月","8"));
		this.osel.add(new Option("九月","9"));
		this.osel.add(new Option("十月","10"));
		this.osel.add(new Option("十一月","11"));
		this.osel.add(new Option("十二月","12"));
		this.osel.selectedIndex=today.getMonth();
		this.osel.style.width="70px";
		this.odiv.appendChild(this.osel);
		
		this.sdiv=document.createElement("select");
		this.sdiv.id="myday";
		this.sdiv.name="myday";
		this.odiv.appendChild(this.sdiv);
		
		this.hou=document.createElement("select");
		this.hou.name="hou";
		this.hou.id="hou";
		for(i=0;i<24;i++)
		{
			this.hou.add(new Option(i+'点钟',i));
		}
		this.odiv.appendChild(this.hou);
		
		var closediv=document.createElement("DIV");
		closediv.style.width="140px";
		closediv.style.height="20px";
		closediv.style.cssText+="line-height:20px;text-align:right;";
			
		closediv.innerHTML="<input type='button' onClick='datediv.checkday()' value='确定'>&nbsp;&nbsp;<input type='button' onClick='datediv.dispear()' value='关闭'>";
		this.odiv.appendChild(closediv);
		
		//this.odiv.setActive();
		this.writeDay(today.getMonth());

}
datediv.dispear=function()//
{
	if(datediv.otd.contains(datediv.odiv))
			datediv.otd.removeChild(datediv.odiv);
}

datediv.writeDay=function(i)
{
	
	i=parseInt(document.getElementById('mon').value);
	switch(i)
	{
		case 1:
			writeday(31);
		break;
		case 2:
			writeday(29);
		break;
		case 3:
			writeday(31);
		break;
		case 4:
			writeday(30);
		break;
		case 5:
			writeday(31);
		break;
		case 6:
			writeday(30);
		break;
		case 7:
			writeday(31);
		break;
		case 8:
			writeday(31);
		break;
		case 9:
			writeday(30);
		break;
		case 10:
			writeday(31);
		break;
		case 11:
			writeday(30);
		break;
		case 12:
			writeday(31);
		break;
	}
}

function writeday(m)
{
	document.getElementById('myday').options.length=0;
	for(var i=1;i<=m;i++)
	{
	   document.getElementById("myday").add(new Option(i+"日",i));
	}

	//	datediv.checkday("+i+")
}
datediv.checkday=function(i)
{
	//datediv.odiv.style.display="none";
	//this.odiv=null;
	var str=this.otxt.value;
	str+="-";
	str+=this.osel.value+"-";
	str+=this.sdiv.value+" ";
	str+=this.hou.value+":0:0"

	this.content.value=str;
	if(this.otd.contains(this.odiv))
		this.otd.removeChild(this.odiv);
}
/*
鸡能飞到墙头，鹰可以搏击长空。是一只蛰伏的鹰，暂时的挫折算不了什么，他日借得东风，定能翱翔九天！”
*/