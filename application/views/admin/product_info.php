
<? if (!empty($product)) { ?>
    <div class="wrapper">
        <input class="p_info_id" type="hidden" disabled id="product_id" value="<?= $product['id']; ?>"/>
        <table>
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Название товара</td>
                    <td>Производитель</td>
                    <td>Цена</td>
                    <td>Валюта</td>
                    <td>Дата создания</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><?= $product['id']; ?></td>
                    <td><input class="p_info_text" type="text" id="product_name" value="<?= $product['product_name']; ?>"></td>
                    <td><select id="product_brand">
                            <? foreach ($brands as $brand) { ?>
                                <option <? if ($brand['id'] == $product['brand_id']) echo "selected"; ?> value="<?= $brand['id']; ?>"><?= $brand['name']; ?></option>
                            <? } ?>
                        </select>
                        <a href="/admin/brands/new_brand" target="_blank">Добавить</a>
                    </td>

                    <td>
                        <input class="p_info_text" type="text" id="product_cost" value="<? if (is_numeric($product['cost'])) echo number_format($product['cost']); ?>"/>
                        <? if (!empty($converted)) { ?>
                            <p>
                                <? foreach ($converted as $v) { ?>
                                    <span id="name_curr_id_<?= $v['id']; ?>" class="name_currency_res" data-id="<?= $v['id']; ?>"><?= $v['name']; ?></span>:
                                    <span id="val_curr_id_<?= $v['id']; ?>" class="val_currenct_res"><?= number_format($v['val']); ?></span><br/>
                                <? } ?>
                            </p>
                        <? } ?>
                    </td>
                    <td><select id="product_currency">
                            <? foreach ($currency as $c) { ?>
                                <option <? if ($product['currency'] == $c['id']) echo 'selected'; ?> value="<?= $c['id']; ?>"><?= $c['name']; ?></option>
                            <? } ?>
                        </select>
                        <a href="/admin/currency" target="_blank">Добавить</a><br/>
                        <p>По умолчанию в долларах</p>
                    </td>
                    <td><p><?= Date('Y-m-d / H:i:s (e)', $product['date']); ?></p></td>
                </tr>
            </tbody>
        </table>
    </div>
    <script>
        $(document).ready(function() {
            curr_arr = new Array();
    <? foreach ($currency as $c) { ?>
                curr_arr.push({name: '<?= $c['name']; ?>', id:<?= $c['id']; ?>, val:<?= $c['val']; ?>});
    <? } ?>

        });
    </script>
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
                        <?= $_SERVER['SERVER_NAME']; ?>/catalog/<?= $level2; ?>/<?= $level3 ?>/<input class="url" type="text" id="url_translit" value="<?= $product['name_translit']; ?>"/>
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
                <td><textarea id="k" placeholder="Ключевые слова – это  часто употребляемые слова на странице (не включая союзы и предлоги) по которому Вы бы хотели, что бы данную страницу находили пользователи поисковой системы."><?= $product['k']; ?></textarea></td>
            </tr>
            <tr>
                <td>Описание (description)</td>
                <td><textarea id="d" placeholder="Краткое описание страницы, используется поисковыми системами для индексации, а также при создании сниппета (аннотации) в выдаче по запросу."><?= $product['d']; ?></textarea></td>
            </tr>
            <tr>
                <td>Название (title)</td>
                <td><textarea id="t" placeholder="Поясняющий текст на страницу в виде всплывающей подсказки, которая отображается, когда курсор мыши задерживается в окне веб-страницы."><?= $product['t']; ?></textarea></td>
            </tr>
            <tr>
                <td>Seotext</td>
                <td><textarea id="s"></textarea></td>
            </tr>
        </table>
    </div>
<? } ?>




<!--Картинки для товара-->
<? if (!empty($images)) { ?>
    <div class="wrapper">
        <table>
            <tbody>
                <tr>
                    <td>
                        <div id="product_images_div">
                            <? foreach ($images as $k => $i) { ?>
                                <div class="block-images-product" id="block_id_img_<?= $i['id']; ?>">
                                    <div class="block-images-product-img"><img class="product_images" gid="<?= $i['id']; ?>" src="<?= $i['img_url_small']; ?>" alt="<?= $i['img_alt']; ?>" title="<?= $i['img_title']; ?>"/></div>
                                    <div class="img-data-alt-title">
                                        <textarea class="img_data style-alt-title" id="img_id_delete_<?= $i['id']; ?>" placeholder="Обязательное описание" data-status="<?= $i['status']; ?>" gid="<?= $i['id']; ?>"><?= $i['img_alt']; ?></textarea>
                                        <br/>
                                        <textarea class="style-alt-title" placeholder="Описание при наведении курсора мыши" id="title_img_id_<?= $i['id']; ?>"><?= $i['img_title']; ?></textarea>
                                    </div>
                                </div>
                            <? } ?>
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
<? } ?>
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
    <button class="btn_apply add_sub_detail">Применить изменения</button>
</div>

<?
if (isset($modal))
    echo $modal;
?>








