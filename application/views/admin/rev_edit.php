<div class="wrapper">
<form id="form_rev">
    <input type="hidden" name="id" value="<?= $review['id']; ?>"/>
<table class="one_review">
    <tr>
        <td>
            Номер отзыва  
        </td>
        <td>
            <input disabled required type="text" name="id-hidden" value="<?= $review['id']; ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            Имя 
        </td>
        <td>
            <input type="text"  name="name" value="<?= $review['name']; ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            E-mail  
        </td>
        <td>
            <input disabled type="text" name="email" value="<?= $review['email']; ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            ip-адрес  
        </td>
        <td>
            <input disabled type="text" name="ip" value="<?= $review['ip']; ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            Оценка  
        </td>
        <td>
            <input type="range" min="1" max="5" name="val" id="range_val" step="0.1" value="<?= $review['val']; ?>"/>
            <span id="val_val"></span>
        </td>
    </tr>
    <tr>
        <td>
            Дата 
        </td>
        <td>
            <input disabled type="date" name="date" value="<?= date('Y-m-d', $review['date']); ?>"/>
        </td>
    </tr>
    <tr>
        <td>
            Текст 
        </td>
        <td>
            <textarea name="text"><?= $review['text']; ?></textarea>
        </td>
    </tr>
</table>
</form>
</div>
<button class="add" id="change_rev">Обновить</button>

<?
if (isset($modal))
    echo $modal;?>