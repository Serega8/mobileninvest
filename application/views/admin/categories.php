
<a href="/admin/catalog/new_category" class="add">Добавить категорию</a>
<div class='with-selected'>
    <p>С отмеченными</p>

    <select class="select-msg" data-type="categories">
        <option>Выбрать действие</option>
        <option value="hide">Не отображать на сайте</option>
        <option value="show">Отображать на сайте</option>
        <option value="delete">Удалить</option>
    </select>
</div>

<div>
    <p><a href="/admin/currency" class="add">Редактор валют</a></p>
</div>
<div>
    <p><a href="/admin/characteristics" class="add">Редактор характеристик</a></p>
</div>
<div>
    <a id="show_seo_data" class="add">Показать seo-данные</a>
</div>
<? if (!empty($categories)) { ?>
    <div class="wrapper list_cat">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Дата создания</th>
                    <th>Настроить</th>
                    <th>
                        <input type="checkbox" value="false" id="chkall" class="check-all"/>
                        <label for="chkall" class="text_check_all" id="sel-msg-all">выбрать все</label>
                    </th>
                </tr>
            </thead>
            <? foreach ($categories as $category) { ?>
                <tr id="msg_<?= $category['id']; ?>" class="main<? if ($category['status'] == '1') echo ' delete"' ?>">
                    <td><p><?= $category['id']; ?></p></td>
                    <td onclick="window.location.href = '/admin/catalog/<?= $category['translit_name']; ?>'"><p><?= $category['category_name']; ?></p></td>
                    <td onclick="window.location.href = '/admin/catalog/<?= $category['translit_name']; ?>'"><p><?= date('Y-m-d / H:i:s (e)', $category['date']); ?></p></td>

                    <td><p><a href='/admin/catalog/<?= $category['translit_name']; ?>/settings'>Настроить</a></p></td>
                    <td class="other">
                        <input type="checkbox" data-id="<?= $category['id']; ?>" val="false" class="change-msg" />
                    </td>

                </tr>
            <? } ?>
        </table>

    </div>

<? } ?>
<? if (isset($modal)) echo $modal; ?>
<?= $seo_box; ?>