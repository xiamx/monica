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
    <h1 id="">最终用户许可协议</h1>

    <p>最后修订：2019年09月18日 </p>

    <p>　　您在使用《常联系 PRM》（以下称“本软件”）之前，请务必仔细阅读本协议的所有条款。当您使用了本软件所提供的任何服务，表示您无条件接受本协议的所有条款，您和本软件之间的合同关系自动成立。若您对本协议的任何条款有异议，您可以选择拒绝来立即停止使用本软件。本软件的联系方式为<CONTACTS>。</p>

    <h2 id="-1">第一条 恪守承诺</h2>

    <p>　　您以各种方式使用本软件的任何服务和数据的过程中，不得以任何方式利用本软件直接或间接从事违反中国法律以及社会公德的行为，且您应当恪守下列承诺： </p>

    <ol>
        <li>发表、上传或转载的内容符合中国法律、社会公德，如：不得发布涉政涉黄的内容。</li>

        <li>不得干扰、损害和侵犯本软件的各种合法权利和利益，如：不得盗版本软件。</li>

        <li>不得干扰、损害和侵犯他人的各种合法权利和利益，如：不得转载未经他人授权的内容。</li>

        <li>遵守本软件附带的其他协议、指导原则、管理细则等，如：若有附带开源许可证则需遵循。 </li>

        <li>对于违反上述条款规定的内容，本软件有权予以删除，并保留移交司法机关处理的权利。</li>
    </ol>

    <h2 id="-2">第二条 免责声明</h2>

    <ol>
        <li>本软件是自由且免费使用的，不提供任何形式的担保。在任何情况下，因使用本软件而产生直接或间接的任何问题，本软件没有义务为您提供任何解决之道，由此可能造成您的任何损失，本软件不承担责任。</li>

        <li>您在本软件提供的内容仅表明您个人的立场和观点。本软件仅为您发表、上传或转载的内容提供存储空间，没有义务查实其出处及其真实性，因您所发提供的内容引发的一切纠纷，本软件不承担责任。  </li>
    </ol>

    <h2 id="-3">第三条 附加条款</h2>

    <ol>
        <li>个人或组织如果认为本软件上存在侵犯自身权益的内容，应及时联系本软件迅速做出处理。</li>

        <li>若您违反了本协议的任一条款，本协议将自动终止，本软件保留通过法律手段追究责任的权利。</li>

        <li>本协议自最后修订之日起生效，对免责声明的解释权及本协议的修订权均属于本软件所有。</li>
    </ol>
</div>


<div class="mw8 center ph3 mb4">
    <div class="cf">
        <div class="fl w-25-ns w-100 tc tl-ns">
            <p class="mt2 f6">Entreprise R&D Meng Xuan Xia © 2019</p>
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
