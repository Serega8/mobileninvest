  
<div class="for-photo inform">
    <div class="center">
        <h1><?=$articles[1]['name']?></h1>
        <p><?=$articles[0]['description']?></p>
    </div>
</div>

<div class="center">
    <div class="news">
        <div class="main-news">
            <div class="hidden active">

                <h2><?=$articles[1]['name']?></h2>
                <?=$art[0]?><a href="/фок-рафиева-белецкого-минск"><?=$art[1]?></a>
            </div>						
            <div class="null"></div>
        </div>
    </div>
    <div class="null"></div>

    <div class="list_carousel for-photo">
        <ul id="foo2">
            <li>
                <a href="/content/images/photo3.jpg" data-lightbox="example-set">
                    <?= HTML::image('/content/images/photo3.jpg'); ?>
                </a>
            </li>
            <li><a href="/content/images/photo1.jpg" data-lightbox="example-set"><?= HTML::image('/content/images/photo1.jpg'); ?></a></li>
            <li><a href="/content/images/photo2.jpg" data-lightbox="example-set"><img src="/content/images/photo2.jpg"></a></li>
            <li><a href="/content/images/slide2.jpg" data-lightbox="example-set"><img src="/content/images/slide2.jpg"></a></li>
            <li><a href="/content/images/slide3.jpg" data-lightbox="example-set"><img src="/content/images/slide3.jpg"></a></li>
        </ul>
        <div class="clearfix"></div>
        <a id="prev2" class="prev" href="#"><i class="fa fa-chevron-left"></i></a>
        <a id="next2" class="next" href="#"><i class="fa fa-chevron-right"></i></a>
        <div id="pager2" class="pager"></div>
    </div>

    <div class="news hidden">
        <div class="main-news here">
            <h2>Главная новость на сегодня</h2>
            <div class="data"><span>20 ноября, 2013</span></div>
            <div class="for-img">
                <div class="back">
                    <img src="/content/images/temp/slide1.jpg">
                </div>
            </div>
            <p>В этот раз наши европейские партнеры приняли мудрое решение. Оно соответствует Декларации Восточного партнерства от 2009 г., которая отмечает, что основным условием должны быть равное представительство, взаимная ответственность и сотрудничество. Я считаю, что эта инициатива может быть эффективной только тогда, когда соблюдаются все эти условия.</p>
            <a href="#" class="more">Читать полностью</a>
            <div class="null"></div>
        </div>
        <div class="feedback">
            <h4>Другие новости</h4>
            <div class="one-feedback">
                <div class="for-img left">
                    <div class="back">
                        <img src="/content/images/temp/slide1.jpg">
                    </div>
                </div>
                <div class="text left">
                    <p>В этот раз наши европейские партнеры приняли мудрое решение. </p>
                    <a href="#" class="more-feedback">Читать полностью »</a>
                </div>
                <div class="null"></div>
            </div>
            <div class="one-feedback">
                <div class="for-img left">
                    <div class="back">
                        <img src="/content/images/temp/slide2.jpg">
                    </div>
                </div>
                <div class="text left">
                    <p>В этот раз наши европейские партнеры приняли мудрое решение. </p>
                    <a href="#" class="more-feedback">Читать полностью »</a>
                </div>
                <div class="null"></div>
            </div>
            <div class="one-feedback">
                <div class="for-img left">
                    <div class="back">
                        <img src="/content/images/temp/slide3.jpg">
                    </div>
                </div>
                <div class="text left">
                    <p>В этот раз наши европейские партнеры приняли мудрое решение. </p>
                    <a href="#" class="more-feedback">Читать полностью »</a>
                </div>
                <div class="null"></div>
            </div>
            <div class="one-feedback">
                <div class="for-img left">
                    <div class="back">
                        <img src="/content/images/temp/slide1.jpg">
                    </div>
                </div>
                <div class="text left">
                    <p>В этот раз наши европейские партнеры приняли мудрое решение. </p>
                    <a href="#" class="more-feedback">Читать полностью »</a>
                </div>
                <div class="null"></div>
            </div>
        </div>
    </div>
    <div class="null"></div>
    <div class="contacts other">
        <div class="map-index"><script type="text/javascript" charset="utf-8" src="http://api-maps.yandex.ru/services/constructor/1.0/js/?sid=ngQbrOtzLv7EGlRXGoBxVBOwx_L9nMot&width=700&height=250"></script></div>
        <div class="hover">
            <div class="cont">
                <h2>Контактная информация:</h2>
                <div class="one-item">
                    <p class="left"><?=$contacts['adr'];?>, <?=$contacts['name'];?></p>
                    <div class="null"></div>
                </div>	
                <div class="one-item">
                    <p class="left"> <?=$contacts['gorod'];?> (Офис) <br> <?=$contacts['vel'];?> (Velcom)</p>
                    <div class="null"></div>
                </div>
                <div class="one-item">
                    <p class="left"><a href="mailto:<?=$contacts['other'];?>"><?=$contacts['other'];?></a></p>
                    <div class="null"></div>
                </div>
            </div>
        </div>
        <div class="null"></div>	
    </div>
</div>	
<!--
Динамичная, быстро развивающаяся компания, специализирующаяся на привлечении инвестиций, проектировании и строительстве объектов различного назначения и предоставлении инжиниринговых услуг в сфере строительства. 
ООО" ИмобиленИнвест "  осуществляет функции управляющей компании. 
ООО «ИмобиленИнвест» – одна из специализированных фирм, оказывающих инжиниринговые услуги в сроительстве. 
За время своего существования, компания приобрела заслуженное доверие зарубежных и отечественных компаний, благодаря высокопрофессиональному менеджменту  и использованию новейших передовых технологий в области строительного проектирования. 
Представляя интересы заказчика на всех этапах работы – от подбора участка, проектирования и до ввода объекта в эксплуатацию. ООО «ИмобиленИнвест» стремится минимизировать стоимость работ при максимальной эффективности, используя прогрессивные разработки научно-исследовательских институтов и эффективное взаимодействие с организациями-подрядчиками и поставщиками оборудования.
Внедрение новейших инноваций при проектировании и строительстве позволяют ООО «ИмобиленИнвест» работать с  объектами любого уровня сложности.
Строительный инжиниринг охватывает все фазы реализации инвестиционно-строительных процессов: проектирование, строительство, эксплуатацию объектов, а так же включает в себя проектные работы, авторский и технический надзор. Наша компания предоставляет полный комплекс работ и услуг по сопровождению всех этапов инвестиционно-строительных проектов, в том числе маркетинговые исследования, получение участков под строительство, проведение тендеров, оптимизацию финансовых потоков.
Для реализации названных задач наша компания готова предложить вам перечень мероприятий осуществляемых на различных этапах инвестиционно-строительного проекта:
       Инвестиционный замысел
       Выбор и подбор участка
       Маркетинговые исследования,  бизнес – планирование,  разработка концепции
       Проектно-изыскательские работы
       Получение инвестиций
       Строительство объектов
       Продажи объектов
Мы видим свою цель работы в возведении зданий и сооружений, отвечающих эстетике ХХI века, в продвижении на отечественный рынок самых передовых технологий и современных строительных материалов. ООО «ИмобиленИнвест» стремится идти в ногу со временем, демонстрируя высокотехнологичный подход к строительному бизнесу. Мы всегда готовы искать индивидуальные формы сотрудничества с каждым клиентом и предоставить ему оптимальное соотношение стоимости и качества услуг.
На данный момент ведущим проектом компании является delimiter строительство физкультурно-оздоровительного комплекса-->