<!DOCTYPE html>
<html lang="zh-TW" style="font-size: 62.5%">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="renderer" content="webkit">
    <meta http-equiv="content-language" content="zh-tw">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, viewport-fit=cover">
    <meta name="format-detection" content="telephone=no">
    @if(app('cache.config')->get('google_verify_type') == 1)
        {!! app('cache.config')->get('google_verify_code') !!}
    @endif
    @if(isset($layout['seo']))
        <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
    @else
        @hasSection('title')
            <title>@yield('title')</title>
        @else
            <title>{{ isset($layout['seo'])?$layout['seo']->title:"" }}</title>
        @endif
    @endif

    @hasSection('keywords')
        <meta name="keywords" content="@yield('keywords')"/>
    @else
        <meta name="keywords" content="{{ isset($layout['seo'])?$layout['seo']->key_word:"" }}"/>
    @endif

    @hasSection('description')
        <meta name="description" content="@yield('description')"/>
    @else
        <meta name="description" content="{{ isset($layout['seo'])?$layout['seo']->description:"" }}"/>
    @endif


    <link rel="canonical" href="{{ config('app.url') }}/{{ trim(request()->path(),'/') }}">

    <link rel="shortcut icon" href="{{ asset_upload(app('cache.config')->get('favicon'),'/favicon.ico') }}">
    @section('style')
        <link rel="stylesheet" type="text/css" href="{{ asset('static/css/style.css') }}?ver={{ config('app.asset_version') }}"/>
        <link rel="stylesheet" href="{{ asset('static/font_3122894_o33hqrxtwf/iconfont.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" href="{{ asset('static/mobile/less/global.css') }}?ver={{ config('app.asset_version') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('static/wow/animate.min.css') }}?ver={{ config('app.asset_version') }}"/>
    @show

    <script src="{{ asset('static/js/jquery.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/wow/wow.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/jquery_lazyload/jquery.lazyload.min.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        var clientWidth = document.documentElement.clientWidth;
        ;(function (doc, win, undefined) {
            var docEl = doc.documentElement,
                resizeEvt = 'orientationchange' in win? 'orientationchange' : 'resize',
                recalc = function () {
                    clientWidth = docEl.clientWidth;
                    if(docEl.clientWidth > 768){
                        clientWidth = 768

                    }
                    docEl.style.fontSize = clientWidth / 37.5 + 'px';
                };
            if (doc.addEventListener === undefined) return;
            win.addEventListener(resizeEvt, recalc, false);
            doc.addEventListener('DOMContentLoaded', recalc, false)
        })(document, window);
        if(clientWidth > 768){
            clientWidth = 768
        }
        document.documentElement.style.fontSize = clientWidth / 37.5 + 'px';
    </script>
    <script>
        new WOW({
            offset:50,
        }).init();
    </script>
    <script>
        var is_ajax_get_cart = 0;
        var flash_data = '{!! session()->get('flash') !!}';
        if(flash_data){
            flash_data = JSON.parse('{!! session()->get('flash') !!}');
        }else{
            flash_data = false;
        }

        var province = [];

        var free_shipping_where = parseInt("{{ \App\Services\ConfigService::get('freight_where',0) }}");
        var free_shipping_freight = parseInt("{{ \App\Services\ConfigService::get('freight',0) }}");

    </script>


</head>
<body>

@section('header')
    <header>
        <div class="logo-wrap">
            <a href="{{ url('/') }}">
                <img class="logo-img" src="{{ asset('static/img/m.logo2.png') }}?ver={{ config('app.asset_version') }}" alt="logo">
            </a>
        </div>
        <div class="right-wrap">
       {{--     <div class="online"><a href="{{ url('product') }}">線上訂購</a></div>--}}
            <div class="menu"><a class="show-menu" href="javascript:;"><i class="iconfont">&#xe62c;</i></a></div>
        </div>
    </header>
    <div class="online-buy">
        <a href="{{ url('product') }}"><i class="iconfont">&#xe811;</i>線上訂購</a>
    </div>
@show

@section('menu')
    <section class="menu-section">
        <div class="menu-head">
            <a href="javascript:;" class="close-menu"><i class="iconfont">&#xe62f;</i></a>
        </div>
        <ul class="menu-list">
            <li class="menu-item">
{{--                <a href="javascript:;">Sale</a>--}}
                <ul class="menu-dropdown">
                    <li>
                        <a href="{{ url('/') }}">首頁</a>
                    </li>

                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:;">Sale</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="{{ url('product') }}">羅氏鮮網路訂購</a>
                    </li>
                    <li>
                        <a href="{{ url('guide') }}">訂購流程說明</a>
                    </li>
                </ul>
            </li>
            <li class="menu-item">
                <a href="javascript:;">About</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="{{ url('about') }}">瞭解羅氏鮮</a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:;">Q&A</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="{{ url('faq') }}">減肥FAQ</a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:;">Articles</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="{{ url('news') }}">瘦身閱讀</a>
                    </li>
                </ul>
            </li>

            <li class="menu-item">
                <a href="javascript:;">Service</a>
                <ul class="menu-dropdown">
                    <li>
                        <a href="{{ url('check') }}">訂單追蹤</a>
                    </li>
                    <li>
                        <a href="{{ url('message') }}">取得協助</a>
                    </li>
                    <li>
                        <a href="{{ url('compute') }}">瘦身計算機</a>
                    </li>
                </ul>
            </li>

        </ul>
    </section>
