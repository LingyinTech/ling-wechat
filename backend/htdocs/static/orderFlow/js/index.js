$(function(){
	
	//定制链基本js
	
	var iW=document.body.clientWidth; 
	if(iW<1500){
		$(".xiaoxi-tank").parent("body").css("overflow","auto");
	}
	var iHeight = window.screen.height;
	
    $(".tabControl>a").click(function(){
    	$(".tabControl>a").removeClass("activeNav");
    	$(this).addClass("activeNav");
    	var i=$(this).index();
    	$(".zc_com").css("display","none");
    	$(".zc_com").eq(i).css("display","block");
    })

    $(".nav_list>li>a").click(function(){
    	var i=$(".nav_list>li>a").index($(this));
        $(".nav_list>li>a").css("backgroundColor","#272c31");
        $(".nav_list>li>a").css("color","#bdc0c3");
        $(".nav_list>li>a").css("border-bottom","none");
        $(".nav_list>li>a").css("height","36px");
        $(".nav_list>li>a").eq(i).css("backgroundColor","#1f252b");
        $(".nav_list>li>a").eq(i).css("color","#fff");
        $(".nav_list>li>a").eq(i).css("border-bottom","1px solid #363b41");
        $(".nav_list>li>a").eq(i).css("height","35px");
        
        $(".nav_list_2>li>a").css("color","#bdc0c3");
        $(".nav_list_2>li").css("backgroundColor","#1f252b");
        $(".nav_list_2>li").css("border-left","none");
    });

    $(".nav_list>li>a").click(function(){
    	var i=$(".nav_list>li>a").index($(this));
        $(".nav_list>li>a").css("backgroundColor","#272c31");
        $(".nav_list>li>a").css("color","#bdc0c3");
        $(".nav_list>li>a").css("border-bottom","none");
        $(".nav_list>li>a").css("height","36px");
        $(".nav_list>li>a").eq(i).css("backgroundColor","#1f252b");
        $(".nav_list>li>a").eq(i).css("color","#fff");
        $(".nav_list>li>a").eq(i).css("border-bottom","1px solid #363b41");
        $(".nav_list>li>a").eq(i).css("height","35px");
        
        $(".nav_list_2>li>a").css("color","#bdc0c3");
        $(".nav_list_2>li>a").css("margin-left","46px");
        $(".nav_list_2>li").css("backgroundColor","#1f252b");
        $(".nav_list_2>li").css("border-left","none");
    });
    
    //导航菜单
    $(".nav_list_2").css("display","none");
    
    $(".up_down").click(function(){
    	var me=$(this).find(".nav_ddzx>img");
        if(!me.hasClass("w-downTrans")){
        	$(".nav_ddzx>img").removeClass("w-downTrans");
            me.addClass("w-downTrans");
        }else{
        	$(".nav_ddzx>img").removeClass("w-downTrans");
        }
    })
    
    $(".up_down>a").click(function(){
    	if($(this).next("ul").length<1){
    		$(".nav_list_2").slideUp(500);
    	}else if( $(this).next("ul").css("display")=="none"){
        	$(".nav_list_2").slideUp(500);
        	$(".nav_ddzx>img").attr("src","images/down.png")
            $(this).next("ul").slideDown(500);
        }else{
            $(this).next("ul").slideUp(500);
        }
    });
    
    //导航二级菜单点击
    $(".nav_list_2>li").click(function(){
    	$(".nav_list>li>a").css("backgroundColor","#272c31");
        $(".nav_list>li>a").css("color","#bdc0c3");
        $(".nav_list>li>a").css("border-bottom","none");
        $(".nav_list>li>a").css("height","36px");
        
    	$(this).parents(".up_down").children("a").css("backgroundColor","#1f252b");
        var i=$(".nav_list_2>li").index($(this));
        $(".nav_list_2>li>a").css("color","#bdc0c3");
        $(".nav_list_2>li").eq(i).find("a").css("color","#fff");
        $(".nav_list_2>li").css("backgroundColor","#1f252b");
        $(".nav_list_2>li").eq(i).css("backgroundColor","#2b7dc9");
        $(".nav_list_2>li").css("border-left","none");
        $(".nav_list_2>li").eq(i).css("border-left","3px solid #63a3ef");
        
        $(".nav_list_2>li>a").css("margin-left","46px");
        $(".nav_list_2>li>a").eq(i).css("margin-left","43px");
        
        
        var me=$(this).parent(".up_down").find(".nav_ddzx>img")
        if(!me.hasClass("w-downTrans")){
        	$(".nav_ddzx>img").removeClass("w-downTrans");
            me.addClass("w-downTrans");
        }else{
        	$(".nav_ddzx>img").removeClass("w-downTrans");
        }
    });
    
    $(".DeletCon>input").click(function(){
    	$(".Delettank").hide();
    })
    
    $('.tips-close').click(function(){
    	$('.tank').hide();
    });
/************************************************************************************/    
    
    //消息框
    $(".xx_xq").click(function(){
        $(".xiaoxi-tank").animate({"bottom":"-151px"},1000);
    });
    
    /*顶部我的账户*/
	$(".loginAfter").hover(function(){
		$(".upDown").addClass("upDownTrans");
		$(".listDown").show();
	},function(){
		$(".upDown").removeClass("upDownTrans");
		$(".listDown").hide();
	})
    
	//控制全选
    $("#all_choose").click(function(){   
		var checked=document.getElementById('all_choose'),div=document.getElementById('yanse_div'),yanse=div.getElementsByTagName('input');
		var result = checked.checked;
		if (result) { // 全选 
		   for(i=0;i<yanse.length;i++){
			   yanse[i].checked=true;
		   };
		}else { // 取消全选 
		   for(i=0;i<yanse.length;i++){
			   yanse[i].checked=false;
		   };
		}; 
	});

   /* 添加注释 */
   $(".annotation>b").hover(function(){
   		$(this).next("div").show();
   },function(){
   		$(this).next("div").hide();
   })
   
    //凭证删除
	$("#proofs").delegate("b","click",function(){
		$(this).parent("span").remove();
		var url = $(this).parent().attr("id");
		var pics = $('#pics').val().split(",");
		for(p in pics){
			if(url==pics[p]){
				pics.splice(p,1);
			}
		}
		$('#pics').val(pics.toString());
	})
	
	/*日期时间鼠标移入移出时间*/
	$(".timeNew div input").hover(function(){
		$(this).parent().find("b").addClass("bActive");
	},function(){
		$(".timeNew div b").removeClass("bActive");
	})
	
	/*表格点击变色*/
	$(".newTab tr").click(function(){
		$(".newTab tr").removeClass("clickTrcolor");
		$(this).addClass("clickTrcolor");
		$(".newTab tr").find("table").removeClass("clickTrcolor");
		$(this).find("table").addClass("clickTrcolor");
	})
	
	$(".financeTab tr").click(function(){
		$(".financeTab tr").removeClass("clickTrcolor");
		$(this).addClass("clickTrcolor");
		$(".financeTab tr").find("table").removeClass("clickTrcolor");
		$(this).find("table").addClass("clickTrcolor");
	})
	
	
	$(".newTab tr").click(function(){
		//$(".newTab tr").find(".more_detail_btn").css("right","-40px");
		//$(this).find(".more_detail_btn").css("right","0px");
	})
	
	$(".newTab tr").bind({
		mouseover:function(){
			$(this).find(".more_detail_btn").css("right","0px");
		},
		mouseout:function(){
			//if($(this).hasClass('clickTrcolor')){
			//	$(this).find(".more_detail_btn").css("right","0px");
			//}else{
			//	$(this).find(".more_detail_btn").css("right","-40px");
			//}
			
			$(this).find(".more_detail_btn").css("right","-40px");
		}
	});
   	/* 登录框边框颜色 */
   	$('.form-input>input').focus(function(){
   		$('.form-input').removeClass('focus-color');
   		$(this).parent('p').addClass('focus-color');
   	});
   	$('.input-code>input').focus(function(){
   		$('.input-code').addClass('focus-color');
   	});
   	$('.input-code>input').blur(function(){
   		$('.input-code').removeClass('focus-color');
   	});
	
	/* 关闭弹窗按钮 */
	$('.tank-close').click(function(){
		$(this).parent().parent().parent().hide();
	});
	$('.tank-bqx').click(function(){
		$(".tank").hide();
	});
	$('.addc-quxiao').click(function(){
		$(this).parent().parent().parent().hide();
	});
	/*款式供应点击查看更多*/
	var isShow=false;
	$('.more_detail_btn').click(function(event){
		var e=arguments.callee.caller.arguments[0]||event;
		if (e && e.stopPropagation) {
	    e.stopPropagation();
	    } else if (window.event) {
	    window.event.cancelBubble = true;
	    }
		$('.newTab tr').removeClass('clickTrcolor');
		$(this).parent().parent().addClass('clickTrcolor');
		$(".kuanshi_detail_pop").animate({right:"0px"},"fast",function(){
			$(this).find('.more_detail_close').animate({left:"-40px"},"fast");
		});
		isShow=true;
		$("body").removeClass("scroll");
		$("body").addClass("of-hide");
		$(".customer-tank").show();
	});
		
	$('.more_detail_close').click(function(){
		$(this).parent('.kuanshi_detail_pop').animate({right:"-540px"},"fast",function(){
			$(this).find('.more_detail_close').animate({left:"-40px"},"fast");
		});
		isShow=false;
		$("body").addClass("scroll");
		$("body").removeClass("of-hide");
	});
	
    $('.newTab_5 tr').click(function(){
    	if(isShow){
    		$('.kuanshi_detail_pop').animate({right:"-540px"},"fast",function(){
    			$(this).find('.more_detail_close').animate({left:"-40px"},"fast");
    		});
    	}
    	else{
    		return ;
    	}
    });
    
	/*订单详情进程变色*/
	$(".order_process:gt(0)").css("color","#999");
   
   	/*操作图标鼠标移入移出*/
    $(".iconTips").hover(function(){
		$(this).find("span").show();
	},function(){
		$(this).find("span").hide();
	})
	
	/**
	 * 个人中心菜单
	 */
	//导航菜单
	$(".left-up-down>a").click(function(){
	    if( $(this).next("ul").css("display")=="none"){
	    	$(".left-menu-list2").slideUp(500);
	    	$(".left-nav-ddzx>img").addClass("left-w-downTrans");
	        $(this).next("ul").slideDown(500);
	        $(this).children(".left-nav-ddzx").children("img").removeClass("left-w-downTrans");
	    }else{
	        $(this).next("ul").slideUp(500);
	        $(this).children(".left-nav-ddzx").children("img").addClass("left-w-downTrans");
	    }
	});
});

