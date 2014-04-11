<?php

class Imagenes_model extends CI_Model
{
    private $table_name = 'imagen';
    public function __construct()
    {
        parent::__construct();
    }
    
    public function create($img_name = '', $alt_imagen = '')
    {
        $imagen = array( 'nombre' => $img_name, 'alt' => $alt_imagen);
        $this->db->insert($this->table_name,$imagen);
        $id_imagen = $this->db->insert_id();
        return $id_imagen;
    }
    
    public function update($id_imagen, $imagen)
    {
        $this->db->where('id', $id_imagen);
        $this->db->update($this->table_name, $imagen);
        $error = NULL;
        if ($this->db->_error_message()) $error = $this->db->_error_message();
        return $result_imagen = array('error' => $error, 'id_imagen' => $id_imagen);
    }
    
    public function update_alt($id_imagen, $alt)
    {
        $parameters = array('alt' => $alt);
        return $this->update($id_imagen,$parameters);
    }
}