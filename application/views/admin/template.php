<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut icon" type="image/x-icon" href="/admin_content/favicon/favicon.ico"/>

        <? foreach ($styles as $style) { ?>
            <?= HTML::style($style); ?>
        <? } ?>

        <? if ($auth) { ?>
            <? foreach ($scripts as $script) { ?>
                <?= HTML::script($script); ?>

            <? } ?>
        <? } ?>
        <title>Панель управления</title>
    </head>
    <body>
        <? if (!$auth) { ?>
            <div id="container" class="exit">
                <div class="all-blocks ">
                    <div class="enter">
                        <div class="page-header">
                            <img src="/admin_content/images/logo.png" alt="">
                        </div>
                        <form action="" method="POST" class="form logout">
                            <h4>Вход</h4>
                            <div>
                                <input type="text" name="login" class="text_field" placeholder="Логин">
                            </div>
                            <div class="group wat-cf">
                                <input type="password" name="password" class="text_field" placeholder="Пароль">
                            </div>
                            <div class="group navform wat-cf">
                                <input type="submit" class="button submit add enter-button" style="width:100px; float:right; margin-top: 0; margin-bottom: 0" name="submit" value="Войти">
                                <div class="null"></div>
                            </div>
                        </form>
                        <div class="page-footer">                        	
                            © 2013 ООО «Intellect IT» - Создание и продвижение сайтов   
                        </div>
                    </div>		
                </div>	
            </div>
        <? } else { ?>
            <div id="container">
                <div class="main-navig">
                    <div class="logo left">
                        <a href="/admin">
                            <img src="/admin_content/images/logo.png" alt="">
                        </a>
                    </div>
                    <ul class="login">
                        <li class="msg">  
                            <a href="/admin/messages">
                                <i class="icon-envelope-alt"></i>
                                <?= $msg_count; ?>
                            </a>
                        </li>
                        <li class="news">
                            <a href="/admin/reviews">
                                <i class="icon-bell-alt"></i>
                                <?= $rev_count; ?>
                            </a>
                        </li>
                        <li class="logout">
                            <a href="/admin/logout">
                                <i class="icon-signout"></i>
                                <span>Выход</span>
                            </a>
                        </li>
                    </ul>
                    <div class="null"></div>
                </div>

                <header>
                    <div class="for-relative">	
                        <div class="search" class="left">						
                            <form action="/admin/search" method="POST">
                                <input type="text" name="q" placeholder="Поиск..." required class="no-submit">
                                <button class="start-search">
                                    <!--input type="submit" class="submit start-search" value=""-->
                                    <i class="icon-search"></i>
                                </button>
                                <div class="null"></div>
                            </form>
                        </div>				
                        <nav>
                            <ul>
                                <li><a href="/admin/index">Главная</a></li>
                                <li><a href="/admin/articles">Статьи</a></li>
                                <li><a href="/admin/catalog">Каталог</a></li>
                                <li><a href="/admin/reviews">Отзывы (<?= $rev_count; ?>)</a></li>
                                <li><a href="/admin/poll">Голосование</a></li>
                                <li><a href="/admin/brands">Производители</a></li>
                                <li><a href="/admin/slideshow">Слайдшоу</a></li>
                                <li><a href="/admin/stats/">Статистика</a></li>
                                <li><a href="/admin/messages">Сообщения (<?= $msg_count; ?>)</a></li>
                                <li><a href="/admin/feedback">Обратная связь</a>
                                <li><a href="/admin/contacts">Контакты</a></li>		
                            </ul>
                        </nav>
                    </div>
                    <div class="hide_menu"></div>
                </header>
                <section class="main">					
                    <div class="for-padding">

                        <div class="bread">
                            <ul>
                                <li><a href="/admin/index"><i class="icon-home"></i></a></li>
                                <li>/</li>
                                <li><a href="/admin/<?= $action['link']; ?>"><?= $action['rus']; ?></a></li>
                                <? if (isset($level2_rus)) { ?>
                                    <li>/</li>
                                    <li><a href="/admin/<?= $action['link']; ?>/<?= $level2; ?>"><?= $level2_rus ?></a></li>
                                <? } ?>

                                <? if (isset($level3_rus)) { ?>
                                    <li>/</li>
                                    <li><a href="/admin/<?= $action['link']; ?>/<?= $level2; ?>/<?= $level3; ?>"><?= $level3_rus; ?></a></li>

                                <? } ?>
                                <? if (isset($level4_rus)) { ?>
                                    <li>/</li>
                                    <li><a href="/admin/<?= $action['link']; ?>/<?= $level2; ?>/<?= $level3; ?>/<?= $level4 ?>"><?= $level4_rus; ?></a></li>

                                <? } ?>
                                <!--<li><a href="#" class="active">Добавить статью</a></li>-->
                                <div class="null"></div>
                            </ul>
                        </div>
                        <div class="title-page">
                            <i class="<?= $action['icon']; ?>"></i><h1><?= $action['rus']; ?></h1>
                        </div>
                        <?= $content; ?>		    		
                    </div>			
                </section>
            </div>





            <script src="/admin_content/js/classie.js"></script>
            <script src="/admin_content/js/modalEffects.js"></script>

            <!-- for the blur effect -->
            <!-- by @derSchepp https://github.com/Schepp/CSS-Filters-Polyfill -->
            <script>
                // this is important for IEs
                var polyfilter_scriptpath = '/js/';
            </script>
        <? } ?>
    </body>
</html>
