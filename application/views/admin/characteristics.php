<a class="add" id='apply_changes'>Применить изменения</a>

<div class="wrapper">
    <table>
        <thead>
            <tr>
                <th>
                    Принадлежащая категория
                </th>
                <th>
                    Название группы
                </th>
                <th>
                    Характеристики
                </th>
            </tr>
        </thead>
        <tbody class="tbody_details">
            <? foreach ($details['details'] as $detail) { ?>
                <tr id="tr_group_<?= $detail['id']; ?>">
                    <td class="categories_select" id="select_cat_<?= $detail['id']; ?>">
                        <select>
                            <? foreach ($categories as $k => $category) { ?>
                                <? if ($k == 0) { ?>  
                                    <option value="0">Всем категориям</option>
                                <? } ?>
                                <option <? if ($detail['category_id'] == $category['id']) echo "selected"; ?> value="<?= $category['id']; ?>"><?= $category['category_name']; ?></option>
                            <? } ?>
                        </select>
                    </td>
                    <td>

                        <input class="input_group" data-status="<?= $detail['status']; ?>" id="input_detail_id_<?= $detail['id']; ?>" data-id="<?= $detail['id']; ?>" type="text" value="<?= $detail['name']; ?>"/>
                        <p> 
                            <a class="delete-group" data-id="<?= $detail['id']; ?>">Удалить</a>
                        </p>

                    </td>
                    <td>
                        <button class="add_sub_detail" data-id="<?= $detail['id']; ?>">Добавить характеристику</button>
                        <div id="block_sub_id_<?= $detail['id']; ?>">
                            <? foreach ($details['sub'] as $k => $sub) { ?>
                                <? if ($sub['detail_id'] == $detail['id']) { ?>
                                    <div id="div_sub_<?= $sub['id']; ?>">
                                        <input group-id='<?= $detail['id']; ?>' data-status="<?= $sub['status']; ?>" class="input_sub" type="text" id="input_sub_id_<?= $sub['id']; ?>" data-id="<?= $sub['id']; ?>" value="<?= $sub['key'] ?>"/>             
                                        <a class="delete-sub" data-id="<?= $sub['id']; ?>">Удалить</a>
                                    </div>
                                <? } ?>
                            <? } ?>
                        </div>

                    </td>
                </tr>
            <? } ?>
        </tbody>
    </table>
</div>
<button id="add_group_details" class="add">Добавить группу</button>
<?
if (isset($modal))
    echo $modal;
?>
<div class="categories_select" style="display:none;">
    <select>
        <? foreach ($categories as $k => $category) { ?>
            <? if ($k == 0) { ?>  
                <option value="0">Всем категориям</option>
            <? } ?>
            <option><?= $category['category_name']; ?></option>
        <? } ?>
    </select>
</div>