//主页面跳转 nav展开
function goTo(alias,url){
	var doc=$(window.parent.frames["menus"].document);
	
	 $(".nav_list>li>a").css("backgroundColor","#272c31");
     $(".nav_list>li>a").css("color","#bdc0c3");
     $(".nav_list>li>a").css("border-bottom","none");
     $(".nav_list>li>a").css("height","36px");
     $(".nav_list>li>a").eq(i).css("backgroundColor","#1f252b");
     $(".nav_list>li>a").eq(i).css("color","#fff");
     $(".nav_list>li>a").eq(i).css("border-bottom","1px solid #363b41");
     $(".nav_list>li>a").eq(i).css("height","35px");
     
     $(".nav_list_2>li>a").css("color","#bdc0c3");
     $(".nav_list_2>li").css("backgroundColor","#1f252b");
     $(".nav_list_2>li").css("border-left","none");
	
	var liPar=doc.find("li[alias='"+alias+"']").parents(".up_down");
	if(liPar && liPar.length>0){	
		doc.find(".nav_list_2").hide();
		doc.find(".nav_list>li>a").css("backgroundColor","#272c31");
		doc.find(".nav_list>li>a").css("color","#bdc0c3");
		
		doc.find("li[alias='"+alias+"']").parent(".nav_list_2").show();
		
		doc.find("li[alias='"+alias+"']").parent(".nav_list_2").find("a").css("color","#bdc0c3");
		doc.find("li[alias='"+alias+"']").css("border-left","3px solid #63a3ef");
		doc.find("li[alias='"+alias+"']").css("background","#2b7dc9");
		doc.find("li[alias='"+alias+"']>a").css("color","#fff");
        doc.find("li[alias='"+alias+"']>a").css("margin-left","43px");
        
		liPar.children("a").css("backgroundColor","#1f252b");
		liPar.children("a").find("img").addClass("w-downTrans");
	}else{
		doc.find("ul>li>a").css("backgroundColor","");
		doc.find("li[alias='"+alias+"']>a").css("backgroundColor","#272c31");	
	}

	window.parent.frames["mainFrame"].location.href = url;
};

