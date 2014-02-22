<? if (!empty($products)) { ?>
    <div class='all-products'>
        <? foreach ($products as $product) { ?>
            <div class='product'>
                <p><?= $product['product_name']; ?></p>
                <a href='/catalog/<?= $level2; ?>/<?= $level3; ?>/<?= $product['translit_name']; ?>'>
                    <img class="img_product" src='<?= $product['img_url_small']; ?>'>
                </a>
            </div>
        <? } ?>
    </div>
<? } else { ?>
    <p>Категория пуста</p>
<? } ?>