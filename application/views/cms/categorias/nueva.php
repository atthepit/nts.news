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
            $action = 'cms/categorias/crear';
            $parameters = array(
                            'id'      => 'form_crear',
                            'role'    => 'form',
                            'enctype' => 'multipart/form-data',
                            'method'  => 'POST'
                            );
            echo form_open($action, $parameters);
        ?>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="categoria" class="form-group">
                        <label for="titulo">Titulo*:</label>
                        <input type="text" class="form-control required" id="titulo" name="titulo" placeholder="Titulo de la categoria" />
                        <input type="checkbox" value="activo" name="activo" checked /> Activo
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Crear" onclick="return validate();"/> <a class="btn btn-link" href="<?php echo base_url(); ?>cms/categorias">Cancelar</a>
        <?php echo form_close(); ?>
    </div>
<?php
    $this->load->view('partials/footer', $footer);
?>