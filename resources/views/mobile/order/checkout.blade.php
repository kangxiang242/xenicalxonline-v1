@extends('mobile.layout')
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
    <link rel="stylesheet" href="{{ asset('static/mobile/less/checkout.css') }}?ver={{ config('app.asset_version') }}">
@stop

@section('script')
    @parent
    <script src="{{ asset('static/js/xarea.js') }}?ver={{ config('app.asset_version') }}"></script>
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
            var id = $(this).val();
            var img = $(this).find("option:selected").attr('data-img');
            var name = $(this).find("option:selected").text();



            $("input[name='goods_id']").val(id);
            $('.goods-title').text(name);
            $('.goods-img').attr('src',img);


            var price = parseInt($(this).find("option:selected").attr('data-price'));
            var market_price = parseInt($(this).find("option:selected").attr('data-market-price'));

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
                $('#top-freight-price').text("含運費NT$"+freight_price);
            }else{
                $('#freight-price').text("免運費");
                $('#top-freight-price').text("免運費");
            }

            $('#order-price').text(" "+format(order_price));
            $('#top-order-price').text(format(order_price))


        });

        function format (num) {
            var reg=/\d{1,3}(?=(\d{3})+$)/g;
            return (num + '').replace(reg, '$&,');
        }
        $(document).scroll(function() {
            var scroH = $(document).scrollTop();
            if(scroH > 10){
                $('.top-fixed').addClass('start')

            }else{
                $('.top-fixed').removeClass('start')
            }


        });
    </script>
    <script>
        submit('#order-form')
    </script>
@stop

@section('content')
    <div class="checkout-header">
        <div class="wrapper">
            <a href="{{ url('/') }}">
                <img src="{{ asset('static/img/m.logo2.png') }}" width="180px" alt="logo">
            </a>
{{--            <h1 class="page-title">安全結賬</h1>--}}
        </div>
    </div>

    <div class="top-fixed">
        <div class="order">
            <div class="total">
                <p class="price">NT$ <span id="top-order-price">
                        @if($goods->price<$freight_where)
                            {{ round($goods->price+$freight_price) }}
                        @else
                            {{ round($goods->price) }}
                        @endif
                    </span></p>
                <p class="sub">(<span id="top-freight-price">
                        @if($goods->price<$freight_where)
                            含運費NT${{ round($freight_price) }}
                        @else
                            免運費
                        @endif</span>)</p>
            </div>
            <button class="submit-btn" onclick="$('#order-form').submit()">提交訂單</button>
        </div>
    </div>

    <div class="checkout-container">
        <form method="POST" action="{{ url('order') }}" id="order-form">
            {{ csrf_field() }}
            <input type="hidden" value="{{ $form_token }}" name="form_token">
            <div class="checkout-wrapper">


                <div class="main">

                    <div class="card">
                        <p class="title">選購療程</p>
                        <div class="product-main">

                            <div class="goods">
                                <div class="img-wrap">
                                    <img class="goods-img" src="{{ asset('uploads/'.$goods->img) }}" alt="{{ $goods->name }}">
                                </div>
                                <div class="info">
                                    <p class="goods-title">{{ $goods->name }}</p>
                                    <input type="hidden" name="goods_id" value="{{ $goods->id }}">
                                    <select class="change" name="goods_ids">
                                        <option value="0">更換療程</option>
                                        @foreach($products as $item)
                                            <option data-price="{{ $item->price }}" data-market-price="{{ $item->market_price }}" data-img="{{ asset('uploads/'.$item->img) }}" value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="delivery">
                                <span>預計寄出日期：{{ date('Y-m-d',strtotime("+1 day")) }}</span>
                            </div>
                        </div>

                    </div>

                    <div class="card">
                        <p class="title">付運資料</p>
                        <div class="mater">
                            <div class="form-group">
                                <input class="form-control" data-validate="required:請輸入收件人姓名" type="text" name="name" id="name">
                                <label class="shut" for="name">收件人姓名</label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" data-validate="required:請輸入收件人聯絡電話|mobile:聯絡電話格式錯誤" type="tel" name="phone" id="phone">
                                <label class="shut" for="phone">收件人聯絡電話</label>
                            </div>
                            <div class="form-group">
                                <input class="form-control" data-validate="required:請輸入收件人電子郵箱|email:電子郵箱格式錯誤" type="email" name="email" id="email">
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
                                        <select name="city" id="city" data-validate="required:請選擇縣市">
                                            <option value="0">選擇縣市</option>
                                        </select>
                                    </div>

                                    <div class="select-box" id="load-2">
                                        <select name="county" id="county" data-validate="required:請選擇地區">
                                            <option value="0">選擇地區</option>
                                        </select>
                                    </div>

                                    <div class="select-box" id="load-3">
                                        <select name="street" id="street" data-validate="required:請選擇路段">
                                            <option value="0">選擇路段</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="form-address" id="form-address-row">
                                    <input class="form-control" data-validate-condition="order_type:0" data-validate="required:請輸入詳細地址" type="text" name="address" id="address">
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

                    <div class="card">
                        <p class="title">訂單</p>
                        <div class="census">
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
                                                    NT${{ round($freight_price) }}
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
                                    <dd style="color: #ff4e4e;font-size: 2rem">
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



                </div>

            </div>
        </form>
    </div>
@endsection
