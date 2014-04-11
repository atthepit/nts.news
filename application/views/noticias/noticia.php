<?php 
    $this->load->view('partials/heading',$heading);
    $this->load->view('partials/front/navbar', $nav);
?>

    <div class="container">
        <div class="page-header">
            <h1><?php echo $noticia['titulo'] ?> <small><?php echo date('d-m-Y',strtotime($noticia['fecha_publicacion'])) ?></small></h1>
        </div>
        <img src="<?php echo base_url() . 'uploads/img/noticias/' . get_image($noticia['imagen'],400,250,'fill') ?>" class="pull-left img-responsive img-thumbnail" style="margin: 10px" />
        <p><?php echo $noticia['texto'] ?></p>
    </div>

<?php
    $this->load->view('partials/footer',$footer);
?>