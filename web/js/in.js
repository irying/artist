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
	



var back = document.getElementById('back');
var clientHeight = document.documentElement.clientHeight;
var timer;
var isTop = true;

window.onscroll = function(){
	var top = document.documentElement.scrollTop || document.body.scrollTop;
	if(top >= clientHeight){
		back.style.display = 'block';
		}else{
			back.style.display = 'none';}
	if(!isTop){
		clearInterval(timer);}
		isTop = false;		
	 
	}
	
	back.onclick = function(){
		timer = setInterval(function(){
			var top = document.documentElement.scrollTop || document.body.scrollTop;
			var speed = Math.floor(top / 3 );
			document.documentElement.scrollTop = document.body.scrollTop = top - speed;
			if(top == 0){
				clearInterval(timer);}
			},20)
		}

}
		