<div class="wrapper">
    <table>
        <tbody>
            <tr>
                <td>Название</td>
                <td><input type="text" placeholder="Название данной категории" id="category_name" value=""/></td>
             </tr>
            <tr>
                <td>URL</td>
                <td><?= $_SERVER['SERVER_NAME']; ?>/catalog/<?= $level2; ?>/<input class="url" type="text" id="url_translit" value=""/>
                    <p style="padding:5px 0; color:#a3a3a3;">если оставить это поле пустым, ссылка будет генерироваться автоматически исходя из названия категории</p>
                </td>
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
                <td>Добавить картинку</td>
                <td>
                    
                    <div class="wrapper1_input">
                        <div class="wrapper2_input">Выбрать файл</div>
                        <input class="input_file" type="file" id="category_image"/>
                    </div>
                    <section id="databox"></section>
                </td>
            </tr>
            <tr>
                <td>Описание картинки</td>
                <td><textarea id="img_alt" placeholder="Обязательно описание картинки. Можно кратко."></textarea></td>
            </tr>
            <tr>
                <td>Описание картинки при наведении</td>
                <td><textarea id="img_title" placeholder="Описание картинки, которое отображается при наведении на нее курсора мыши."></textarea></td>
            </tr>
            <tr>
                <td>Применить изменения</td>
                <td><a id="apply_category" class="add" style="margin-left:0;" data-type="new_sub_category">Применить</a></td>
            </tr>
        </tbody>
    </table>
</div>
<input type="hidden" id="level" value="<?= $level2; ?>"/>

<?
if (isset($modal))
    echo $modal;?>