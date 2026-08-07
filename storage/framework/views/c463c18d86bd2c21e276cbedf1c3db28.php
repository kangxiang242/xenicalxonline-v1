<?php $__env->startSection('style'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('style'); ?>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/news.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
    <link rel="stylesheet" type="text/css" href="<?php echo e(asset('static/less/pagination.css')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"/>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('script'); ?>
    <?php echo \Illuminate\View\Factory::parentPlaceholder('script'); ?>
    <script src="<?php echo e(asset('static/js/jquery.waypoints.min.js')); ?>?ver=<?php echo e(config('app.asset_version')); ?>"></script>
    <script>
        $(function(){
            $('.cardList > li').waypoint(function(){
                this.element.classList.add('show');
            },{
                offset: '70%'
            });
        });
        $(window).scroll(function() {
            bgEffect()

        });

        function bgEffect(){
            let top = document.scrollingElement.scrollTop; //触发滚动条，记录数值
            let banner_height = $('.container-bg').height()-60;
            let opacity = 1-top/banner_height;
            $('.container-bg').css('opacity',opacity);
            if(opacity<=0.6){
                $('.page-title').css('color','rgba(0,0,0,'+top/banner_height+')');
            }else{
                $('.page-title').css('color','#fff');
            }

            if(($(window).scrollTop() + $(window).height()).toFixed(0) == $(document).height()){
                $('.container-bg').css('opacity',0);
            }


        }
    </script>
<?php $__env->stopSection(); ?>


<?php $__env->startSection('content'); ?>
    <div class="container-bg" style="background-image: url('<?php echo e(asset_upload(app('cache.config')->get('page_news_back_img_pc'))); ?>')">
        <p class="bg-text"><?php echo app('cache.config')->get('page_news_title'); ?></p>
        <p class="beat"><i class="iconfont">&#xe784;</i></p>
    </div>
    <h1 class="page-title">瘦身專欄</h1>
    <div class="news-wrap">
        <ul class="breadcrumb">
            <li><a href="<?php echo e(url('/')); ?>">首頁</a></li>
            <li class="active">瘦身專欄</li>
        </ul>
        <ul class="cardList vertical">

            <?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if BLOCK]><![endif]--><?php endif; ?><?php $__currentLoopData = $news; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <li class="">
                    <div class="item ">
                        <div class="Img"><a href="<?php echo e(url('news/'.$item->id)); ?>"><img src="<?php echo e(asset('uploads/'.$item->img)); ?>" alt="<?php echo e($item->title); ?>"></a></div>
                        <div class="Txt">
                            <div class="newsInfoIdxBox">
                                <div class="newsDateBox">
                                    <span class="day"><?php echo e($item->release_at->format('d')); ?></span>
                                    <span class="ym"><?php echo e(substr($item->release_at->format('Y'),-2)); ?> <?php echo e($item->release_at->format('M')); ?></span>
                                </div>
                                <div class="newsTitle">
                                    <h3><a href="<?php echo e(url('news/'.$item->id)); ?>"><?php echo e($item->title); ?></a></h3>
                                </div>
                            </div>
                            <p class="ellipsis" style="overflow-wrap: break-word;">
                                <?php echo e(\Illuminate\Support\Str::limit($item->brief?$item->brief:strip_tags($item->content),680)); ?>

                            </p>
                        </div>
                    </div>
                </li>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?><?php if(\Livewire\Mechanisms\ExtendBlade\ExtendBlade::isRenderingLivewireComponent()): ?><!--[if ENDBLOCK]><![endif]--><?php endif; ?>


        </ul>

        <?php echo e($news->links()); ?>

    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('web.layout', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/mac-2312-r/workspace/wwwroot/纤体-減肥/xenicalxonline/xenicalxonline-v1/resources/views/web/news/index.blade.php ENDPATH**/ ?>