<?php if($cart): ?>

<table class="table table-bordered table-striped">
    <thead>
        <tr>
            <th></th>
            <th> Description</th>
            <th> Qty </th>
            <th> Prix </th>
            <th> Total </th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($cart as $cart): 
        $article = $this->sitemodel->get_one($cart['id']);
        $show = site_url('article/show/'.$article->article_id);?>
        
        <tr>
            <td>
                <a href="<?= $show ?>">
                    <img src="<?= $this->picture_path.$article->image_name;?>" width="100" height="100">
                </a>
            </td>
            <td><strong> <?= $cart['name']; ?></strong></td>
            <td>
                <span class="update_form">
                    <?= form_open('article/update/'.$cart['rowid'], array('class'=>"form-inline")); ?>
                    <input type="hidden" name="article_id" value="<?= $article->article_id ?>">
                    <input type="hidden" name="price" value="<?= $cart['price'] ?>">
                    <input type="text" name="qty" class="input-small" value="<?= $cart['qty']; ?>">
                    <button class="btn"><i class="icon-pencil"></i></button>
                    <span class="delete"><a href="<?= site_url('article/delete/'.$cart['rowid']); ?>" class="btn btn-inverse"><i class="icon-white icon-trash"></i></a></span>
                    <?= form_close(); ?>
                </span>
            </td>
            <td>
                <?= number_format($cart['price'],2,","," ");?> €
            </td>
              <td>
                <span class="total_for_item"><strong> <?= number_format($cart['subtotal'],2,","," ");?> €</strong><span class="total_for_item">
            </td>
        </tr>
        <?php endforeach; ?>
        <tr>
            <td colspan="6">&nbsp</td>
        </tr>
        <tr>
            <td colspan="4"><strong>Nombre d'articles</strong></td>
            <td> <span class="nb_article"><?= $total_articles; ?> </span></td>
            
        </tr>
        <tr>
            <td colspan="4">
                <strong>Total </strong> 
            </td>
            <td> <strong><span class="total"><?= number_format($total,2,","," ");?> € </span></strong></td>
        </tr>
    </tbody>
    
</table>
<span> <a class="btn btn-success" href="<?= site_url('article/payer');?>"> Payer ma commande </a></span>
<span class="btn pull-right"><a href="<?= site_url('article')?>">Continuer mes achats</a></span>

<?php else: ?>

<h2> Aucun article dans le panier </h2>
<?php endif; 