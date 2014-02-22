<div class="wrapper">
    <p>Курсы валют заполняются по отношению к 1$</p>
        <table id='edit_currency'>
            <thead>

            </thead>
            <tbody class='currency_tr_name'>
                <? foreach ($curs as $k => $c) { ?>
                    <? if ($k !== 0) { ?>
                        <tr id='currency_id_<?= $c['id']; ?>'>
                            <td>
                                <input data-id='<?= $c['id']; ?>' class='name_curr currency_input' placeholder='USD/BYR/...' data-status='<?= $c['status']; ?>' value="<?= $c['name']; ?>" id='curr_name_<?= $c['id']; ?>' type='text'/>
                                <input class='val_curr currency_input' placeholder='9100/4990...' id='curr_val_<?= $c['id']; ?>' value="<?= $c['val']; ?>" type='text'/> <a style="color:#fff">= 1$</a> 
                                <a class='delete-item-curr' data-id='<?= $c['id']; ?>'>Удалить</a>
                            </td>
                        </tr>
                    <? } ?>
                <? } ?>
            </tbody>

        </table>
    
</div>
<button id='add_item_currency' class="add">Добавить валюту</button>
<button id='update_curr' class="add">Применить</button>
<?
if (isset($modal))
    echo $modal;?>