function goTomain(url){
	var doc=$(window.parent.frames["menus"].document);
	var src=doc.find("img[clicked='true']").attr("src");
	if(src){
		src=src.substring(0,src.length - 5)+"1.png";
		doc.find("img[clicked='true']").attr("src",src);
		doc.find("img[clicked='true']").attr("clicked","false");
	}
	
	doc.find(".nav_list>li>a").css("backgroundColor","#424155");
	doc.find(".nav_ddzx>img").attr("src","images/down.png");
	doc.find(".nav_list_2").slideUp(500);
	
	window.parent.frames["mainFrame"].location.href = url;
}

/**
 * 登录
 */
window.ctx={};
function login(){
	var phone = $.trim($('#phone').val());
	var password = $.trim($('#password').val());
	if(phone==''){
		$('.yz').html('请输入手机号码');
		return false;
	}else if(password==''){
		$('.yz').html('请输入密码');
		return false;
	}else{
		var redirect = window.locaUrl;
		var checked = $("#remmber")[0].checked;
		$.post(window.ctx+"/login", { phone: phone, password: password,isRemmber:checked},
	   	function(data){
     		if(data.code=='0'){
     			if(redirect){
     				window.location.href=redirect;
     			}else{
     				window.location.href=window.ctx+"/console";
     			}
     		}else{
     			if(data.result){
     				if(data.result.state == -1){
     					$('#chainSuccess').show();
     					$('#perfectLogin').unbind('click').bind('click',function(){
     						window.location.href = window.ctx+"/dealer/editPerfect?id="+data.result.merchant_id;
     					});
     					if(redirect){
     						$('#supplyGo1').unbind('click').bind('click',function(){
     							window.location.href=redirect;
     						});
     						$('#supplyGo2').unbind('click').bind('click',function(){
     							window.location.href=redirect;
     						});
     					}
     				}else{
     					$('.yz').html(data.msg);
     				}
     			}else{
     				$('.yz').html(data.msg);
     			}
     		}
	   	});
	}
}

