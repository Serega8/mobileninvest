<?foreach($articles as $article) {?>
<div class='blok-advice'>
    <div>
        <img src="<?=$article['img_url'];?>" alt="<?=$article['img_alt'];?>" title="<?=$article['img_title'];?>">
    </div>
    <div>
        <a href='/articles/<?=$article['name_translit'];?>' class='title'><?=$article['name'];?></a>
        <p><?=Text::limit_chars(strip_tags($article['description']),'600','...');?></p>
    </div>
</div>
<?}?>
