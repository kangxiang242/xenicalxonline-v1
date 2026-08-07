<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/index.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>

    <style>
        .swiper-container {
            height: 100%;
        }

        .swiper-slide {
            overflow: hidden;
        }

        .slide-inner {
            position: absolute;
            width: 100%;
            height: 100%;
            left: 0;
            top: 0;
            background-size: cover;
            background-position: center;
        }

        .splitting.-aos-active .char {
            -webkit-animation: splitting 1.2s cubic-bezier(.245,.495,0,.99) forwards;
            animation: splitting 1.2s cubic-bezier(.245,.495,0,.99) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .splitting .word {
            display: inline-block;
            overflow: hidden
        }

        .splitting .char {
            display: inline-block;
            -webkit-transform: translate3d(0,100%,0);
            transform: translate3d(0,100%,0);
            opacity: 0
        }

        @-webkit-keyframes splitting {
            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @keyframes splitting {
            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @-webkit-keyframes splitting-in {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,100%,0);
                transform: translate3d(0,100%,0)
            }

            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @keyframes splitting-in {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,100%,0);
                transform: translate3d(0,100%,0)
            }

            to {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }
        }

        @-webkit-keyframes splitting-out {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }

            to {
                opacity: 0;
                -webkit-transform: translate3d(0,-100%,0);
                transform: translate3d(0,-100%,0)
            }
        }

        @keyframes splitting-out {
            0% {
                opacity: 1;
                -webkit-transform: translate3d(0,0,0);
                transform: translate3d(0,0,0)
            }

            to {
                opacity: 0;
                -webkit-transform: translate3d(0,-100%,0);
                transform: translate3d(0,-100%,0)
            }
        }



        .text-animation-main {
            width: 100%;
            height: 100%;

            top: 0;
            left: 0;
            display: block;
            opacity: 0;
            -webkit-transition: opacity 3s;
            transition: opacity 3s
        }

        .text-animation-main .splitting.-aos-active .char {
            -webkit-transform: translate(0) scaleY(1) rotateX(0) rotate(0);
            transform: translate(0) scaleY(1) rotateX(0) rotate(0);
            -webkit-animation: none;
            animation: none;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .text-animation-main.-show {
            opacity: 1;
            z-index: 2;
            -webkit-transition: opacity 2s;
            transition: opacity 2s;
            pointer-events: all
        }

        .text-animation-main.-show .splitting.-aos-active .char {
            opacity: 0;
            -webkit-animation: splitting-in 1.2s cubic-bezier(.99,0,.755,.505) forwards;
            animation: splitting-in 1.2s cubic-bezier(.99,0,.755,.505) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }

        .text-animation-main:not(.-show) {
            pointer-events: none;
            z-index: 1
        }

        .text-animation-main:not(.-show) .splitting.-aos-active .char {
            opacity: 1;
            -webkit-animation: splitting-out .8s cubic-bezier(.99,0,.755,.505) forwards;
            animation: splitting-out .8s cubic-bezier(.99,0,.755,.505) forwards;
            -webkit-animation-delay: calc(30ms*var(--char-index));
            animation-delay: calc(30ms*var(--char-index))
        }



    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/jquery.textAnimation.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/jquery.waypoints.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/countUp.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/a/js/jquery.parallax-scroll.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/jquery.parallax.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script src="<?php echo e(asset('static/js/jquery.marquee.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script>
        /*$(window).resize(function(){
            resizeVideo();
        });

        resizeVideo();
        function resizeVideo(){

            var video_width = 1000+parseInt($('.suit').find('.wrapper').css('marginLeft'));
            $('.video-main').css('width',video_width);
            var left = $('.shop-btn').offset().left
            $('.shop-btn a').css('left',left+4);
        }*/
    </script>
    <script>
        var is_epilogue_waypoints = false;
        $('.epilogue').waypoint(function(direction) {
            if(is_epilogue_waypoints === false){
                is_epilogue_waypoints = true;
                $('.epilogue .text').textAnimation({
                    speed: 600,
                    delay: 100,
                    left: 50,
                    top: 50,
                    scale: 1,
                    rotateY: 0,
                    rotateX: 0,
                    translateZ: 1000,
                    letterSpacing: '10px',
                    easing: "cubic-bezier(0.290, 0.350, 0.460, 1.200)",
                    backgroundColor: "transparent",
                    isRandomScale: false,
                    isRandomPosition: false,
                    isRandomRotateY: false,
                    isRandomRotateX: false,
                    isRandomTranslateZ: false,
                    isRandomSpeed: false,
                    isRandomDelay: false});

            }


        }, {
            offset: '70%'
        })

        setTimeout(function(){

            $('.slogan').textAnimation({
                speed: 600,
                delay: 100,
                left: 50,
                top: 50,
                scale: 1,
                rotateY: 0,
                rotateX: 0,
                translateZ: 1000,
                letterSpacing: '10px',
                easing: "cubic-bezier(0.290, 0.350, 0.460, 1.200)",
                backgroundColor: "transparent",
                isRandomScale: false,
                isRandomPosition: false,
                isRandomRotateY: false,
                isRandomRotateX: false,
                isRandomTranslateZ: false,
                isRandomSpeed: false,
                isRandomDelay: false});
        },1000)


        $('#use-num').waypoint(function(direction) {
            let demo = new CountUp('use-num',0, 98.8,1,2,{
                useEasing: true,
                useGrouping: true,
            });
            demo.start();

        }, {
            offset: '100%'
        })

        $('.timeline').waypoint(function(direction) {

            $('#ts-svg').addClass('ts-svg')

        }, {
            offset: '50%'
        })

        $('.how').waypoint(function(direction) {
            $('.appear-1').addClass('animate__animated animate__fadeInUp')
            setTimeout(function(){
                $('.appear-2').addClass('animate__animated animate__fadeInUp')
            },500)
            setTimeout(function(){
                $('.appear-3').addClass('animate__animated animate__fadeInUp')
            },1000)
            setTimeout(function(){
                $('.appear-4').addClass('animate__animated animate__fadeInUp')
            },1500)


        }, {
            offset: '50%'
        })

    </script>




    <script>
        textAnimation("#text-banner-0 #banner-p1");
        textAnimation("#text-banner-0 #banner-p2");
        textAnimation("#text-banner-0 #banner-p3");

        textAnimation("#text-banner-1 #banner-p1");
        textAnimation("#text-banner-1 #banner-p2");
        textAnimation("#text-banner-1 #banner-p3");

        textAnimation("#text-banner-2 #banner-p1");
        textAnimation("#text-banner-2 #banner-p2");
        textAnimation("#text-banner-2 #banner-p3");




    </script>
    <script>


        var state = 0; //0表示没有进行动画过渡，1表示在进行动画过渡
        function rotate(dir) {

            if (dir == 1 && state == 0) {
                state = 1;
                var origin_elem = $('.sef-activate');

                var last_elem = $('.sef-activate').prev();

                if(last_elem.length <= 0){
                    last_elem = $('.sef').last();
                }



                origin_elem.removeClass('sef-activate');


                last_elem.addClass('sef-activate');


                origin_elem.css({
                    'left':'0px',
                });


                var next1 = origin_elem.next()
                if(next1.length <= 0){
                    next1 = $('.sef').first();

                }
                next1.css({
                    'left': '300px',
                });


                var next2 = next1.next();
                if(next2.length <= 0){
                    next2 = $('.sef').first();
                }



                next2.css({
                    'left': '600px',
                });


                var next3 = next2.next();
                if(next3.length <= 0){
                    next3 = $('.sef').first();
                }
                next3.css({
                    'left': '900px',
                });

                state = 0;


            } else if (dir == 2 && state == 0) {
                state = 1;

                var origin_elem = $('.sef-activate');

                var next_elem = $('.sef-activate').next();

                if(next_elem.length <= 0){
                    next_elem = $('.sef').first();
                }



                origin_elem.removeClass('sef-activate');


                next_elem.addClass('sef-activate');


                origin_elem.css({
                    'left':'900px',
                });


                var prev1 = origin_elem.prev()
                if(prev1.length <= 0){
                    prev1 = $('.sef').last();

                }
                prev1.css({
                    'left': '600px',
                });


               var prev2 = prev1.prev();
                if(prev2.length <= 0){
                    prev2 = $('.sef').last();
                }

                prev2.css({
                    'left': '300px',
                });


                var prev3 = prev2.prev();
               if(prev3.length <= 0){
                   prev3 = $('.sef').last();
               }
               prev3.css({
                   'left': '0px',
               });

                state = 0;



            }
        }


        $('.question-show').click(function(){
            var is_show = $(this).attr('data-show');
            var height = $(this).find('.q-desc').height()+10+$(this).find('.q-title').height()
            if(!is_show){
                $(this).css('height',height);
                $(this).attr('data-show',1);
                $(this).find('.q-icon').html('&#xeca2;');
            }else{
                $(this).css('height',$(this).find('.q-title').height());
                $(this).removeAttr('data-show');
                $(this).find('.q-icon').html('&#xe775;');
            }

        });

    </script>

    <script>
        var interleaveOffset = 0.5;
        var bannerImageScale=1.1;
        var swiperOptions = {
            allowTouchMove: true,
            autoplay: {
                delay: 6000,
                disableOnInteraction: false
            },
            grabCursor: true,
            watchSlidesProgress: true,
            mousewheelControl: true,
            speed: 1000,
            loop: true,
            pagination: {
                el: '.progress',

                renderBullet: function (index, className) {
                    return '<div class="bar ' + className + '"></div>';
                },
            },
            on: {
                init:function(){

                },
                slideChange: function(){

                    var eq = this.activeIndex;
                    var elem = $(this.slides[eq]).find(".slide-inner").attr('data-bind-text');
                    $(this.slides[eq]).find(".slide-inner video")[0].play()
                    $('#'+elem).find('.text-animation-main').addClass('-show');
                    $('#'+elem).siblings().find('.text-animation-main').removeClass('-show');
                },
                progress: function() {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        var slideProgress = swiper.slides[i].progress;
                        var innerOffset = swiper.width * interleaveOffset;
                        var innerTranslate = slideProgress * innerOffset;

                        var innerScaleOffset = Math.abs(1 - bannerImageScale);
                        var innerScale = Math.abs(slideProgress * innerScaleOffset) + 1;
                        //swiper.slides[i].querySelector(".slide-inner").style.transform = "translate3d(".concat(innerTranslate, "px, 0, 0) scale(").concat(innerScale, ")");
                        swiper.slides[i].querySelector(".slide-inner").style.transform =
                            "translate3d(" + innerTranslate + "px, 0, 0)";
                    }
                },
                touchStart: function() {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = "";
                    }
                },
                setTransition: function(speed) {
                    var swiper = this;
                    for (var i = 0; i < swiper.slides.length; i++) {
                        swiper.slides[i].style.transition = speed + "ms";
                        swiper.slides[i].querySelector(".slide-inner").style.transition = speed + "ms";
                    }
                }
            }
        };

        var swiper = new Swiper("#swiper-video3", swiperOptions);

    </script>



    <script>
        $(document).scroll(function() {
            var scroH = $(document).scrollTop();  //滚动高度
            var viewH = $(window).height();  //可见高度
            var contentH = $(document).height();  //内容高度

            if(scroH> 10){
                $('header').addClass('header-index')

            }

            if(scroH <10){  //距离顶部大于100px时
                $('header').removeClass('header-index')
            }

        });



        var is_marq = false;
        var animation_duration;
        $('#loopWrap').marquee({
            //duration in milliseconds of the marquee

            speed:60,
            //gap in pixels between the tickers
            gap: 0,
            //time in milliseconds before the marquee will start animating
            delayBeforeStart: 0,
            //'left' or 'right'
            direction: 'left',
            //true or false - should the marquee be duplicated to show an effect of continues flow
            duplicated: true,
            pauseOnHover:true,
            startVisible:true,

        });


        $(".epilogue-img").parallax({
            speed:20,
            delay: 1000,
            deviation:300,
        });

    </script>

