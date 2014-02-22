<div class="wrapper">
    <table>
        <tbody>
            <tr>
                <td>Название</td>
                <td><input placeholder="Введите название производителя" type="text" id="category_name" value=""/></td>
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
                <td><textarea id="img_alt" placeholder="Обязательно описание картинки."></textarea></td>
            </tr>
            <tr>
                <td>Описание картинки при наведении мышки</td>
                <td><textarea id="img_title" placeholder="Описание картинки, будетотображаться при наведении мыши"></textarea></td>
            </tr>
            <tr>
                <td>Описание бренда</td>
                <td><textarea id="descr"></textarea></td>
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
                <td>Применить изменения</td>
                <td><button id="apply_category" class="add" style="margin-left:0;" data-type="brand_new">Применить</button></td>
            </tr>
        </tbody>

    </table>
</div>
<? if (isset($modal)) echo $modal; ?>
