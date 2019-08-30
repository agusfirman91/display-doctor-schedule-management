<?php

class M_main extends CI_Model
{

    public function getAll($table)
    {
        return $this->db->get($table)->result();
    }

    public function getAllOrder($table, $order)
    {
        $this->db->order_by($order, 'ASC');
        return $this->db->get($table)->result();
    }

    function getWhere($table, $where)
    {
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->result();
    }


    public function getJoin($table1, $table2, $c_table1, $c_table2, $c_join)
    {
        $this->db->select($table1 . '.' . $c_table1 . ',' . $table2 . '.' . $c_table2);
        $this->db->from($table1);
        $this->db->join($table2, $c_join);
        return $this->db->get()->result();
    }

    public function getJoinGroupBy($table1, $table2, $c_table1, $c_table2, $c_join, $groupBy)
    {
        $this->db->select($table1 . '.' . $c_table1 . ',' . $table2 . '.' . $c_table2);
        $this->db->from($table1);
        $this->db->join($table2, $c_join);
        $this->db->group_by($groupBy);
        return $this->db->get()->result();
    }

    function getWhereJoin($table1, $table2, $c_table1, $c_table2, $c_join, $where)
    {
        $this->db->select($table1 . '.' . $c_table1 . ',' . $table2 . '.' . $c_table2);
        $this->db->from($table1);
        $this->db->join($table2, $c_join);
        $this->db->where($where);
        return $this->db->get()->result();
    }


    function getWhereJoinNotIn($table1, $table2, $c_table1, $c_table2, $c_join, $where)
    {
        $this->db->select($table1 . '.' . $c_table1 . ',' . $table2 . '.' . $c_table2);
        $this->db->from($table1);
        $this->db->join($table2, $c_join);
        $this->db->where_not_in($where);
        return $this->db->get()->result();
    }

    public function getAllJoin($table1, $table2, $table3, $c_table1, $c_table2, $c_table3, $c_join1, $c_join2)
    {
        $c_table = "$table1.$c_table1, $table2.$c_table2, $table3.$c_table3";
        $this->db->select($c_table);
        $this->db->from($table1);
        $this->db->join($table2, $c_join1, 'left');
        $this->db->join($table3, $c_join2, 'left');
        return $this->db->get()->result();
    }
    public function getAllJoinWhere($table1, $table2, $table3, $c_table1, $c_table2, $c_table3, $c_join1, $c_join2, $where)
    {
        $c_table = "$table1.$c_table1, $table2.$c_table2, $table3.$c_table3";
        $this->db->select($c_table);
        $this->db->from($table1);
        $this->db->join($table2, $c_join1, 'inner');
        $this->db->join($table3, $c_join2, 'inner');
        $this->db->where(array('menus.parent_id' => '0', 'group_access_permission.group_id' => $where));
        return $this->db->get()->result();
    }

    function getWhereNotIn($table, $where)
    {
        $this->db->from($table);
        $this->db->where_not_in('user_role.name', $where);
        $query = $this->db->get();
        return $query->result();
    }
    function getWhereRow($table, $where)
    {
        $this->db->from($table);
        $this->db->where($where);
        $query = $this->db->get();
        return $query->row();
    }

    function getById($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function check_unique_specialist_doctor($table, $id)
    {
        $this->db->from($table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    function check_current_password($table, $username)
    {
        $this->db->from($table);
        $this->db->where('username', $username);
        $query = $this->db->get();
        return $query->row();
    }
}
