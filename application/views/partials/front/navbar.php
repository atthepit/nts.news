<nav class="navbar navbar-default" role="navigation">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo base_url() ?>"><i class="glyphicon glyphicon-home"></i> <?php echo $nav['brand'] ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <?php foreach($nav['categorias'] as $categoria) : ?>
            <li><a href="<?php echo base_url()?>noticias/<?php echo($categoria['titulo']) ?>"><?php echo ucfirst($categoria['titulo']) ?></a></li>
            <li class="divider"></li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>
</nav>

