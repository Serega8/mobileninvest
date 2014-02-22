<a href="/admin/catalog/<?= $level2; ?>/new_sub_category"><button class="add">Добавить подкатегорию</button></a>
<a href="/admin/catalog/<?= $level2; ?>/new_product"><button class="add">Добавить товар</button></a>
<? if (!empty($sub_categories)) { ?>
    <div class='with-selected'>
        <p>С отмеченными</p>

        <select class="select-msg" data-type="sub_categories">
            <option>Выбрать действие</option>
            <option value="hide">Не отображать на сайте</option>
            <option value="show">Отображать на сайте</option>
            <option value="delete">Удалить</option>
        </select>
    </div>

    <p class="p_list">Список подкатегорий</p>
    <div class="wrapper list_cat"> 
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Дата создания</th>
                    <th>Настроить</th>
                    <th>
            <div id="change_msg_div">
                <input type="checkbox" value="false" id="chkall" class="check-all"/>
                <label for="chkall" class="text_check_all" id="sel-msg-all">выбрать все</label>
            </div>
            </th>
            </tr>
            </thead>
            <? foreach ($sub_categories as $category) { ?>
                <tr class="main<? if ($category['status'] == 1) echo ' delete' ?>" id="msg_<?= $category['id']; ?>">
                    <td><p><?= $category['id']; ?></p></td>
                    <td onclick="window.location.href = '/admin/catalog/<?= $level2; ?>/<?= $category['sub_translit']; ?>'"><p><?= $category['sub_name']; ?></p></td>
                    <td onclick="window.location.href = '/admin/catalog/<?= $level2; ?>/<?= $category['sub_translit']; ?>'"><p><?= date('Y-m-d / H:i:s (e)', $category['date']); ?></p></td>
                    <td><p><a href='/admin/catalog/<?= $level2; ?>/<?= $category['sub_translit']; ?>/sub_category_edit'>Настроить</a></p></td>
                    <td>  <input type="checkbox" data-id="<?= $category['id']; ?>" val="false" class="change-msg" />
            <!--                <select class='cat_select' data-type='sub' data-id='<?= $category['id']; ?>' data-status='<?= $category['status']; ?>'>
                            <option value='0' <? if ($category['status'] == 0) echo "selected"; ?>>Активна</option>
                            <option value='1' <? if ($category['status'] == 1) echo "selected"; ?>>Неактивна</option>
                            <option value='3'>Удалить</option>
                        </select>-->
                    </td>
                </tr>
            <? } ?>
        </table>
    </div>
<? } ?>














<? if (!empty($products_category)) { ?>

    <div class='with-selected' style="margin-bottom:-20px;">
        <p>С отмеченными</p>

        <select class="select-msg" data-type="products">
            <option>Выбрать действие</option>
            <option value="hide">Не отображать на сайте</option>
            <option value="show">Отображать на сайте</option>
            <option value="delete">Удалить</option>
        </select>
    </div>

    <p class="p_list">Список товаров</p>
    <div class="wrapper list_cat"> 
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Дата создания</th>
                    <th>Добавить отзыв</th>
                    <th>
                <input type="checkbox" value="false" id="chkall" d-type="products" class="check-all"/>
                <label for="chkall" class="text_check_all" id="sel-prod">выбрать все</label>
                </th>
                </tr>
                </thead>
                <? foreach ($products_category as $product) { ?>
                    <tr class="main<? if ($product['status'] == 1) echo ' delete' ?>" id="msg_pr_<?= $product['id']; ?>" >
                        <td><p><?= $product['id']; ?></p></td>
                        <td onclick="window.location.href = '/admin/catalog/<?= $level2; ?>/<?= $product['translit_name']; ?>'"><p><?= $product['product_name']; ?></p></td>
                        <td onclick="window.location.href = '/admin/catalog/<?= $level2; ?>/<?= $product['translit_name']; ?>'"><p><?= date('Y-m-d / H:i:s (e)', $product['date']); ?></p></td>

                        <td><a href='/admin/catalog/<?= $level2; ?>/<?= $product['translit_name']; ?>/add_review'>Добавить отзыв</a></td>
                        <td>
                            <input type="checkbox" data-id="<?= $product['id']; ?>" val="false" class="change-msg-products" />

                        </td>
                    </tr>
                <? } ?>
        </table>
    </div>
<? } ?>