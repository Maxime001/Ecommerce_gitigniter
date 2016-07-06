<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title><?= $title ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <!-- Le styles -->
    <link href="<?= base_url();?>/css/bootstrap.css" rel="stylesheet">
    <style type="text/css">
      body {
        padding-top: 60px;
        padding-bottom: 40px;
      }
    </style>
    <link href="../assets/css/bootstrap-responsive.css" rel="stylesheet">


  </head>

  <body>

    <div class="navbar navbar-inverse navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="brand" href="<?= site_url().'article';?>">Shop</a>
          <div class="nav-collapse collapse">
              
        <ul class="nav">
            <li>
                <a href="#">Inscription</a>
            </li>
            <?php if($this->cart->contents()): ?>
            <li>
                <a href="<?= site_url('article/panier');?>">
                    Mon panier(<span class="nb_article"><?= $this->cart->total_items();?>)</span>
                </a>
            <?php endif; ?>
            </li>
        </ul>

        <form class="navbar-form pull-right">
          <input class="span2" type="text" placeholder="Email">
          <input class="span2" type="password" placeholder="Password">
          <button type="submit" class="btn">Login</button>
        </form>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>

<div class="container">