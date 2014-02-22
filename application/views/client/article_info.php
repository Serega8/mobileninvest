
<div>
    <? if (isset($images[0]['img_url'])) { ?>
        <img src="<?= $images[0]['img_url']; ?>">
    <? } ?>
</div>
<div>
    <p class='box-text'><?= $article['description']; ?></p>
</div>