@extends('mobile.layout')

@section('style')
    @parent
    <link rel="stylesheet" href="{{ asset('static/mobile/less/product.css') }}?ver={{ config('app.asset_version') }}">
@stop

@section('script')
    @parent
    <script src="{{ asset('static/a/js/jquery.easing.1.3.js') }}?ver={{ config('app.asset_version') }}"></script>

@stop
@section('breadcrumb')
    <ul class="breadcrumb">
        <li><a href="{{ url('/') }}">首頁</a></li>

        <li class="active">線上訂購</li>
    </ul>
@stop

@section('embed-banner')
    <div class="embed-banner">
        <h1 class="embed-title">{!! app('cache.config')->get('page_product_title') !!}</h1>
        <div class="embed-desc">{!! str_replace(PHP_EOL,'<br>',app('cache.config')->get('page_product_desc')) !!}</div>
    </div>
@stop

@section('content')
    <section class="product-container">
        <div class="wrapper">

            <div class="product-main">

                @foreach($products as $key=>$goods)

                    <div class="goods wow animate__animated animate__fadeInUp">
                        <div class="line"></div>
                        <p class="title">{{ $goods->name }}</p>
                        <div class="ex-column">
                            <div class="img-wrap"><img  src="{{ asset('uploads/'.$goods->img) }}" alt="{{ $goods->name }}"></div>
                            <div class="info">
                                <div class="info-boa">
                                    <div class="tags">
                                        @if($goods->label)
                                            <p class="tags">
                                                @foreach(explode('|',$goods->label) as $label)
                                                    <span>{{ $label }}</span>
                                                @endforeach
                                            </p>
                                        @endif
                                    </div>
                                    @if($goods->attr)
                                        <div class="attr">
                                            @foreach($goods->attr as $attr)
                                                <p class="list">
                                                    <span class="attr-name">{{ $attr->name }}：</span>
                                                    <span class="attr-value">{{ $attr->value }}</span>
                                                </p>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            </div>

                        </div>

                        <div class="fix-price">
                            <div class="price">
                                <span class="now">NT$ {{ round($goods->price) }}</span>
                                @if($goods->market_price-$goods->price > 0)
                                    <span class="discount">-NT${{ round($goods->market_price-$goods->price) }}</span>
                                @else
                                    <span class="discount">藥局統一售價</span>
                                @endif
                            </div>

                            <div class="checkout">
                                <a href="{{ url('checkout/'.$goods->id) }}">立即購買</a>
                            </div>
                        </div>

                    </div>
                @endforeach



            </div>

        </div>
    </section>
@endsection