<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>

    <section class="index-banner">
        <div class="logo-cont">
            <a href="<?php echo e(url('/')); ?>">
                <div class="logo-wrap">
                    <div class="place">
                        <div class="compose">
                            <img class="fra-1" src="<?php echo e(asset('static/img/lg/fraw-1.png')); ?>" alt="logo">
                            <img class="fra-2" src="<?php echo e(asset('static/img/lg/fraw-2.png')); ?>" alt="logo">
                            <img class="fra-3"  src="<?php echo e(asset('static/img/lg/fraw-3.png')); ?>" alt="logo">
                        </div>
                        <div class="intact">
                            <img class="xenical-logo" src="<?php echo e(asset('static/img/lg/xenical-2.png')); ?>" alt="xenical">
                            <p class="text white">全球領先健康減肥藥</p>
                        </div>

                    </div>
                </div>
            </a>
        </div>
            <div class="video-main">
                <div class="video-wrap">
                    <div class="swiper-container" id="swiper-video3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide">
                                <div class="slide-inner" data-bind-text="text-banner-0">
                                    <video id="video1" loop style="object-fit:cover"  muted="" width="100%" height="100%" playsinline="">
                                        <source src="<?php echo e(asset('static/video/111.mp4')); ?>" type="video/mp4">
                                    </video>

                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="slide-inner" data-bind-text="text-banner-1">
                                    <video style="object-fit:cover" loop muted="" width="100%" height="100%" playsinline="">
                                        <source src="<?php echo e(asset('static/video/22.mp4')); ?>" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                            <div class="swiper-slide">
                                <div class="slide-inner" data-bind-text="text-banner-2">
                                    <video style="object-fit:cover" loop  muted="" width="100%" height="100%" playsinline="">
                                        <source src="<?php echo e(asset('static/video/33.mp4')); ?>" type="video/mp4">
                                    </video>
                                </div>
                            </div>

                        </div>
                    </div>
                    <a class="sl-btn" href="<?php echo e(url('product')); ?>"><span>選購羅氏鮮</span><i class="iconfont">&#xe625;</i></a>
                    <div class="shade-mask"></div>

                    <div class="pill1"></div>
                    <div class="pill2"></div>

                    <div class="progress"></div>



                    <div class="text-effect" id="text-banner-0">
                        <p class="p1" id="banner-p1">零食肆意吃</p>
                        <p class="p2" id="banner-p2">Arbitrary&nbsp;</p>
                        <p class="p3" id="banner-p3">盡情享瘦，食飲不設限</p>
                    </div>

                    <div class="text-effect" id="text-banner-1" >
                        <p class="p1" id="banner-p1">衣服隨心穿</p>
                        <p class="p2" id="banner-p2">Free&nbsp;</p>
                        <p class="p3" id="banner-p3">重塑身姿，減肥看得見</p>
                    </div>

                    <div class="text-effect" id="text-banner-2" >
                        <p class="p1" id="banner-p1">自信樂活族</p>
                        <p class="p2" id="banner-p2">Confident&nbsp;</p>
                        <p class="p3" id="banner-p3">輕鬆減脂，重拾自信0負擔</p>
                    </div>


                </div>

            </div>
        <div class="vh">
            

        </div>

    </section>




    <section class="suit">
        <div class="wrapper">
            <div class="suit-head wow animate__animated animate__fadeInUp" >
                <h2 class="title">想減肥的你是否有這樣的困擾？</h2>
            </div>
            <div class="suit-content wow animate__animated animate__fadeInUp">
                <?php
                    $people_key=0;
                ?>
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $for_people; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="item" data-parallax='{"y": <?php echo e($people_key%2==0?'-':''); ?>100}'>
                    <div class="box">
                        <img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->text); ?>">
                    </div>
                    <p class="text"><?php echo e($item->text); ?></p>
                </div>
                    <?php
                        $people_key++;
                    ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
            </div>
        </div>
    </section>

    <section class="about-section timeline">
        <div class="wrapper about ">
            <div class="row ab-main"  >
                <div style="position: relative">
                    <h1 class="ab-title"><?php echo app('cache.config')->get('home_about_title'); ?><br>輕鬆帮你解決減肥困擾</h1>
                    <div id="ts-svg">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 170" preserveAspectRatio="none">
                            <path d="M7.7,145.6C109,125,299.9,116.2,401,121.3c42.1,2.2,87.6,11.8,87.3,25.7">
                            </path>
                        </svg>
                    </div>
                </div>
                <p class="sub">WHAT IS XENICAL</p>
                <div class="text  wow animate__animated animate__fadeInUp">
                    <?php echo app('cache.config')->get('home_about'); ?>

                </div>
            </div>
            
        </div>
    </section>

    <section class="timeline">

        <div class="timeline-body wow animate__animated animate__fadeInUp" id="loopWrap">

            <div class="group">
                <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $trouble; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="item">
                        <p class="p1"><?php echo e($item->text); ?></p>
                        <p class="p2"><span class="num"><?php echo e($item->number); ?></span><span class="unit"><?php echo e($item->unit); ?></span></p>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

            </div>
        </div>
    </section>

    <section class="how">
        <div class="wrapper">
            <div class="modal wow animate__animated animate__fadeInUp">
                <h2 class="title">羅氏鮮的減肥機轉</h2>
                <p class="sub">HOW TO WORK</p>
            </div>
            <div class="how-body">
                <div class="how-resolve">
                    <div class="picker appear-1">
                        <span class="min-zf left-more" style="left: 182px;top: 122px;"></span>
                        <span class="min-zf left-more" style="left: 195px;top: 186px;"></span>
                        <span class="min-zf right-more" style="right: 134px;top: 93px;"></span>
                        <span class="min-zf right-more" style="right: 124px;top: 138px;"></span>

                    </div>
                    <div class="introduce appear-2">
                        <?php echo app('cache.config')->get('how_to_work_1'); ?>

                    </div>
                </div>

                <div class="how-resolve restrain ">
                    <div class="picker appear-3">
                        <span class="max-zf bottom-more" style="bottom: 108px;left: 236px"></span>
                    </div>
                    <div class="introduce appear-4">
                        <?php echo app('cache.config')->get('how_to_work_2'); ?>

                    </div>
                </div>

            </div>
        </div>
        <div class="decorate de-1"></div>
        <div class="decorate de-2"></div>
    </section>

    <section class="product">
        <div class="wrapper">
            <div class="modal bs wow animate__animated animate__fadeInUp">
                <h2 class="title">線上購買羅氏鮮</h2>
                <p class="sub">HOW TO BUY</p>
            </div>
            <div class="product-body">
                <div class="introduce wow animate__animated animate__fadeInUp">
                    <p class="title">線下通路</p>
                    <p class="desc">
                        羅氏鮮已上市全台各大藥局<br>
                        統一定價NT$1,800<br>
                        購買者<span style="color: #ff4e4e">必須出示醫師處方箋</span>
                    </p>
                    <p class="marking">藥</p>
                </div>
                <div class="shop">
                    <div class="introduce order wow animate__animated animate__fadeInUp">
                        <p class="title">線上通路</p>
                        <p class="desc">
                            台灣羅氏鮮官方線上訂購<br>
                            <span style="color: #00d111">無須醫師處方箋</span>，歐洲原廠進口<br>
                            購買組合懶人包可享受優惠讓利
                        </p>
                        <img class="shop-img lazy" src="<?php echo e(asset('static/img/shop.png')); ?>" alt="羅氏鮮">
                    </div>
                    <div class="goods wow animate__animated animate__fadeInUp">
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>

                            <div class="item">
                                <p class="title"><?php echo e($item->name); ?></p>
                                <p class=green-mask>
                                    <span class="price">NT$<?php echo e(number_format(round($item->price))); ?></span>
                                    <span class="box">
                                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($item->market_price-$item->price > 0): ?>
                                            優惠NT$<?php echo e(number_format(round($item->market_price-$item->price))); ?>

                                        <?php else: ?>
                                            藥局統一售價
                                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?></span>
                                </p>
                                <a class="shop-btn " href="<?php echo e(url('checkout/'.$item->id)); ?>">立即購買</a>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    </div>
            

                </div>
            </div>
        </div>
    </section>


    <section class="lunbo">
        <div class="wrapper" style="">
            <div class="modal wow animate__animated animate__fadeInUp">
                <h2 class="title">健康減肥<br>美麗更動人</h2>
            </div>
            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($trade_show): ?>
            <div class="lunbo-body wow animate__animated animate__fadeInUp">
                <div class="evaluate">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = array_values($trade_show); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($key>5): ?>
                            <?php break; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>

                        <div class="sef <?php echo e($key==0?"sef-activate":""); ?>"><img src="<?php echo e(asset_upload($item['img'])); ?>" alt="<?php echo e(isset($item['text'])?$item['text']:''); ?>"></div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
                <div class="switch prev-btn"><a href="javascript:;" onclick="rotate(1)"><i class="iconfont">&#xe779;</i></a></div>
                <div class="switch next-btn"><a href="javascript:;" onclick="rotate(2)"><i class="iconfont">&#xe775;</i></a></div>
            </div>
            <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
        </div>
    </section>


    <section class="tdee">
        <div class="wrapper" style="">
            <div class="modal bs wow animate__animated animate__fadeInUp">
                <h2 class="title">你真的瞭解你的身體嗎？</h2>
  
            </div>
            <div class="tdee-about  wow animate__animated animate__fadeInUp">
                <?php echo str_replace(PHP_EOL,'<br>',app('cache.config')->get('slim_about')); ?>

            </div>
            <div class="tdee-body ">
                <a class="tdee-btn" href="<?php echo e(url('compute')); ?>"><span class="text">測試你的數據</span></a>
            </div>
        </div>

    </section>





    <section class="fqa">
        <div class="wrapper" style="">
            <div class="modal wow animate__animated animate__fadeInUp">
                <h2 class="title">醫師問答</h2>
                <p class="sub">Q&A</p>
            </div>
            <div class="fqa-body">
                <div class="question wow animate__animated animate__fadeInUp">
                    <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $faqs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $key=>$faq): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php if($key>5): ?>
                            <?php break; ?>
                        <?php endif; ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                    <div class="item question-show">
                        <p class="q-title">Q：<?php echo e($faq->questions); ?></p>
                        <p class="q-desc"><?php echo $faq->answers; ?></p>
                        <i class="q-icon iconfont">&#xe775;</i>
                    </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>
                </div>
            </div>
        </div>
    </section>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/xenicalxonline/xenicalxonline-v1/resources/views/web/index.blade.php ENDPATH**/ ?>