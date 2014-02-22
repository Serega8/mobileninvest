<div id="brands">
    <div>
        <a href="/admin/brands/new_brand" class="add">Добавить нового производителя</a>
    </div>
    <div class='with-selected'>
        <p>С отмеченными</p>

        <select class="select-msg" data-type="brands">
            <option>Выбрать действие</option>
            <option value="hide">Не отображать на сайте</option>
            <option value="show">Отображать на сайте</option>
            <option value="delete">Удалить</option>
        </select>
    </div>
    <div>
        <a id="show_seo_data" class="add">Показать seo-данные</a>
    </div>
    <? if (!empty($brands)) { ?>
        <div class="wrapper list_cat">
            <table>
                <thead>
                    <tr>
                        <th>
                            ID
                        </th>
                        <th>
                            Название
                        </th>

                        <th>
                            Изображение
                        </th>
                        <th>
                            Просмотр
                        </th>
                        <th>
                <div id="change_msg_div">
                   <input type="checkbox" value="false" id="chkall" class="check-all"/>
                        <label for="chkall" class="text_check_all" id="sel-msg-all">выбрать все</label>
                </div>
                </th>
                </tr>
                </thead>
                <tbody>
                    <? foreach ($brands as $brand) { ?>
                        <tr id="msg_<?= $brand['id']; ?>" <? if ($brand['status'] == '1') echo "class='delete'" ?>>
                            <td>
                                <p><?= $brand['id']; ?></p>
                            </td>
                            <td>
                                <p><?= $brand['name']; ?></p>
                            </td>
                            <td>
                                <img src="<?= $brand['img_url']; ?>" style="max-height: 20px;"/>
                            </td>
                            <td>
                                <p><a href="/admin/brands/<?= $brand['id']; ?>">Перейти</a></p>
                            </td>
                            <td>
                                <input type="checkbox" data-id="<?= $brand['id']; ?>" val="false" class="change-msg" />
                            </td>
                        </tr>
                    <? } ?>
                </tbody>
            </table>
        </div>
    <? } ?>
</div>
<div style="width:80%;min-height: 600px;margin-top:20px;">
<?= $seo_box; ?>
</div>
<?
if (isset($modal))
    echo $modal; ?>