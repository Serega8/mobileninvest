<ul><? foreach ($menu as $m) { ?>
    <li>
        <a href=""><?= $m['name']; ?></a>
        <ul>
                <? foreach ($sub_menu as $s) { ?>
                    <? if ($m['id'] == $s['pid']) { ?>
                        <li>
                            <a href=""><?= $s['sub_name']; ?></a>
                            <ul>
                                <? foreach ($product as $p) { ?>
                                    <? if ($p['sub_category_id'] == $s['id']) { ?>
                                        <li>
                                            <a href=""><?= $p['product_name']; ?></a>
                                        </li>
                                    <? } ?>  
                                <? } ?>    
                            </ul>

                        </li>
                    <? } ?>

                <? } ?>
                <? foreach ($product as $p) { ?>
                    <? if (($p['sub_category_id'] == NULL) && ($p['category_id'] == $m['id'])) { ?>
                        <li>
                            <a href=""><?= $p['product_name']; ?></a>
                        </li>
                    <? } ?>
                <? } ?>
            </ul>
        </li>
    <? } ?>
</ul>