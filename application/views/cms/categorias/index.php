<?php
    $this->load->view('partials/heading',$heading);
    $this->load->view('partials/cms/navbar',$nav);
?>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">
                Categorias
            </div>
            <div class="panel-body">
                <div class="col-md-10">
                    <form method="GET" id="form_busqueda" class="form-inline" action="<?php base_url() ?>categorias">
                        <input type="text" name="buscar" placeholder="Buscar por titulo..." class="form-control" value="<?php echo $busqueda ?>"/>
                        <button type="submit"  class="btn btn-default">
                            <span class="glyphicon glyphicon-search"></span> Buscar
                        </button>
                    </form>
                </div>
                <div class="col-md-2">
                    <a class="btn btn-primary" href="<?php echo base_url(); ?>cms/categorias/nueva"><i class="glyphicon glyphicon-plus-sign"></i> Nueva Categoria</a>
                </div>
            </div>
            <table class="table">
                <thead>
                    <th># <i class="glyphicon glyphicon-chevron-up"></i> <i class="glyphicon glyphicon-chevron-down"></i></th>
                    <th>Titulo <i class="glyphicon glyphicon-chevron-up"></i> <i class="glyphicon glyphicon-chevron-down"></i></th>
                    <th>Activo</th>
                    <th colspan="2">Acciones</th>
                </thead>
                <tbody>
                    <?php foreach($categorias as $categoria) : ?>
                        <tr>
                            <td><?php echo $categoria['id'] ?></td>
                            <td><?php echo ucwords($categoria['titulo']) ?></td>
                            <td>
                                <?php if ($categoria['activo'] == '1'): ?>
                                    <i class="glyphicon glyphicon-ok"></i>
                                <?php else : ?>
                                    <i class="glyphicon glyphicon-remove"></i>
                                <?php endif ?>
                            </td>
                            <td>
                                <a href="<?php echo base_url() ?>cms/categoria/<?php echo $categoria['id'] ?>/edit" class="btn btn-primary">
                                    <i class="glyphicon glyphicon-pencil"></i> Editar
                                </a>
                            </td>
                            <td>
                                <?php $url_eliminar =  base_url().'cms/categoria/'.$categoria['id'].'/delete' ?>
                                <a href="<?php echo $url_eliminar ?>" onclick="return confirm('La noticia sera eliminada definitivamente.\n ¿De acuerdo?')" class="btn btn-danger">
                                    <i class="glyphicon glyphicon-trash"></i> Eliminar
                                </a>
                            </td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </div>

<?php
    $this->load->view('partials/footer', $footer);
?>