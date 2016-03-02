window.onload = function(){
		var landOn = document.getElementById('land_on');
		var loginOn = document.getElementById('login_on');
		var list1 = document.getElementById('list1');
		var list2 = document.getElementById('list2');
		var navR = document.getElementById('navR');
		var light = true;
		var closebtn=document.getElementById("closebtn");
		var closebtn2=document.getElementById("closebtn2");
		
		navR.onclick = function(){
			if(light)
			list1.style.visibility = "visible";
			}
			
		
		landOn.onclick = function(){
			list2.style.visibility = "visible";
			list1.style.visibility = "hidden";
			}
		loginOn.onclick = function(){
			list2.style.visibility = "hidden";
			list1.style.visibility = "visible";
			}
		closebtn.onclick=function(){
		//list1.style.display="none";
		list1.style.visibility="hidden";
		list2.style.visibility="hidden";}
		
		closebtn2.onclick=function(){
		//list2.style.display="none";
		list2.style.visibility="hidden";}