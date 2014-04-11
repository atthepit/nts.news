<?php

class Noticias_model extends CI_Model
{
    private $table_name = 'noticia';
    public function __construct()
    {
        parent::__construct();
    }
    
    public function create($noticia)
    {
        $this->db->insert($this->table_name, $noticia);
        $id_noticia = -1;
        $error_noticia = NULL;
        $result = array('id_noticia' => $id_noticia, 'error' => $error_noticia);
        $error_noticia = $this->db->_error_message();
        if($error_noticia)
        {
            $result['error'] = $error_noticia;
        } else {
            $id_noticia = $this->db->insert_id();
            $result['id_noticia'] = $id_noticia;
        }
        return $result;
    }
    
    public function get_all($offset = 0, $limit = 20, $order_by = 'id', $direction = 'ASC')
    {
        $this->db->select('n.*, c.titulo as categoria, img.nombre as imagen, img.alt as alt_img');
        $this->db->from($this->table_name . ' n');
        $this->db->join('categoria c', 'c.id = n.id_categoria');
        $this->db->join('imagen img', 'img.id = n.id_imagen');
        $this->db->limit($limit, $offset);
        $this->db->order_by($order_by, $direction);
        $query = $this->db->get();
        $result = $query->num_rows() > 0 ? $query->result_array() : array();
        return $result;
    }
    
    public function get($noticia, $offset = 0, $limit = 20, $order_by = 'id', $direction = 'ASC')
    {
        $this->db->select('n.*, c.titulo as categoria, img.nombre as imagen, img.alt as alt_img');
        $this->db->from($this->table_name . ' n');
        $this->db->join('categoria c', 'c.id = n.id_categoria');
        $this->db->join('imagen img', 'img.id = n.id_imagen');
        $this->db->where($noticia);
        $this->db->limit($limit, $offset);
        $this->db->order_by($order_by, $direction);
        $query = $this->db->get();
        $result = $query->num_rows() > 0 ? $query->result_array() : array();
    
        return $result;   
    }
    
    public function get_by_id($id_noticia)
    {
        $result = $this->get(array('n.id' => $id_noticia));
        return $result[0];
    }
    
    public function get_id_imagen($id_noticia)
    {
        $this->db->select('id_imagen');
        $this->db->from($this->table_name);
        $this->db->where('id',$id_noticia);
        $query = $this->db->get();
        $result = $query->result_array();
        $noticia = $result[0];
        return $noticia['id_imagen'];
    }
    
    public function get_all_like($like, $offset = 0, $limit = 20, $order_by = 'id', $direction = 'ASC')
    {
        $this->db->select('n.*, c.titulo as categoria, img.nombre as imagen, img.alt as alt_img');
        $this->db->from($this->table_name . ' n');
        $this->db->join('categoria c', 'c.id = n.id_categoria');
        $this->db->join('imagen img', 'img.id = n.id_imagen');
        $this->db->like('n.titulo',$like);
        $this->db->limit($limit, $offset);
        $this->db->order_by($order_by, $direction);
        $query = $this->db->get();
        $result = $query->num_rows() > 0 ? $query->result_array() : array();
        return $result;
    }
    
    public function get_like($noticia, $like, $offset = 0, $limit = 20, $order_by = 'id', $direction = 'ASC')
    {
        $this->db->select('n.*, c.titulo as categoria, img.nombre as imagen, img.alt as alt_img');
        $this->db->from($this->table_name . ' n');
        $this->db->join('categoria c', 'c.id = n.id_categoria');
        $this->db->join('imagen img', 'img.id = n.id_imagen');
        $this->db->where($noticia);
        $this->db->like('n.titulo',$like);
        $this->db->limit($limit, $offset);
        $this->db->order_by($order_by, $direction);
        $query = $this->db->get();
        $result = $query->num_rows() > 0 ? $query->result_array() : array();
        return $result;   
    }
    
    public function get_latest($limit = 20) 
    {
        $offset = 0;
        $order_by = 'fecha_publicacion';
        $noticia = array('n.activo' => 1);
        $direction = 'DESC';
        return $this->get($noticia, $offset, $limit, $order_by, $direction);
    }
    
    public function get_by_titulo($titulo)
    {
        $noticia = array('n.titulo' => $titulo);
        $resultado = $this->get($noticia);
        return $resultado[0];
    }
    
    public function get_total($noticia)
    {
        //TODO: Hacer que devuelva el numero de columnas que tiene esa query
        $this->db->select();
        $this->db->from($this->table_name . ' n');
        $this->db->join('categoria c', 'c.id = n.id_categoria');
        $this->db->join('imagen img', 'img.id = n.id_imagen');
        $this->db->where($noticia);
        $this->db->group_by('n.id');
        $query = $this->db->get();
        $result = $query->result_array();
        return count($result);
    }
    
    public function update($id_noticia, $noticia)
    {
        $this->db->where('id', $id_noticia);
        $modificado = $this->db->update($this->table_name, $noticia);
        $error = 'NULL';
        if ($this->db->_error_message()) $error = $this->db->_error_message();
        $result_imagen = array('error' => $error, 'id_noticia' => $id_noticia);
    }
    
    public function update_id_imagen($id_noticia, $id_imagen)
    {
        $parameters = array('id_imagen' => $id_imagen);
        return $this->update($id_noticia,$parameters);
    }
    
    public function delete($noticia)
    {
        return $this->db->delete($this->table_name, $noticia);
    }
    
    public function delete_by_id($id_noticia)
    {
        return $this->delete(array('id' => $id_noticia));
    }
}