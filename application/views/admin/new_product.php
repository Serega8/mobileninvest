<div class="wrapper">
    <table>
        <thead>
            <tr>
                <td>Название товара</td>
                <td>Производитель</td>
                <td>Цена</td>
                <td>Валюта</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td><input class="p_info_text" type="text" id="product_name" placeholder="Введите название товара" ></td>
                <td><select id="product_brand">
                        <? foreach ($brands as $k => $brand) { ?>
                            <option <? if ($k == 0) echo 'selected'; ?> value="<?= $brand['id']; ?>"><?= $brand['name']; ?></option>
                        <? } ?>
                    </select>
                    <a href="/admin/brands/new_brand" target="_blank">Добавить</a>
                </td>
                <td><input class="p_info_text" type="text" id="product_cost" placeholder="Введите стоимость"/></td>
                <td><select id="product_currency">
                        <? foreach ($currency as $k => $c) { ?>
                            <option <? if ($k == 0) echo 'selected'; ?> value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
                        <? } ?>
                    </select>
                    <a href="/admin/currency" target="_blank">Добавить</a><br/>
                    <p>По умолчанию в долларах</p>
                </td>
            </tr>
        </tbody>
    </table>
</div>


<div class="wrapper">
    <table>
        <thead>
            <tr>
                <td>URL</td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>
                    <?= $_SERVER['SERVER_NAME']; ?>/catalog/<?= $level2; ?>/<input class="url" type="text" id="url_translit"/>
                    <p style="padding:5px 0; color:#a3a3a3;">если оставить это поле пустым, ссылка будет генерироваться автоматически исходя из названия товара</p>

                </td>

            </tr>
        </tbody>
    </table>
</div>


<div class="wrapper">
    <table>
        <tr>
            <td>Ключевые слова (keywords)</td>
            <td><textarea id="k" placeholder="Ключевые слова – это  часто употребляемые слова на странице (не включая союзы и предлоги) по которому Вы бы хотели, что бы данную страницу находили пользователи поисковой системы."></textarea></td>
        </tr>
        <tr>
            <td>Описание (description)</td>
            <td><textarea id="d" placeholder="Краткое описание страницы, используется поисковыми системами для индексации, а также при создании сниппета (аннотации) в выдаче по запросу."></textarea></td>
        </tr>
        <tr>
            <td>Название (title)</td>
            <td><textarea id="t" placeholder="Поясняющий текст на страницу в виде всплывающей подсказки, которая отображается, когда курсор мыши задерживается в окне веб-страницы."></textarea></td>
        </tr>
        <tr>
            <td>Seotext</td>
            <td><textarea id="s"></textarea></td>
        </tr>
    </table>
</div>
<!--Картинки для товара-->
<div class="wrapper">
    <table class="images">
        <tbody>
            <tr>
                <td>
                    <div class="wrapper1_input">
                        <div class="wrapper2_input">Выбрать файлы</div>
                        <input class="input_file" multiple="multiple" type="file" id="files" size="1"/>
                    </div>
                    <section id="databox"></section>

                </td>
            </tr>
        </tbody>
    </table>
</div>
<!--Характеристики-->

<? if (!empty($details['details'])) { ?>
    <div class="wrapper">
        <table>
            <? foreach ($details['details'] as $det) { ?>
                <? $count = 0; ?>
                <tr>
                    <td><?= $det['name']; ?></td>
                    <td><? foreach ($details['sub'] as $sub) { ?>
                            <? $count++; ?>
                            <? if ($sub['detail_id'] == $det['id']) { ?>
                                <p class='keys-for-product'>
                                    <? foreach ($values as $val) { ?>
                                        <? if ($sub['id'] == $val['sub_detail_id']) { ?>
                                            <span class="key_product"> <?= $sub['key']; ?></span>
                                            <input class='values' val-id='<?= $val['id']; ?>' new='false' type='text' detail-id='<?= $sub['id']; ?>' value='<?= $val['val']; ?>'/>
                                        <? } ?>
                                    <? } ?>
                                    <? if (count($values) < $count) { ?>
                                        <span class="key_product"> <?= $sub['key']; ?></span>
                                        <input class='values' new='true' type='text' detail-id='<?= $sub['id']; ?>' value=''/>
                                    <? } ?>
                                </p>
                            <? } ?>
                        <? } ?>
                    </td>
                </tr>
            <? } ?>
        </table>
    </div>
<? } ?>
<div class="wrapper">
<button id="btn_add_product" class="add_sub_detail">Применить изменения</button>
</div>
<input type="hidden" id="level2" value="<?= $level2; ?>"/>

<input type="hidden" id="level3" value="<?= $level3; ?>"/>

<?
if (isset($modal))
    echo $modal;?>