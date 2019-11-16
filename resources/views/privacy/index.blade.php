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
    <h1>
        隐私政策
    </h1>
    <p>
    非常欢迎您光临「常联系 PRM」（以下简称本网站），为了让您能够安心的使用本网站的各项服务与资讯，特此向您说明本网站的隐私权保护政策，以保障您的权益，请您详阅下列内容：
    </p>
    <h2>一、隐私权保护政策的适用范围</h2>
    <p>
        隐私权保护政策内容，包括本网站如何处理在您使用网站服务时收集到的个人识别资料。隐私权保护政策不适用于本网站以外的相关连结网站，也不适用于非本网站所委託或参与管理的人员。
    </p>
    <h2>二、个人资料的蒐集、处理及利用方式</h2>

    <p>

    当您造访本网站或使用本网站所提供之功能服务时，我们将视该服务功能性质，请您提供必要的个人资料，并在该特定目的范围内处理及利用您的个人资料；非经您书面同意，本网站不会将个人资料用于其他用途。
    本网站在您使用服务信箱、问卷调查等互动性功能时，会保留您所提供的姓名、电子邮件地址、联络方式及使用时间等。
    于一般浏览时，伺服器会自行记录相关行径，包括您使用连线设备的IP位址、使用时间、使用的浏览器、浏览及点选资料记录等，做为我们增进网站服务的参考依据，此记录为内部应用，决不对外公佈。
    为提供精确的服务，我们会将收集的问卷调查内容进行统计与分析，分析结果之统计数据或说明文字呈现，除供内部研究外，我们会视需要公佈统计数据及说明文字，但不涉及特定个人之资料。
    </p>

    <h2>
        三、资料之保护
    </h2>

    <p>
    本网站主机均设有防火牆、防毒系统等相关的各项资讯安全设备及必要的安全防护措施，加以保护网站及您的个人资料採用严格的保护措施，只由经过授权的人员才能接触您的个人资料，相关处理人员皆签有保密合约，如有违反保密义务者，将会受到相关的法律处分。
    如因业务需要有必要委託其他单位提供服务时，本网站亦会严格要求其遵守保密义务，并且採取必要检查程序以确定其将确实遵守。

    </p>
    <h2>
        四、网站对外的相关连结
    </h2>

    <p>
    本网站的网页提供其他网站的网路连结，您也可经由本网站所提供的连结，点选进入其他网站。但该连结网站不适用本网站的隐私权保护政策，您必须参考该连结网站中的隐私权保护政策。
    </p>

    <h2>
    五、与第三人共用个人资料之政策
    </h2>

    <p>
    本网站绝不会提供、交换、出租或出售任何您的个人资料给其他个人、团体、私人企业或公务机关，但有法律依据或合约义务者，不在此限。
    </p>

    <p>
    前项但书之情形包括不限于：
    </p>

    <ol>
        <li>
            经由您书面同意。
        </li>
        <li>
            法律明文规定。
        </li>
        <li>
            为免除您生命、身体、自由或财产上之危险。
        </li>
        <li>
            与公务机关或学术研究机构合作，基于公共利益为统计或学术研究而有必要，且资料经过提供者处理或蒐集者依其揭露方式无从识别特定之当事人。
        </li>
        <li>
            当您在网站的行为，违反服务条款或可能损害或妨碍网站与其他使用者权益或导致任何人遭受损害时，经网站管理单位研析揭露您的个人资料是为了辨识、联络或採取法律行动所必要者。
        </li>
        <li>
            有利于您的权益。
        </li>
    </ol>
    <p>
        本网站委託厂商协助采集、处理或利用您的个人资料时，将对委外厂商或个人善尽监督管理之责。
    </p>


    <h2>
        六、Cookie的使用
    </h2>

    <p>
        为了提供您最佳的服务，本网站会在您的电脑中放置并取用我们的Cookie，若您不愿接受Cookie的写入，您可在您使用的浏览器功能项中设定隐私权等级为高，即可拒绝Cookie的写入，但可能会导致网站某些功能无法正常执行 。
    </p>
    <h2>
        七、隐私权保护政策之修正
    </h2>

    <p>
        本网站隐私权保护政策将因应需求随时进行修正，修正后的条款将刊登于网站上。
    </p>
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
