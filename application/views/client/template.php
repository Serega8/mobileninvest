<!DOCTYPE html>
<html>
    <head>
        <title>Физкультурно-оздоровительный комплекс</title>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">

        <meta name="description" content="">
        
        <? foreach ($styles as $style): ?>
            <?= HTML::style($style); ?>
        <? endforeach; ?>
        
        <? foreach ($scripts as $script): ?>
            <?= HTML::script($script); ?>
        <? endforeach; ?>

        <!--[if IE]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->

        <script type="text/javascript" language="javascript">
            $(function() {
                //	Scrolled by user interaction
                $('#foo2').carouFredSel({
                    items: 3,
                    auto: true,
                    prev: '#prev2',
                    next: '#next2',
                    pagination: "#pager2",
                    mousewheel: true,
                    scroll: {
                        items: 1,
                        duration: 500,
                        pauseOnHover: true
                    }
                });


            });
        </script>
        
    </head>
    <body>		
        <div id="container">
            <!--header-->
            <? if ($_SERVER['REQUEST_URI'] == '/'):?>
            <header class="other">
            <? else:?>
            <header>
             <? endif;?>
                <div class="top-line">
                    <div class="center">
                        <div class="logo left">
                            <a href="/" title="Физкультурно-оздоровительный комплекс">
                                Физкультурно-оздоровительный комплекс
                            </a>
                        </div>
                        <nav class="right">
                            <ul>
                                <li><a href="/">Главная</a></li>
                                <li><a href="/фок-рафиева-белецкого-минск">О комплексе</a></li>
                                <li><a href="/наши-партнеры">Партнеры</a></li>
                                <li><a href="/планировки">Планировки</a></li>
                                <!-- <li><a href="price.html">Цены</a></li> -->
                                <!-- <li><a href="review.html">Отзывы</a></li> -->
                                <li><a href="/наши-контакты">Контакты</a></li>
                                <div class="null"></div>
                            </ul>
                        </nav>
                        <div class="null"></div>
                    </div>
                    <span class="top_stripe_shadow"></span>
                </div>	
            </header>
            <!--header-->
            
            <div class="all-blocks">
                <?= $content; ?>
            </div>
            
            <div class="helper"></div>
            
            <!--footer-->
            <footer>
                <div class="center">
                    <div class="first about-bottom left">
                        <h2>О нас</h2>
                        <p>
                            Мы видим свою цель работы в возведении зданий и сооружений, отвечающих эстетике ХХI века, в продвижении на отечественный рынок самых передовых технологий и современных строительных материалов.
                        </p>
                    </div>
                    <div class=" second left last-news">
                        <h2>Контактная информация</h2>
                        <div class="one-half left">
                            <div class="one-item">
                                <span class="left"><i class="fa fa-map-marker"></i></span>
                                <p class="left"><?=$contacts['adr'];?></p>
                                <div class="null"></div>
                            </div>	
                            <div class="one-item">
                                <span class="left"><i class="fa fa-phone"></i></span>
                                <p class="left"><?=$contacts['gorod'];?> (Офис) <br> <?=$contacts['vel'];?> (Velcom)</p>
                                <div class="null"></div>
                            </div>
                            <div class="one-item">
                                <span class="left"><i class="fa fa-envelope"></i></span>
                                <p class="left"><a href="mailto:<?=$contacts['other'];?>"><?=$contacts['other'];?></a></p>
                                <div class="null"></div>
                            </div>
                        </div>
                    </div>
                    <div class="bottom-menu left">
                        <h2>Быстрое меню</h2>
                        <ul>
                            <li><a href="/">&raquo; Главная</a></li>
                            <li><a href="/фок-рафиева-белецкого-минск">&raquo; О комплексе</a></li>
                            <li><a href="/наши-партнеры">&raquo; Партнерам</a></li>
                            <li><a href="/планировки">&raquo; Планировки</a></li>
                            <li><a href="/наши-контакты">&raquo; Контакты</a></li>
                            <div class="null"></div>
                        </ul>
                    </div>
                    <div class="null"></div>
                </div>
            </footer>
            <!--footer-->
        </div>
    </body>
</html>