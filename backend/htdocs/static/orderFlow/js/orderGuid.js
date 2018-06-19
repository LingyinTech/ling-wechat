$(function(){
	
	//基础等级经销商下单引导js
	
	/* 下单引导 */
	
	/* 第二步 订单名称引导 */
	$(".guid1 .inGuid").click(function(){
		formGuide2();
	})
	/* 第三步 顾客姓名引导 */
	$(".guid2 .inGuid").click(function(){
		formGuide3();
	})
	/* 第四步 款式信息引导 */
	$(".guid3 .inGuid").click(function(){
		formGuide4();
	})
	/* 第五步 效果图 上传图片引导 */
	$(".guid4_2 .inGuid").click(function(){
		formGuide5();
	})
	/* 第六步 印花方式 备注引导 */
	$(".guid5_1 .inGuid").click(function(){
		formGuide6();
	})
	/* 第七步 订单销售额引导 */
	$(".guid6_1 .inGuid").click(function(){
		formGuide7();
	})
	/* 第八步 加工厂引导 */
	$(".guid7 .inGuid").click(function(){
		formGuide8();
	})
	/* 第九步 下单存草稿引导 */
	$(".guid8 .inGuid").click(function(){
		formGuide9();
	})
	
	/* 跳过引导动画 */
	$(".guid .juipGuid").click(function(){
		
		endGuid();
		
		$(".guid").hide();
		$(".guidTwo").hide();
		$(".leadTank").hide();
	})
	
	/* 结束引导动画 */
	$(".endguid").click(function(){
		
		endGuid();
		
		$(".guid").hide();
		$(".guidTwo").hide();
		$(".leadTank").hide();
		
		/* 去掉第九步 */
		$(".guideTips9").removeClass("leadCon");
		$(".guid9_1").hide();
		$(".guid9_2").hide();
	})
	

	/* 点击加号增加一行样式减号提示显示 */
	$(".tankJiahao").click(function(){
		$(".guid4_3").show();
	})
	
})

	/* 下单引导 */
	/* 第一步 上传资料包 */
	function formGuide1(){
		/* 阴影显示 */
		$(".leadTank").show();
		/* 第一步 上传资料包 */
		
		$(".guideTips1").addClass("leadCon");
		$(".guid1").show();
		
		return false;
	}
	
	/* 第二步 订单名称引导 */
	function formGuide2(){
		/* 去掉第一步 */
		$(".guideTips1").removeClass("leadCon");
		$(".guid1").hide();
		
		/* 执行第二步 */
		$(".guideTips2 td").addClass("leadCon");
		$(".guid2").show();
	}
	
	/* 第三步 顾客姓名引导 */
	function formGuide3(){
		/* 去掉第二步 */
		$(".guideTips2 td").removeClass("leadCon");
		$(".guid2").hide();
		
		/* 执行第三步 */
		$(".guideTips3 td").addClass("leadCon");
		$(".guid3").show();
	}
	
	/* 第四步 款式信息 加号 减号引导 */
	function formGuide4(){
		/* 去掉第三步 */
		$(".guideTips3 td").removeClass("leadCon");
		$(".guid3").hide();
		
		/* 执行第四步 */
		$(".guideTips4 td").addClass("leadCon");
		$(".skuTr td").addClass("leadCon");
		$(".guid4_1").show();
		$(".guid4_2").show();
		
		$(".xd_zj").addClass("tankJiahao")
	}
	
	/* 第五步 效果图 上传图片引导 */
	function formGuide5(){
		/* 去掉第四步*/
		$(".guideTips4 td").removeClass("leadCon");
		$(".skuTr td").removeClass("leadCon");
		$(".guid4_1").hide();
		$(".guid4_2").hide();
		$(".guid4_3").hide();
		$(".xd_zj").removeClass("tankJiahao")
		
		/* 执行第五步*/
		$(".guideTips5 td").addClass("leadCon");
		$(".guid5_1").show();
		$(".guid5_2").show();
		$(".guid5_3").show();
	}
	
	/* 第六步 印花方式 备注引导 */
	function formGuide6(){
		/* 去掉第五步*/
		$(".guideTips5 td").removeClass("leadCon");
		$(".guid5_1").hide();
		$(".guid5_2").hide();
		$(".guid5_3").hide();
		
		/* 执行第六步*/
		$(".guideTips6 td").addClass("leadCon");
		$(".guid6_1").show();
		$(".guid6_2").show();
		$(".guid6_3").show();
	}
	
	/* 第七步 订单销售额引导 */
	function formGuide7(){
		/* 去掉第六步*/
		$(".guideTips6 td").removeClass("leadCon");
		$(".guid6_1").hide();
		$(".guid6_2").hide();
		$(".guid6_3").hide();
		
		/* 执行第七步*/
		$(".guideTips7 td").addClass("leadCon");
		$(".guid7").show();
	}
	
	/* 第八步 加工厂引导 */
	function formGuide8(){
		/* 去掉第八步*/
		$(".guideTips7 td").removeClass("leadCon");
		$(".guid7").hide();
		
		/* 执行第八步*/
		$(".guideTips8 td").addClass("leadCon");
		$(".guid8").show();
	}
	
	/* 第九步 下单存草稿引导 */
	function formGuide9(){
		/* 去掉第九步*/
		$(".guideTips8 td").removeClass("leadCon");
		$(".guid8").hide();
		
		/* 执行第九步*/
		$(".guideTips9").addClass("leadCon");
		$(".guid9_1").show();
		$(".guid9_2").show();
	}
	
	
	/* 移除所有leadcon样式 */
	function endGuid(){
		$(".guideTips1").removeClass("leadCon");
		$(".guideTips2 td").removeClass("leadCon");
		$(".guideTips3 td").removeClass("leadCon");
		$(".guideTips4 td").removeClass("leadCon");
		$(".guideTips5 td").removeClass("leadCon");
		$(".guideTips6 td").removeClass("leadCon");
		$(".guideTips7 td").removeClass("leadCon");
		$(".guideTips8 td").removeClass("leadCon");
		$(".guideTips9").removeClass("leadCon");
	}
