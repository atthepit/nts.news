<?php 
    $this->load->view('partials/heading',$heading);
    $this->load->view('partials/front/navbar', $nav);
?>

    <div class="container">
    <div class="row">
        <?php foreach($noticias as $noticia) : ?>
            
                <div class="col-sm-12 col-md-6 col-lg-6">
                    <div class="thumbnail">
                        <a href="<?php echo base_url() ?>noticia/<?php echo join('_',explode(' ',urlencode(utf8_encode($noticia['titulo'])))) ?>">
                            <img src="<?php echo base_url() . 'uploads/img/noticias/' . get_image($noticia['imagen'],600,200, 'crop') ?>"/>
                        </a>
                        <div class="caption">
                            <h3><?php echo $noticia['titulo'] ?></h3>
                            <p><?php echo substr($noticia['texto'],0,255) . '...' ?></p>
                            <p><a href="<?php echo base_url() ?>noticia/<?php echo join('_',explode(' ',$noticia['titulo'])) ?>" class="btn btn-link"><i class="glyphicon glyphicon-plus"></i> Ver más</a></p>
                        </div>
                    </div>
                </div>
            
        <?php endforeach ?>
        </div>
    </div>

<?php
    $this->load->view('partials/footer',$footer);
?>