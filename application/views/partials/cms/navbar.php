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
      <a class="navbar-brand" href="<?php echo base_url() ?>cms/"><?php echo $nav['brand'] ?></a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li <?php if($selected == 'noticias') echo "class=active" ?>><a href="<?php echo base_url() . 'cms/noticias' ?>">Noticias</a></li>
        <li <?php if($selected == 'categorias') echo "class=active" ?>><a href="<?php echo base_url() . 'cms/categorias' ?>">Categorias</a></li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="<?php echo base_url() . 'cms/session/logout' ?>" >Logout</a></li>
      </ul>
    </div>
  </div>
</nav>