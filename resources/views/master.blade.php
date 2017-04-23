<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,user-scalable=0">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="./public/css/weui.css">
    <link rel="stylesheet" href="./public/css/ex.css">
    {{--<link rel="stylesheet" href="/css/notebook.css">--}}
</head>
<style>
    /*.button-sp-area{margin:0 auto;padding:15px 0;width:60%}*/
    .placeholder{margin:1.5px;padding:0 10px;background-color:#ebebeb;height:3em;line-height:1.5em;
        /*text-align:center;*/
        color:#777777;

        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;


    }
    /*article {*/
        /*!*display: -webkit-box;*!*/
        /*!*display: -webkit-flex;*!*/
        /*!*display: -ms-flexbox;*!*/
        /*!*display: flex;*!*/
        /*!*-webkit-align-items: center;*!*/
        /*!*-webkit-box-align: center;*!*/
        /*!*-ms-flex-align: center;*!*/
        /*!*align-items: center;*!*/
        /*!*min-width: 0;*!*/
    /*}*/

    .media_hd {
        /*margin-right: .8em;*/
        /*width: 60px;*/
        /*height: 60px;*/
        /*line-height: 60px;*/
        /*text-align: center;*/

    /*img {*/
        /*width: 100%;*/
        /*max-height: 100%;*/
        /*vertical-align: middle;*/
    /*}*/
    }

    .media_bd {
        /*-webkit-box-flex: 1;*/
        /*-webkit-flex: 1;*/
        /*-ms-flex: 1;*/
        /*flex: 1;*/
        /*min-width: 0;*/

    h4 {
        font-weight: 400;
        font-size: 17px;
        width: auto;
        overflow: hidden;
        text-overflow: ellipsis;//文字超过盒子宽度显示省略符号
    white-space: nowrap;//文本不会换行，文本会在在同一行上继续，直到遇到 <br> 标签为止
        /*不明白微信为毛写那么多和换行相关的属性*/
    word-wrap: normal;
        word-wrap: break-word;//允许长单词换行到下一行
    word-break: break-all;//使用浏览器默认的换行规则

    }

    p {
        color: #999999;
        font-size: 13px;
        line-height: 1.2;
        overflow: hidden;
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-box-orient: vertical;
        -webkit-line-clamp: 2;
    }
    }
</style>
<body >

{{--<div class="page">--}}
    {{--@yield('content')--}}
{{--</div>--}}


<div class="page__bd" style="height: 100%;">
    <div class="weui-tab">
        <div class="weui-tab__panel">
            @yield('content')
        </div>
        <div class="weui-tabbar">
            {{--<a href="javascript:;" class="weui-tabbar__item weui-bar__item_on">--}}
            {{--<span style="display: inline-block;position: relative;">--}}
            {{--<img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">--}}
            {{--<span class="weui-badge" style="position: absolute;top: -2px;right: -13px;">8</span>--}}
            {{--</span>--}}
            {{--<p class="weui-tabbar__label">微信</p>--}}
            {{--</a>--}}
            <a href="javascript:;" class="weui-tabbar__item">
                <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
                <p class="weui-tabbar__label">首页</p>
            </a>

            @if( Session::get('name')==null)
                <a href="javascript:;" class="weui-tabbar__item">
                <span style="display: inline-block;position: relative;">
                    <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
                    <span class="weui-badge weui-badge_dot" style="position: absolute;top: 0;right: -6px;"></span>
                </span>
                    <p class="weui-tabbar__label">登录</p>
                </a>
            @else
                <a href="javascript:;" class="weui-tabbar__item">
                <span style="display: inline-block;position: relative;">
                    <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
                    <span class="weui-badge weui-badge_dot" style="position: absolute;top: 0;right: -6px;"></span>
                </span>
                    <p class="weui-tabbar__label">我</p>
                </a>
                <a href="javascript:;" class="weui-tabbar__item">
                    <img src="./images/icon_tabbar.png" alt="" class="weui-tabbar__icon">
                    <p class="weui-tabbar__label">发表</p>
                </a>
            @endif
        </div>
    </div>
</div>


</body>
{{--<script src="/js/jquery-1.11.2.min.js"></script>--}}
<script src="./public/js/zepto.min.js"></script>
<script type="text/javascript" src="https://res.wx.qq.com/open/js/jweixin-1.0.0.js"></script>
<script src="https://res.wx.qq.com/open/libs/weuijs/1.0.0/weui.min.js"></script>
<script src="./public/js/example.js"></script>

@yield('my-js')
</html>
