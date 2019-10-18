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

        $groupId = $this->session->userdata('group_id');
        $userId = $this->session->userdata('user_id');

        // cari menu 
        $this->data['list_menus_access'] = $this->m_main->getMenu($groupId, $userId);

        // cari sub menu 
        foreach ($this->data['list_menus_access'] as $k => $menu) {
            $this->data['list_menus_access'][$k]->parent_menu = $this->m_main->getSubMenu($menu->id, $menu->group_id);
        }
        $this->data['list_menus'] = $this->m_main->getWhere('menus', 'parent_id=0');
        foreach ($this->data['list_menus'] as $k => $menu) {
            $this->data['list_menus'][$k]->parent_menu = $this->m_main->getWhere('menus', 'menus.parent_id=' . $menu->id);
        }

        $this->data['groups'] = $this->m_main->getAll('groups');
        $this->data['list_user'] = $this->m_main->getWhere('user', 'id !=' . $userId);
        foreach ($this->data['list_user'] as $k => $user) {
            $this->data['list_user'][$k]->groups = $this->m_main->getWhereJoin('user', 'groups', '*', 'name', 'user.group_id=groups.id', 'user.id=' . $user->id);
        }
        // $this->data['csrf'] = $this->_get_csrf_nonce();
        // $this->output->enable_profiler(TRUE);
    }

    public function index()
    {
        $this->template->load('template', 'acs/menus', $this->data);
    }

    public function menu()
    {
        $this->data['list_menus'] = $this->m_acs->getJoin('tblmenus', 'tblgroupmenus', '*', 'name as kategori', 'tblmenus.groupmenu_id=tblgroupmenus.id');
        $this->data['list_groupMenus'] = $this->m_main->getAll('tblgroupmenus');
        $this->template->load('template', 'acs/menus', $this->data);
    }

    public function menu_category()
    {
        $this->data['list_menuCategories'] = $this->m_main->getAll('tblkategorimenus');
        $this->template->load('template', 'acs/menu_category', $this->data);
    }

    public function group_menu()
    {
        $this->data['list_groupMenus'] = $this->m_main->getAll('tblgroupmenus');
        $this->template->load('template', 'acs/group_menus', $this->data);
    }

    public function save_rotations()
    {
        // $headerMenu[] = array();
        // $menuId[] = array();
        $rotation_id = $this->input->post('rotation_id');
        $classId = $this->input->post('class_id');
        $headerMenu = $this->input->post('header');
        $menuId = $this->input->post('menu_id');
        // $group = 
        // foreach ($menuId as $value) {
        // } 
        // $i      = $this->input;
        $menu = implode(",", $menuId);

        $data = array(
            'rotation_id' => $rotation_id,
            'class_id' => $classId,
            'header' => $headerMenu,
            'menu' => $menu
        );
        if ($this->db->insert('tbldetailrotations', $data)) {
            $message = "OK";
        } else {
            $this->session->set_flashdata('message', "Data Gagal Disimpan");
        }
        // redirect($url);
        // foreach ($menuId as $k => $header) {
        //     echo $header[$k] . ", ";
        //     // foreach ($header as $nama) {
        //     // }
        //     // echo "<br />";
        //     // var_dump($data);
        // }
        // $qty = count($headerMenu);
        // $result[] = array();
        // foreach ($data as $key => $value) {
        //     // echo
        //     $result[] = $value;
        //     foreach ($result[1] as $key => $nilai) {
        //         $result[$key] .= $nilai;

        //         print_r($result);
        //     }
        // }
        // print_r($result);
        // print_r($data['header_menu'][0]);

        // $i = 1
        // for ($i = 1; $i <= $qty; $i++) {
        // $data = array(
        //     'class_id' => $classId,
        //     'header_menu' => $headerMenu,
        //     'menu_id' => $menuId
        // );
        // }
        // echo $this->db->last_query();
        echo json_encode($message);
    }

    public function rotation_test_array()
    {
        $header = array('a', 'b');
        $menus = array('a' => 'aa', 'a' => 'ab', 'a' => 'ac', 'b' => 'ba', 'b' => 'bb', 'b' => 'bc');


        // $data = array(
        //     $header => $menuId
        // );
        // foreach ($header as $val) {
        //     // print_r($header);
        //     foreach ($menu as $val => $value) {
        //         var_dump($val . $value);
        //     }
        // }

        foreach ($header as $key => $menus) {
            if (is_array($menus)) {
                foreach ($menus as $menu) {
                    echo $key;
                }
            }
        }
        // $headerMenus = array('a' => array(
        //     'aa', 'ab', 'ac'
        // ),  'b' =>  array(
        //     'ba', 'bb', 'bc'
        // ));
        // var_dump($headerMenus);





        // $herbivora = array('kambing', 'sapi', 'kuda');
        $karnivora = array('harimau', 'serigala', 'anjing');
        $omnivora = array('ayam', 'monyet', 'beruang');
        // $binatang = array(
        //     'herbivora' => $herbivora,
        //     'karnivora' => $karnivora,
        //     'omnivora' => $omnivora
        // );

        // foreach ($binatang as $key => $value) {
        //     echo $key . ": ";
        //     foreach ($value as $key => $nilai) {
        //         $result[] =  $nilai;

        //         // $res =  mb_substr($result, 0, -1);
        //         // $res =  rtrim($result, ", ");
        //         // echo $res;
        //     }
        //     echo  implode(",", $result) . "<br>";
        // }
    }

    public function rotations($id = null, $cat = null)
    {
        $this->data['list_rotations'] = $this->m_main->getAll('tblrotations');
        if ($id) {
            $this->data['resRotation'] = $this->m_acs->get_by_id('tblrotations', $id);
            if ($this->data['resRotation']) {
                $this->data['list_rotations_menu'] = $this->m_main->getAll('tblrotation_menu');
                $this->data['list_category_menu'] = $this->m_main->getAll('tblkategorimenus');
                $this->data['list_class'] = $this->m_main->getAll('tblclassroom');
                $this->data['list_menus'] = $this->m_acs->getAllJoin('tblmenus', 'tblgroupmenus', 'tblkategorimenus',  '*', 'name as groupmenu', 'name as kategori', 'tblmenus.groupmenu_id = tblgroupmenus.id', 'tblgroupmenus.category_id= tblkategorimenus.id');
                $this->data['rotation_id'] = $id;
                if ($cat) {
                    $this->data['detailRotations'] = $this->m_acs->getDetailRotation($id, $cat);
                }
                $this->template->load('template', 'acs/rotation_menu', $this->data);
            } else {
                redirect('acs/rotations');
            }
        } else {
            $this->template->load('template', 'acs/rotations', $this->data);
        }
    }

    public function orders()
    {
        $this->data['list_orders'] = $this->m_main->getJoin('tblorders', 'tblpasien', '*', 'no_rm,nama', 'tblorders.id_patient=tblpasien.id');
        // $this->data['list_user'] = $this->m_main->getWhere('user', 'id !=' . $userID);
        // $this->data['menus'] = $this->m_main->getAll('tblmenus');
        foreach ($this->data['list_orders'] as $k => $menus) {
            $this->data['list_orders'][$k]->menu_1 = $this->m_acs->getWhereJoin('tblorders', 'tblmenus', 'menu_1', 'name', 'tblorders.menu_1=tblmenus.id', 'tblmenus.id=' . $menus->menu_1);
        }
        foreach ($this->data['list_orders'] as $k => $menus) {
            $this->data['list_orders'][$k]->menu_2 = $this->m_acs->getWhereJoin('tblorders', 'tblmenus', 'menu_2', 'name', 'tblorders.menu_2=tblmenus.id', 'tblmenus.id=' . $menus->menu_2);
        }
        foreach ($this->data['list_orders'] as $k => $menus) {
            $this->data['list_orders'][$k]->menu_3 = $this->m_acs->getWhereJoin('tblorders', 'tblmenus', 'menu_3', 'name', 'tblorders.menu_3=tblmenus.id', 'tblmenus.id=' . $menus->menu_3);
        }
        // var_dump($this->data['list_orders']);
        // die;
        $this->template->load('template', 'acs/orders', $this->data);
    }

    public function create_orders()
    {
        $this->data['list_suku'] = $this->m_acs->getAll('tblsuku');
        $this->data['list_agama'] = $this->m_acs->getAll('tblagama');
        $this->data['list_patients'] = $this->m_acs->getAllJoin('tblpasien', 'tblsuku', 'tblagama', '*', 'suku', 'agama', 'tblpasien.idsuku=tblsuku.idsuku', 'tblpasien.idagama=tblagama.idagama');
        $this->data['menus'] = $this->m_acs->getAllObject('tblmenus');
        // var_dump($this->data['list_menus']);
        // die;
        $this->template->load('template', 'acs/create-orders', $this->data);
    }

    public function patients()
    {
        $this->data['list_suku'] = $this->m_acs->getAll('tblsuku');
        $this->data['list_agama'] = $this->m_acs->getAll('tblagama');
        $this->data['list_patients'] = $this->m_acs->getAllJoin('tblpasien', 'tblsuku', 'tblagama', '*', 'suku', 'agama', 'tblpasien.idsuku=tblsuku.idsuku', 'tblpasien.idagama=tblagama.idagama');
        // var_dump($this->data['data']);
        $this->template->load('template', 'acs/patients', $this->data);
    }

    function ajax_rotation_detail($id, $cat)
    {
        // $data = $id . '-' . $cat;
        $detailRotations = $this->m_acs->get_datatables_rotation('detailRotation', $id, $cat);
        $data = array();
        $no = $_POST['start'];
        foreach ($detailRotations as $detail) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $detail->class;
            $row[] = $detail->header;
            $row[] = $detail->menu;
            //add html for action
            $row[] = '
                    <a href="javascript:void(0);"  title="Edit detail" onclick="edit_detail(' . "'" . $detail->id . "'" . ')" > 
                    <span class="fa fa-edit"></span>
                    </a>
                    <a href="javascript:void(0);" onclick="delete_detail(' . "'" . $detail->id . "'" . ')" title="Delete detail">
                    <span class="fa fa-trash"></span>
                    </a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_acs->count_all(),
            "recordsFiltered" => $this->m_acs->count_filtered(),
            "data" => $data,
        );
        echo json_encode($output);
        // echo json_encode($detailRotations);
    }

    public function ajax_list()
    {
        $list = $this->m_acs->get_datatables();
        // var_dump($this->data['list']);
        $data = array();
        $no = $_POST['start'];
        foreach ($list as $patient) {
            $no++;
            $row = array();
            $row[] = $no;
            $row[] = $patient->no_rm;
            $row[] = $patient->no_reg;
            $row[] = $patient->nama;
            $row[] = $patient->kelas;
            $row[] = $patient->tgl_lahir;
            $row[] = $patient->alamat;
            $row[] = $patient->sex == 'L' ? 'Laki- Laki' : 'Perempuan';
            $row[] = $patient->suku;
            $row[] = $patient->agama;
            //add html for action
            $row[] = '
                    <a href="javascript:void(0);"  title="Edit patient" onclick="edit_patient(' . "'" . $patient->id . "'" . ')" > 
                    <span class="fa fa-edit"></span>
                    </a>
                    <a href="javascript:void(0);" onclick="delete_patient(' . "'" . $patient->id . "'" . ')" title="Delete patient">
                    <span class="fa fa-trash"></span>
                    </a>';
            $data[] = $row;
        }
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->m_acs->count_all(),
            "recordsFiltered" => $this->m_acs->count_filtered(),
            "data" => $data,
        );
        //output to json format
        echo json_encode($output);
    }

    public function update($table)
    {

        if ($table == 'tblpasien') {
            $this->data = array(
                "no_rm" => $this->input->post('no_rm'),
                "nama" => $this->input->post('nama'),
                "alamat" => $this->input->post('alamat'),
                "sex" => $this->input->post('sex'),
                "tgl_lahir" => $this->input->post('tgl_lahir'),
                "idsuku" => $this->input->post('suku'),
                "idagama" => $this->input->post('agama')
            );
            $url = 'acs/patients';
        } else if ($table == 'tblgroupmenus') {
            $this->data = array(
                "name" => $this->input->post('name'),
                "description" => $this->input->post('description')
            );
            $url = 'acs/group-menu';
        } else if ($table == 'tblkategorimenus') {
            $this->data = array(
                "name" => $this->input->post('name'),
                "description" => $this->input->post('description')
            );
            $url = 'acs/menu-category';
        } else if ($table == 'tblmenus') {

            $config['upload_path'] = './assets/images/uploads/menus';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '1024';
            // $config['max_width'] = '500';
            // $config['max_height'] = '500';
            $config['remove_space'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $url = 'acs/menu';
            $image_old = $this->input->post('image_old');
            $image = $this->input->post('image');
            $this->load->library('upload', $config);
            if (!$_FILES['image']['name']) {
                $image = $image_old;
            } else {
                if ($this->upload->do_upload('image')) {
                    $image =  $this->upload->data('file_name');
                }
            }
            $this->data = array(
                "name" => $this->input->post('name'),
                "groupmenu_id" => $this->input->post('groupmenu_id'),
                "description" => $this->input->post('description'),
                "image" => $image
            );
        } else if ($table == 'tblrotations') {
            $this->data = array(
                "name" => $this->input->post('name'),
                "description" => $this->input->post('description')
            );
            $url = 'acs/rotations';
        }

        // var_dump($this->data);
        // die;
        $this->db->update($table, $this->data, array('id' => $this->input->post('id')));
        $this->session->set_flashdata('message', "Data Berhasil Diupdate");
        redirect($url);
    }


    public function add($table)
    {
        if ($table == 'tblorders') {
            $this->data = array(
                "id_patient" => $this->input->post('pasien'),
                "menu_1" => $this->input->post('menu-1'),
                "menu_2" => $this->input->post('menu-2'),
                "menu_3" => $this->input->post('menu-3'),
                "description" => $this->input->post('description'),
                "date_create" => date('Y-m-d')

            );
            $url = 'acs/orders';
        } else if ($table == 'tblpasien') {
            $this->data = array(
                "no_rm" => $this->input->post('no_rm'),
                "nama" => $this->input->post('nama'),
                "alamat" => $this->input->post('alamat'),
                "sex" => $this->input->post('sex'),
                "tgl_lahir" => $this->input->post('tgl_lahir'),
                "idsuku" => $this->input->post('suku'),
                "idagama" => $this->input->post('agama')
            );
            $url = 'acs/patients';
        } else if ($table == 'tblgroupmenus') {
            $this->data = array(
                "name" => $this->input->post('name'),
                "description" => $this->input->post('description')
            );
            $url = 'acs/group-menu';
        } else if ($table == 'tblkategorimenus') {
            $this->data = array(
                "name" => $this->input->post('name'),
                "description" => $this->input->post('description')
            );
            $url = 'acs/menu-category';
        } else if ($table == 'tblmenus') {
            $config['upload_path'] = './assets/images/uploads/menus';
            $config['allowed_types'] = 'jpg|png|jpeg|image|ico';
            $config['max_size']  = '1024';
            // $config['max_width'] = '500';
            // $config['max_height'] = '500';
            $config['remove_space'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $url = 'acs/menu';
            $this->load->library('upload', $config);

            if (!$this->upload->do_upload('image')) {
                $this->session->set_flashdata('message', 'Image Display' . $this->upload->display_errors());
                redirect($url);
            } else {
                $image =  $this->upload->data('file_name');
            }
            $this->data = array(
                "name" => $this->input->post('name'),
                "description" => $this->input->post('description'),
                "groupmenu_id" => $this->input->post('groupmenu_id'),
                "image" => $image
            );
        } else if ($table == 'tblrotations') {
            $this->data = array(
                "name" => $this->input->post('name'),
                "description" => $this->input->post('description')
            );
            $url = 'acs/rotations';
        }
        if ($this->db->insert($table, $this->data)) {
            $this->session->set_flashdata('message', "Data Berhasil Disimpan");
        } else {
            $this->session->set_flashdata('message', "Data Gagal Disimpan");
        }
        redirect($url);
        // var_dump($this->data);
    }
    public function req_data($table, $id)
    {
        if ($id != 0) {
            $this->data = $this->m_acs->getById($table, $id);
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


    // public function get_all()
    // {
    //     $patient = $this->m_acs->getAllJoin('tblpasien', 'tblsuku', 'tblagama', '*', 'suku', 'agama', 'tblpasien.idsuku=tblsuku.idsuku', 'tblpasien.idagama=tblagama.idagama');
    //     $this->output->set_content_type('application/json')->set_output(json_encode($patient));
    // }
    // public function getSuku()
    // {
    //     $suku = $this->m_acs->getAll('tblsuku');
    //     $this->output->set_content_type('application/json')->set_output(json_encode($suku));
    // }

    // public function getAgama()
    // {
    //     $agama = $this->m_acs->getAll('tblagama');
    //     $this->output->set_content_type('application/json')->set_output(json_encode($agama));
    // }

    // public function insert()
    // {
    //     $postdata = json_decode(file_get_contents('php://input'), TRUE);
    //     if (isset($postdata['patient'])) {
    //         $no_rm = (isset($postdata['patient']['no_rm']) ? $postdata['patient']['no_rm'] : NULL);
    //         $no_reg = (isset($postdata['patient']['no_reg']) ? $postdata['patient']['no_reg'] : NULL);
    //         $nama = (isset($postdata['patient']['nama']) ? $postdata['patient']['nama'] : NULL);
    //         $idsuku = (isset($postdata['patient']['idsuku']) ? $postdata['patient']['idsuku'] : NULL);
    //         $idagama = (isset($postdata['patient']['idagama']) ? $postdata['patient']['idagama'] : NULL);
    //         if ($no_rm == NULL) {
    //             http_response_code(400);
    //             $this->output->set_content_type('application/json')->set_output(json_encode(['errors' => ["Name Field is required"]]));
    //         } else {
    //             $data = array(
    //                 'no_rm'   => $no_rm,
    //                 'no_reg'   => $no_reg,
    //                 'nama'    => $nama,
    //                 'idsuku'     => $idsuku,
    //                 'idagama'      => $idagama
    //             );
    //             $this->m_acs->insert('tblpasien', $data);
    //         }
    //     }
    // }
    // public function update()
    // {
    //     $postdata = json_decode(file_get_contents('php://input'), TRUE);
    //     if (isset($postdata['patient'])) {
    //         $id = (isset($postdata['patient']['id']) ? $postdata['patient']['id'] : NULL);
    //         $no_rm = (isset($postdata['patient']['no_rm']) ? $postdata['patient']['no_rm'] : NULL);
    //         $no_reg = (isset($postdata['patient']['no_reg']) ? $postdata['patient']['no_reg'] : NULL);
    //         $nama = (isset($postdata['patient']['nama']) ? $postdata['patient']['nama'] : NULL);
    //         $idsuku = (isset($postdata['patient']['idsuku']) ? $postdata['patient']['idsuku'] : NULL);
    //         $idagama = (isset($postdata['patient']['idagama']) ? $postdata['patient']['idagama'] : NULL);
    //         if ($no_rm == NULL) {
    //             http_response_code(400);
    //             $this->output->set_content_type('application/json')->set_output(json_encode(['errors' => ["Name Field is required"]]));
    //         } else {
    //             $data = array(
    //                 'no_rm'   => $no_rm,
    //                 'no_reg'   => $no_reg,
    //                 'nama'    => $nama,
    //                 'idsuku'     => $idsuku,
    //                 'idagama'      => $idagama,
    //                 'id'      => $id
    //             );
    //             $this->m_acs->update($data);
    //         }
    //     }
    // }
    // public function delete()
    // {
    //     $postdata = json_decode(file_get_contents("php://input"));
    //     if (isset($postdata) && !empty($postdata)) {
    //         $id = (int) $postdata->ID;
    //         $this->m_acs->delete($id);
    //     }
    // }

    // $integers = array();

    // for ($i = 0; $i < 10; $i++) {
    //     $integers[] = rand(0, 1000);
    // }

    // $long_string = implode(',', $integers);
    // echo $long_string;
}
