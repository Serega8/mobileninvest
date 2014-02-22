<a href="/admin/poll/add" class="add">Добавить голосование</a>

<? if (!empty($all)) { ?>
    <div class="with-selected">
        <p>С отмеченными</p>

        <select class="select-msg" data-type="poll">
            <option>Выбрать действие</option>
            <option value="hide">Не отображать на сайте</option>
            <option value="show">Отображать на сайте</option>
            <option value="delete">Удалить</option>
        </select>
    </div>
    <div class="wrapper list_cat">
        <table>
            <thead style="width:70%;">
                <tr>
                    <th>Номер голосования</th>
                    <th>Название и варианты</th>
                    <th><div id="change_msg_div">
                <input type="checkbox" value="false" id="chkall" class="check-all"/>
                <label for="chkall" class="text_check_all" id="sel-msg-all">выбрать все</label>
            </div></th>
            </tr>
            </thead>
            <? foreach ($all as $pol) { ?>
                <tr class="main<? if ($pol['status'] == 1) echo ' delete' ?>" id="msg_<?= $pol['id']; ?>">
                    <td><?= $pol['id']; ?></td>
                    <td class="td_click_poll" id="msg_td_<?= $pol['id']; ?>" onclick="window.location.href = '/admin/poll/<?= $pol['id']; ?>'"><?= $pol['q']; ?></td>
                    <td><input type="checkbox" data-id="<?= $pol['id']; ?>" val="false" class="change-msg" /></td>
                </tr>
                <? foreach ($all_items as $item) { ?>
                    <? if ($item['vote_id'] == $pol['id']) { ?>
                        <tr class="item_vote_text">
                            <td></td>
                            <td><p class="ivt_text"><?= $item['text']; ?><progress class="poll_progress" min="0" max="100" value="<?=$item['val'];?>"><?=$item['val'];?>%</progress></p></td>
                            <td></td>
                        </tr>
                    <? } ?>
                <? } ?>
            <? } ?>
        </table>
    </div>
<? } ?>

