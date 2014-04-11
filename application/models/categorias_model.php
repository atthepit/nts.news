<?php

class Categorias_model extends CI_Model
{
    private $table_name = 'categoria';
    
    public function get_all($offset = 0, $limit = 20, $order_by = 'titulo', $direction = 'ASC')
    {
        $this->db->select();
        $this->db->from($this->table_name);
        $this->db->order_by($order_by,$direction);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        $result = $query->num_rows() > 0 ? $query->result_array() : array();
        return $result;
    }
    
    public function get($categoria, $offset = 0, $limit = 20, $order_by = 'titulo', $direction = 'ASC')
    {
        $this->db->select();
        $this->db->from($this->table_name);
        $this->db->where($categoria);
        $this->db->order_by($order_by,$direction);
        $this->db->limit($limit,$offset);
        $query = $this->db->get();
        $result = $query->num_rows() > 0 ? $query->result_array() : array();
        return $result;
    }
    
    public function get_by_titulo($titulo, $offset = 0, $limit = 20, $order_by = 'titulo', $direction = 'ASC')
    {
        $categoria = array('titulo' => $titulo);
        $result = $this->get($categoria,$offset, $limit, $order_by, $direction);
        return $result[0];
    }
    
    public function get_by_id($id_categoria, $offset = 0, $limit = 20, $order_by = 'titulo', $direction = 'ASC')
    {
        $categoria = array('id' => $id_categoria);
        $result = $this->get($categoria,$offset, $limit, $order_by, $direction);
        $categoria = NULL;
        $error = NULL;
        if(!empty($result))
        {
            $categoria = $result[0];
        }
        else
        {
            $error = $this->db->_error_message();
        }
        $result_categoria = array('categoria' => $categoria, 'error' => $error);
        return $result_categoria;
    }
    
    public function get_all_active($offset = 0, $limit = 20, $order_by = 'titulo', $direction = 'ASC')
    {
        $categoria = array('activo' => '1');
        $result = $this->get($categoria,$offset, $limit, $order_by, $direction);
        return $result;
    }
    
    public function get_all_like($busqueda, $offset = 0, $limit = 20, $order_by = 'titulo', $direction = 'ASC')
    {
        $this->db->select();
        $this->db->from($this->table_name);
        $this->db->order_by($order_by,$direction);
        $this->db->limit($limit,$offset);
        $this->db->like('titulo',$busqueda);
        $query = $this->db->get();
        $result = $query->num_rows() > 0 ? $query->result_array() : array();
        return $result;
    }
    
    public function create($categoria)
    {
        $this->db->insert($this->table_name,$categoria);
        $id_categoria = -1;
        $error_categoria = NULL;
        $result = array('id_categoria' => $id_categoria, 'error' => $error_categoria);
        $error_categoria = $this->db->_error_message();
        if($error_categoria)
        {
            $result['error'] = $error_categoria;
        } else {
            $id_categoria = $this->db->insert_id();
            $result['id_categoria'] = $id_categoria;
        }
        return $result;
    }
    
    public function delete($categoria)
    {
        return $this->db->delete($this->table_name, $categoria);
    }
    
    public function delete_by_id($id_categoria)
    {
        return $this->delete(array('id' => $id_categoria));
    }
    
    public function update($id_categoria, $categoria)
    {
        $this->db->where('id', $id_categoria);
        $this->db->update($this->table_name,$categoria);
    }
}