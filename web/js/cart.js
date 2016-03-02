window.onload = function(){
		//
		if (!document.getElementsByClassName) {
        document.getElementsByClassName = function (cls) {
            var ret = [];
            var els = document.getElementsByTagName('*');
            for (var i = 0, len = els.length; i < len; i++) {
                if (els[i].className === cls
                    || els[i].className.indexOf(cls + ' ') >= 0
                    || els[i].className.indexOf(' ' + cls + ' ') >= 0
                    || els[i].className.indexOf(' ' + cls) >= 0) {
                    ret.push(els[i]);
                	}
            	}
            return ret;
        	}
		}
		/*if(!document.getElementsByClassName){
			document.getElementsByClassName=function(cls){
				var ret = [];
				var els = document.getElementsByTagName('*');
				
				for( var i=0,len = els.length;i++;){
					if(els[i].className.indexOf(cls + ' ')>=0 || els[i].className.indexOf(' ' + cls + ' ')>=0 || els[i].className.indexOf(' ' + cls )>=0){
						ret.push(els[i]);
						}
					}
				return ret;
				}
			}
			*/
	var card = document.getElementById('card');
	var tr = card.children[1].rows;
	var checkInputs = document.getElementsByClassName('check');
	var checkAllInputs = document.getElementsByClassName('check-all');
	var selectedTotal = document.getElementById('selectedTotal');
	var priceTotal = document.getElementById('priceTotal');
	var selected = document.getElementById('selected');
	var foot = document.getElementById('foot');
	var deleteAll = document.getElementById('deleteAll');
	
    //计算
    function getTotal() {
        var seleted = 0;
        var price = 0;
        for (var i = 0, len = tr.length; i < len; i++) {
            if (tr[i].getElementsByTagName('input')[0].checked) {
                tr[i].className = 'on';
                seleted += parseInt(tr[i].getElementsByTagName('input')[1].value);
                price += parseFloat(tr[i].cells[4].innerHTML);
            }
            else {
                tr[i].className = '';
            }
        }

        selectedTotal.innerHTML = seleted;
        priceTotal.innerHTML = price.toFixed(2);
      //  selectedViewList.innerHTML = HTMLstr;

      /*  if (seleted == 0) {
            foot.className = 'foot';
        }*/
    }
	//
	 function sum(tr){
		 var cells = tr.cells;
		 var price = cells[2];
		 var subtotal = cells[4];
		 var count = tr.getElementsByTagName('input')[1];
		 var span = tr.getElementsByTagName('span')[1];
		 var val = parseInt(count.value);
		 var pri = parseFloat(price.innerHTML);
		 subtotal.innerHTML = (val * pri).toFixed(2);
		  if(val == 1){
			  span.innerHTML = '';}
			  else{
			  span.innerHTML = '-';}
		  }
	 /*function getSubtotal(tr) {
        var cells = tr.cells;
        var price = cells[2]; //单价
        var subtotal = cells[4]; //小计td
        var countInput = tr.getElementsByTagName('input')[1]; //数目input
        var span = tr.getElementsByTagName('span')[1]; //-号
        //写入HTML
        subtotal.innerHTML = (parseInt(countInput.value) * parseFloat(price.innerHTML)).toFixed(2);
        //如果数目只有一个，把-号去掉
        if (countInput.value == 1) {
            span.innerHTML = '';
        }else{
            span.innerHTML = '-';
        }
    }*/
	// 点击选择框	
	for(var i = 0 , len = checkInputs.length; i < len; i++){
		checkInputs[i].onclick = function(){
			if(this.className === 'check-all check'){
				for( var j=0; j< checkInputs.length; j++){
					checkInputs[j].checked = this.checked;
					}
				}
			
			if(this.checked == false){
				for(var k = 0; k < checkAllInputs.length; k++){
					checkAllInputs[k].checked = false;
					}
				}
			getTotal();
		}
	}
		
	/*selected.onclick = function(){
		if(foot.className == 'foot'){
			if(selectedTotal.innerHTML !=0){
				foot.className ='foot show';
				}
			}
			else{
				foot.className = 'foot';}
		}
	*/
	
	for(var i=0; i<tr.length;i++){
		tr[i].onclick = function(e){
			 e = e || window.event;
			var el = e.target || e.srcElement;
			var cls = el.className;
			var countInout = this.getElementsByTagName('input')[1];
			var value = parseInt(countInout.value);
			var reduce = this.getElementsByTagName('span')[1];
			switch(cls){
				case 'add':
					countInout.value = value + 1;
					reduce.innerHTML = '-';
					sum(this);
					break;
				case 'reduce': //点击了减号
                    if (value > 1) {
                        countInout.value = value - 1;
                        sum(this);
                    }
                    break;
				case 'delete':
					var conf = confirm('确定不买？!');
					if(conf){
						this.parentNode.removeChild(this);
						}
					break;
				default :
                    break;
				}
				getTotal();
			}
		 tr[i].getElementsByTagName('input')[1].onkeyup = function () {
            var val = parseInt(this.value);
            if (isNaN(val) || val <= 0) {
                val = 1;
            }
            if (this.value != val) {
                this.value = val;
            }
            getSubtotal(this.parentNode.parentNode); //更新小计
            getTotal(); //更新总数
        }	
	}
	
	//为每行元素添加事件

        // 给数目输入框绑定keyup事件
       /* tr[i].getElementsByTagName('input')[1].onkeyup = function () {
            var val = parseInt(this.value);
            if (isNaN(val) || val <= 0) {
                val = 1;
            }
            if (this.value != val) {
                this.value = val;
            }
            getSubtotal(this.parentNode.parentNode); //更新小计
            getTotal(); //更新总数
        }
    
*/
    // 点击全部删除
    deleteAll.onclick = function () {
        if (selectedTotal.innerHTML != 0) {
            var con = confirm('确定删除所选商品吗？'); //弹出确认框
            if (con) {
                for (var i = 0; i < tr.length; i++) {
                    // 如果被选中，就删除相应的行
                    if (tr[i].getElementsByTagName('input')[0].checked) {
                        tr[i].parentNode.removeChild(tr[i]); // 删除相应节点
                        i--; //回退下标位置
                     }
                }
            }
        } else {
            alert('请选择商品！');
        }
        getTotal(); //更新总数
    }
/*
	deleteAll.onclick = function(){
		if(selectedTotal.innerHTML != 0){
			var con = confirm(竟然不买了？！)；
			if(con){
				for(var i = 0; i < tr.length; i++){
					if(tr[i].getElementsByTagName('input')[0].checked){
						tr[i].parentNode.removeChild(tr[i]);
						i--;}
					}
				}
			}
			getTotal();
		}
		
	*/
    // 默认全选
    checkAllInputs[0].checked = true;
    checkAllInputs[0].onclick();
   
	
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
			
		
		// landOn.onclick = function(){
		// 	list2.style.visibility = "visible";
		// 	list1.style.visibility = "hidden";
		// 	}
		// loginOn.onclick = function(){
		// 	list2.style.visibility = "hidden";
		// 	list1.style.visibility = "visible";
		// 	}
		// closebtn.onclick=function(){
		// //list1.style.display="none";
		// list1.style.visibility="hidden";
		// list2.style.visibility="hidden";}
		
		// closebtn2.onclick=function(){
		// //list2.style.display="none";
		// list2.style.visibility="hidden";}
	
}	// window