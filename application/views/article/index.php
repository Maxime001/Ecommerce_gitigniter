<?php if($articles): ?>
<ul class ="thumbnails">
    <?php foreach($articles as $a):
      
        // Sert a générer des url pour chaque article
        $show = site_url('article/show/'.$a->article_id);
        ?>
    <li class="span4">
        <div class="thumbnail">
            <a href="<?= $show ?>">
                <img src="<?= $this->picture_path.$a->image_name ?>" alt="<?= $a->title ?>" width="256" height="256">
            </a>
            <div class="caption">
                <h3> <?= $a->title ?></h3>
                <p> <?= character_limiter($a->description,200);?></p>
                <p>
                    <a href="<?= $show;?>" class="btn btn-primary">Voir</a>
                    <a class="btn btn-warning"><?= number_format($a->price_amount,2,',',' ');?> €</a>
                </p>
            </div>
        </div>
    </li>
    <?php endforeach ?>
</ul>

    <?php endif; ?>