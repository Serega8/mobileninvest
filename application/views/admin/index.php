<p style='margin-left:40px;'>Добро пожаловать в панель управления сайтом!</p>
    <!--<progress value='50' max='100' min='0'></progress>-->
<div style="width:80%;height: 60px;">
        <a id="show_seo_data" class="add">Показать seo-данные</a>
    </div>
<div class='wrapper'>
    <table class='tables_index' style='width:30%;'>
        <tr class='avialable_cats'>
            <td>Количество доступных пользователям категорий:</td>
            <td><?= $categories_am['av']; ?></td>
        </tr>
        <tr class='hidden_cats'>
            <td>Количество скрытых категорий:</td>
            <td><?= $categories_am['hid']; ?></td>
        </tr>
        <tr class='deleted_cats'>
            <td>Количество удаленных категорий:</td>
            <td><?= $categories_am['del']; ?></td>
        </tr>

    </table>



    <table class='tables_index' style='width:30%;'>
        <tr class='avialable_cats'>
            <td>Количество доступных пользователям  подкатегорий:</td>
            <td><?= $subcategories_am['av']; ?></td>
        </tr>
        <tr class='hidden_cats'>
            <td>Количество скрытых подкатегорий:</td>
            <td><?= $subcategories_am['hid']; ?></td>
        </tr>
        <tr class='deleted_cats'>
            <td>Количество удаленных подкатегорий:</td>
            <td><?= $subcategories_am['del']; ?></td>
        </tr>

    </table>

    <table class='tables_index' style='width:30%;'>
        <tr class='avialable_cats'>
            <td>Количество доступных пользователям товаров:</td>
            <td><?= $products_am['av']; ?></td>
        </tr>
        <tr class='hidden_cats'>
            <td>Количество скрытых товаров:</td>
            <td><?= $products_am['hid']; ?></td>
        </tr>
        <tr class='deleted_cats'>
            <td>Количество удаленных товаров:</td>
            <td><?= $products_am['del']; ?></td>
        </tr>

    </table>



</div>
<div style="width:92%; padding-top:120px;padding-bottom:50px;margin-left:10px;">
<?= $seo_box; ?>
</div>
<?
if (isset($modal))
    echo $modal; ?>