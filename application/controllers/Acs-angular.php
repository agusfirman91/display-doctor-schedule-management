<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Acs extends CI_Controller
{

    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_main');
        $this->load->model('m_acs');
        $this->load->library('pagination');
        $this->data['setting'] = $this->m_main->getWhereRow('setting', 'is_active=1');
    }

    public function index()
    {
        $this->load->view('_partials/header', $this->data);
        $this->load->view('acs/home', $this->data);
        $this->load->view('_partials/footer');
    }

    public function patients()
    {
        // if (!empty($this->input->get("search"))) {
        //     $this->db->like('title', $this->input->get("search"));
        //     $this->db->or_like('description', $this->input->get("search"));
        // }
        // $this->db->limit(5, ($this->input->get("page", 1) - 1) * 5);
        $this->data['sukus'] =  $this->m_acs->getAllObject("tblsuku");
        $this->data['agamas'] =  $this->m_acs->getAllObject("tblagama");
        $this->data['total'] = $this->db->count_all("tblpasien");
        // var_dump($this->data['data']);
        $this->load->view('_partials/header', $this->data);
        $this->load->view('acs/patients', $this->data);
        $this->load->view('_partials/footer');
    }

    public function get_all()
    {
        $patient = $this->m_acs->getAllJoin('tblpasien', 'tblsuku', 'tblagama', '*', 'suku', 'agama', 'tblpasien.idsuku=tblsuku.idsuku', 'tblpasien.idagama=tblagama.idagama');
        $this->output->set_content_type('application/json')->set_output(json_encode($patient));
    }
    public function getSuku()
    {
        $suku = $this->m_acs->getAll('tblsuku');
        $this->output->set_content_type('application/json')->set_output(json_encode($suku));
    }

    public function getAgama()
    {
        $agama = $this->m_acs->getAll('tblagama');
        $this->output->set_content_type('application/json')->set_output(json_encode($agama));
    }

    public function insert()
    {
        $postdata = json_decode(file_get_contents('php://input'), TRUE);
        if (isset($postdata['patient'])) {
            $no_rm = (isset($postdata['patient']['no_rm']) ? $postdata['patient']['no_rm'] : NULL);
            $no_reg = (isset($postdata['patient']['no_reg']) ? $postdata['patient']['no_reg'] : NULL);
            $nama = (isset($postdata['patient']['nama']) ? $postdata['patient']['nama'] : NULL);
            $idsuku = (isset($postdata['patient']['idsuku']) ? $postdata['patient']['idsuku'] : NULL);
            $idagama = (isset($postdata['patient']['idagama']) ? $postdata['patient']['idagama'] : NULL);
            if ($no_rm == NULL) {
                http_response_code(400);
                $this->output->set_content_type('application/json')->set_output(json_encode(['errors' => ["Name Field is required"]]));
            } else {
                $data = array(
                    'no_rm'   => $no_rm,
                    'no_reg'   => $no_reg,
                    'nama'    => $nama,
                    'idsuku'     => $idsuku,
                    'idagama'      => $idagama
                );
                $this->m_acs->insert('tblpasien', $data);
            }
        }
    }
    public function update()
    {
        $postdata = json_decode(file_get_contents('php://input'), TRUE);
        if (isset($postdata['patient'])) {
            $id = (isset($postdata['patient']['id']) ? $postdata['patient']['id'] : NULL);
            $no_rm = (isset($postdata['patient']['no_rm']) ? $postdata['patient']['no_rm'] : NULL);
            $no_reg = (isset($postdata['patient']['no_reg']) ? $postdata['patient']['no_reg'] : NULL);
            $nama = (isset($postdata['patient']['nama']) ? $postdata['patient']['nama'] : NULL);
            $idsuku = (isset($postdata['patient']['idsuku']) ? $postdata['patient']['idsuku'] : NULL);
            $idagama = (isset($postdata['patient']['idagama']) ? $postdata['patient']['idagama'] : NULL);
            if ($no_rm == NULL) {
                http_response_code(400);
                $this->output->set_content_type('application/json')->set_output(json_encode(['errors' => ["Name Field is required"]]));
            } else {
                $data = array(
                    'no_rm'   => $no_rm,
                    'no_reg'   => $no_reg,
                    'nama'    => $nama,
                    'idsuku'     => $idsuku,
                    'idagama'      => $idagama,
                    'id'      => $id
                );
                $this->m_acs->update($data);
            }
        }
    }
    public function delete()
    {
        $postdata = json_decode(file_get_contents("php://input"));
        if (isset($postdata) && !empty($postdata)) {
            $id = (int) $postdata->ID;
            $this->m_acs->delete($id);
        }
    }
}
