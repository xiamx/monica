<!DOCTYPE html>
<html lang="zh" dir="{{ htmldir() }}">
<head>
    <base href="{{ url('/') }}/"/>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>@yield('title', trans('app.application_title'))</title>
    <link rel="manifest" href="manifest.webmanifest">

    <link rel="stylesheet" href="{{ asset(mix('css/app-'.htmldir().'.css')) }}">

    <link rel="shortcut icon" href="img/favicon.png">
    <script>
        window.Laravel = {!! \Safe\json_encode([
          'locale' => \App::getLocale(),
          'htmldir' => htmldir()
      ]); !!}
    </script>
</head>
<body class="sans-serif">
<div class="mw8 center ph3">
    <div class="cf">
        <nav class="dt w-100 mw9 center">
            <div class="dtc w2 v-mid pt3 pb3">
                <a href="/" class="db">

                    <img src="/img/logo_vertical.png" class="mw-none" style="width: 150px;">
                </a>
            </div>
            <div class="dtc v-mid tr pa3">
                <a class="f6 fw4 dib ml2 pv2 ph3 secondary-button br3" href="/login">登陆</a>
                <a class="f6 fw4 dib ml2 pv2 ph3 secondary-button br3" href="/register?lang=zh">新用户注册</a>
            </div>
        </nav>
    </div>
</div>


<div class="mw8 center ph3">
    <div class="cf">
        <div class="fl w-100 tc mb5">
            <h1 class="f2 normal lh-copy">你的专属友情备忘录</h1>
            <h2 class="normal lh-copy">常联系 PRM 是一款个人关系管理系统，你可以用它来记录和亲朋好友互动中的美好瞬间。</h2>
        </div>

        <div class="fl w-100 tc mb5">
            <a href="/register" class="primary-button br3 pv3 ph4 mb2 dib fw5">免费注册</a>
        </div>
    </div>
</div>

<div class="mw8 center ph3" style="margin-bottom: 80px;">
    <div class="cf mb6-ns mb2">
        <div class="fl w-50-ns w-100 pl5-ns mb3 mb0-ns">
            <h2 class="normal">2019 年我们竟然要用软件管理个人关系</h2>
            <p class="measure lh-copy">
                2019 年，你在刷微信，但是你又有多久没和好朋友见面了？
                想要一起聚餐？那你得等到你们都有空有心情的时候，一拖再拖。</p>
            <p class="measure lh-copy">常联系PRM陪你一起记录珍贵的时刻。</p>
        </div>
        <div class="fl w-50-ns w-100 tc">
            <img src="/img/demo_1.png" style="width: 340px"/>
        </div>
    </div>
    <div class="cf mb4-ns mb2">
        <div class="fl w-100-ns w-100 pr4-ns" style="margin-bottom: 40px">
            <h2 class="normal">核心功能</h2>
            <h3>写日记、朋友圈也挺好的，为什么要用常联系PRM？强在信息的汇总。</h3>
            <p class="measure lh-copy">你可以在常联系PRM 上快速记录并快速回忆亲朋好友的：</p>
            <div class="flex">
                <div>
                    <ul class="list ml0 pl0">
                        <li class="mb2">
                            家庭与工作信息
                        </li>
                        <li class="mb2">
                            和其他人的关系
                        </li>
                        <li class="mb2">
                            一起分享的喜怒哀乐
                        </li>
                        <li class="mb2">
                            重要节日提醒
                        </li>
                    </ul>
                </div>
                <div class="ml4">
                    <ul class="list pl0">
                        <li class="mb2">礼物点子</li>
                        <li class="mb2">承诺过的事情</li>
                        <li class="mb2">收到的礼物，欠下的债务</li>
                    </ul>
                </div>
            </div>
            <p class="measure lh-copy">最重要的是，常联系PRM是完全私密的，你记下的内容只有你一个人可以看到。</p>
        </div>
        <div class="fl w-100-ns w-100 tc">
            <img src="/img/demo_2.png" style=""/>
        </div>
    </div>
</div>

<div class="mw8 center ph3 mb4">
    <div class="cf">
        <div class="fl w-25-ns w-100 tc tl-ns">
            <p class="mt2 f6">Entreprise R&D Meng Xuan Xia © 2019</p>
        </div>
    </div>
</div>

<div class="mw8 center ph3 mb4">
    <div class="cf">
        <div class="fl w-20-ns w-100">
            <p class="fw5 mt0">关于我们</p>
            <ul class="pl0 list">
                <li class="mb2 f6"><a href="/privacy" class="muted-link no-underline">隐私政策</a></li>
                <li class="mb2 f6"><a href="/terms" class="muted-link no-underline">用户协议</a></li>
            </ul>
        </div>
    </div>
</div>


<!-- <script src="/js/app.js"></script> -->
<style>
    body {
        background-color: #fffbf2;
    }

    .primary-button {
        background-color: #3cb371;
        border: 1px solid #3cb371;
        border-bottom-color: rgb(60, 179, 113);
        border-bottom-width: 1px;
        border-bottom-color: rgba(0, 0, 0, .15);
        color: #fff;
        border-bottom-width: 2px;
    }
</style>
</body>
</html>
