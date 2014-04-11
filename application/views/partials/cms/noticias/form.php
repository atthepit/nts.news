<div class="panel panel-default">
    <div class="panel-body">
        <div id="noticia" class="form-group">
            <label for="titulo">Titulo*:</label>
            <input type="text" class="form-control required" id="titulo" name="titulo" placeholder="Titulo de la noticia" value="<?php echo $noticia['titulo'] ?>" />
            <label for="texto">Texto*:</label>
            <textarea class="form-control required" rows="5" id="texto" name="texto" placeholder="Introduce el texto de tu noticia"><?php echo $noticia['texto'] ?></textarea>
            <label for="categoria">Categoria:</label>
            <select id="categoria" class="form-control" name="categoria">
                <?php foreach($categorias as $categoria) : ?>
                <option value="<?php echo $categoria['id']; ?>" <?php if($noticia['id_categoria'] == $categoria['id']) echo 'selected'; ?>>
                    <?php echo ucwords($categoria['titulo']) ?>
                </option>
                <?php endforeach ?>
            </select>
            <input type="checkbox" value="activo" name="activo" <?php if($noticia['activo']) echo 'checked' ?> /> Activo
        </div>
    </div>
</div>

<div class="panel panel-default">
    <div class="panel-body">
        <div id="imagenes" class="form-group">
            <div class="row">
                <div class="col-md-2">
                    <img class="img-responsive img-rounded" src="<?php echo base_url() . 'uploads/img/noticias/' . get_image($noticia['imagen'],150,110,'crop') ?>" />
                </div>
                <div class="col-md-10">
                    <label for="imagen">Imagen de la noticia*:</label>
                    <input type="file" id="imagen" name="imagen" class="required" />
                    <label for="alt_img">Texto alternativo:</label>
                    <input type="text" id="alt_img" name="alt_img" class="form-control" placeholder="Texto alternativo para la imagen" value="<?php echo $noticia['alt_img'] ?>" />
                </div>
            </div>
        </div>
    </div>
</div>