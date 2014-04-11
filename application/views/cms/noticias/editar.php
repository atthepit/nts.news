<?php
    $this->load->view('partials/heading',$heading);
    $this->load->view('partials/cms/navbar',$nav);
?>

    <?php foreach($errores as $error) : ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    <div class="container">
        <?php
            $action = 'cms/noticias/guardar_noticia/' . $noticia['id'];
            $parameters = array(
                            'id'      => 'form_editar',
                            'role'    => 'form',
                            'enctype' => 'multipart/form-data',
                            'method'  => 'POST'
                            );
            echo form_open($action,$parameters);
        ?>
            <?php $this->load->view('partials/cms/noticias/form',$noticia) ?>
            <input type="submit" class="btn btn-primary" value="Guardar Cambios"/> <a class="btn btn-link" href="<?php echo base_url(); ?>cms/noticias">Cancelar</a>
        <?php echo form_close(); ?>
    </div>

<?php 
    $this->load->view('partials/footer',$footer);
?>