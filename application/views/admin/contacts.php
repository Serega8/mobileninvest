<div id="contacts">


    <? if (isset($info)) { ?>
        <p style="margin-left:20px;">
            <?= $info; ?>
        </p>
    <? } ?>

    <div>
        <a id="show_seo_data" class="add">Показать seo-данные</a>
    </div>
    <div class="wrapper">
        <form id="contacts_form" action="" method="POST">
            <table>
                <tr>
                    <td>Телефон (velcom)</td>
                    <td><input type="text" name="velcom" value="<?= $c['vel']; ?>" /></td>
                </tr>
                <tr>
                    <td>Телефон (mts)</td>
                    <td><input type="text" name="mts" value="<?= $c['mts']; ?>"/></td>
                </tr>
                <tr>
                    <td>Телефон (life)</td>
                    <td><input type="text" name="life" value="<?= $c['life']; ?>"/></td>
                </tr>
                <tr>
                    <td>Телефон (diallog)</td>
                    <td><input type="text" name="dialog" value="<?= $c['dialog']; ?>"/></td>
                </tr>
                <tr>
                    <td>Телефон городской</td>
                    <td><input type="text" name="gorod" value="<?= $c['gorod']; ?>"/></td>
                </tr>
                <tr>
                    <td>Адрес</td>
                    <td><input type="text" name="adr" value="<?= $c['adr']; ?>"/></td>
                </tr>
                <tr>
                    <td>Имя (ФИО)</td>
                    <td><input type="text" name="name" value="<?= $c['name']; ?>"/></td>
                </tr>
                <tr>
                    <td>Дополнительная информация</td>
                    <td><textarea name="other"><?= $c['other']; ?></textarea></td>
                </tr>
                <tr>
                    <td>Карта</td>
                    <td><textarea name="img_url"><?= $c['img_url']; ?></textarea></td>
                </tr>

            </table>
            <button id="update_contacts" class="add">Обновить</button>
        </form>
    </div>


</div>
<?= $seo_box; ?>

<?
if (isset($modal))
    echo $modal; ?>