<?php
    $this->load->view('partials/heading',$heading);
    $this->load->view('partials/cms/navbar',$nav);
?>
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Noticias</div>
            <div class="panel-body">
                <div class="col-md-10">
                    <form method="GET" id="form_busqueda" class="form-inline" action="<?php base_url() ?>noticias">
                        <input type="text" name="buscar" placeholder="Buscar por titulo..." class="form-control" value="<?php echo $busqueda ?>"/>
                        <select id="categoria" class="form-control" name="categoria">
                            <option value="0">Todas</option>
                            <?php foreach($categorias as $categoria) : ?>
                            <option value="<?php echo $categoria['id']; ?>" <?php if($categoria_get == $categoria['id']) echo 'selected'; ?>>
                                <?php echo ucwords($categoria['titulo']) ?>
                            </option>
                            <?php endforeach ?>
                        </select>
                        <button type="submit"  class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span> Buscar
                        </button>
                    </form>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>cms/noticias/nueva"><i class="glyphicon glyphicon-plus-sign"></i> Nueva Noticia</a>
                </div>
            </div>
            <table class="table">
                <col width="10%" />
                <col width="10%" />
                <col width="20%" />
                <col width="35%" />
                <col width="15%" />
                <col width="60%" />
                <col width="50%" />
                <thead>
                    <th>Imagen</th>
                    <th>
                        #
                        <a href="<?php echo base_url() ?>cms/noticias?order=id&direccion=ASC<?php if($busqueda) echo "&buscar=".$busqueda ?><?php if($categoria_get) echo "&categoria=".$categoria_get ?>">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </a>
                        <a href="<?php echo base_url() ?>cms/noticias?order=id&direccion=DESC<?php if($busqueda) echo "&buscar=".$busqueda ?><?php if($categoria_get) echo "&categoria=".$categoria_get ?>">
                            <i class="glyphicon glyphicon-chevron-down"></i>
                        </a>
                    </th>
                    <th>
                        Titulo
                        <a href="<?php echo base_url() ?>cms/noticias?order=titulo&direccion=ASC<?php if($busqueda) echo "&buscar=".$busqueda ?><?php if($categoria_get) echo "&categoria=".$categoria_get ?>">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </a>
                        <a href="<?php echo base_url() ?>cms/noticias?order=titulo&direccion=DESC<?php if($busqueda) echo "&buscar=".$busqueda ?><?php if($categoria_get) echo "&categoria=".$categoria_get ?>">
                            <i class="glyphicon glyphicon-chevron-down"></i>
                        </a>
                    </th>
                    <th>Texto</th>
                    <th>Categoria</th>
                    <th>
                        Fecha<br />
                        <a href="<?php echo base_url() ?>cms/noticias?order=fecha_publicacion&direccion=ASC<?php if($busqueda) echo "&buscar=".$busqueda ?><?php if($categoria_get) echo "&categoria=".$categoria_get ?>">
                            <i class="glyphicon glyphicon-chevron-up"></i>
                        </a>
                        <a href="<?php echo base_url() ?>cms/noticias?order=fecha_publicacion&direccion=DESC<?php if($busqueda) echo "&buscar=".$busqueda ?><?php if($categoria_get) echo "&categoria=".$categoria_get ?>">
                            <i class="glyphicon glyphicon-chevron-down"></i>
                        </a>
                    </th>
                    <th>Activo</th>
                    <th colspan="2">Acciones</th>
                </thead>
                <tbody>
                    <?php foreach($noticias as $noticia) : ?>
                        <tr>
                            <td><img class="img-rounded img-responsive" src="<?php echo base_url() . 'uploads/img/noticias/' . get_image($noticia['imagen'],90,90,'crop') ?>" alt="<?php echo $noticia['alt_img'] ?>" height="140" width="70" /></td>
                            <td><?php echo $noticia['id'] ?></td>
                            <td><?php echo $noticia['titulo'] ?></td>
                            <td><?php echo substr($noticia['texto'],0,255) . '...' ?></td>
                            <td><?php echo ucwords($noticia['categoria']) ?></td>
                            <td><?php echo date('d-m-Y',strtotime($noticia['fecha_publicacion'])) ?></td>
                            <td>
                                <?php if ($noticia['activo'] == '1'): ?>
                                    <i class="glyphicon glyphicon-ok"></i>
                                <?php else : ?>
                                    <i class="glyphicon glyphicon-remove"></i>
                                <?php endif ?>
                            </td>
                            <td><a href="<?php echo base_url() ?>cms/noticia/<?php echo $noticia['id'] ?>/edit" class="btn btn-primary"><i class="glyphicon glyphicon-pencil"></i> Editar</a></td>
                            <td>
                                <?php $url_eliminar =  base_url().'cms/noticia/'.$noticia['id'].'/delete' ?>
                                <a href="<?php echo $url_eliminar ?>" onclick="return confirm('La noticia sera eliminada definitivamente.\n ¿De acuerdo?')" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
<?php
    $this->load->view('partials/footer', $footer);
?>