<?php

class Usuarios_model extends CI_Model
{
    private $table_name = 'usuario';
    public function __construct()
    {
        parent::__construct();
    }
    
    public function login($user, $password)
    {
        $admin = 1;
        $this->db->select();
        $this->db->from($this->table_name);
        $this->db->where('email',$user);
        $this->db->where('password',$password);
        $this->db->where('rol',$admin);
        $query = $this->db->get();
        $user_data = NULL;
        $error = NULL;
        if($query->num_rows() == 1)
        {
            $result = $query->result_array();
            $user_data = array('email' => $result[0]['email']);
        } else {
            $error = "<p> Usuario o contraseña incorrectos </p>";
        }
        $result = array('user_data' => $user_data, 'error' => $error);
        return $result;
    }
}
    