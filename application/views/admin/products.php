<a href="/admin/catalog/<?= $level2; ?>/<?= $level3; ?>/new_product"><button class="add">Добавить товар</button></a>
<? if (!empty($products)) { ?>
    <div class='with-selected'>
        <p>С отмеченными</p>

        <select class="select-msg" data-type="products">
            <option>Выбрать действие</option>
            <option value="hide">Не отображать на сайте</option>
            <option value="show">Отображать на сайте</option>
            <option value="delete">Удалить</option>
        </select>
    </div>
    <div class="wrapper list_cat">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Дата создания</th>
                    <th>Добавить отзыв</th>
                    <th>
            <div id="change_msg_div">
                <input type="checkbox" value="false" id="chkall" d-type="products" class="check-all"/>
                <label for="chkall" class="text_check_all" id="sel-prod">выбрать все</label>
            </div>
            </th>
            </tr>
            </thead>
            <? foreach ($products as $product) { ?>
                <tr  class="main<? if ($product['status'] == 1) echo ' delete' ?>" id="msg_pr_<?= $product['id']; ?>" >
                    <td><p><?= $product['id']; ?></p></td>
                    <td onclick="window.location.href = '/admin/catalog/<?= $level2; ?>/<?= $level3; ?>/<?= $product['translit_name']; ?>'"><p><?= $product['product_name']; ?></p></td>
                    <td onclick="window.location.href = '/admin/catalog/<?= $level2; ?>/<?= $level3; ?>/<?= $product['translit_name']; ?>'"><p><?= date('Y-m-d / H:i:s', $product['date']); ?></p></td>

                    <td><a href='/admin/catalog/<?= $level2; ?>/<?= $level3; ?>/<?= $product['translit_name']; ?>/add_review'>Добавить отзыв</a></td>
                    <td><input type="checkbox" data-id="<?= $product['id']; ?>" val="false" class="change-msg-products" />
        <!--                <select class='cat_select' data-type='product' data-id='<?= $product['id']; ?>' data-status='<?= $product['status']; ?>'>
                            <option value='0' <? if ($product['status'] == 0) echo "selected"; ?>>Активен</option>
                            <option value='1' <? if ($product['status'] == 1) echo "selected"; ?>>Неактивен</option>
                            <option value='3'>Удалить</option>
                        </select>-->
                    </td>
                </tr>
            <? } ?>
        </table>
    </div>


    <?
}?>