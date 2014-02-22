<? if (!empty($products)) { ?>
    <? foreach ($categories as $k => $cat) { ?>
        <p class="category_name"><?= $cat['name']; ?></p>
        <? foreach ($sub_categories as $ksub => $sub_cat) { ?>
            <? $count = 0; ?>
            <? if ($sub_cat['pid'] == $cat['id']) { ?>
                <p class="sub_category_name"><?= $sub_cat['name']; ?></p>
                <? foreach ($products as $kp => $product) { ?>
                    <? if ($sub_cat['id'] == $product['sub_category_id']) { ?>
                        <? $count++; ?>
                        <div class='product_brand_<?= $sub_cat['id']; ?>' <? if ($count > 4) echo 'style="display:none;"'; ?>>
                            <p><?= $product['product_name']; ?></p>

                            <a href='/catalog/<?= $cat['translit']; ?>/<?= $sub_cat['stranslit']; ?>/<?= $product['translit_name']; ?>'>
                                <img class="img_product" src='<?= $product['img_url_small']; ?>'>
                            </a>

                        </div>
                    <? } ?>
                <? } ?>
            <? } ?>
            <? if ($count > 4) { ?>
                <p class="show_all_sub" data-sub-id='<?= $sub_cat['id']; ?>' status='hidden'>Показать все</p>
            <? } ?> 
        <? } ?>
    <? } ?>
<? } ?>