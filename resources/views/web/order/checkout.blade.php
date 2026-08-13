@extends('web.layout')
@php
    $freight_where = \App\Services\ConfigService::get('freight_where',0);
    $freight_price = \App\Services\ConfigService::get('freight',0);

    $delivery_type_all = \App\Services\ConfigService::get('delivery_type',[]);
    if($delivery_type_all){
        $delivery_type_all = json_decode(\App\Services\ConfigService::get('delivery_type',[]),true);
    }
@endphp
@section('style')
    @parent
    <link rel="stylesheet" type="text/css" href="{{ asset('static/less/checkout.css') }}?ver={{ config('app.asset_version') }}"/>

@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/jquery.contip.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/sweetalert2.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/xarea.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script src="{{ asset('static/js/api.js') }}?ver={{ config('app.asset_version') }}"></script>
    <script>
        $(".form-control").blur(function(){
            if($(this).val()){
                $(this).addClass('focus');
                $(this).removeClass('red-error');
            }else{
                $(this).removeClass('focus');
                $(this).addClass('red-error');
            }
        });

        $("select[name='goods_ids']").change(function(){

            var $this = $(this);

            var load = '<div class="load"><svg xmlns="http://www.w3.org/2000/svg" class="mx-auto block" style="height:15px;color: #ff9b3e" viewBox="0 0 120 30" fill="currentColor"><circle cx="15" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="60" cy="15" r="9" fill-opacity="0.3"><animate attributeName="r" from="9" to="9" begin="0s" dur="0.8s" values="9;15;9" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="0.5" to="0.5" begin="0s" dur="0.8s" values=".5;1;.5" calcMode="linear" repeatCount="indefinite"></animate></circle><circle cx="105" cy="15" r="15"><animate attributeName="r" from="15" to="15" begin="0s" dur="0.8s" values="15;9;15" calcMode="linear" repeatCount="indefinite"></animate><animate attributeName="fill-opacity" from="1" to="1" begin="0s" dur="0.8s" values="1;.5;1" calcMode="linear" repeatCount="indefinite"></animate></circle></svg></div>'

            $this.parents('.card').append(load);


            setTimeout(function () {
                $this.parents('.card').find('.load').remove();

                var id = $this.val();
                var img = $this.find("option:selected").attr('data-img');
                var name = $this.find("option:selected").text();
                $("input[name='goods_id']").val(id);
                $('.goods-title').text(name);
                $('.goods-img').attr('src',img);


                var price = parseInt($this.find("option:selected").attr('data-price'));
                var market_price = parseInt($this.find("option:selected").attr('data-market-price'));

                var data_name = $this.find("option:selected").attr('data-name');
                if(data_name){
                    $('.goods-title').text(data_name);
                }

                $('#goods-price').text(format(market_price));

                var discount_elem = $('#discount-price');
                if(market_price-price>0){
                    discount_elem.text(format(market_price-price));
                    discount_elem.parents('dl').show();
                }else{
                    discount_elem.text(0);
                    discount_elem.parents('dl').hide();
                }

                var freight_where = parseInt("{{ $freight_where }}");
                var freight_price = parseInt("{{ $freight_price }}");

                var order_price = price;
                if(freight_where > price){
                    order_price  += freight_price;
                    $('#freight-price').text("NT$"+format(freight_price));
                }else{
                    $('#freight-price').text("免運費");
                }

                $('#order-price').text(" "+format(order_price));



            },600)




        });
        function format (num) {
            var reg=/\d{1,3}(?=(\d{3})+$)/g;
            return (num + '').replace(reg, '$&,');
        }

    </script>
@stop


