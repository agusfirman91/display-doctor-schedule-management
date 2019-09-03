<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Bsh extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_main');
        $this->data['setting'] = $this->m_main->getWhereRow('setting', 'is_active=1');
    }

    public function index()
    {
        $this->data['list_pasien'] = $this->m_main->getAllJoin(
            'tblpasien',
            'tblsuku',
            'tblagama',
            '*',
            'suku',
            'agama',
            'tblpasien.idsuku=tblsuku.idsuku',
            'tblpasien.idagama=tblagama.idagama'
        );
        $this->data['list_suku'] = $this->m_main->getAll('tblsuku');
        $this->data['list_agama'] = $this->m_main->getAll('tblagama');
        // var_dump($this->data['list_pasien'][0]->sex);
        // die;
        $this->template->load('template', 'bsh/list_pasien', $this->data);
    }

    public function update($table)
    {

        if ($table == 'tblpasien') {
            $this->data = array(
                "idpasien" => $this->input->post('idpasien'),
                "nama" => $this->input->post('nama'),
                "alamat" => $this->input->post('alamat'),
                "sex" => $this->input->post('sex'),
                "tgl_lahir" => $this->input->post('tgl_lahir'),
                "idsuku" => $this->input->post('suku'),
                "idagama" => $this->input->post('agama')
            );
        }

        $this->db->update($table, $this->data, array('id' => $this->input->post('id')));
        $this->session->set_flashdata('message', "Data Berhasil Diupdate");
        redirect('bsh');
        // var_dump($this->data);
    }


    public function add($table)
    {
        if ($table == 'tblpasien') {
            $this->data = array(
                "idpasien" => $this->input->post('idpasien'),
                "nama" => $this->input->post('nama'),
                "alamat" => $this->input->post('alamat'),
                "sex" => $this->input->post('sex'),
                "tgl_lahir" => $this->input->post('tgl_lahir'),
                "idsuku" => $this->input->post('suku'),
                "idagama" => $this->input->post('agama')
            );
            $url = 'bsh';
        }
        if ($this->db->insert($table, $this->data)) {
            $this->session->set_flashdata('message', "Data Berhasil Disimpan");
        } else {
            $this->session->set_flashdata('message', "Data Gagal Disimpan");
        }
        redirect($url);
    }
    public function req_data($table, $id)
    {
        if ($id != 0) {
            $this->data = $this->m_main->getById($table, $id);
        } else {
            $this->data = ['id' => 0];
        }
        echo json_encode($this->data);
    }

    public function delete($table, $id)
    {
        $this->db->where('id', $id);
        $hapus = $this->db->delete($table);
        if ($hapus) {
            $this->session->set_flashdata('message', "Data Berhasil Dihapus");
        } else {
            echo json_encode(array('message' => 'Data Gagal Dihapus'));
        }
    }
}
