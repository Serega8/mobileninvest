<div class="wrapper">
    <table>
        <tbody>
            <tr>
                <td>ID</td>
                <td><input type="text" id="ident" disabled value="<?= $brand['id']; ?>"/></td>
            </tr>
            <tr>
                <td>Название</td>
                <td><input type="text" id="category_name" placeholder="Введите название производителя" value="<?= $brand['name']; ?>"/></td>
            </tr>
            <tr>
                <td>Картинка</td>
                <td><img class="image_category" src="<?= $brand['img_url']; ?>" alt="<?= $brand['img_alt']; ?>" title="<?= $brand['img_title']; ?>"/>
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
                <td><textarea id="img_alt" placeholder="Обязательно описание картинки."><?= $brand['img_alt']; ?></textarea></td>
            </tr>
            <tr>
                <td>Описание картинки при наведении</td>
                <td><textarea id="img_title" placeholder="Описание картинки, будетотображаться при наведении мыши"><?= $brand['img_title']; ?></textarea></td>
            </tr>
            <tr>
                <td>Описание бренда</td>
                <td><textarea id="descr"><?= $brand['descr']; ?></textarea></td>
            </tr>


            <tr>
                <td>Ключевые слова (keywords)</td>
                <td><textarea id="k" placeholder="Ключевые слова – это  часто употребляемые слова на странице (не включая союзы и предлоги) по которому Вы бы хотели, что бы данную страницу находили пользователи поисковой системы."><?= $brand['k']; ?></textarea></td>
            </tr>
            <tr>
                <td>Описание (description)</td>
                <td><textarea id="d" placeholder="Краткое описание страницы, используется поисковыми системами для индексации, а также при создании сниппета (аннотации) в выдаче по запросу."><?= $brand['d']; ?></textarea></td>
            </tr>
            <tr>
                <td>Название (title)</td>
                <td><textarea id="t" placeholder="Поясняющий текст на страницу в виде всплывающей подсказки, которая отображается, когда курсор мыши задерживается в окне веб-страницы."><?= $brand['t']; ?></textarea></td>
            </tr>
            <tr>
                <td>Seotext</td>
                <td><textarea id="s"><?= $brand['s']; ?></textarea></td>
            </tr>
            <tr>
                <td>Применить изменения</td>
                <td><button id="apply_category" class="add" data-type="brand_edit">Применить</button></td>
            </tr>
        </tbody>

    </table>
</div>
<? if (isset($modal)) echo $modal; ?>