@section('content')
    <div class="checkout-header">
        <div class="wrapper">
            <a href="{{ url('/') }}">
                <div class="logo-wrap hover-logo">
                    <div class="place">
                        <div class="compose">
                            <img class="fra-1" src="{{ asset('static/img/lg/fra-1.png') }}" alt="logo">
                            <img class="fra-2" src="{{ asset('static/img/lg/fra-2.png') }}" alt="logo">
                            <img class="fra-3"  src="{{ asset('static/img/lg/fra-3.png') }}" alt="logo">
                        </div>
                        <div class="intact">
                            <img class="xenical-logo" src="{{ asset('static/img/lg/xenical-1.png') }}" alt="xenical">
                            <p class="text">全球領先健康減肥藥</p>
                        </div>

                    </div>
                </div>
            </a>
            <h1 class="page-title">安全結賬</h1>
        </div>
    </div>
    <div class="checkout-container">
        <form onsubmit="return orderStore();" method="POST" action="{{ url('order') }}" id="order-form">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $form_token }}" name="form_token">
            <div class="checkout-wrapper">
                <ul class="step">
                    <li class="art">填寫付運資料</li>
                    <li>確認訂單</li>
                    <li>建立訂單</li>
                </ul>

                <div class="main">

                    <div class="base-column">
                        <p class="title">付運資料</p>
                        <div class="mater">
                            <div class="form-group" style="width: 360px">
                                <input class="form-control" type="text" name="name" id="name">
                                <label class="shut" for="name">收件人姓名</label>
                            </div>
                            <div class="form-group" style="width: 360px">
                                <input class="form-control" type="tel" name="phone" id="phone" maxlength="10" inputmode="numeric" oninput="this.value=this.value.replace(/[^0-9]/g,'')" pattern="^09\d{8}$" title="請輸入09開頭的10位數字">
                                <label class="shut" for="phone">收件人聯絡電話</label>
                            </div>
                            <div class="form-group" style="width: 360px">
                                <input class="form-control" type="text" name="email" id="email">
                                <label class="shut" for="email">收件人電郵</label>
                            </div>
                            <div class="form-group">
                                <p class="form-group-title">請選擇配送方式</p>
                                <div class="form-radio">
                                    <input type="radio" id="order-type-1" name="order_type" value="1" checked>
                                    <label class="radio-label" for="order-type-1">
                                        <span class="ana"></span>
                                        <span class="text">7-11便利店 取貨付款</span>
                                    </label>
                                </div>

                                <div class="form-radio">
                                    <input type="radio" id="order-type-0" name="order_type" value="0">
                                    <label class="radio-label" for="order-type-0">
                                        <span class="ana"></span>
                                        <span class="text">宅配到府 貨到付款</span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group">
                                <p class="form-group-title" id="order-type-title">配送至門店</p>
                                <div class="form-select">
                                    <div class="select-box" id="load-1">
                                        <select name="city" id="city">
                                            <option value="0">選擇縣市</option>
                                        </select>
                                    </div>

                                    <div class="select-box" id="load-2">
                                        <select name="county" id="county">
                                            <option value="0">選擇地區</option>
                                        </select>
                                    </div>

                                    <div class="select-box" id="load-3">
                                        <select name="street" id="street">
                                            <option value="0">選擇路段</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-address" id="form-address-row">
                                    <input class="form-control" type="text" name="address" id="address">
                                    <label class="shut" for="address">詳細地址</label>
                                </div>

                                <div class="form-store" id="form-store-row">

                                </div>
                            </div>


                            <div class="form-group">
                                <p class="form-group-title">訂單留言</p>
                                <textarea class="form-textarea" name="remarks" ></textarea>
                            </div>

                        </div>
                    </div>

                    <div class="count-column">
                        <div class="card">
                            <div class="product-main">
                                <p class="title">選購療程</p>
                                <div class="goods">
                                    <div class="img-wrap">
                                        <img class="goods-img" src="{{ asset('uploads/'.$goods->img) }}" alt="{{ $goods->name }}">
                                    </div>
                                    <div class="info">
                                        <p class="goods-title">{{ $goods->name }}</p>
                                        <input type="hidden" name="goods_id" value="{{ $goods->id }}">
                                        <select class="change" name="goods_ids">
                                            <option data-price="{{ $goods->price }}" data-market-price="{{ $goods->market_price }}" data-img="{{ asset('uploads/'.$goods->img) }}" value="{{ $goods->id }}" data-name="{{ $goods->name }}">更換療程</option>
                                            @foreach($products as $item)
                                                <option data-price="{{ $item->price }}" data-market-price="{{ $item->market_price }}" data-img="{{ asset('uploads/'.$item->img) }}" value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="delivery">
                                <span>預計寄出日期：{{ date('Y-m-d',strtotime("+1 day")) }}</span>
                            </div>

                            <div class="census">
                                <p class="title">訂單</p>
                                <div class="compute">
                                    <dl>
                                        <dt>
                                            <p class="p-title">商品原價</p>
                                        </dt>
                                        <dd>
                                            NT$<span id="goods-price">{{ number_format(round($goods->market_price)) }}</span>
                                        </dd>
                                    </dl>

                                    <dl style="display: {{ $goods->market_price-$goods->price>0?"flex":'none' }}">
                                        <dt>
                                            <p class="p-title">訂購優惠</p>
                                        </dt>
                                        <dd>
                                            -NT$<span id="discount-price">{{ number_format(round($goods->market_price-$goods->price)) }}</span>
                                        </dd>
                                    </dl>

                                    <dl>
                                        <dt>
                                            <p class="p-title">運費<span class="grep">（含航空運輸費用）</span></p>
                                            <p class="p-text">訂單滿NT${{ number_format(round($freight_where)) }}，可享受官方免運費服務</p>
                                        </dt>
                                        <dd>
                                            <span id="freight-price">
                                                @if($goods->price<$freight_where)
                                                    NT${{ number_format(round($freight_price)) }}
                                                @else
                                                    免運費
                                                @endif
                                            </span>
                                        </dd>
                                    </dl>
                                    <dl>
                                        <dt>
                                            <p class="p-title">税項</p>
                                        </dt>
                                        <dd>免費</dd>
                                    </dl>
                                </div>

                                <div class="count">
                                    <dl>
                                        <dt>
                                            <p class="p-title">訂單總值</p>
                                        </dt>
                                        <dd style="font-size: 28px;color: #ff4e4e">
                                            NT$<span id="order-price">
                                            @if($goods->price<$freight_where)
                                                {{ number_format(round($goods->price+$freight_price)) }}
                                            @else
                                                {{ number_format(round($goods->price)) }}
                                            @endif
                                            </span>
                                        </dd>
                                    </dl>
                                </div>
                            </div>
                        </div>

                        <button class="submit-btn" type="submit">建立訂單</button>
                    </div>

                </div>

            </div>
        </form>
    </div>
@endsection
