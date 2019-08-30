<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class M_login extends CI_Model
{
    //fungsi cek session
    function logged_id()
    {
        return $this->session->userdata('user_id');
    }

    //fungsi check login
    function check_login($table, $field1, $field2)
    {
        $this->db->select('*');
        $this->db->from($table);
        $this->db->where($field1);
        $this->db->where($field2);
        $this->db->limit(1);
        $query = $this->db->get();
        if ($query->num_rows() == 0) {
            return FALSE;
        } else {
            return $query->result();
        }
    }

   public function getJoin($table1,$table2,$c_table1,$c_table2, $c_join, $where)
    {
        $this->db->select($table1.'.'.$c_table1.','.$table2.'.'.$c_table2);
        $this->db->from($table1);
        $this->db->join($table2, $c_join);
        $this->db->where($where);
        return $this->db->get()->row();
    }
}