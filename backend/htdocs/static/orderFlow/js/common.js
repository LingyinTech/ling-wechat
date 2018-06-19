;(function() {
	
	//打印js,cookie
	
	var LODOP; //声明为全局变量      
	
	function getCookie(name){
		if(document.cookie.length>0){
			var start = document.cookie.indexOf(name + "="),end;
			if(start!==-1){//存在cookie
				start = start + name.length+1;
				end = document.cookie.indexOf(";",start);
				if(end==-1){//已经是最后了
					end = document.cookie.length;
				}
				return unescape(document.cookie.substring(start,end));
			}
			return "";
		}
	}
	 
	function setCookie(name, value, expiredays){
	 	var exdate=new Date();
	 	exdate.setDate(exdate.getDate() + expiredays);
	 	document.cookie=name+ "=" + escape(value) + ((expiredays==null) ? "" : ";expires="+exdate.toGMTString());
	}
	
	function getExpressInfo(type,postid,expressName,orderNo){
		$.ajax({
			url:  window.ctx+'/express',
			type: "POST",
			data:{type:type,postid:postid,expressName:expressName,orderNo:orderNo},
			dataType:'json',
			success:function(data){
				if(data.code=='0' && data.results){
					var infos = data.results;
					var html = "";
					for ( var i in infos) {
						if(i==0){
							html+="<tr class='last' class='wuliu-tdColor'><td colspan='5'><p>"+infos[i].time+"</p></td><td colspan='13'><p>"+infos[i].context+"</p></td></tr>"
						}else if(i==infos.length-1){
							html+="<tr><td colspan='5' class='wuliu-tdColor'><p>"+infos[i].time+"</p></td><td colspan='13'><p>"+infos[i].context+"</p></td></tr>"
						}else{
							html+="<tr><td colspan='5' class='wuliu-tdColor'><p>"+infos[i].time+"</p></td><td colspan='13'><p>"+infos[i].context+"</p></td></tr>"
						}
					}
					$(".result-info2>tbody").html(html);
					$(".wuliu_mes").parent(".tank").show();
					$(".wuliu_mes").show();
				}else{
					showMsg("暂时无物流信息!");
				}
			}
		});
	}
	
	//批量更新订单状态
	function updateOrdersStateBatch(state,supplierType){
		var ids = '',boxs = $('#yanse_div input[type="checkbox"]:checked');
		if(boxs && boxs.length>0){
			var length = boxs.length;
			$('.piliang-fh').show();
			if(state == 2){
				$('#title').html('批量接单<span class="tank-close">×</span>');
				$('#content').html('已选<span>'+length+'</span>个订单，确定批量接单?');
			}else if(state == 3){
				$('#title').html('批量批复<span class="tank-close">×</span>');
				$('#content').html('已选<span>'+length+'</span>个订单，确定批量批复?');
			}else if(state == 4){
				$('#title').html('批量发货<span class="tank-close">×</span>');
				$('#content').html('已选<span>'+length+'</span>个订单，确定批量发货?');
			}
			
			$('#batchSumbit').unbind('click').bind('click',function(){
				$.Showmsg('更新状态中...');
				$("#batchSumbit").attr("disabled","disabled");
				$(boxs).each(function(){
					ids += $(this).val() + ',';
				})
				var start = $("input[name='start']").val(),end=$("input[name='end']").val();
				$.getJSON(window.ctx+'/order/updateOrdersStateBatch',{ids:ids,updateState:state},function(data){
					if(data.code == '0'){
						if(!supplierType){//印花单
							if(window.type == 1){
								window.location.href = window.ctx+'/order/listStandardOrders?state='+state+"&start="+start+"&end="+end;
							}else{
								window.location.href = window.ctx+'/order/listFactoryStandardOrders?state='+state+"&start="+start+"&end="+end;
							}
						}else{//进出货单
							window.location.href = window.ctx+'/order/listSupplierStandardOrders?supplier_type='+supplierType+'&state='+state+"&start="+start+"&end="+end;
						}
					}
				})
			})
		}else{
			showMsg('请先勾选订单!');
		}
	}
	
	//电子面单打印操作
	function editSurfaceSingle(type){
		$(".tank-mdhead").text(type);
		$('.tank-miandan').show();
		$('#surfaceSingle').trigger('change');
	}
	
	//判断快递打印还是电子面单打印
	function checkPrintType(orderId,isPrint){
		var type = $(".tank-mdhead").text();
		if(type == '打印电子面单'){
			getPrintTemplate(orderId,isPrint);
		}else if (type == '打印快递单'){
			expressPrintOrders(orderId,isPrint);
		}
	}
	
	//获取电子面单打印模板
	function getPrintTemplate(orderId,isPrint){
		var ids = $('#surfaceSingle').val();
		if(!ids){
			showMsg('请先设置快递电子面单信息');
			return;
		}
		var templateId = $('#templates').val();
		if(!templateId){
			showMsg('请先设置电子面单模板寄件人信息');
			return;
		}
		var expressId = ids.split('_')[0];
		$.getJSON(window.ctx+'/express/getPrintTemplate',{orderId:orderId,expressId:expressId,templateId:templateId},
			function(data){
				if(data.ResultCode == 100){
					LODOP = getLodop();
					LODOP.PRINT_INIT("电子面单");
					LODOP.SET_PRINT_PAGESIZE(1,'100mm','180mm','');//设置纸张高度
					LODOP.SET_PRINT_MODE("FULL_HEIGHT_FOR_OVERFLOW",true);//超过纸张高度收缩到纸张高度
					LODOP.ADD_PRINT_HTM(0, 0, "100%", '100%', data.PrintTemplate);
					if(isPrint){
						LODOP.PRINT(); 
					}else{
						LODOP.PREVIEW();
					}
				}else{
					alert(data.Reason);
				}
			}
		)
	}
	
	//批量打印的电子面单模板
	function batchPrintTemplates() {  
		var ids = '',boxs = $('#yanse_div input[type="checkbox"]:checked');
		if(boxs && boxs.length>0){
			$.Showmsg('查询信息中...');
			$(boxs).each(function(){
				ids += $(this).val() + ',';
			})
			ids = ids.substring(0,ids.length-1);
			$.getJSON(window.ctx+'/express/getPrintTemplates?ids='+ids,
				function(data){
					$.Hidemsg();
					if(data.code == 99){
						alert(data.msg);
					}else{
						LODOP = getLodop();
					    LODOP.PRINT_INIT("电子面单");
					    LODOP.SET_PRINT_PAGESIZE(1,'100mm','180mm','');   //设置纸张高度    
						for(var d in data){
							var template = jQuery.parseJSON(data[d]);
							if(template.ResultCode == 100){
								 LODOP.NewPage();
								 LODOP.SET_PRINT_MODE("FULL_HEIGHT_FOR_OVERFLOW",true);//超过纸张高度收缩到纸张高度
								 LODOP.ADD_PRINT_HTM(0, 0, "100%", '100%', template.PrintTemplate);
							}else{
								alert('订单:'+template.orderNo+'  '+template.orderName+'\n'+template.Reason);
								return;
							}
						}
						LODOP.PREVIEW(); 
						//LODOP.PRINT(); 
					}
				}
			)
		}else{
			showMsg('请先勾选订单!');
		}
	};  
	
	//获取电子面单寄件人信息模板
	function getSurfaceSingleTemplate(surfaceId){
		$.getJSON(window.ctx+'/admin/listSurfaceSingleTemplate?id='+surfaceId,
			function(data){
				if(data.code == 0){
					$('#sender').show();
					var html = '',templates = data.results;
					if(!templates || templates.length < 1){
						//showMsg('未设置电子面单模板');
						$('#templates').html('');
						$('#sender').hide();
						return;
					}
					for(var t in templates){
						html += '<option value="'+templates[t].id+'" '; 
						if('yes' == templates[t].is_default){
							html += 'selected';
						}
						html += ' >'+templates[t].name+'</option>';
					}
					$('#templates').html(html);
					$('#templates').trigger('change');
				}
			}		
		)
	}
	
	//获取电子面单模板寄件人信息
	function getTemplates(){
		var templateId = $('#templates').val();
		if(!templateId){
			return;
		}
		$.getJSON(window.ctx+'/admin/getTemplateDetail?templateId='+templateId,
			function(data){
				if(data.code == 0){
					var template = data.result;
					$('#templatePerson').val(template.person);
					$('#templateNumber').val(template.number);
					$('#templatePhone').val(template.phone);
					$('#templateProvince').text(template.province);
					$('#templateCity').text(template.city);
					$('#templateAddress').val(template.address);
				}
			}		
		)
	}
	
	//快递改变获取模板
	$(document).on("change", "#surfaceSingle", function(){
		var ids = $(this).val();
		if(ids){
			var surfaceId = ids.split('_')[1];
			getSurfaceSingleTemplate(surfaceId);
		}
	});
	//模板改变获取寄件人信息
	$(document).on("change", "#templates", function(){
		getTemplates();
	});
	
	$(document).on("click", ".tank-close", function(){
		$('.piliang-fh').hide();
	});
	
	//批量打印订单
    function batchPrintOrders() {
		var boxs = $('#yanse_div input[type="checkbox"]:checked');
		if(boxs && boxs.length>0){
			LODOP = getLodop();
			LODOP.PRINT_INIT("打印订单详情");
			LODOP.SET_PRINT_PAGESIZE(1,0,0,'A4');
			$(boxs).each(function(){
				var orderNo = $(this).attr('orderno');
				//var url = 'https://www.dingzhilian.com/express/getOrdersDetailByMerchantId?orderNo='+orderNo+'&adminType='+window.type+'&adminLevel='+window.adminLevel;
				var url = 'http://juchuangfushi.com/express/getOrdersDetailByMerchantId?orderNo='+orderNo+'&adminType='+window.type+'&adminLevel='+window.adminLevel;
				LODOP.NewPage();
		        LODOP.ADD_PRINT_URL(30,20,"100%","100%", url); 
		        LODOP.SET_PRINT_STYLEA(0,"IDTagForPick","printOrder");//指定id内容
		        LODOP.SET_PRINT_MODE("PRINT_PAGE_PERCENT","Auto-Width");//按整宽打印
			})
			//LODOP.PREVIEW();
			LODOP.PRINT();     
		}else{
			showMsg('请先勾选订单!');
		}
    }
    
    //打印快递单
    function expressPrintOrders(orderId,isPrint) {
		var templateId = $('#templates').val();
		var ids = $('#surfaceSingle').val();
		var expressId = ids.split('_')[0];
		$.getJSON(window.ctx+'/express/getExpress',{expressId:expressId},
			function(data){
				if(data.code == 0){
					var express = data.result;
					LODOP = getLodop();
					LODOP.PRINT_INIT("打印快递单");
					LODOP.SET_PRINT_PAGESIZE(1,'230mm','127mm','');
					//var url = 'https://www.dingzhilian.com/express/getOrdersDetailByMerchantId?orderNo='+orderNo+'&adminType='+window.type+'&adminLevel='+window.adminLevel;
					var url = 'http://juchuangfushi.com/express/orderExpress?orderId='+orderId+'&templateId='+templateId;
					LODOP.NewPage();
					LODOP.ADD_PRINT_URL("19mm","16mm","100%","100%", url); 
					LODOP.SET_PRINT_STYLEA(0,"IDTagForPick",express.code);//指定id内容
					LODOP.SET_PRINT_MODE("PRINT_PAGE_PERCENT","100%");//按整宽打印
					if(isPrint){
						LODOP.PRINT(); 
					}else{
						LODOP.PREVIEW();
					}  
				}
			}
		)
    }
	
    window.common = window.common || {};
    window.ctx={};
    window.type={};
    window.adminLevel = {};
    window.common.updateOrdersStateBatch = updateOrdersStateBatch;
    window.common.editSurfaceSingle = editSurfaceSingle;
    window.common.getPrintTemplate = getPrintTemplate;
    window.common.batchPrintTemplates = batchPrintTemplates;
    window.common.batchPrintOrders = batchPrintOrders;
    window.common.getExpressInfo = getExpressInfo;
    window.common.getCookie = getCookie;
    window.common.setCookie = setCookie;
    window.common.expressPrintOrders = expressPrintOrders;
    window.common.checkPrintType = checkPrintType;
    
})();