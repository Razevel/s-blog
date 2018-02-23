
<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\helpers\Url;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <?= Html::csrfMetaTags() ?>
    
    <title><?= Html::encode($this->title) ?></title>
    

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Slab:400,100,300,700' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Jaldi:400,700' rel='stylesheet' type='text/css'>
    <script type="application/x-javascript"> 
        addEventListener("load", 
            function() { 
                setTimeout(hideURLbar, 0); 
            }, 
            false
        ); 
        function hideURLbar(){ 
            window.scrollTo(0,1); 
        }
    </script>

    <script type="text/javascript">
        jQuery(document).ready(function($) {
            $(".scroll").click(function(event){     
                event.preventDefault();
                $('html,body').animate({scrollTop:$(this.hash).offset().top},1000);
            });
        });
    </script>

    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>


<div class="mothergrid">
    <div class="container">
        <div class="header">
            <div class="logo">
                <a href="<?=Url::to(['blog/index']);?>"> 
                    <img src="<?=Url::to('@web/images/logo.png')?>" alt="SmileBlog Logo"/> 
                </a>
            </div>
            <span class="menu">
                <img src="<?=Url::to('@web/images/icon.png')?>" alt=""/>
            </span>
            <div class="clear"> </div>
            <div class="navg">
                <ul class="res">
                    <li><a class="active" href="<?=Url::to(['blog/index']);?>"><?=Yii::t('app', 'BLOG')?></a></li>
                </ul>
                <script>
                    $( "span.menu").click(function() {
                        $("ul.res" ).slideToggle("slow", function() {                     
                        });
                    });
                </script>
            </div>
            <div class="clearfix"> </div>
        </div>
    </div>
</div>
<div id="main-content">
<?= $content ?>
</div>
<div class="footer">
    <div class="container">
        <div class="footer-main">
            <div class="footer-navg">
                <ul>
                    <li>
                        <a class="active" href="<?=Url::to(['blog/index']);?>"><?=Yii::t('app', 'BLOG')?></a>
                    </li>
                </ul>
            </div>
            <div class="footer-top">
                <div class="col-md-4 footer-left">
                    <h3><?=Yii::t('app', 'Follow us')?></h3>
                    <ul>
                        <li><a href="<?=Yii::$app->params['adminContact']['vk']?>"><span class="a"> </span></a></li>
                        <li><a href="<?=Yii::$app->params['adminContact']['google']?>"><span class="c"> </span></a></li>
                    </ul>
                </div>
                
                <div class="col-md-4 footer-middle">
                    <h3><?=Yii::t('app', 'News letter')?></h3>
                    <input type="text" value="<?=Yii::t('app', 'Enter your email')?>" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '<?=Yii::t('app', 'Enter your email')?>';}"/>
                    <input type="submit" value="<?=Yii::t('app', 'Subscribe')?>">
                </div>
                
                <div class="col-md-4 footer-right">
                    <h3><?=Yii::t('app', 'Contact us')?></h3>
                    <p><?=Yii::t('app', 'email')?> : <?=Yii::$app->params['adminContact']['email']?></p>
                    <p><?=Yii::t('app', 'ph')?> : <?=Yii::$app->params['adminContact']['phone']?></p>
                </div>
                <div class="clearfix"> </div>
            </div>

            <div class="footer-bottom">
                <p><?= date('Y') ?> &copy Template by <a href="http://w3layouts.com/"> W3layouts </a> | Backend by<a href="<?=Yii::$app->params['adminContact']['vk']?>"> Rodionov E. A. </a> </p>
            </div>
            
            <div class="clearfix"> </div>
            <script type="text/javascript">
                $(document).ready(function() {
                /*
                var defaults = {
                    containerID: 'toTop', // fading element id
                    containerHoverID: 'toTopHover', // fading element hover id
                    scrollSpeed: 1200,
                    easingType: 'linear' 
                };
                */  
                    function windowSize(){
                        var wH = $(window).height();
                        //Header + footer
                        var layoutH = Math.round($('.footer').height() + $('.header').height());  
                        var cH = wH - layoutH;        
                        $('#main-content').css('min-height', cH);
                    }

                    $(window).on('load resize', windowSize);
                    $().UItoTop({ easingType: 'easeOutQuart' });
                });
            </script>
            <a href="#" id="toTop" style="display: block;"> <span id="toTopHover" style="opacity: 1;"> </span></a>
        </div>
    </div>
</div>


<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>