<?php
    $this->load->view('partials/heading',$heading);
    $this->load->view('partials/cms/navbar',$nav);
?>

    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading">Login</div>
            <div class="panel-body form-group">
                <?php echo form_open('cms/session/do_login',array('method' => 'POST')) ?>
                    <label for="user">Usuario:</label>
                    <input type="text" id="user" name="user" placeholder="Introduzca el email de usuario" class="form-control"/>
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" class="form-control" placeholder="Introduzca la contraseña del usuario"/><br />
                    <input type="submit" class="btn btn-primary" value="Entrar"/>
                <?php echo form_close() ?>
            </div>
        </div>
    </div>

<?php
    $this->load->view('partials/footer', $footer);
?>