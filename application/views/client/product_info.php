
<div>
    <p><?= $product['product_name']; ?></p>
    <p><?= $product['cost']; ?></p>
</div>
<div id="details">
    <? if (!empty($details)) { ?>

        <? foreach ($details['details'] as $det) { ?>

            <? foreach ($details['sub'] as $sub) { ?>

                <? if ($sub['detail_id'] == $det['id']) { ?>

                    <? foreach ($values as $val) { ?>
                        <? if ($sub['id'] == $val['sub_detail_id'] && !empty($val['val'])) { ?>
                            <p class='caption'><?= $sub['key']; ?></p>
                            <p class='meaning'><?= $val['val']; ?></p>
                        <? } ?>
                    <? } ?>
                <? } ?>
            <? } ?>
        <? } ?>
    <? } ?>
</div>
<div id="images">
    <? if (!empty($images)) { ?>
        <? foreach ($images as $k => $i) { ?>

            <a href="<?= $i['img_url']; ?>">
                <img class="p-images" src="<?= $i['img_url_small']; ?>" title="<?= $i['img_alt']; ?>" alt="<?= $i['img_alt']; ?>"/>
            </a>

        <? } ?>
    <? } ?>
</div>
<div id="reviews">
    <? if (!empty($reviews)) { ?>
        <? foreach ($reviews as $k => $i) { ?>
            <div>
                <p><?= $i['name']; ?></p>
                <p><?= $i['text']; ?></p>
                <p><?= $i['val']; ?></p>
                <p><?= date('Y-m-d / H:i:s', $i['date']); ?></p>
            </div>
        <? } ?>
    <? } ?>
</div>
<div>
    <? if ((isset($msg) ) && $msg !== null) { ?>
        <div class="errors">
            <p><?= $msg; ?></p>
        </div>
    <? } ?>

    <form action="" method="POST">
        <label>Имя</label><input type="text" name="name" required/><br/>
        <label>E-mail</label><input type="email" name="email" required /><br/>
        <label>оценка</label><input type="range" name="val" min="1" max="5" step="0.1"/><br/>
        <label>Текст сообщения</label><textarea name="text" required></textarea><br/>
        <img src="/file.png?<?= date('U'); ?>" alt="13"/><input placeholder="Code" type="text" name="txtpic"/><br/>
        <button name="submit">Добавить</button>
    </form>
</div>