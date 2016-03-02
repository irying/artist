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
			list1.style.visibility = "visible";}
			
		
		landOn.onclick = function(){
			list2.style.visibility = "visible";
			list1.style.visibility = "hidden";
			light = false;
			}
		loginOn.onclick = function(){
			list2.style.visibility = "hidden";
			list1.style.visibility = "visible";
			}
		closebtn.onclick=function(){
		list1.style.display="none";}
		//list1.className="hide";
		//list2.className="hide";}
		
		closebtn2.onclick=function(){
		list2.style.display="none";}
		//list2.className="hide";}
		
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
		
		
		
		}