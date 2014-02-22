
<div class="wrapper">

    <table id="seo_box">
        <tr>
            <td>Ключевые слова (keywords)</td>
            <td><textarea placeholder="Ключевые слова – это  часто употребляемые слова на странице (не включая союзы и предлоги) по которому Вы бы хотели, что бы данную страницу находили пользователи поисковой системы." class="seo_textarea"><?= $seo['k']; ?></textarea></td>
        </tr>
        <tr>
            <td>Seotext </td>
            <td><textarea class="seo_textarea"><?= $seo['s']; ?></textarea></td>
        </tr>
        <tr>
            <td>Название (title)</td>
            <td><textarea class="seo_textarea" placeholder="Ключевые слова – это  часто употребляемые слова на странице (не включая союзы и предлоги) по которому Вы бы хотели, что бы данную страницу находили пользователи поисковой системы."><?= $seo['t']; ?></textarea></td>
        </tr>
        <tr>
            <td>Описание (description)</td>
            <td><textarea class="seo_textarea" placeholder="Краткое описание страницы, используется поисковыми системами для индексации, а также при создании сниппета (аннотации) в выдаче по запросу."><?= $seo['d']; ?></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="hidden" id="ident" value="<?= $seo['id']; ?>"/>
                <button id="update_seo" class="add" d-type="<?= $d_type; ?>">Обновить данные</button>
            </td>
        </tr>
    </table>

</div>
