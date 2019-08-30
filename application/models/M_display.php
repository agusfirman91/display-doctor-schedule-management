<?php 

class M_display extends CI_Model
{

   
    public function getAll($table)
    {
        return $this->db->get($table)->result();

    }

    public function getJoin($table1,$table2,$c_table1,$c_table2, $c_join, $where, $where2)
    {
        $this->db->select($table1.'.'.$c_table1.','.$table2.'.'.$c_table2);
        $this->db->from($table1);
        $this->db->join($table2, $c_join);
        $this->db->where ( $where);
        $this->db->where ( $where2);
        return $this->db->get()->result();
    }

    public function getAllJoin($table1,$table2,$table3,$c_table1,$c_table2,$c_table3, $c_join1,$c_join2,$where,$where2)
    {
        $c_table = "$table1.$c_table1, $table2.$c_table2, $table3.$c_table3";
        $this->db->select ( $c_table ); 
        $this->db->from ( $table1 );
        $this->db->join ( $table2, $c_join1 , 'left' );
        $this->db->join ( $table3, $c_join2 , 'left' );
        $this->db->where ( $where);
        $this->db->where ( $where2);
        $query = $this->db->get(); 
        return $query->result();
    }
     public function getAllJoinRow($table1,$table2,$table3,$c_table1,$c_table2,$c_table3, $c_join1,$c_join2,$where,$where2)
    {
        $c_table = "$table1.$c_table1, $table2.$c_table2, $table3.$c_table3";
        $this->db->select ( $c_table ); 
        $this->db->from ( $table1 );
        $this->db->join ( $table2, $c_join1 , 'left' );
        $this->db->join ( $table3, $c_join2 , 'left' );
        $this->db->where ( $where);
        $this->db->where ( $where2);
        $query = $this->db->get(); 
        return $query->row();
    }

    function getWhere($table, $where)
    {
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get(); 
        return $query->row();
    }
    
    function getById($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id',$id);
        $query = $this->db->get(); 
        return $query->row();
    }

    function check_unique_specialist_doctor($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id',$id);
        $query = $this->db->get(); 
        return $query->row();
    }
}