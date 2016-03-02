window.onload = function () {
	var container = document.getElementById('container');
	var list = document.getElementById('list');
	var buttons = document.getElementById('buttons').getElementsByTagName('span');
	var prev = document.getElementById('prev');
	var next = document.getElementById('next');
	var index = 1;
	var len = 5;
	var animated = false;
	var interval = 6000;
	var timer;


	function animate (offset) {
		if (offset == 0) {
			return;
		}
		animated = true;
		var time = 300;
		var inteval = 10;
		var speed = offset/(time/inteval);
		var left = parseInt(list.style.left) + offset;

		var go = function (){
			if ( (speed > 0 && parseInt(list.style.left) < left) || (speed < 0 && parseInt(list.style.left) > left)) {
				list.style.left = parseInt(list.style.left) + speed + 'px';
				setTimeout(go, inteval);
			}
			else {
				list.style.left = left + 'px';
				if(left>-200){
					list.style.left = -620 * len + 'px';
				}
				if(left<(-620 * len)) {
					list.style.left = '-620px';
				}
				animated = false;
			}
		}
		go();
	}

	function showButton() {
		for (var i = 0; i < buttons.length ; i++) {
			if( buttons[i].className == 'on'){
				buttons[i].className = '';
				break;
			}
		}
		buttons[index - 1].className = 'on';
	}

	function play() {
		timer = setTimeout(function () {
			next.onclick();
			play();
		}, interval);
	}
	function stop() {
		clearTimeout(timer);
	}

	next.onclick = function () {
		if (animated) {
			return;
		}
		if (index == 5) {
			index = 1;
		}
		else {
			index += 1;
		}
		animate(-620);
		showButton();
	}
	prev.onclick = function () {
		if (animated) {
			return;
		}
		if (index == 1) {
			index = 5;
		}
		else {
			index -= 1;
		}
		animate(620);
		showButton();
	}

	for (var i = 0; i < buttons.length; i++) {
		buttons[i].onclick = function () {
			if (animated) {
				return;
			}
			if(this.className == 'on') {
				return;
			}
			var myIndex = parseInt(this.getAttribute('index'));
			var offset = -620 * (myIndex - index);

			animate(offset);
			index = myIndex;
			showButton();
		}
	}

	container.onmouseover = stop;
	container.onmouseout = play;

	play();
	
	
	// var num = document.getElementsByClassName('size')[0];
	// var picon1 = num.getElementsByTagName('img')[0];
	// var picon2 = num.getElementsByTagName('img')[1];
	// var picon3 = num.getElementsByTagName('img')[2];
	
	// var num1 = num.getElementsByClassName('num1')[0];
	// var num2 = num.getElementsByClassName('num2')[0];
	// var num3 = num.getElementsByClassName('num3')[0];
	
	// var count = document.getElementById('count');
	// var countNum = count.getElementsByTagName('input')[0];
	// var add = count.getElementsByClassName('add')[0];
	// var reduce = count.getElementsByClassName('reduce')[0];
	
	// num1.onclick = function(){
	// 	picon1.className = "picon_on";
	// 	picon2.className = "picon";
	// 	picon3.className = "picon";}
	// num2.onclick = function(){
	// 	picon2.className = "picon_on";
	// 	picon1.className = "picon";
	// 	picon3.className = "picon";}
	// num3.onclick = function(){
	// 	picon3.className = "picon_on";
	// 	picon2.className = "picon";
	// 	picon1.className = "picon";}
	// add.onclick = function(){
	// 	var value = parseInt(countNum.value);
	// 	countNum.value = value + 1;}
	// reduce.onclick = function(){
	// 	if(countNum.value > 0){
	// 	var value = parseInt(countNum.value);
	// 	countNum.value = value - 1;}}
		
		
		
	var idea = document.getElementById('idea');
    var boxs = idea.children;
		
	 //把事件代理到每条分享div容器
    for (var i = 0; i < boxs.length; i++) {
		 //点击
        boxs[i].onclick = function (e) {
            e = e || window.event;
            var el = e.srcElement || e.target;
            switch (el.className) {
				 case 'btn1':
                    reply(el.parentNode.parentNode, el);
                    break;
				
				}
		}
	}
	
	 function reply(box, el) {
        var commentList = box.getElementsByClassName('comment-list')[0];
        var textarea = box.getElementsByClassName('express')[0];
        var commentBox = document.createElement('div');
        commentBox.className = 'comment-box';
        commentBox.setAttribute('user', 'self');
        commentBox.innerHTML =
            '<img class="myhead" src="images/head/2.jpg" alt=""/>' +
                '<div class="comment-content">' +
                '<p class="comment-text"><span class="user">我：</span>' + textarea.value + '</p>' +
                '<p class="comment-time">' +
                formateDate(new Date()) +
                '<a href="javascript:;" class="comment-praise" total="0" my="0" style="display:none;">赞</a>' +
                '<a href="javascript:;" class="comment-operate" style="display:none;">删除</a>' +
                '</p>' +
                '</div>'
        commentList.appendChild(commentBox);
        textarea.value = '';
        textarea.onblur();
    }
	
	//格式化日期
    function formateDate(date) {
        var y = date.getFullYear();
        var m = date.getMonth() + 1;
        var d = date.getDate();
        var h = date.getHours();
        var mi = date.getMinutes();
        m = m > 9 ? m : '0' + m;
        return y + '-' + m + '-' + d + ' ' + h + ':' + mi;
    }
	
	// var landOn = document.getElementById('land_on');
	// 	var loginOn = document.getElementById('login_on');
	// 	var list1 = document.getElementById('list1');
	// 	var list2 = document.getElementById('list2');
	// 	var navR = document.getElementById('navR');
	// 	var light = true;
	// 	var closebtn=document.getElementById("closebtn");
	// 	var closebtn2=document.getElementById("closebtn2");
		
		navR.onclick = function(){
			if(light)
			list1.style.visibility = "visible";
			}

	function proAdd(i){
        alert(i);
    }
}