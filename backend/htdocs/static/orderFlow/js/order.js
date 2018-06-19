;(function () {

    //订单下单js

    var emptyOption = "<option value=''>请选择</option>";
    var emptyTd1 = "<td>未添加尺码信息</td>";
    var emptyTd2 = "<td></td>";


    //查询款式尺码
    function findSizeColor(obj, i) {
        var goodsId = $(".goods_id").eq(i).val();
        console.log(goodsId);
        if (goodsId) {

            var idStr = obj.parents(".skuTr").attr("id");
            var index = idStr.split("_")[1];
            var i = $('.color').index(obj);
            layer.load(2, {time: 10 * 1000});
            $.get('/order-flow/goods/attr?goods_id=' + goodsId, function (data) {
                if (data.status == 0) {
                    var c = data.color;
                    if (c && c.length > 0) {
                        $('.color').eq(i).empty();
                        for (k in c) {
                            $('.color').eq(i).append('<option value="' + c[k].attr_type + '_' + c[k].id + '_' + c[k].attr_value + '">' + c[k].attr_value + '</option>');
                        }
                    } else {
                        $('.color').eq(i).html(emptyOption);
                    }

                    var r = data.size;
                    if (r && r.length > 0) {
                        var size_html = "", size_value = "";
                        for (k in r) {

                            var sizeName = r[k].attr_value;
                            if (sizeName.indexOf("#") > 0) {//删除尺码名称中的#
                                sizeName = sizeName.replace("#", "");
                            }

                            size_html += '<td>' + r[k].attr_value + '</td>';
                            size_value += "<td><input type='text' maxlength='6' name='skuList[" + index + "][" + r[k].attr_type + '_' + r[k].id + '_' + r[k].attr_value + "]' class='" + sizeName + " size' /></td>";
                        }
                        $('.size_name').eq(i).html(size_html);
                        $('.size_count').eq(i).html(size_value);
                    } else {
                        $('.size_name').eq(i).html(emptyTd1);
                        $('.size_count').eq(i).html(emptyTd2);
                    }
                }
                layer.closeAll();
            }, 'json');
        } else {
            $('.size_name').eq(i).html(emptyTd1);
            $('.size_count').eq(i).html(emptyTd2);
        }
        clearSize(i);
    }

    function findStyleLevel(i) {//经销商加工厂进货单下单获取合作伙伴款式价格等级  ---对应经销商加工厂
        var supplier = $(".supplier").eq(i).val();
        if (supplier) {
            $.ajax({
                url: window.ctx + '/admin/getLevel?supplier_id=' + supplier,
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    var style_level_id = data.style_level_id;
                    if (!style_level_id) {
                        showMsg("款式价格等级未设置,请联系供应商!");
                        return;
                    }
                    var merchant_id = data.merchant_id;
                    $.ajax({
                        url: window.ctx + '/style/findStyle?merchant_id=' + merchant_id,
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            var html = "";
                            var style = data.results;
                            if (style) {
                                for (var s in style) {
                                    html += "<option value='" + style[s].id + "_" + style[s].name + "' ";
                                    if (style[s].id == window.supplyStyleId) {
                                        html += "selected";
                                    }
                                    html += " >" + style[s].name + "</option>";
                                }
                                $(".style_id").html(html);
                                $(".style_id").trigger("change");
                                window.style_level_id = style_level_id;
                                totalObtainAmount();
                            }
                        }
                    })
                },
                error: function (data) {
                    alert("出错了!");
                }
            });
        }
    }

    function findCustomerStyleLevel(i) {//供应商出货单下单获取合作伙伴款式价格等级  ---对应财务收付款客户,不对应合作伙伴
        var customer = $(".customer").eq(i).val();
        if (customer) {
            $.ajax({
                url: window.ctx + '/admin/getCustomerLevel?customerId=' + customer,
                type: "GET",
                dataType: 'json',
                success: function (data) {
                    var style_level_id = data.style_level_id;
                    if (!style_level_id) {
                        showMsg("该客户款式价格等级未设置");
                        return;
                    }
                    var merchant_id = data.merchant_id;
                    $.ajax({
                        url: window.ctx + '/style/findStyle',
                        type: "GET",
                        dataType: 'json',
                        success: function (data) {
                            var html = "";
                            var style = data.results;
                            if (style) {
                                for (var s in style) {
                                    html += "<option value='" + style[s].id + "_" + style[s].name + "' >" + style[s].name + "</option>";
                                }
                                $(".style_id").html(html);
                                $(".style_id").trigger("change");
                                window.style_level_id = style_level_id;
                                totalObtainAmount();
                            }
                        }
                    })
                },
                error: function (data) {
                    alert("出错了!");
                }
            });
        }
    }

    function calSingleTotal(i) {//款式数量

        var total = 0;
        var skuTr = $(".skuTr:eq(" + i + ")");
        var sizes = $(".skuTr:eq(" + i + ") .sizeTab tr:eq(0) td");
        var sizeArr = new Array();
        sizes.each(function () {
            var sizeName = $(this).text();
            if (sizeName.indexOf("#") > 0) {//删除尺码名称中的#
                sizeName = sizeName.replace("#", "");
            }
            sizeArr.push(sizeName);
        });
        for (var k = 0; k < sizeArr.length; k++) {
            var val = skuTr.find("." + sizeArr[k]).val();
            if (val != '') {
                total = parseFloat(total) + parseInt(val);
            }
        }
        $('.total').eq(i).html(total);
    }

    // 订算总数量
    function calTotalCases() {
        //总件数
        var totals = 0;
        $(".size").each(function () {
            if (this.value != '') {
                totals = parseFloat(totals) + parseInt(this.value);
            }
        });
        $('.totals').html(totals);
    }

    function clearSize(i) {//清空size数据
        $('.skuTr:eq(' + i + ') .size').val('');
        calSingleTotal(i);
        calTotalCases();
    }

    function ajaxFileUpload(i, ispic) {//ajax上传文件
        var file = $('#file' + i).val();
        if (!file) {
            return;
        }
        $("#loading" + i).show();

        $.get('/upload/form-api', function (data) {
            var uploadData = new FormData();
            uploadData.append('file', $('#file' + i).get(0).files[0]);
            uploadData.append('policy', data.policy);
            uploadData.append('authorization', data.authorization);
            console.log(uploadData);
            $.ajax('http://v0.api.upyun.com/' + data.serviceName, {
                type: 'POST',
                data: uploadData,
                cache: false,
                processData: false,
                contentType: false,
            }).done(function (data, textStatus) {
                console.log(data);
            }).fail(function (res, textStatus, error) {
                try {
                    var body = JSON.parse(res.responseText);
                    alert('error: ' + body.message);
                } catch (e) {
                    console.error(e);
                }
            });
        }, 'json');

        return false;
    }

    function fillCustomer(order) {
        $("input[name='phone']").val(order.phone);
        $("input[name='name']").val(order.name);
        $("input[name='region']").val(order.region);
        $("#city-picker1").citypicker();
        $("input[name='address']").val(order.address);
        $(".drop-down").slideUp();
    }

    function save(state) {
        $('#orderinfo-order_state').val(state);

        $("td.div_red").removeClass("div_red");
        $("tr.div_red").removeClass("div_red");

        var msg = '';
        if (state == 0) {
            msg = ', 即将跳转草稿箱';
            $('#caogao-btn-tishi').show();
        } else if (state == 1) {
            msg = ', 即将跳转订单中心';
            $('#order-btn-tishi').show();
        }

        //异步提交订单
        var url = '/order-flow/order/create'
        $.post(url, $("#orderForm").serialize(), function (data) {
            if (data.status == 0) {
                $('.tank-tishi-main-con-txt').html("保存成功" + msg);
                $('.tank-tishi-main').show();
                setInterval('window.order.reduce(' + state + ')', 1000);
            } else {
                layer.msg('保存存失败');
                $('#caogao-btn-tishi').hide();
                $('#order-btn-tishi').hide();
            }
        }, 'json');
    }

    //读取上传资料包里面的内容，并设置效果图和印花方式
    function readOrderFile(filePath) {
        $.getJSON(window.ctx + '/order/readOrderFile?filePath=' + filePath, function (data) {
            if (data.code == "0") {
                var xiaoguotu = data.mapResults.xiaoguotu;
                var yinhuafangshi = data.mapResults.yinhuafangshi;

                var contentHtml = '';
                var tag = ""
                for (var i = 0; i < xiaoguotu.length; i++) {
                    if (xiaoguotu[i].indexOf("图一") >= 0) {
                        contentHtml += '<div style="float:left; height:250px;"><div style="color:red;font-size:22px;">图一</div><img src="' + window.picPath + xiaoguotu[i] + '"/></div>';
                    } else if (xiaoguotu[i].indexOf("图二") >= 0) {
                        contentHtml += '<div style="float:left; height:250px;"><div style="color:red;font-size:22px;">图二</div><img src="' + window.picPath + xiaoguotu[i] + '"/></div>';
                    } else if (xiaoguotu[i].indexOf("图三") >= 0) {
                        contentHtml += '<div style="float:left; height:250px;"><div style="color:red;font-size:22px;">图三</div><img src="' + window.picPath + xiaoguotu[i] + '"/></div>';
                    } else if (xiaoguotu[i].indexOf("图四") >= 0) {
                        contentHtml += '<div style="float:left; height:250px;"><div style="color:red;font-size:22px;">图四</div><img src="' + window.picPath + xiaoguotu[i] + '"/></div>';
                    } else if (xiaoguotu[i].indexOf("图五") >= 0) {
                        contentHtml += '<div style="float:left; height:250px;"><div style="color:red;font-size:22px;">图五</div><img src="' + window.picPath + xiaoguotu[i] + '"/></div>';
                    } else if (xiaoguotu[i].indexOf("图六") >= 0) {
                        contentHtml += '<div style="float:left; height:250px;"><div style="color:red;font-size:22px;">图六</div><img src="' + window.picPath + xiaoguotu[i] + '"/></div>';
                    } else {
                        contentHtml += '<img src="' + window.picPath + xiaoguotu[i] + '"/>';
                    }

                }
                var ue = UE.getEditor('container');//获得编辑器
                if (!ue.hasContents()) {//编辑器里面为空，才自动设置设置效果图
                    ue.setContent(contentHtml);//设置效果图显示在编辑器中
                }
                debugger
                var printTr = $(".printTr");
                var printRemarkFirst = $("#print_" + 0).children(".tl").children(".print_remark").val();//获取第一栏印花方式备注信息

                if (printTr.length == 1 && printRemarkFirst == "" && yinhuafangshi != null) {//只有一栏印花方式、备注里面为空、印花方式不为空的时候，才自动填充印花信息

                    var printFirst = "";
                    if (yinhuafangshi[0].indexOf("丝印") >= 0) {//包含丝印，则丝印方式为丝印，一次类推
                        printFirst = "1_丝印_个";
                    } else if (yinhuafangshi[0].indexOf("胶印") >= 0) {
                        printFirst = "2_浅色胶片_个";
                    } else if (yinhuafangshi[0].indexOf("胶片印") >= 0) {
                        printFirst = "3_深色胶片_个";
                    } else if (yinhuafangshi[0].indexOf("烫金烫银反光") >= 0) {
                        printFirst = "4_烫金烫银反光_个";
                    } else if (yinhuafangshi[0].indexOf("夜光") >= 0) {
                        printFirst = "5_夜光_个";
                    } else if (yinhuafangshi[0].indexOf("热升华") >= 0) {
                        printFirst = "6_热升华_个";
                    } else if (yinhuafangshi[0].indexOf("刺绣") >= 0) {
                        printFirst = "7_刺绣8cm以内_个";
                    } else {
                        printFirst = "丝印";
                    }
                    $("#print_" + 0).children(".position").children(".print_first").find("option[value=" + printFirst + "]").prop("selected", true);//给第一栏设置印花方式
                    $("#print_" + 0).children(".tl").children(".print_remark").val(yinhuafangshi[0]);//给第一栏设置印花备注
                    $("#print_" + 0).children(".printC").children(".print_count").val("1")//给第一栏设置印花数量，为1

                    for (var i = 1; i < yinhuafangshi.length; i++) {//从第二项开始自动添加新的一栏印花方式同时赋值

                        var html = $(".printTr:first").html();
                        var index = $(".printTr:first").attr("id").substring(6);
                        var prints = 'print[' + parseInt(index) + ']';
                        var newHtml = html.split(prints).join('print[' + pLength + ']');
                        $(".printTr:last").after("<tr class='printTr print-tr' id='print_" + pLength + "'>" + newHtml + "</tr>");
                        $("#print_" + pLength + " .print_count").val(0);
                        $("#print_" + pLength + " .print_num").val(0);
                        $("#print_" + pLength + " .print_remark").val("");

                        $(".jh-print").css("opacity", "1").eq(0).css("opacity", "1");

                        var print = "";
                        if (yinhuafangshi[i].indexOf("丝印") >= 0) {
                            print = "1_丝印_个";
                        } else if (yinhuafangshi[i].indexOf("胶印") >= 0) {
                            print = "2_浅色胶片_个";
                        } else if (yinhuafangshi[i].indexOf("胶片印") >= 0) {
                            print = "3_深色胶片_个";
                        } else if (yinhuafangshi[i].indexOf("烫金烫银反光") >= 0) {
                            print = "4_烫金烫银反光_个";
                        } else if (yinhuafangshi[i].indexOf("夜光") >= 0) {
                            print = "5_夜光_个";
                        } else if (yinhuafangshi[i].indexOf("热升华") >= 0) {
                            print = "6_热升华_个";
                        } else if (yinhuafangshi[i].indexOf("刺绣") >= 0) {
                            print = "7_刺绣8cm以内_个";
                        } else {
                            print = "丝印";
                        }

                        $("#print_" + pLength).children(".position").children(".print_first").find("option[value=" + print + "]").prop("selected", true);//设置印花方式
                        $("#print_" + pLength).children(".tl").children(".print_remark").val(yinhuafangshi[i]);//设置印花备注
                        $("#print_" + pLength).children(".printC").children(".print_count").val("1")//设置印花数量为1

                        pLength++;
                    }
                }
            }
        })
    }

    $('.drop-down').mouseleave(function () {	//input失去焦点提示框消失
        $(".drop-down").slideUp();
    });

    $('.order-drop-down').mouseleave(function () {//input失去焦点提示框消失
        $(".order-drop-down").slideUp();
    });

    var second = 5;
    function reduce(state) {
        second = second - 1;
        $('#tank-tishi-time').text(second + "s");
        if (second == 0) {
            if (state == 0) {
                window.location.href = '/order-flow/order/index/state_0';
            } else {
                window.location.href = '/order-flow/order/index/state_' + state;
            }
        }
    };

    //删除款式信息
    function shanchu(obj) {
        if ($(".skuTr").length > 1) {
            $(obj).parents(".skuTr").remove();
            calTotalCases();

            if ($(".skuTr").length == 1) {
                $(".jh").eq(0).css("opacity", "0");
            }
            $("#univalence").trigger("keyup");//删除后改变销售额
        }
    }

    function selectGoods(goodsId, i, goodsName) {
        $(".goods_id").eq(i).val(goodsId);
        $(".goods_name").eq(i).text(goodsName);
        $(".skuTr:eq(" + i + ")").removeClass("div_red");
        window.order.findSizeColor($(".goods_id").eq(i), i);
    }

    window.order = window.order || {};
    window.picPath = {};
    window.ctx = {};
    window.type = {};
    window.style_i = {};
    window.supplyStyleId = {};
    window.supplier_type = {};
    window.level = {};
    window.order.findStyleLevel = findStyleLevel;
    window.order.findCustomerStyleLevel = findCustomerStyleLevel;
    window.order.findSizeColor = findSizeColor;
    window.order.calTotalCases = calTotalCases;
    window.order.clearSize = clearSize;
    window.order.ajaxFileUpload = ajaxFileUpload;
    window.order.shanchu = shanchu;
    window.order.save = save;
    window.order.fillCustomer = fillCustomer;//填充搜索数据
    window.order.reduce = reduce;
    window.order.selectGoods = selectGoods;

})();