
<div class="wrapper">
    <table>
        <tr>
            <td>ID</td>
            <td><input type="text" disabled value="<?= $article['id']; ?>" id="article_id" data-type="red"/></td>
        </tr>
        <tr>
            <td><p>Название</p></td>
            <td><input placeholder="Введите название" type="text" id="article_name" value="<?= $article['name']; ?>"/></td>
        </tr>
        <tr>
            <td>Ключевые слова (keywords)</td>
            <td><textarea id="k" placeholder="Ключевые слова – это  часто употребляемые слова на странице (не включая союзы и предлоги) по которому Вы бы хотели, что бы данную страницу находили пользователи поисковой системы."><?= $article['k']; ?></textarea></td>
        </tr>
        <tr>
            <td>Описание (description)</td>
            <td><textarea id="d" placeholder="Краткое описание страницы, используется поисковыми системами для индексации, а также при создании сниппета (аннотации) в выдаче по запросу."><?= $article['d']; ?></textarea></td>
        </tr>
        <tr>
            <td>Название (title)</td>
            <td><textarea id="t" placeholder="Поясняющий текст на страницу в виде всплывающей подсказки, которая отображается, когда курсор мыши задерживается в окне веб-страницы."><?= $article['t']; ?></textarea></td>
        </tr>
        <tr>
            <td>Seotext</td>
            <td><textarea id="s"><?= $article['s']; ?></textarea></td>
        </tr>


        <tr>
            <td><p>Описание</p></td>
            <td><textarea placeholder="Текст статьи" id="article_descr" class="descr_article"><?= $article['description']; ?></textarea></td>
        </tr>
        <tr>
            <td><p>Картинка</p></td>
            <td><? if (empty($images)) echo "Отсутствует"; ?>
                <? foreach ($images as $image) { ?>

                    <img class="image_category" src="<?= $image['img_url']; ?>" alt="<?= $image['img_alt']; ?>" title="<?= $image['img_title']; ?>"/>
                    <br/>
                    <textarea placeholder="Описание" id="img_alt"><?= $image['img_alt']; ?></textarea><br/>
                    <textarea placeholder="Описание при наведении"id="img_title"><?= $image['img_title']; ?></textarea>
                <? } ?>
                <br/>

            </td>
        </tr>
        <tr>
            <td>Добавить картинку</td>

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