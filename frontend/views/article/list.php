<?php
/**
 * Created by PhpStorm.
 * User: huanjin
 * Date: 2018/3/2
 * Time: 22:37
 */
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport"
          content="width=device-width,initial-scale=1.0,maximum-scale=1.0,user-scalable=0,viewport-fit=cover">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="format-detection" content="telephone=no">

    <title>stormzhang</title>

    <link rel="stylesheet" href="//wechat.lingyin99.com/static/css/article.css">

    <style type="text/css">
        .slider {
            overflow: hidden;
            position: relative
        }

        .swiper {
            height: 180px;
            overflow: hidden;
            position: relative
        }

        .swiper .item {
            float: left;
            position: relative
        }

        .swiper .item a {
            display: block
        }

        .swiper .item .img {
            display: block;
            width: 100%;
            height: 180px;
            background: center center no-repeat;
            background-size: cover
        }

        .swiper .item .desc {
            position: absolute;
            left: 0;
            right: 0;
            bottom: 0;
            height: 1.4em;
            font-size: 16px;
            padding: 20px 50px 12px 13px;
            background-image: -webkit-linear-gradient(top, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, .7) 100%);
            background-image: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0, rgba(0, 0, 0, .7) 100%);
            color: #fff;
            text-shadow: 0 1px 0 rgba(0, 0, 0, .5);
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            word-wrap: normal
        }

        .indicator {
            position: absolute;
            right: 15px;
            bottom: 10px
        }

        .indicator a {
            float: left;
            margin-left: 6px
        }

        .icon_dot {
            display: inline-block;
            vertical-align: middle;
            width: 6px;
            height: 6px;
            border-radius: 3px;
            background-color: #d0cdd1
        }

        .icon_dot.active {
            background-color: #6a666f
        }
    </style>
    <style type="text/css">
        .tab_hd {
            height: 44px
        }

        .tab_hd_inner {
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            width: 100%;
            font-size: 0;
            background-color: #f2f2f2
        }

        .tab_hd_inner .item {
            height: 44px;
            line-height: 44px;
            width: 100%;
            -webkit-box-flex: 1;
            -webkit-flex: 1;
            -ms-flex: 1;
            box-flex: 1;
            flex: 1;
            font-size: 15px;
            color: #000;
            text-align: center;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent
        }

        .tab_hd_inner .item.active {
            color: #21b100
        }

        .tab_hd_inner .item:active {
            background-color: rgba(0, 0, 0, .1)
        }

        .article_list {
            background-color: #fff
        }

        .list_item {
            display: block;
            padding: 15px 15px 10px 10px;
            overflow: hidden;
            position: relative;
            text-decoration: none;
            -webkit-tap-highlight-color: transparent
        }

        .list_item:active {
            background-color: rgba(0, 0, 0, .1)
        }

        .list_item:after {
            content: " ";
            position: absolute;
            bottom: 0;
            width: 100%;
            height: 1px;
            border-bottom: 1px solid #e2e2e2;
            -webkit-transform-origin: 0 100%;
            -ms-transform-origin: 0 100%;
            transform-origin: 0 100%;
            -webkit-transform: scaleY(.5);
            -ms-transform: scaleY(.5);
            transform: scaleY(.5);
            left: 10px
        }

        .list_item:last-child:after {
            border: 0
        }

        .list_item .cover {
            float: left;
            margin-right: 10px
        }

        .list_item .cover .img {
            display: block;
            width: 80px;
            height: 60px
        }

        .list_item .cont {
            overflow: hidden
        }

        .list_item .cont .title {
            font-weight: 400;
            font-size: 16px;
            color: #000;
            width: 100%;
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            word-wrap: normal
        }

        .list_item .cont .desc {
            font-size: 13px;
            color: #999;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 2;
            line-height: 1.3
        }

        .more {
            text-align: center
        }

        .list-loading {
            text-align: center;
            color: #888;
            padding: 10px 0;
        }
    </style>
</head>
<body id="" class="zh_CN ">

