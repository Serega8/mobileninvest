<? if (!empty($products)) { ?>
    <div class='with-selected' style="padding-bottom:20px;">
        <p>С отмеченными</p>
        <select class="select-msg" data-type="reviews">
            <option>Выбрать действие</option>
            <option value="hide">Не отображать на сайте</option>
            <option value="show">Отображать на сайте</option>
            <option value="delete">Удалить</option>
        </select>
    </div>
    <div class="wrapper list_cat">
        <table class="table_reviews">
            <thead>
                <tr>
                    <th>Номер товара</th>
                    <th>Название товара и отзывы к нему</th>
                    <th>
            <div id="change_msg_div">
                <input type="checkbox" value="false" id="chkall" class="check-all"/>
                <label for="chkall" class="text_check_all" id="sel-msg-all">выбрать все</label>
            </div></th>
            </tr>
            </thead>
            <tbody>

                <? foreach ($products as $k => $product) { ?>
                    <tr class="product_tr main">
                        <td class="product_id_td"><?= $product['id']; ?></td>
                        <td>
                            <a href="/admin/catalog/<?= $product['level2']; ?>/<? if ($product['level3']) echo $product['level3'] . "/"; ?><?= $product['translit_name']; ?>"><?= $product['product_name']; ?></a>
                            <a style="float:right" href="/admin/catalog/<?= $product['level2']; ?>/<? if ($product['level3']) echo $product['level3'] . "/"; ?><?= $product['translit_name']; ?>/add_review">Добавить отзыв</a>
                        </td>
                        <td></td>
                    </tr>
                    <? foreach ($reviews as $review) { ?>
                        <? if ($review['product_id'] == $product['id']) { ?>
                            <tr class="main review_tr<? if ($review['status'] == 1) echo ' delete' ?>" id="msg_<?= $review['id']; ?>">
                                <td></td>
                                <td class="review_data" onclick="window.location.href = '/admin/reviews/<?= $review['id']; ?>'">
                                    <p class="p_rev">
                                        <?= $review['id']; ?> /
                                        <?= Text::limit_chars($review['email'], 40, '...'); ?> /
                                        <?= $review['name']; ?> /
                                        <?= Text::limit_chars($review['text'], 55, '...'); ?> 
                                    </p>
                                </td>
                                <td>
                                    <input type="checkbox" data-id="<?= $review['id']; ?>" val="false" class="change-msg" />
                                </td>
                            </tr>
                        <? } ?>
                    <? } ?>
                <? } ?>
            </tbody>
        </table>
    </div>
<? } else { ?>
    <p>Ни одного отзыва еще нету</p>
<?
}?>