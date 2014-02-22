
<form id="form_rev">
    <input type="hidden" name="product_id" value="<?= $product_id; ?>" />
    <table class="one_review">
        <tr>
            <td>
                Имя 
            </td>
            <td>
                <input type="text" name="name" value=""/>
            </td>
        </tr>
        <tr>
            <td>
                E-mail  
            </td>
            <td>
                <input type="text" name="email" value=""/>
            </td>
        </tr>
        <tr>
            <td>
                Оценка  
            </td>
            <td>
                <input type="range" min="1" max="5" name="val" step="0.1" id="range_val" value="1"/>
                <span id="val_val">0</span>
            </td>
        </tr>
        <tr>
            <td>
                Текст 
            </td>
            <td>
                <textarea name="text"></textarea>
            </td>
        </tr>
    </table>
</form>
<button id="add_rev" class="add">Обновить</button>

<?
if (isset($modal))
    echo $modal;?>