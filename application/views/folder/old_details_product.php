<!--<table class="details">
    <tbody class="tbody_n">
        <?
        if (!empty($details)) {
            $category_d = $details['details'];
            $sub_d = $details['sub_details'];
            ?>
            <? foreach ($category_d as $km => $main) { ?>
                <tr id="tr_id_<?= $main['id']; ?>">
                    <td>
                        <input placeholder="Название группы" type="text" data-status="<?= $main['status']; ?>" id="group_id_name_<?= $main['id']; ?>" gid="<?= $main['id']; ?>" class="details_name" value="<?= $main['name']; ?>"/><br/>
                        <a class="delete-group" gid="<?= $main['id']; ?>">Удалить</a>
                    </td>
                    <td id="group_id_<?= $main['id']; ?>">
                        <button data-id="<?= $main['id']; ?>" class="add_sub_detail" >Добавить характеристику</button><br/>
                        <? foreach ($sub_d as $k => $s) { ?>
                            <? if ($s['detail_id'] == $main['id']) { ?>
                                <? if ($k == 0) { ?>
                                    <div class="chars-div"><input placeholder="Характеристика" class="ex-chars" data-group-id="<?= $main['id']; ?>" data-status="<?= $s['status']; ?>" id="<?= $s['id']; ?>" type="text" value="<?= $s['key']; ?>"/>
                                        <span id="span_<?= $s['id']; ?>"> : </span>
                                        <input placeholder="Значение" type="text" id="val_<?= $s['id']; ?>" value="<?= $s['value']; ?>"/>
                                        <a class="delete-char" data-id="<?= $s['id']; ?>">Удалить</a><br id="br_<?= $s['id']; ?>"/>
                                    </div>
                                <? } else { ?>
                                    <div class="chars-div"><input placeholder="Характеристика" class="ex-chars" data-group-id="<?= $main['id']; ?>" data-status="<?= $s['status']; ?>" id="<?= $s['id']; ?>" type="text" value="<?= $s['key']; ?>"/>
                                        <span id="span_<?= $s['id']; ?>"> : </span>
                                        <input placeholder="Значение" type="text" id="val_<?= $s['id']; ?>" value="<?= $s['value']; ?>"/>
                                        <a class="delete-char" data-id="<?= $s['id']; ?>">Удалить</a><br id="br_<?= $s['id']; ?>"/>
                                    </div>
                                <? } ?>
                            <? } ?>
                        <? } ?>

                    </td>
                </tr>
            <? } ?>  
        <? } ?>       
        <tr>
            <td><button class="new_group_button">Добавить новую группу</button></td>
            <td></td>
        </tr>
    </tbody>
</table>-->