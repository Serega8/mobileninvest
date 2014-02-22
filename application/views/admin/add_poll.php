<div class="wrapper">
    <table id='edit_poll'>
        <thead>

        </thead>
        <tbody class='poll_tr_name'>
            <tr>
                <td><textarea placeholder="Введите вопрос" id='question'></textarea></td>
                <td></td>
            </tr>

        </tbody>

    </table>
</div>
<button id='add_item_poll' class="add">Добавить пункт</button>
<button id='update_poll' class="add" data-type="add">Добавить</button>
<?
if (isset($modal))
    echo $modal;?>