//获取商家是否有关联账号
function getAccount(){
	$.ajax({
		url : window.ctx+"/admin/getRelevanceFriends",
		type: "GET",
		dataType: "json",
		success : function(data) {
			if(data.code == "0"){
				var accounts = data.results;
				var html = "";
				for(var a in accounts){
					html += "<li onclick='switchAccount("+accounts[a].id+","+accounts[a].merchant_id+")'>"+accounts[a].name+"</li>";
				}
				$(".listDown").html(html);
			}
		},
	})
}

function switchAccount(friend_id,dealer_id){
	$.ajax({
		url : window.ctx+"/admin/switchAccount?friend_id="+friend_id+"&dealer_id="+dealer_id,
		type: "GET",
		dataType: "json",
		success : function(data) {
			if(data.code == "0"){
				location.href=window.ctx+"/console";
     		}else{
     			$(".DeletTitle").text(data.msg);
     			$(".Delettank").show();
     			$(".btns").unbind("click").bind("click",function(){
	     			location.reload();
     			});
     		}
		}
	})
}

var i = 0;
var countdown=60; 
function settime(val) { 
	if (countdown == 0) { 
		$(".get-code").removeClass("get-code2");
		val.removeAttribute("disabled");    
		val.value="获取验证码"; 
		countdown = 60; 
		return;
	} else {
		$(".get-code").addClass("get-code2");
		val.setAttribute("disabled", true); 
		val.value =countdown+ "s后重新获取";
		countdown--; 
	} 

	setTimeout(function() { 
		settime(val) 
	},1000) 
}

