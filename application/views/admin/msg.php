<div class="wrapper">
    <table>
        <thead>
            <tr>
                <? foreach ($names as $name) { ?>
                    <th>
            <p><?= $name['name']; ?></p>
            </th>
        <? } ?>
        <th>ip-адрес</th>
        <th>Дата</th>
        </tr>
        </thead>
        <tr>
            <? $count = 0; ?>
            <? foreach ($names as $name) { ?>
                <? foreach ($message as $m) { ?>
                    <? if ($m['tag_id'] == $name['id']) { ?>
                        <? $count++; ?>
                        <td><?= $m['text']; ?></td>
                    <? } ?>
                <? } ?>
            <? } ?>
            <? if ($count < count($names)) { ?>
                <? for ($i = 0; $i < abs($count - count($names)); $i++) { ?>
                    <td><p>-</p></td>
                <? } ?>
            <? } ?>
            <td><?= $ipaddr['ip']; ?></td>
            <td><?= date('Y-m-d / H:i:s', $ipaddr['date']); ?></td>
        </tr>
    </table>
</div>