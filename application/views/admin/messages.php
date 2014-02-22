<div id="messages list_cat">
    <div class="with-selected" style="padding-bottom:20px;">
        <p>С отмеченными</p>

        <select class="select-msg" data-type="msg">
            <option>Выбрать действие</option>
            <option value="read">Пометить как прочитанные</option>
            <option value="delete">Удалить</option>
        </select>
    </div>
    <? if (!empty($messages)) { ?>
        <div class="wrapper">
            <table>
                <thead>
                    <tr>
                        <th>Номер</th>
                        <? foreach ($names as $name) { ?>
                            <th>
                    <p><?= $name['name']; ?></p>
                    </th>
                <? } ?>
                <th>Просмотреть</td>
                <th><div id="change_msg_div">
                    <input type="checkbox" value="false" class="check-all"/>
                    <p id="sel-msg-all">отметить все </p>
                </div>
                </th>
                </tr>
                </thead>
                <? if (!empty($messages)) { ?>
                    <? foreach ($messages as $msg) { ?>
                        <? $count = 0; ?>
                        <tr id="msg_<?= $msg['id']; ?>" <? if ($msg['status'] == 0) echo 'class="not_read_msg"'; ?>>
                            <td><p><?= $msg['id']; ?></p></td>
                            <? foreach ($names as $name) { ?>
                                <? foreach ($msg['messages'] as $m) { ?>
                                    <? if ($m['tag_id'] == $name['id']) { ?>
                                        <? $count++; ?>
                                        <td><p><?= Text::limit_chars($m['text'], 30, '...'); ?></p></td>
                                    <? } ?>
                                <? } ?>
                            <? } ?>
                            <? if ($count < count($names)) { ?>
                                <? for ($i = 0; $i < abs($count - count($names)); $i++) { ?>
                                    <td><p>-</p></td>
                                <? } ?>
                            <? } ?>
                            <td>
                                <a href="/admin/messages/<?= $msg['id'] ?>">Прочесть полностью</a>
                            </td>
                            <td>
                                <input type="checkbox" data-id="<?= $msg['id'] ?>" val="false" class="change-msg" />
                            </td>
                        </tr>
                    <? } ?>
                <? } ?>
            </table>
        </div>
    <? } ?>
</div>