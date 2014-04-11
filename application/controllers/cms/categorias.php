<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Categorias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('categorias_model','',TRUE);
    }
    
    public function index()
    {
        if($this->session->userdata('user'))
        {
            $offset = 0; //Cambiar por valores pasados por parámetros GET
            $limit = 20; // " "
            $order_by = isset($_GET['order']) ? $this->input->get('order') : 'id';
            $direction = isset($_GET['direccion']) ? $this->input->get('direccion') : 'ASC';
            $busqueda = $this->input->get('buscar');
            if($busqueda)
            {
                $categorias = $this->categorias_model->get_all_like($busqueda,$offset,$limit,$order_by,$direction);
            } else
            {
                $categorias = $this->categorias_model->get_all($offset,$limit,$order_by,$direction);
            }
            $data_view['categorias'] = $categorias;
            $data_view['busqueda'] = $busqueda;
            $data_view['order'] = $order_by; 
            $data_view['heading'] = array('title' => 'CMS - Categorias');
            $data_view['nav'] = array('brand' => 'CMS', 'selected' => 'categorias');
            $data_view['footer'] = array();
	        $this->load->view('cms/categorias/index', $data_view); 
        }
        else
        {
            redirect('/cms/session/login','refresh');
        }
    }
    
    public function nueva()
    {
        if($this->session->userdata('user')){
            $errores = array();
            $data_view['errores'] = $errores;
            $data_view['heading'] = array('title' => 'CMS - Nueva Categoria');
            $data_view['nav'] = array('brand' => 'CMS', 'selected' => 'categorias');
            $data_view['footer'] = array();
	        $this->load->view('cms/categorias/nueva', $data_view); 
        }
        else
        {
            redirect('/cms/session/login','refresh');
        }
    }
    
    public function crear()
    {
        if($this->session->userdata('user')){
            $titulo = $this->input->post('titulo');
            $activo = $this->input->post('activo') ? '1' : '0';
            $categoria = array('titulo' => $titulo, 'activo' => $activo);
            $result = $this->categorias_model->create($categoria);
            $error = $result['error'];
            $categoria_id = $result['id_categoria'];
            if($error != NULL) 
            {
                $errores['error_categoria'] = $error;
                $this->session->set_flashdata('errores', $errores);
                redirect('cms/categorias/nueva','refresh','500');
            }
            
            redirect('cms/categorias','refresh','201');
        }
        else
        {
            redirect('/cms/session/login','refresh');
        }
    }
    
    public function editar($id_categoria)
    {
        if($this->session->userdata('user')){
            $result_categoria = $this->categorias_model->get_by_id($id_categoria);
            $errores = $result_categoria['error']? $result_categoria['error'] : array();
            $categoria = $result_categoria['categoria'];
            $data_view['errores'] = $errores;
            $data_view['categoria'] = $categoria;
            $data_view['id_categoria'] = $id_categoria;
            $data_view['heading'] = array('title' => 'CMS - Editar Categoria');
            $data_view['nav'] = array('brand' => 'CMS', 'selected' => 'categorias');
            $data_view['footer'] = array();
	        $this->load->view('cms/categorias/editar', $data_view);
        }
        else
        {
            redirect('/cms/session/login','refresh');
        }
    }
    
    public function guardar($id_categoria)
    {
        if($this->session->userdata('user'))
        {
            $titulo = $this->input->post('titulo');
            $activo = $this->input->post('activo') ? '1' : '0';
            $categoria = array('titulo' => $titulo, 'activo' => $activo);
            $result = $this->categorias_model->update($id_categoria, $categoria);
            $error = $result['error'];
            $categoria_id = $result['id_categoria'];
            if($error != NULL) 
            {
                $errores['error_categoria'] = $error;
                $this->session->set_flashdata('errores', $errores);
                redirect('cms/categorias/nueva','refresh','500');
            }
            
            redirect('cms/categorias','refresh','200');
        }
        else
        {
            redirect('/cms/session/login','refresh');
        }
    }
    
    public function eliminar($id_categoria)
    {
        if($this->session->userdata('user')){
            if($this->categorias_model->delete_by_id($id_categoria))
            {
                $status_code = '200';
            } else {
                $status_code = '500';
            }
            redirect('cms/categorias','refresh',$status_code);
        }
        else
        {
            redirect('/cms/session/login','refresh');
        }
    }
}