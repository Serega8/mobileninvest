<? foreach ($brands as $brand) { ?>

    <p><?= $brand['name']; ?></p>
    <a href="/brands/<?= $brand['translit']; ?>">
        <img class="b-images" src='<?= $brand['img_url']; ?>' alt="<?= $brand['img_alt']; ?>" title="<?= $brand['img_title']; ?>">
    </a>
    </div>
<? } ?>