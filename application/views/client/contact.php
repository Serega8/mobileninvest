<div class="bread">
    <div class="center">
        <h1>Контакты</h1>
        <ul>
            <li><?= HTML::anchor('/', 'Главная'); ?></li>
            <li>/</li>
            <li><?= HTML::anchor('/наши-контакты', 'Контакты'); ?></li>
        </ul>
    </div>
</div>
<!-- <div class="map"><div id="map-canvas"></div></div> -->
<div class="map">
    <script type="text/javascript" charset="utf-8" src="http://api-maps.yandex.ru/services/constructor/1.0/js/?sid=h9nHB5wTbCvnGRtpczYOBRl2Qj0Xjs6J"></script>
</div>
<div class="center">
    <div class="two-half left">
        <h2>Задайте нам вопрос:</h2>
        
        
        
        <form class="rf other" action="" method="post">
            <div>
                <input type="text" name="name" placeholder="Имя" class="rfield">
                <input type="text" name="message" placeholder="E-mail" class="rfield">
                <div class="null"></div>
            </div>
            <div>
                <textarea name="text" placeholder="Введите сообщение" class="rfield"></textarea>
            </div>
            <div class="null"></div>
            <input type="submit" class="submit btn_submit disabled" value="Отправить">
        </form>
        
        
        
        
    </div>
    <div class="one-half left">
        <h2 style="padding-left: 10px;">Наш адрес:</h2>
        <div class="one-item">
            <span class="left"><i class="fa fa-map-marker"></i></span>
            <p class="left"><?=$contacts['adr'];?></p>
            <div class="null"></div>
        </div>	
        <div class="one-item">
            <span class="left"><i class="fa fa-phone"></i></span>
            <p class="left"><?=$contacts['gorod'];?> (Офис) <br><?=$contacts['vel'];?> (Velcom)</p>
            <div class="null"></div>
        </div>
        <div class="one-item">
            <span class="left"><i class="fa fa-envelope"></i></span>
            <p class="left"><a href="mailto:<?=$contacts['other'];?>"><?=$contacts['other'];?></a></p>
            <div class="null"></div>
        </div>
    </div>
    <div class="null"></div>
</div>			
