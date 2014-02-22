<div class="wrapper">
    <input type="hidden" disabled id="ident" value="<?= $category_info['id']; ?>"/>
    <table>

        <tbody>
            <tr>
                <td>ID</td>
                <td><?= $category_info['id']; ?></td>
            </tr>

            <tr>
                <td>Название</td>
                <td><input type="text" id="category_name" value="<?= $category_info['category_name']; ?>"/></td>
            </tr>
            <tr>
                <td>URL</td>
                <td><?= $_SERVER['SERVER_NAME']; ?>/catalog/<input class="url" type="text" id="url_translit" value="<?= $category_info['translit_name']; ?>"/>
                    <p style="padding:5px 0; color:#a3a3a3;">если оставить это поле пустым, ссылка будет генерироваться автоматически исходя из названия категории</p>
                </td>
            </tr>


            <tr>
                <td>Ключевые слова (keywords)</td>
                <td><textarea id="k" placeholder="Ключевые слова – это  часто употребляемые слова на странице (не включая союзы и предлоги) по которому Вы бы хотели, что бы данную страницу находили пользователи поисковой системы."><?= $category_info['k']; ?></textarea></td>
            </tr>
            <tr>
                <td>Описание (description)</td>
                <td><textarea id="d" placeholder="Краткое описание страницы, используется поисковыми системами для индексации, а также при создании сниппета (аннотации) в выдаче по запросу."><?= $category_info['d']; ?></textarea></td>
            </tr>
            <tr>
                <td>Название (title)</td>
                <td><textarea id="t" placeholder="Поясняющий текст на страницу в виде всплывающей подсказки, которая отображается, когда курсор мыши задерживается в окне веб-страницы."><?= $category_info['t']; ?></textarea></td>
            </tr>
            <tr>
                <td>Seotext</td>
                <td><textarea id="s"><?= $category_info['s']; ?></textarea></td>
            </tr>






            <tr>
                <td>Картинка</td>
                <td><?if (empty($category_info['img_url'])) echo "Отсутствует";?>
                    <img class="image_category" src="<?= $category_info['img_url']; ?>" alt="<?= $category_info['img_alt']; ?>" title="<?= $category_info['img_title']; ?>"/>
                </td>
            </tr>
            <tr>
                <td>Изменить картинку</td>
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
                <td><textarea id="img_alt" placeholder="Обязательно описание картинки. Можно кратко."><?= $category_info['img_alt']; ?></textarea></td>
            </tr>
            <tr>
                <td>Описание картинки при наведении</td>
                <td><textarea id="img_title" placeholder="Описание картинки, которое отображается при наведении на нее курсора мыши."><?= $category_info['img_title']; ?></textarea></td>
            </tr>
            <tr>
                <td>Дата добавления</td>
                <td><p><?= date('Y-m-d / H:i:s (e)', $category_info['date']); ?></p></td>
            </tr>
            <tr>
                <td>Применить изменения</td>
                <td><button id="apply_category" class="add" style="margin-left:0;" data-type="category_edit">Применить</button></td>
            </tr>
        </tbody>

    </table>

</div>
<? if (isset($modal)) echo $modal; ?>
<input type="hidden" id="level" value="<?= $level2; ?>"/>