<div class="container">
    <div id="js_plugins_loading" class="loading" style="display: none;">
        加载中
    </div>
    <div id="js_plugins" style="visibility: visible;">
        <div class="slider js_plugin" id="namespace_0" data-pid="1">
            <div class="swiper" style="height: 180px; width: 100%;">

                <!-- 轮播banner -->

                <div class="item js_post" style="width: 624px; height: 180px;">
                    <a href="http://mp.weixin.qq.com/s?__biz=MzA4NTQwNDcyMA==&amp;mid=2650664103&amp;idx=1&amp;sn=213b3e9ffa1b9f74e2dc6947d2ffcc59&amp;scene=19#wechat_redirect">
                        <div class="img js_img"
                             style="background-image: url('http://mmbiz.qpic.cn/mmbiz_jpg/159icnNTXChPm7VvDxSfb35hEia0mPOjuib400yQNqno3oIFiciaBLQbDbRCibLsSSs0mVZN9O2hgWrBpY8QZkuapR1w/0');"></div>
                        <p class="desc js_title">一不小心日入十万了</p>
                    </a>
                </div>

                <div class="item js_post" style="width: 624px; height: 180px;">
                    <a href="http://mp.weixin.qq.com/s?__biz=MzA4NTQwNDcyMA==&amp;mid=2650664086&amp;idx=1&amp;sn=b8d0eb4c767aedb9496e9b0256958659&amp;scene=19#wechat_redirect">
                        <div class="img js_img"
                             style="background-image: url('http://mmbiz.qpic.cn/mmbiz_jpg/159icnNTXChMAMUwXlwSKmMCbNjH4kmBeIt2pLWZTtC7HVsMKf2D8s7icFWYRJK3l3r7eYs3YeMLUGOfdXLapd0w/0');"></div>
                        <p class="desc js_title">现在学编程，晚么？</p>
                    </a>
                </div>

            </div>
            <div class="indicator">

                <a href="javascript:;"><i class="icon_dot active"></i></a>

                <a href="javascript:;"><i class="icon_dot "></i></a>

            </div>
        </div>
        <div class="tab js_plugin" id="namespace_1" data-pid="2">
            <div class="tab_hd">
                <div class="tab_hd_inner">

                    <!-- 导航菜单 -->

                    <div type="index" data-index="0" class="item active">近期文章</div>

                    <div type="index" data-index="1" class="item ">工具</div>


                </div>
            </div>
            <div class="tab_bd">

                <!-- 文章列表 -->

                <div class="article_list article_list_0">

                    <a class="list_item js_post"
                       href="http://mp.weixin.qq.com/s?__biz=MzA4NTQwNDcyMA==&amp;mid=2650664004&amp;idx=1&amp;sn=d648973bd94a8d389d3bb311b13690d8&amp;scene=19#wechat_redirect">
                        <div class="cover">
                            <img class="img js_img"
                                 src="http://mmbiz.qpic.cn/mmbiz_jpg/159icnNTXChO5NXr1DeZ8RwRhk03osJMicSQb2oGnZnyMgBe4Ff6e1Qm4PwiaAo1ZdkSjJRvJfvwbmyx1XDticoPTg/0"
                                 alt="">
                        </div>
                        <div class="cont">
                            <h2 class="title js_title">2018 年的第一次福利</h2>
                            <p class="desc">可能是今年最大的一次福利。</p>
                        </div>
                    </a>

                    <a class="list_item js_post"
                       href="http://mp.weixin.qq.com/s?__biz=MzA4NTQwNDcyMA==&amp;mid=2650664035&amp;idx=1&amp;sn=35f6c9f13382bc5ee7b8825b44a45f86&amp;scene=19#wechat_redirect">
                        <div class="cover">
                            <img class="img js_img"
                                 src="http://mmbiz.qpic.cn/mmbiz_jpg/159icnNTXChNFUkI8ia1hsL5bFcUiatN129cK2sxm5eD2sBhtmGnV8X2HRLTMzSmSuFn5jCAvR85diaOON9R3qaGsQ/0"
                                 alt="">
                        </div>
                        <div class="cont">
                            <h2 class="title js_title">别再透支你的社交信用了</h2>
                            <p class="desc">你可能从来没在意的。</p>
                        </div>
                    </a>

                    <a class="list_item js_post"
                       href="http://mp.weixin.qq.com/s?__biz=MzA4NTQwNDcyMA==&amp;mid=2650664093&amp;idx=1&amp;sn=03571d68194b58c0a89b0ef43f185d3f&amp;scene=19#wechat_redirect">
                        <div class="cover">
                            <img class="img js_img"
                                 src="http://mmbiz.qpic.cn/mmbiz_jpg/159icnNTXChNoLST3Fp6giagJavNgG4OVRXykZmFPve7HVFmJs4L0UEUlXebeP5VlLIib5brwzO8icEBP4UL5VVPicQ/0"
                                 alt="">
                        </div>
                        <div class="cont">
                            <h2 class="title js_title">第二期终于来了！</h2>
                            <p class="desc">你们期待的终于来了。</p>
                        </div>
                    </a>

                    <a class="list_item js_post"
                       href="http://mp.weixin.qq.com/s?__biz=MzA4NTQwNDcyMA==&amp;mid=2650664031&amp;idx=1&amp;sn=0327c4bf4e733f9c08658f18b4f8f773&amp;scene=19#wechat_redirect">
                        <div class="cover">
                            <img class="img js_img"
                                 src="http://mmbiz.qpic.cn/mmbiz_jpg/159icnNTXChNYZMrWSnErUWNib3iaCgRYCrxSQkOBcGmFxKWDCV0pXhHdXY6N5U3ELVupJbv4n3sPwAC0vy3KFHdg/0"
                                 alt="">
                        </div>
                        <div class="cont">
                            <h2 class="title js_title">你在百度区块链养狗了么？</h2>
                            <p class="desc">带你区块链养狗。</p>
                        </div>
                    </a>

                    <a class="list_item js_post"
                       href="http://mp.weixin.qq.com/s?__biz=MzA4NTQwNDcyMA==&amp;mid=2650663944&amp;idx=1&amp;sn=7ed62f28d9ad28176efd494a60ce6eb2&amp;scene=19#wechat_redirect">
                        <div class="cover">
                            <img class="img js_img"
                                 src="http://mmbiz.qpic.cn/mmbiz_jpg/159icnNTXChOv939mS4ISfQlPhfRV3aApFnl9qhdPfUgtIZ6RvzYqKjpstqHeXdT7By6tGCRHUUkGAruasEfia3A/0"
                                 alt="">
                        </div>
                        <div class="cont">
                            <h2 class="title js_title">今天，你在冲顶大会赚钱了么？</h2>
                            <p class="desc">你的注意力别被娱乐消费了。</p>
                        </div>
                    </a>

                </div>

                <div class="article_list article_list_1" style="display: none;">

                </div>

            </div>
        </div>

    </div>
