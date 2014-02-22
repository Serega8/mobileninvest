<? if (!empty($subcategories)) { ?>
    <? foreach ($subcategories as $subcategory) { ?>
        <div class="categories">
            <p><?= $subcategory['sub_name']; ?></p>
            <a href="/catalog/<?= $level2 ?>/<?= $subcategory['sub_translit']; ?>">
                <img src="<?= $subcategory['img_url']; ?>" alt="<?= $subcategory['img_alt']; ?>" title="<?= $subcategory['img_title']; ?>"/>
            </a>
        </div>
    <? } ?>
<? } ?>
<? if (!empty($products)) { ?>
    <div class='all-products'>
        <? foreach ($products as $product) { ?>
            <div class='product'>
                <p><?= $product['product_name']; ?></p>
                <a href='/catalog/<?= $level2; ?>/<?= $product['translit_name']; ?>'>
                    <img class="img_product" src='<?= $product['img_url_small']; ?>'>
                </a>
            </div>
        <? } ?>
    </div>
<? }?>