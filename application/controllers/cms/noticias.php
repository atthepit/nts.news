<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('noticias_model','',TRUE);
        $this->load->model('categorias_model','',TRUE);
    }
    
    public function index() {
        if($this->session->userdata('user')) {
            $offset = 0; //Cambiar por valores pasados por parámetros GET
            $limit = 20; // " "
            $order_by = isset($_GET['order']) ? $this->input->get('order') : 'id';
            $direction = isset($_GET['direccion']) ? $this->input->get('direccion') : 'ASC';
            $categoria = $this->input->get('categoria');
            $busqueda = $this->input->get('buscar');
            $categoria_get = '0';
            if($categoria || $busqueda)
            {
                if($categoria != 0)
                {
                    $noticias = $this->noticias_model->get_like(array('id_categoria' => $categoria), $busqueda, $offset, $limit, $order_by,$direction);
                    $categoria_get = $categoria;
                }
                else
                {
                    $noticias = $this->noticias_model->get_all_like($busqueda, $offset, $limit, $order_by, $direction);
                }
            } 
            else 
            {
                $noticias = $this->noticias_model->get_all($offset, $limit, $order_by, $direction);
            }
            
            $categorias = $this->categorias_model->get_all();  
            $data_view['noticias'] = (array) $noticias;
            $data_view['categorias'] = $categorias;
            $data_view['busqueda'] = $busqueda;
            $data_view['categoria_get'] = $categoria_get;
            $data_view['order'] = $order_by; 
            $data_view['heading'] = array('title' => 'CMS - Noticias');
            $data_view['nav'] = array('brand' => 'CMS', 'selected' => 'noticias');
            $data_view['footer'] = array();
	        $this->load->view('cms/noticias/index', $data_view); 
        } else {
            redirect('cms/session/login','refresh','403');
        }
    }
    
    public function nueva() {
        if($this->session->userdata('user')) {
            $categorias = $this->categorias_model->get_all();
            $errores = $this->session->flashdata('errores');
            if(!$errores) $errores = array();
            $data_view['heading'] = array('title' => 'CMS');
            $data_view['nav'] = array('brand' => 'CMS', 'selected' => 'noticias');
            $data_view['categorias'] = $categorias;
            $data_view['footer'] = array();
            $data_view['errores'] = $errores;
    	    $this->load->view('cms/noticias/nueva', $data_view);
        } else {
            redirect('cms/session/login','refresh','403');
        }
    }
    
    private function upload_img($imagen = 'imagen', $alt_imagen = '')
    {
       if($this->session->userdata('user')) {
           $this->load->model('imagenes_model','', TRUE);
           $errores = array();
           
           $config['upload_path'] = './uploads/img/noticias';
    	   $config['allowed_types'] = 'gif|jpg|png';
       	   $config['max_size']	= '1000';
    	   $config['max_width']  = '1024';
    	   $config['max_height']  = '768';
            
    	   $this->load->library('upload', $config);
           $id_imagen = NULL;
           $error_imagen = NULL;
           if($this->upload->do_upload($imagen))
           {
               $img_data = $this->upload->data();
               $img_name = $img_data['file_name'];
               $id_imagen = $this->imagenes_model->create($img_name, $alt_imagen);
               
           } else {
               $error_imagen = $this->upload->display_errors();
           }
           return array('id_imagen' => $id_imagen, 'error' => $error_imagen);
        } else {
            redirect('cms/session/login','refresh','403');
        }
    }
    
    public function crear()
    {
        if($this->session->userdata('user')) {
           $titulo = $this->input->post('titulo');
           $texto = $this->input->post('texto');
           $categoria = $this->input->post('categoria');
           $activo = $this->input->post('activo') ? 1 : 0;
           $fecha = date('Y-m-d');
           $alt_imagen = $this->input->post('alt_img');
           $result_imagen = $this->upload_img('imagen',$alt_imagen);
           $error_imagen = $result_imagen['error'];
           $id_imagen = $result_imagen['id_imagen'];
           $errores = array();
           if($error_imagen == NULL)
           {
              $noticia = array( 'titulo' => $titulo,
                                'texto' => $texto,
                                'id_categoria' => $categoria,
                                'activo' => $activo,
                                'fecha_publicacion' => $fecha,
                                'id_imagen' => $id_imagen);
              $result_noticia = $this->noticias_model->create($noticia);
              $id_noticia = $result_noticia['id_noticia'];
              $error_noticia = $result_noticia['error'];
              if($error_noticia != NULL) 
              {
                    $errores['error_noticia'] = $error_noticia;
              }
           } else {
               $errores['error_imagen'] = $error_imagen;
           }
           
           if(!empty($errores))
           {
               $this->session->set_flashdata('errores', $errores);
               redirect('cms/noticias/nueva','refresh','500');
           }
           
           redirect('cms/noticias','refresh','201');
       } else {
            redirect('cms/session/login','refresh','403');
       }
    }
    
    public function borrar_noticia($id_noticia)
    {
        if($this->session->userdata('user')) {
            if($this->noticias_model->delete(array("id" => $id_noticia)))
            {
                $status_code = '200';
            } else {
                $status_code = '500';
            }
            redirect('cms/noticias','refresh',$status_code);
        } else 
        {
            redirect('cms/session/login','refresh','403');
        }
            
    }
    
    public function editar($id_noticia)
    {
        if($this->session->userdata('user')) {
            $noticia = $this->noticias_model->get_by_id($id_noticia);
            $categorias = $this->categorias_model->get_all();
            $errores = $this->session->flashdata('errores');
            if(!$errores) $errores = array();
            $data_view['heading'] = array('title' => 'CMS - '. $noticia['titulo']);
            $data_view['nav'] = array('brand' => 'CMS', 'selected' => 'noticias');
            $data_view['noticia'] = $noticia;
            $data_view['errores'] = $errores;
            $data_view['categorias'] = $categorias;
            $data_view['footer'] = array();
            $this->load->view('cms/noticias/editar',$data_view);
        } else {
            redirect('cms/session/login','refresh','403');
        }
    }
    
    private function cambiar_imagen($id_noticia, $imagen, $alt_imagen)
    {
        $result_imagen = $this->upload_img($imagen,$alt_imagen);
        $error_imagen = $result_imagen['error'];
        $id_imagen = $result_imagen['id_imagen'];
        if ($error_imagen == NULL)
        {
            $this->noticias_model->update_id_imagen($id_noticia,$id_imagen);
        }
        return $result_imagen;
    }
    
    public function guardar_noticia($id_noticia)
    {
        if($this->session->userdata('user')) {
            $titulo = $this->input->post('titulo');
            $texto = $this->input->post('texto');
            $categoria = $this->input->post('categoria');
            $activo = $this->input->post('activo') ? 1 : 0 ;
            $imagen = 'imagen';
            $alt_imagen = $this->input->post('alt_img');
            
            //comprobar si hay imagen
            //si la hay cambiar la actual y subir la nueva
            //si no, comprobar el alt
            //si no está vacio, cambiarlo en la imagen original
            //si todo ha ido bien, realizar el update en la noticia
            //si no, volver la pagina de edicion mostrando los errores
            $errores = array();
            
            $hay_imagen = isset($_FILES['imagen']) && (!empty($_FILES['imagen']['name']));
            
            if($hay_imagen)
            {
                $result_imagen = $this->cambiar_imagen($id_noticia,$imagen,$alt_imagen);
            } else {
                if(trim($alt_imagen) != "")
                {
                    $this->load->model('imagenes_model','',TRUE);
                    $id_imagen = $this->noticias_model->get_id_imagen($id_noticia);
                    $result_imagen = $this->imagenes_model->update_alt($id_imagen,$alt_imagen);
                }
                else
                {
                    $result_imagen['id_imagen'] = $this->noticias_model->get_id_imagen($id_noticia);
                }
            }
            
            $error_imagen = $result_imagen['error'];
            $id_imagen = $result_imagen['id_imagen'];
            
            
            if($error_imagen == NULL)
            {
                $noticia = array(   'titulo' => $titulo,
                                    'texto' => $texto,
                                    'id_categoria' => $categoria,
                                    'activo' => $activo,
                                    'id_imagen' => $id_imagen);

                $result_noticia = $this->noticias_model->update($id_noticia, $noticia);
                $error_noticia = $result_noticia['error'];
                if($error_noticia == NULL)
                {
                    redirect('cms/noticias','refresh','200');
                } else
                {
                    $errores['error_noticia'] = $error_noticia;
                }
            } else 
            {
                $errores['error_imagen'] = $error_imagen;
            }
            
            if(!empty($errores))
            {
                $this->session->set_flashdata('errores', $errores);
                redirect('cms/noticia/' . $id_noticia . '/edit', 'refresh', '500');
            }

        } else {
            redirect('cms/session/login','refresh','403');
        }
    }
    
    public function categorias()
    {
        
    }
}
?>