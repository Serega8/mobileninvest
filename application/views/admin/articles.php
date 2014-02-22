<a href="/admin/articles/new_article" class="add">Добавить статью</a>
<div style="width:80%;height: 60px;">
        <a id="show_seo_data" class="add">Показать seo-данные</a>
    </div>
<? if (!empty($articles)) { ?>
    <div class='with-selected'>
        <p>С отмеченными</p>

        <select class="select-msg" data-type="articles">
            <option>Выбрать действие</option>
            <option value="hide">Не отображать на сайте</option>
            <option value="show">Отображать на сайте</option>
            <option value="delete">Удалить</option>
        </select>
    </div>
    <div class="wrapper list_cat">
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Название</th>
                    <th>Дата создания</th>
                    <th>Текст</th>
                    <th>
                         <input type="checkbox" value="false" id="chkall" class="check-all"/>
                <label for="chkall" class="text_check_all" id="sel-prod">выбрать все</label>
                
            </th>
            </tr>
            </thead>
            <? foreach ($articles as $article) { ?>
                <tr id="msg_<?= $article['id']; ?>" class="main<? if ($article['status'] == 1) echo ' delete"' ?>">
                    <td><p><?= $article['id']; ?></p></td>
                    <td onclick="window.location.href = '/admin/articles/<?= $article['name_translit']; ?>'"><p><?= Text::limit_chars($article['name'], 20, '...'); ?></p></td>
                    <td onclick="window.location.href = '/admin/articles/<?= $article['name_translit']; ?>'"><p><?= Date('Y-m-d / H:i:s', $article['date']); ?></p></td>
                    <td onclick="window.location.href = '/admin/articles/<?= $article['name_translit']; ?>'"><p><?= Text::limit_chars(strip_tags($article['description']), 40, '...'); ?></p></td>
                    <td class="other">
                        <input type="checkbox" data-id="<?= $article['id']; ?>" val="false" class="change-msg" />
                    </td>
                </tr>
            <? } ?>
        </table>
    </div>	
<?
}?>
<?= $seo_box; ?>

<?
if (isset($modal))
    echo $modal; ?>