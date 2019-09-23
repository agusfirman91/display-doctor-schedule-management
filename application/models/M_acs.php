<?php

class M_acs extends CI_Model
{
    var $table = 'tblpasien';
    var $column = array('no_rm', 'nama', 'nama', 'alamat', 'sex', 'tgl_lahir', 'suku', 'agama');
    var $order = array('id' => 'desc');
    public function __construct()
    {
        parent::__construct();
        $this->search = '';
    }

    // model datatables
    private function _get_datatables_query()
    {

        $this->db->select('tblpasien.id,no_rm,nama,alamat,sex,tgl_lahir,tblsuku.suku,tblagama.agama');
        $this->db->from('tblpasien');
        //add this line for join
        $this->db->join('tblsuku', 'tblpasien.idsuku=tblsuku.idsuku', 'left');
        $this->db->join('tblagama', 'tblpasien.idagama=tblagama.idagama', 'left');


        // $this->db->from($this->table);
        $i = 0;

        foreach ($this->column as $item) {
            if ($_POST['search']['value']) ($i === 0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
            $column[$i] = $item;
            $i++;
        }

        if (isset($_POST['order'])) {
            $this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    function get_datatables()
    {
        $this->_get_datatables_query();
        if ($_POST['length'] != -1)
            $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    function count_filtered()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    public function count_all()
    {
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row();
    }
    // end model datatables


    public function getAll($table)
    {
        return $this->db->get($table)->result_array();
    }

    public function insert($table, $data)
    {
        $this->db->insert($table, $data);
        return TRUE;
    }

    public function update($data)
    {
        $this->db->where(array('id' => $data['id']));
        $this->db->update('tblpasien', $data);
        return TRUE;
    }

    public function delete($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('tblpasien');
    }

    public function getAllObject($table)
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
