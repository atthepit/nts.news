<?php
    $this->load->view('partials/heading',$heading);
    $this->load->view('partials/cms/navbar',$nav);
?>

    <script>
        $('#form_crear').validate({
            submitHandler: function(form) {
            
                var hay_errores = false;
                $("label.error, input.error, select.error, textarea.error").removeClass("error");
                
                $(".required").each(function(){
                    if($(this).val().trim() =="" || $(this).val().trim() == -1){
                        $(this).addClass("error");                            
                        hay_errores = true;
                    }
                });
                //marca el primero de los campos con errores.
                $("input.error, select.error, textarea.error").first().focus();
                if($('#tiene_imagen').val() == 0 && $('#img').val() == '')
                {
                    $('#img').addClass('error');
                    hay_errores = true;
                }
                
                return hay_errores;
            }
        });
    </script>
    <?php foreach($errores as $error) : ?>
        <div class="alert alert-danger">
            <?php echo $error; ?>
        </div>
    <?php endforeach ?>
    
    <div class="container">
        <?php
            $action = 'cms/noticias/crear';
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
                    <div id="noticia" class="form-group">
                        <label for="titulo">Titulo*:</label>
                        <input type="text" class="form-control required" id="titulo" name="titulo" placeholder="Titulo de la noticia" />
                        <label for="texto">Texto*:</label>
                        <textarea class="form-control required" rows="5" id="texto" name="texto" placeholder="Introduce el texto de tu noticia"></textarea>
                        <label for="categoria">Categoria:</label>
                        <select id="categoria" class="form-control" name="categoria">
                            <?php foreach($categorias as $categoria) : ?>
                            <option value="<?php echo $categoria['id']; ?>"><?php echo ucwords($categoria['titulo']) ?></option>
                            <?php endforeach ?>
                        </select>
                        <input type="checkbox" value="activo" name="activo" checked /> Activo
                    </div>
                </div>
            </div>
            <div class="panel panel-default">
                <div class="panel-body">
                    <div id="imagenes" class="form-group">
                        <label for="imagen">Imagen de la noticia*:</label>
                        <input type="file" id="imagen" name="imagen" class="required" />
                        <label for="alt_img">Texto alternativo:</label>
                        <input type="text" id="alt_img" name="alt_img" class="form-control required" placeholder="Texto alternativo para la imagen" />
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-primary" value="Publicar" onclick="return validate();"/> <a class="btn btn-link" href="<?php echo base_url(); ?>cms/noticias">Cancelar</a>
        <?php echo form_close(); ?>
    </div>

<?php 
    $this->load->view('partials/footer',$footer);
?>