<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Session extends CI_Controller {
    public function __construct(){
        parent::__construct();
        $this->load->model('usuarios_model','',TRUE);
    }
    
    public function login()
    {
        $errores = $this->session->flashdata('errores');
        if(!$errores) $errores = array();
        $data_view['heading'] = array('title' => 'CMS - Login');
        $data_view['nav'] = array('brand' => 'CMS', 'selected' => 'none');
        $data_view['footer'] = array();
        $data_view['errores'] = $errores;
        $this->load->view('cms/login',$data_view);
    }
    
    public function do_login()
    {
        $user = $this->input->post('user');
        $pass = $this->input->post('password');
        $this->load->model('usuarios_model');
        $result = $this->usuarios_model->login($user,$pass);
        $error_login = $result['error'];
        if(!$error_login)
        {
            $user_data = $result['user_data'];
            $this->session->set_userdata('user',$user_data);
            redirect('cms/noticias','refresh','200');
        } else {
            $this->session->set_flashdata('errores', $error_login);
            redirect('cms/session/login','refresh','500');
        }
    }
    
    public function logout()
    {
        $this->session->unset_userdata('user');
        $this->login();
    }
 }