</div>


<script nonce="">
    var __DEBUGINFO = {
        debug_js: "//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/biz_wap/debug/console34c264.js",
        safe_js: "//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/biz_wap/safe/moonsafe34c264.js",
        res_list: []
    };
</script>

<script>window.__moon_host = 'res.wx.qq.com';
    window.moon_map = {
        "biz_common/utils/report.js": "//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/biz_common/utils/report3518c6.js",
        "homepage/report.js": "//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/homepage/report243273.js",
        "biz_wap/zepto/event.js": "//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/biz_wap/zepto/event34c264.js",
        "biz_wap/zepto/ajax.js": "//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/biz_wap/zepto/ajax37cd31.js",
        "biz_wap/zepto/zepto.js": "//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/biz_wap/zepto/zepto34c264.js",
        "homepage/index.js": "//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/homepage/index2e7b74.js"
    };</script>
<script>
    var cgiData = {
        biz: 'MzA4NTQwNDcyMA==',
        hid: '1',
        pagename: 'stormzhang',
        comboList: {
            'js': '/hp/hp_1_7.js,/hp/hp_2_10.js',
            'css.js': '/hp/hp_1_7.css.js,/hp/hp_2_10.css.js'
        }
    };
</script>
<script>
    var soonBaseURL = location.protocol + '//' + window.location.host,
        soonMap = {
            'js': [],
            'css.js': []
        };


    for (var k in cgiData.comboList) {
        soonMap[k] = cgiData.comboList[k].split(',');
    }

</script>

<script onerror="wx_loaderror(this)" type="text/javascript"
        src="//res.wx.qq.com/mmbizwap/zh_CN/htmledition/js/homepage/soon322696.js"></script>
<script>
    seajs.use('homepage/index.js');
</script>


<script nonce="" type="text/javascript">
    document.addEventListener("touchstart", function () {}, false);
</script>

</body>
</html>