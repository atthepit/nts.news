<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Noticias extends CI_Controller {

    public function __construct()
    {
        parent::__construct();
        $this->load->model('noticias_model','',TRUE);
        $this->load->model('categorias_model','',TRUE);
    }
    
    public function index()
    {
        $heading = array('title' => 'Noticias');
        $footer = array();
        $categorias = $this->categorias_model->get_all_active();
        $nav = array('brand' => 'Front', 'categorias' => $categorias);
        $limit = 10;
        $noticias = $this->noticias_model->get_latest($limit);
   
        $data_view['heading'] = $heading;
        $data_view['nav'] = $nav;
        $data_view['noticias'] = $noticias;
        $data_view['footer'] = $footer;
        
        $this->load->view('noticias/index',$data_view);
    }
    
    public function categoria($titulo)
    {
        $heading = array('title' => 'Noticias - '.ucwords(urldecode($titulo)));
        $footer = array();
        $categorias = $this->categorias_model->get_all_active();
        $nav = array('brand' => 'Front', 'categorias' => $categorias);
        
        $categoria = $this->categorias_model->get_by_titulo(urldecode($titulo));
        $id_categoria = $categoria['id'];
        $offset = isset($_GET['offset']) ? $this->input->get('offset') : 0;
        $limit  = isset($_GET['limit'])  ? $this->input->get('limit')  : 20;
        $noticia = array('id_categoria' => $id_categoria, 'n.activo' => '1');
        $noticias = $this->noticias_model->get($noticia,$offset,$limit,'fecha_publicacion');
        $total = $this->noticias_model->get_total($noticia);
        $pagination = array('offset' => $offset, 'total' => $total, 'limit' => $limit);
        
        $data_view['heading'] = $heading;
        $data_view['nav'] = $nav;
        $data_view['noticias'] = $noticias;
        $data_view['pagination'] = $pagination;
        $data_view['categoria'] = $titulo;
        $data_view['footer'] = $footer;
        
        $this->load->view('noticias/categoria', $data_view);
    }
    
    public function noticia($seo_titulo)
    {
        $titulo = join(' ',explode('_',utf8_decode(urldecode(utf8_decode($seo_titulo)))));
        $noticia = $this->noticias_model->get_by_titulo($titulo);
        $heading = array('title' => $noticia['titulo']);
        $footer = array();
        $categorias = $this->categorias_model->get_all_active();
        $nav = array('brand' => 'Front', 'categorias' => $categorias);
        
        $data_view['heading'] = $heading;
        $data_view['nav'] = $nav;
        $data_view['noticia'] = $noticia;
        $data_view['footer'] = $footer;
        
        $this->load->view('noticias/noticia', $data_view);
    }
    public function noticia_por_id($id)
    {
        $noticia = $this->noticias_model->get_by_id($id);
        $heading = array('title' => $noticia['titulo']);
        $footer = array();
        $categorias = $this->categorias_model->get_all_active();
        $nav = array('brand' => 'Front', 'categorias' => $categorias);
        
        $data_view['heading'] = $heading;
        $data_view['nav'] = $nav;
        $data_view['noticia'] = $noticia;
        $data_view['footer'] = $footer;
        
        $this->load->view('noticias/noticia', $data_view);
    }
}