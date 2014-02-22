<div class="wrapper">
<table id='edit_poll'>
    <thead>

    </thead>
    <tbody class='poll_tr_name'>
        <tr>
            <td><textarea id='question'><?= $poll['q']; ?></textarea></td>
            <td></td>
        </tr>
        <? foreach ($items as $item) { ?>
            <tr id='tr_item_id_<?= $item['id']; ?>'>
                <td>
                    <input class='exist_item_poll' data-id='<?=$item['id'];?>' data-status='<?=$item['status'];?>' id='item_poll_id_<?= $item['id']; ?>' type='text' value='<?= $item['text']; ?>'/>
                    <a class='delete-item-poll' data-id='<?= $item['id']; ?>'>Удалить</a>
                </td>
            </tr>
        <? } ?>
    </tbody>
</table>
</div>
<input type='hidden' id='poll_id' value='<?=$poll['id'];?>'/>
<button id='add_item_poll' class="add">Добавить пункт</button>
<button id='update_poll' class="add" data-type="edit">Обновить</button>
<?if (isset($modal)) echo $modal;?>