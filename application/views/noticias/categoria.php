<?php 
    $this->load->view('partials/heading',$heading);
    $this->load->view('partials/front/navbar', $nav);
?>

    <div class="container">
        <?php if(empty($noticias)): ?>
            <h3>No existen noticias para esta categoría.</h3>
        <?php endif ?>
        <ul class="media-list">
            <?php foreach($noticias as $noticia) : 
                    $url_noticia = base_url(). 'noticia/' . join('_',explode(' ',urlencode(utf8_encode($noticia['titulo'])))); 
            ?>
                <li class="media">
                    <a class="pull-left" href="<?php echo $url_noticia?>">
                        <img class="media-object img-circle" src="<?php echo base_url() . 'uploads/img/noticias/' . get_image($noticia['imagen'], 100,100,'crop') ?>" alt="<?php echo $noticia['alt_img'] ?>" />
                    </a>
                    <div class="media-body">
                        <h4 class="media-heading"><?php echo $noticia['titulo'] ?></h4>
                        <p><?php echo substr($noticia['texto'],0,450) . '...' ?></p>
                        <a href="<?php echo $url_noticia ?>" class="btn btn-link" >Ver más</a>
                    </div>
                </li>
            <?php endforeach ?>
        </ul>
        <?php $this->load->view('partials/pagination',$pagination); ?>
    </div>
<?php
    $this->load->view('partials/footer',$footer);
?>