@show


@section('banner')
    @if($layout['banners'] && !$layout['banners']->isEmpty())
        <section class="banner-section">
            <div class="banner-main">
                @foreach($layout['banners'] as $key=>$item)
                    @if($item->m_img)
                        <a href="{{ $item->href?url($item->href):"javascript:;" }}"><img src="{{ asset_upload($item->m_img) }}" alt="{{ $item->alt }}"></a>
                    @endif
                @endforeach
            </div>
            @yield('embed-banner')
        </section>
    @endif
@show

@section('breadcrumb')

@show

@yield('content')


@if(request()->is('/'))
    <footer>
        {{--<div class="head">
            <a href="{{ url('/') }}">
                <div class="logo-wrap">
                    <div class="place">
                        <div class="compose">
                            <img class="fra-1" src="{{ asset('static/img/lg/fraw-1.png') }}" alt="logo">
                            <img class="fra-2" src="{{ asset('static/img/lg/fraw-2.png') }}" alt="logo">
                            <img class="fra-3"  src="{{ asset('static/img/lg/fraw-3.png') }}" alt="logo">
                        </div>
                        <div class="intact">
                            <img class="xenical-logo" src="{{ asset('static/img/lg/xenical-2.png') }}" alt="xenical">

                        </div>

                    </div>
                    <p class="text white">全球領先健康減肥藥</p>
                </div>
            </a>
        </div>--}}

        <div class="main">
            <div class="menu-column">

                <div class="menu">
                    <p class="title">Sale</p>
                    <ul class="nav">
                        <li><a href="{{ url('product') }}">羅氏鮮線上購買</a></li>
                        <li><a href="{{ url('guide') }}">購買流程說明</a></li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="title">About</p>
                    <ul class="nav">
                        <li><a href="{{ url('about') }}">瞭解羅氏鮮</a></li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="title">Q&A</p>
                    <ul class="nav">
                        <li><a href="{{ url('faq') }}">減肥FAQ</a></li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="title">Articles</p>
                    <ul class="nav">
                        <li><a href="{{ url('news') }}">減肥專欄</a></li>
                    </ul>
                </div>
                <div class="menu">
                    <p class="title">Service</p>
                    <ul class="nav">
                        <li><a href="{{ url('check') }}">訂單追蹤</a></li>
                        <li><a href="{{ url('message') }}">取得協助</a></li>
                        <li><a href="{{ url('compute') }}">瘦身計算機</a></li>
                    </ul>
                </div>
            </div>

            <div class="contact-column">
                <div class="topic">
                    <div class="item">
                        <a href="{{ url('product') }}">
                            <div class="col">
                                <div class="icon"><i class="iconfont">&#xe64f;</i></div>
                                <div class="text">
                                    <p class="en">Buy Online</p>
                                    <p class="cn"><span>網路訂購</span></p>
                                </div>
                                <div class="arrow-right"><i class="iconfont">&#xe613;</i></div>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="address">
                    {!! str_replace(PHP_EOL,'<br/>',app('cache.config')->get('foot_text')) !!}
                </div>
            </div>

            <div class="description">
                <div class="partner">
                    <div class="icon"><img  style="width: 12.6rem" src="{{ asset('static/img/fdausa.png') }}" alt="fda-usa"></div>
                    <div class="icon"><img style="width: 15.2rem" src="{{ asset('static/img/ema.png') }}" alt="ema"></div>
                    <div class="icon"><img  style="width: 14.5rem" src="{{ asset('static/img/fdataiwan.png') }}" alt="台湾fda"></div>
                    <div class="icon"><img  style="width: 5rem" src="{{ asset('static/img/ROCHE.png') }}" alt="ROCHE"></div>
                    <div class="icon"><img  style="width: 12rem" src="{{ asset('static/img/CHEPLA.png') }}" alt="CHEPLA"></div>
                    <div class="icon"><img  style="width: 2.6rem" src="{{ asset('static/img/7-11.png') }}" alt="7-11"></div>
                    <div class="icon"><img  style="width: 12.2rem" src="{{ asset('static/img/heimao.png') }}" alt="黑猫宅急便"></div>
                    <div class="icon"><img style="width: 5.2rem" src="{{ asset('static/img/ssl.png') }}" alt="ssl"></div>
                </div>
                <p class="copyright">{!! app('cache.config')->get('copyright') !!}</p>
            </div>
        </div>
    </footer>
@endif


</body>


@section('script')
    <script src="{{ asset('static/js/sweetalert2.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/jquery.form.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/api.js') }}?ver={{ config('app.asset_version') }}"></script>
    {!! app('cache.config')->get('google_ga') !!}
    <script>
        $('.show-menu').click(function () {
            $('.menu-section').addClass('-show');
            $('body').append('<div class="shade"></div>');
            $('body').addClass('overflow-hidden')
        });
        $('.close-menu').click(function(){
            $('.menu-section').removeClass('-show');
            $('.shade').remove();
            $('body').removeClass('overflow-hidden')
        });

        $('body').on('click','.shade',function(){
            $('.menu-section').removeClass('-show');
            $('.shade').remove();
            $('body').removeClass('overflow-hidden')
        });
    </script>

@show
<script type="text/javascript" charset="utf-8">
    $(function() {
        $("img.lazy").lazyload({effect: "fadeIn"});
    });
</script>
</html>
