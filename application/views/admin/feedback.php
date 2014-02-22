<div style="width:80%;height: 60px;">
        <a id="show_seo_data" class="add">Показать seo-данные</a>
    </div>
<div id="feedback">
    <?
    foreach ($exist as $ex) {
        switch ($ex['tag']) {
            case 'input':
                ?>
                <div class="tags_feedback" id="tag_id_<?= $ex['id']; ?>" type-tag="<?= $ex['tag']; ?>">
                    <p class="p_feedback_name">
                        <?= $ex['name']; ?>    
                    </p>
                    <input class="input_feedback_name" type="<?= $ex['type']; ?>" data-status="<?= $ex['status']; ?>" data-id="<?= $ex['id']; ?>" id="tag_<?= $ex['id']; ?>" placeholder="<?= $ex['placeholder']; ?>"/>
                    <a class="change_tag" data-id="<?= $ex['id']; ?>">Изменить /</a> 
                    <a class="delete_tag" data-id="<?= $ex['id']; ?>">Удалить</a>
                </div>
                <?
                break;
            case 'textarea':
                ?>
                <div class="tags_feedback" id="tag_id_<?= $ex['id']; ?>" type-tag="<?= $ex['tag']; ?>">
                    <p class="p_feedback_name">
                        <?= $ex['name']; ?>    
                    </p>
                    <textarea class="input_feedback_name" id="tag_<?= $ex['id']; ?>" data-status="<?= $ex['status']; ?>" data-id="<?= $ex['id']; ?>" placeholder="<?= $ex['placeholder']; ?>"></textarea>
                    <a class="change_tag" data-id="<?= $ex['id']; ?>">Изменить /</a> 
                    <a class="delete_tag" data-id="<?= $ex['id']; ?>">Удалить</a>
                </div>
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

</div>


<?
if (isset($modal))
    echo $modal; ?>

<div style="margin-top:40px;margin-left:20px;">
    <button id="add_col" class="add">Добавить</button>
<button id="add_feedback" class="add">Применить</button></div>

<div id="construct" style="display:none;">
    <p>Выберите тип поля</p>
    <select id="select_type">
        <option value="textarea">Текстовое поле</option>
        <option value="input" selected="selected">Тип Input</option>
        <option value="select">Выбор из списка</option>
    </select>
    <select id="sel_type_2">
        <option value="text" selected="selected">Текст</option> 
        <option value="date">Дата</option>
        <option value="datetime-local">Дата и время</option>
        <option value="email">E-mail</option>
        <option value="month">Месяц</option>
        <option value="color">Цвет</option>
        <option value="number">Номер</option>
        <option value="range">Диапазон</option>
        <option value="tel">Телефон</option>
    </select>
    <input type="text" placeholder="Placeholder" id="placeholder_col"/>
    <input type="text" placeholder="Имя" id="name_col"/>
</div>
<?= $seo_box; ?>