<? if (!empty($categories)) { ?>
    <? foreach ($categories as $category) { ?>
        <div class="categories">
            <p><?=$category['category_name'];?></p>
            <a href="/catalog/<?=$category['translit_name'];?>">
                <img src="<?= $category['img_url']; ?>" alt="<?= $category['img_alt']; ?>" title="<?= $category['img_title']; ?>"/>
            </a>
        </div>
    <? } ?>
<? } ?>