//验证手机号码
function isMobile(mobile){
	if(!/^1[3|4|5|7|8]\d{9}$/i.test(mobile)){
		return false;
	}
	return true;
}

//表格动态配置
function Change() {
	for (var i = 1; i <= $("#tb tr:eq(0) th").length; i++) {
		if ($("#" + i + "").is(":checked")) {
			$("#tb tr th:nth-child(" + i + ")").show();
			$("#tb tr td:nth-child(" + i + ")").show();
		} else {
			$("#tb tr th:nth-child(" + i + ")").hide();
			$("#tb tr td:nth-child(" + i + ")").hide();
		}
	}
}
function Change2() {
	for (var i = 1; i <= $("#tb2 tr:eq(0) th").length; i++) {
		if ($("#" +i+i+"").is(":checked")) {
			$("#tb2 tr th:nth-child(" + i + ")").show();
			$("#tb2 tr td:nth-child(" + i + ")").show();
		} else {
			$("#tb2 tr th:nth-child(" + i + ")").hide();
			$("#tb2 tr td:nth-child(" + i + ")").hide();
		}
	}
}

//部门改变事件
function deptChange(){
	var deptId = $("select[name='dept_id']").val();
	if(!deptId){
		$("select[name='manageer_id']").html("");
		return;
	}
	$.ajax({
		url:window.ctx+'/admin/getManageerByDept?deptId='+deptId,
		type:"GET",
		dataType: "json",
		success:function(data){
			if(data.code=="0"){
				var html ="",results = data.results;
				for (var m in results) {
					html +="<option value='"+results[m].id+"'>"+results[m].name+"</option>";
				}
				$("select[name='manageer_id']").html(html);
				var manageerId = $("#manageerId").val();
				$("select[name='manageer_id'] option[value='"+manageerId+"']").prop("selected","selected");
			}
		}
	});
}

//经手人改变事件
function principalChange(){
	var id = $("select[name='principal_id']").val();
	$.getJSON(window.ctx+'/finance/getDeptAndManageer?principalId='+id,function(data) {
		if(data.code="0"){
			var result = data.result;
			$("#manageerId").val(result.manageer);
			$("select[name='dept_id'] option[value='"+result.dept_id+"']").prop("selected","selected");
			deptChange();
		}
	})
}

//获取几天前的日期
function getBeforeDate(n){
	var d = new Date();
	var year = d.getFullYear();
	var mon = d.getMonth()+1;
	var day = d.getDate();
	if(day <= n){
        if(mon > 1) {
        	mon=mon-1;
        }else{
        	year = year-1;
        	mon = 12;
        }
    }
	d.setDate(d.getDate()-n);
    year = d.getFullYear();
    mon = d.getMonth()+1;
    day = d.getDate();
    return year+"-"+(mon<10?('0'+mon):mon)+"-"+(day<10?('0'+day):day);
}

//控制金额输入
function clearNoNum(obj){    
    obj.value = obj.value.replace(/[^\d.]/g,"");  //清除“数字”和“.”以外的字符     
    obj.value = obj.value.replace(/\.{2,}/g,"."); //只保留第一个. 清除多余的     
    obj.value = obj.value.replace(".","$#$").replace(/\./g,"").replace("$#$",".");    
    obj.value = obj.value.replace(/^(\-)*(\d+)\.(\d\d).*$/,'$1$2.$3');//只能输入两个小数     
    if(obj.value.indexOf(".")< 0 && obj.value !=""){//以上已经过滤，此处控制的是如果没有小数点，首位不能为类似于 01、02的金额    
    	obj.value= parseFloat(obj.value);    
    }    
}    

/**
 * URL跳转
 */
function go(url){
	window.location.href=url;
}

/**
*	百度统计
*/
var _hmt = _hmt || [];
(function() {
  var hm = document.createElement("script");
  hm.src = "https://hm.baidu.com/hm.js?c206a9b14cd6eaf8ddccdd9bb9b8878a";
  var s = document.getElementsByTagName("script")[0]; 
  s.parentNode.insertBefore(hm, s);
})();
