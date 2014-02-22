<div class="search" class="left">						
    <form action="/admin/search" method="POST">
        <input style="width:500px;" type="text" name="q" placeholder="Поиск..." class="no-submit">
        <button class="start-search">
            <!--input type="submit" class="submit start-search" value=""-->
            <i class="icon-search"></i>
        </button>
        <div class="null"></div>
    </form>
</div>
<div class='with-selected'>

    <? if (!empty($products)) { ?>
        <p class="add">С отмеченными</p>

        <select class="select-msg add" data-type="products">
            <option>Выбрать действие</option>
            <option value="hide">Не отображать на сайте</option>
            <option value="show">Отображать на сайте</option>
            <option value="delete">Удалить</option>
        </select>
    </div>
    <div class="wrapper">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Дата создания</th>
                    <th>Добавить отзыв</th>
                    <th>
            <div id="change_msg_div">
                <input type="checkbox" value="false" class="check-all" d-type="products"/>
                <p id="sel-prod">отметить все </p>
            </div>
            </th>
            </tr>
            </thead>
            <? foreach ($products as $product) { ?>
                <tr  class="main<? if ($product['status'] == 1) echo ' delete' ?>" id="msg_pr_<?= $product['id']; ?>" >
                    <td><p><?= $product['id']; ?></p></td>
                    <td onclick="window.location.href = '/admin/catalog/<?= $product['level2']; ?>/<?= $product['level3']; ?>/<?= $product['translit_name']; ?>'"><p><?= $product['product_name']; ?></p></td>
                    <td onclick="window.location.href = '/admin/catalog/<?= $product['level2']; ?>/<?= $product['level3']; ?>/<?= $product['translit_name']; ?>'"><p><?= date('Y-m-d / H:i:s', $product['date']); ?></p></td>

                    <td><a href='/admin/catalog/<?= $product['level2']; ?>/<?= $product['level3']; ?>/<?= $product['translit_name']; ?>/add_review'>Добавить отзыв</a></td>
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
    <? } else { ?>
        <p>По вашему запросу ничего не найдено</p>
    <? } ?>
</div>

