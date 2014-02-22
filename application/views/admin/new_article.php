<div class="wrapper">
    <table>
        
        <tr>
            <td id="article_id" data-type="new">Название</td>
            <td><input type="text" data-type="new" id="article_name" placeholder="Название статьи"/></td>
        </tr>
        <tr>
            <td>Ключевые слова (keywords)</td>
            <td><textarea id="k" placeholder="Ключевые слова – это  часто употребляемые слова на странице (не включая союзы и предлоги) по которому Вы бы хотели, что бы данную страницу находили пользователи поисковой системы."></textarea></td>
        </tr>
        <tr>
            <td>Описание (description)</td>
            <td><textarea id="d" placeholder="Краткое описание страницы, используется поисковыми системами для индексации, а также при создании сниппета (аннотации) в выдаче по запросу."></textarea></td>
        </tr>
        <tr>
            <td>Название (title)</td>
            <td><textarea id="t" placeholder="Поясняющий текст на страницу в виде всплывающей подсказки, которая отображается, когда курсор мыши задерживается в окне веб-страницы."></textarea></td>
        </tr>
        <tr>
            <td>Seotext</td>
            <td><textarea id="s"></textarea></td>
        </tr>

        <tr>
            <td>Описание</td>
            <td><textarea id="article_descr" class="descr_article" placeholder="Текст"></textarea></td>
        </tr>
        <tr>
            <td>Картинка</td>
            <td>
                
                <div class="wrapper1_input">
                        <div class="wrapper2_input">Выбрать файл</div>
                        <input class="input_file" type="file" id="files"/>
                    </div>
                    <section id="databox"></section>
            </td>
        </tr>

    </table>
</div>
<button id="btn_article_apply" class="add">Применить изменения</button>
<?
if (isset($modal))
    echo $modal;?>