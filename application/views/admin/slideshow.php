<? if (!empty($images)) { ?>
    <div class="wrapper">
        <table>
            <tbody>
                <tr>
                    <td>
                        <div id="product_images_div">
                            <? foreach ($images as $k => $i) { ?>
                                <div class="block-images-product" id="block_id_img_<?= $i['id']; ?>">
                                    <div class="block-images-product-img"><img class="product_images" gid="<?= $i['id']; ?>" src="<?= $i['img_url']; ?>" alt="<?= $i['img_alt']; ?>" title="<?= $i['img_title']; ?>"/></div>
                                    <div class="img-data-alt-title">
                                        <textarea class="img_data style-alt-title" id="img_id_delete_<?= $i['id']; ?>"  placeholder="Обязательное описание"  data-status="<?= $i['status']; ?>" gid="<?= $i['id']; ?>"><?= $i['img_alt']; ?></textarea>
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
                        <div class="wrapper2_input">Выбрать файл</div>
                        <input class="input_file" multiple="mutiple" type="file" id="files"/>
                    </div>
                    <section id="databox"></section>
                </td>
            </tr>
        </tbody>
    </table>

    <button id="slide_apply_btn" class="add_sub_detail">Применить изменения</button>
</div>
<?
if (isset($modal))
    echo $modal;?>