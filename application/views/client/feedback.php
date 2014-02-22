<div id="feedback">
    <? if ($msg !== null) { ?>
        <div class="errors"><?= $msg; ?></div>
    <? } ?>
    <form method="POST" action="">
        <?
        foreach ($exist as $ex) {
            switch ($ex['tag']) {
                case 'input':
                    ?>
                    <label><?= $ex['name']; ?></label>
                    <input required type="<?= $ex['type']; ?>" name="<?= $ex['id']; ?>" placeholder="<?= $ex['placeholder']; ?>"/>
                    <br/>
                    <?
                    break;
                case 'textarea':
                    ?>
                    <label><?= $ex['name']; ?></label>
                    <textarea required class="feedback_rows" name="<?= $ex['id']; ?>" placeholder="<?= $ex['placeholder']; ?>"></textarea>
                    <br/>
                    <?
                    break;
                case 'select':
                    ?>

                    <?
                    break;
                default:
                    ?>
                    Unknown tag;
                    <?
                    break;
            }
        }
        ?>
                    <img src="/file.png?<?=date('u');?>" alt="13"/><input type="text" name="txtpic"/>
        <button id="send_message">Отправить</button>
    </form>
</div>
