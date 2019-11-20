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
    <!-- Matomo -->
    <script type="text/javascript">
        var _paq = window._paq || [];
        /* tracker methods like "setCustomDimension" should be called before "trackPageView" */
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//stats.clxprm.com/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '1']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.type='text/javascript'; g.async=true; g.defer=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
    </script>
    <!-- End Matomo Code -->
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

@yield('content')

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
