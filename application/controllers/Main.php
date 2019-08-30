<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Main extends CI_Controller
{

    public $data = [];

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
        $this->load->model('m_main');

        if (!$this->m_login->logged_id()) {
            redirect("home");
        }
        $this->data['setting'] = $this->m_main->getWhereRow('setting', 'is_active=1');

        $group_id = $this->session->userdata('group_id');
        $this->data['list_menus_access'] = $this->m_main->getAllJoinWhere(
            "user",
            "group_access_permission",
            "menus",
            "id as user_id",
            "group_id as group_access_permission_group_id",
            "*",
            "group_access_permission.group_id=user.group_id",
            "group_access_permission.menu_id=menus.id",
            $group_id
        );
        foreach ($this->data['list_menus_access'] as $k => $menu) {
            $this->data['list_menus_access'][$k]->parent_menu = $this->m_main->getWhere('menus', 'menus.parent_id=' . $menu->id);
        }

        $this->data['list_menus'] = $this->m_main->getWhere('menus', 'parent_id=0');
        foreach ($this->data['list_menus'] as $k => $menu) {
            $this->data['list_menus'][$k]->parent_menu = $this->m_main->getWhere('menus', 'menus.parent_id=' . $menu->id);
        }

        $userID = $this->session->userdata('user_id');
        $this->data['list_user'] = $this->m_main->getWhere('user', 'id !=' . $userID);
        $this->data['groups'] = $this->m_main->getAll('groups');
        foreach ($this->data['list_user'] as $k => $user) {
            $this->data['list_user'][$k]->groups = $this->m_main->getWhereJoin('user', 'groups', '*', 'name', 'user.group_id=groups.id', 'user.id=' . $user->id);
        }
        var_dump($this->data['list_menus_access']);
        die;
        $this->data['csrf'] = $this->_get_csrf_nonce();
        // $this->output->enable_profiler(TRUE);
    }


    public function index()
    {
        $this->template->load('template', 'main/list_user', $this->data);
    }

    public function _get_csrf_nonce()
    {
        $this->load->helper('string');
        $key = random_string('alnum', 8);
        $value = random_string('alnum', 20);
        $this->session->set_flashdata('csrfkey', $key);
        $this->session->set_flashdata('csrfvalue', $value);

        return [$key => $value];
    }
    public function change_password()
    {
        $this->form_validation->set_rules('inputPasswordCurrent', 'Password', 'required');
        $this->form_validation->set_rules('inputPasswordNew', 'Password', 'required');
        $this->form_validation->set_rules('inputPasswordNew2', 'Password', 'required|matches[inputPasswordNew]');

        if ($this->form_validation->run() == FALSE) {

            $this->template->load('template', 'main/change_password', $this->data);
        } else {
            $username = $this->session->userdata('user_name');
            $c_password = md5($this->input->post('inputPasswordCurrent'));
            $passwordNew = md5($this->input->post('inputPasswordNew'));
            $row = $this->m_main->check_current_password('user', $username);
            if ($row) {
                if ($c_password == $row->password) {
                    $this->data = array(
                        'password' => $passwordNew
                    );
                    $this->db->where('username', $this->session->userdata('user_name'));
                    $this->db->update('user', $this->data);
                    $this->session->set_flashdata('message', "Data Berhasil Disimpan, Silahkan Re-Login");
                    redirect('main/change-password');
                } else {
                    $this->session->set_flashdata('message', "Data Gagal Disimpan, Password lama tidak sesuai");
                    redirect('main/change-password');
                }
            } else {
                $this->session->set_flashdata('message', "Data Gagal Disimpan, Password lama tidak sesuai");
                redirect('main/change-password');
            }
        }

        $username = $this->session->userdata('user_name');
        $this->data['list_user'] = $this->m_main->getWhereJoin(
            'user',
            'user_role',
            '*',
            'id as id_role,name',
            'user.group_id = user_role.id',
            'username != "' . $username . '" '
        );
        $this->data['user_role'] = $this->m_main->getAll('groups');
    }

    public function user()
    {
        $this->template->load('template', 'main/list_user', $this->data);
    }

    public function datajson()
    {
        $this->load->library('datatables');
        // $this->datatables->add_column('image_icon', '<img src="http://www.rutlandherald.com/wp-content/uploads/2017/03/default-user.png" width=20>', 'foto');
        $this->datatables->select('nama ,image_icon,image_display,is_active');
        $this->datatables->add_column('action', anchor('main/edit/.$1', 'Edit', array('class' => 'btn btn-danger btn-sm')), 'id');
        $this->datatables->from('setting');
        return print_r($this->datatables->generate());
    }

    public function duty_doctor()
    {
        $this->data['list_duty_doctor'] = $this->m_main->getAllJoin(
            'doctor_of_duty',
            'plasma',
            'doctor',
            '*',
            'name as plasma_name',
            'name',
            'doctor_of_duty.plasma_id=plasma.id',
            'doctor_of_duty.doctor_id=doctor.id'
        );
        $this->data['list_plasma'] = $this->m_main->getWhere('plasma', 'type_id=1 or type_id=3');
        $this->data['list_doctor'] = $this->m_main->getWhere('doctor', 'is_doctor_of_duty=1');

        $this->template->load('template', 'main/duty_doctor', $this->data);
    }

    public function specialist_doctor()
    {
        $this->data['list_doctor_spesialist'] = $this->m_main->getAllJoin(
            'specialist_doctor',
            'plasma',
            'doctor',
            '*',
            'name as plasma_name',
            'name',
            'specialist_doctor.plasma_id=plasma.id',
            'specialist_doctor.doctor_oc_1=doctor.id or specialist_doctor.doctor_oc_2=doctor.id'
        );
        $this->data['list_plasma'] = $this->m_main->getAll('plasma');
        $this->data['list_doctor'] = $this->m_main->getWhere('doctor', 'is_doctor_specialist=1');

        // var_dump($data);
        $this->template->load('template', 'main/specialist_doctor', $this->data);
    }

    public function nurse()
    {
        $this->data['list_nurse'] = $this->m_main->getAll('nurse');

        $this->template->load('template', 'main/nurse', $this->data);
    }

    public function nurse_spv()
    {
        $this->data['list_nurse_spv'] = $this->m_main->getAllJoin(
            'nurse_spv',
            'plasma',
            'nurse',
            '*',
            'name as plasma_name',
            'name',
            'nurse_spv.plasma_id=plasma.id',
            'nurse_spv.nurse_id=nurse.id'
        );
        $this->data['list_plasma'] = $this->m_main->getAll('plasma');
        $this->data['list_nurse'] = $this->m_main->getAll('nurse');

        $this->template->load('template', 'main/nurse_spv', $this->data);
    }

    public function nurse_of_duty()
    {
        $this->data['list_nurse_of_duty'] = $this->m_main->getAllJoin(
            'nurse_of_duty',
            'plasma',
            'nurse',
            '*',
            'name as plasma_name',
            'name',
            'nurse_of_duty.plasma_id=plasma.id',
            'nurse_of_duty.nurse_id=nurse.id'
        );
        $this->data['list_plasma'] = $this->m_main->getAll('plasma');
        $this->data['list_nurse'] = $this->m_main->getAll('nurse');

        $this->template->load('template', 'main/nurse_of_duty', $this->data);
    }

    public function pic_nurse()
    {
        $this->data['list_pic_nurse'] = $this->m_main->getAllJoin(
            'pic_nurse',
            'plasma',
            'nurse',
            '*',
            'name as plasma_name',
            'name',
            'pic_nurse.plasma_id=plasma.id',
            'pic_nurse.nurse_id=nurse.id'
        );
        $this->data['list_plasma'] = $this->m_main->getAll('plasma');
        $this->data['list_nurse'] = $this->m_main->getAll('nurse');

        $this->template->load('template', 'main/pic_nurse', $this->data);
    }

    public function image_slide()
    {
        $this->data['list_image_slide'] = $this->m_main->getJoin('image_slide', 'plasma', '*', 'name as plasma_name', 'image_slide.plasma_id=plasma.id');
        $this->data['list_plasma'] = $this->m_main->getAll('plasma');

        $this->template->load('template', 'main/image_slide', $this->data);
    }

    public function display_management()
    {
        $this->data['list_plasma'] = $this->m_main->getJoin(
            'plasma',
            'type_plasma',
            '*',
            'name as name_type',
            'plasma.type_id=type_plasma.id'
        );
        $this->data['list_type'] = $this->m_main->getAll('type_plasma');

        $this->template->load('template', 'main/display_management', $this->data);
    }

    public function doctor_room()
    {
        $this->data['list_room'] = $this->m_main->getJoin('doctor_room', 'plasma', '*', 'name as plasma_name', 'plasma.id=doctor_room.plasma_id');
        $this->data['list_plasma'] = $this->m_main->getWhere('plasma', 'type_id=2');

        $this->template->load('template', 'main/doctor_room', $this->data);
    }

    public function doctor_schedule()
    {
        $this->data['list_doctor_schedule'] = $this->m_main->getAllJoin(
            'doctor_schedule',
            'doctor_room',
            'doctor',
            '*',
            'room_number',
            'name',
            'doctor_schedule.room_id = doctor_room.id',
            'doctor_schedule.doctor_id=doctor.id'
        );
        $this->data['list_room'] = $this->m_main->getAll('doctor_room');
        $this->data['list_dokter'] = $this->m_main->getAll('doctor');

        $this->template->load('template', 'main/doctor_schedule', $this->data);
    }

    public function doctor()
    {

        $this->data['list_dokter'] = $this->m_main->getAll('doctor');
        $this->template->load('template', 'main/doctor', $this->data);
    }

    public function jam_besuk()
    {
        $this->data['list_visit'] = $this->m_main->getJoin(
            'visit_time',
            'plasma',
            '*',
            'name',
            'plasma.id = visit_time.plasma_id'
        );
        $this->data['list_plasma'] = $this->m_main->getWhereJoin(
            'plasma',
            'type_plasma',
            '*',
            'name as name_type',
            'plasma.type_id = type_plasma.id',
            'type_plasma.name = "ranap" '
        );

        $this->data['list_dokter'] = $this->m_main->getAll('doctor');
        $this->template->load('template', 'main/visit_time', $this->data);
    }

    public function setting()
    {
        $this->data['list_setting'] = $this->m_main->getAll('setting');
        $this->template->load('template', 'main/setting', $this->data);
    }

    public function access_permission()
    {
        $this->data['list_groups'] = $this->m_main->getAll('groups');
        foreach ($this->data['list_groups'] as $k => $group) {
            $this->data['list_groups'][$k]->menus = $this->m_main->getWhereJoin('group_access_permission', 'menus', 'id as menu_id,group_id,menu_id', '*', 'group_access_permission.menu_id=menus.id', 'group_access_permission.group_id=' . $group->id);
        }
        // var_dump($this->data['list_groups']);
        $this->template->load('template', 'main/access_permission', $this->data);
    }

    public function access_permission_edit($id = null)
    {
        $this->data['currentMenus'] = $this->m_main->getWhereJoin('group_access_permission', 'menus', 'id as group_id,group_id,menu_id', '*', 'group_access_permission.menu_id=menus.id', 'group_access_permission.group_id=' . $id);
        $this->data['currentGroup'] = $this->m_main->getById('groups', $id);
        if ($this->data['currentGroup'] == "") {
            redirect('error');
        }
        $this->form_validation->set_rules('name', 'Name', 'required');

        if ($this->form_validation->run() == TRUE) {

            $menuId = '';
            $menuData = $this->input->post('menus');
            foreach ($menuData as $mn) {
                $data = array(
                    "menu_id" => $mn,
                    "group_id" => $id
                );
                $this->db->where($data);
                $dataExist = $this->db->get('group_access_permission')->row();
                $menuId .= $mn . ',';
                if (!$dataExist) {
                    $this->db->insert('group_access_permission', $data);
                    $this->session->set_flashdata('message', "Data Berhasil Disimpan");
                }
            }
            $integerIDs = array_map('intval', $menuData);
            // $this->db->delete('id');
            $this->db->where('group_id', $id);
            $this->db->where_not_in('menu_id', $integerIDs);
            $this->db->delete('group_access_permission');
            $this->session->set_flashdata('message', "Data Berhasil Disimpan");
            redirect('main/access_permission');
        } else {
            $this->template->load('template', 'main/access_permission_edit', $this->data);
        }
    }

    public function access_permission_add()
    {
        $this->form_validation->set_rules('name', 'Name', 'required');
        $this->form_validation->set_rules('menus[]', 'Name', 'required');

        if ($this->form_validation->run() == TRUE) {
            $groupName = $this->input->post('name');
            $menuData = $this->input->post('menus');
            $this->db->insert('groups', array('name' => $groupName));
            $groupId = $this->db->insert_id();
            foreach ($menuData as $mn) {
                $data = array(
                    "menu_id" => $mn,
                    "group_id" => $groupId
                );
                $this->db->insert('group_access_permission', $data);
                $this->session->set_flashdata('message', "Data Berhasil Disimpan");
            }

            // $this->data['currentMenus'] = $this->m_main->getWhereJoin('group_access_permission', 'menus', 'id as group_id,group_id,menu_id', '*', 'group_access_permission.menu_id=menus.id', 'group_access_permission.group_id=' . $id);

            // $this->session->set_flashdata('message', "Data Berhasil Disimpan");
            redirect('main/access_permission');
        } else {
            $this->template->load('template', 'main/access_permission_add', $this->data);
        }
    }

    public function menus()
    {
        $this->data['list_menus'] = $this->m_main->getAllOrder('menus', 'sort');
        $this->template->load('template', 'main/menus', $this->data);
        // var_dump($check);
    }

    public function save_menus()
    {
        $this->data = array(
            "name" => $this->input->post('label'),
            "link" => $this->input->post('link')
        );
        if ($_POST['id'] != '') {
            $this->db->update('menus', $this->data, array('id' => $this->input->post('id')));
            $this->session->set_flashdata('message', "Data Berhasil Disimpan");
            $arr['type']  = 'edit';
            $arr['label'] = $this->input->post('label');
            $arr['link']  = $this->input->post('link');
            $arr['id']    = $this->input->post('id');
        } else {
            $this->db->insert('menus', $this->data);

            $arr['menu'] = '<li class="dd-item dd3-item" data-id="' . $this->db->insert_id() . '" >
                            <div class="dd-handle dd3-handle">Drag</div>
                            <div class="dd3-content"><span id="label_show' . $this->db->insert_id() . '">' . $_POST['label'] . '</span>
                                <span class="span-right">/<span id="link_show' . $this->db->insert_id() . '">' . $_POST['link'] . '</span> &nbsp;&nbsp; 
                                    <a class="edit-button" id="' . $this->db->insert_id() . '" label="' . $_POST['label'] . '" link="' . $_POST['link'] . '" ><i class="align-middle" data-feather="edit"></i></a>
                                    <a class="del-button" id="' . $this->db->insert_id() . '"><i class="align-middle" data-feather="delete"></i></a>
                                </span> 
                            </div>';

            $arr['type'] = 'add';
        }

        print json_encode($arr);
    }

    public function save_menu_all()
    {

        $data = json_decode($_POST['data']);

        function parseJsonArray($jsonArray, $parentID = 0)
        {

            $return = array();
            foreach ($jsonArray as $subArray) {
                $returnSubSubArray = array();
                if (isset($subArray->children)) {
                    $returnSubSubArray = parseJsonArray($subArray->children, $subArray->id);
                }

                $return[] = array('id' => $subArray->id, 'parentID' => $parentID);
                $return = array_merge($return, $returnSubSubArray);
            }
            return $return;
        }

        $readbleArray = parseJsonArray($data);

        $i = 0;
        foreach ($readbleArray as $row) {
            $i++;
            $this->data = array(
                "parent_id" => $row['parentID'],
                "sort" => $i
            );
            $this->db->update('menus', $this->data, array('id' => $row['id']));
        }
    }

    public function delete_menu()
    {
        $id = $_POST['id'];

        $check = $this->db->where('parent_id', $id)->from('menus')->count_all_results();
        if ($check > 0) {
            $this->session->set_flashdata('message', "Data Berhasil Diupdate");
            $this->db->update('menus', array('parent_id' => 0), array('parent_id' => $id));
            $this->db->delete('menus', array('id' => $id));
        } else {
            // $data['message'] = "Data deleted successfully - " . $check;
            $delete = $this->db->delete('menus', array('id' => $id));
            if ($delete) {
                $this->session->set_flashdata('message', "Data Berhasil Dihapus");
            } else {
                $this->session->set_flashdata('message', "Data gagal Berhasil Dihapus");
            }
        }
        // echo json_encode($data);
    }

    public function add($table)
    {
        if ($table == 'user') {
            $this->data = array(
                "nik" => $this->input->post('nik'),
                "username" => $this->input->post('username'),
                "password" => md5($this->input->post('password')),
                "group_id" => $this->input->post('user_group')
            );
            $url = 'main/user';
        } else if ($table == 'visit_time') {
            $url = 'main/jam-besuk';
            $this->data = array(
                "noon" => $this->input->post('noon'),
                "afternoon" => $this->input->post('afternoon'),
                "plasma_id" => $this->input->post('plasma_id')
            );
        } else if ($table == 'doctor') {
            $this->data = array(
                "name" => $this->input->post('doctorname')
            );
            $url = 'main/doctor';
        } else if ($table == 'doctor_schedule') {

            if ($this->input->post('monday') != "") {
                $monday = $this->input->post('monday');
            } else {
                $monday = "-";
            }
            if ($this->input->post('tuesday') != "") {
                $tuesday = $this->input->post('tuesday');
            } else {
                $tuesday = "-";
            }
            if ($this->input->post('wednesday') != "") {
                $wednesday = $this->input->post('wednesday');
            } else {
                $wednesday = "-";
            }
            if ($this->input->post('thursday') != "") {
                $thursday = $this->input->post('thursday');
            } else {
                $thursday = "-";
            }
            if ($this->input->post('friday') != "") {
                $friday = $this->input->post('friday');
            } else {
                $friday = "-";
            }
            if ($this->input->post('saturday') != "") {
                $saturday = $this->input->post('saturday');
            } else {
                $saturday = "-";
            }
            if ($this->input->post('sunday') != "") {
                $sunday = $this->input->post('sunday');
            } else {
                $sunday = "-";
            }
            $this->data = array(
                "doctor_id" => $this->input->post('doctor_id'),
                "room_id" => $this->input->post('room_id'),
                "monday" => $monday,
                "tuesday" => $tuesday,
                "wednesday" => $wednesday,
                "thursday" => $thursday,
                "friday" => $friday,
                "saturday" => $saturday,
                "sunday" => $sunday
            );
            $url = 'main/doctor-schedule';
        } else if ($table == 'nurse') {
            $this->data = array(
                "name" => $this->input->post('nursename')
            );
            $url = 'main/nurse';
        } else if ($table == 'nurse_of_duty') {
            $this->data = array(
                "nurse_id" => $this->input->post('nurse_id'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/nurse';
        } else if ($table == 'nurse_spv') {
            $this->data = array(
                "nurse_id" => $this->input->post('nurse_id'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/nurse-spv';
        } else if ($table == 'doctor_room') {
            $this->data = array(
                "room_number" => $this->input->post('room_number'),
                "description" => $this->input->post('description'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/doctor-room';
        } else if ($table == 'pic_nurse') {
            $this->data = array(
                "nurse_id" => $this->input->post('nurse_id'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/pic-nurse';
        } else if ($table == 'doctor_of_duty') {
            $this->data = array(
                "doctor_id" => $this->input->post('doctor_id'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/doctor-of-duty';
        } else if ($table == 'plasma') {
            $this->data = array(
                "name" => $this->input->post('display_name'),
                "title" => $this->input->post('display_title'),
                "url" => $this->input->post('url'),
                "type_id" => $this->input->post('type_id')
            );
            $url = 'main/display-management';
        } else if ($table == 'image_slide') {
            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '1024';
            // $config['max_width'] = '500';
            // $config['max_height'] = '500';
            $config['remove_space'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $url = 'main/image-slide';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('pic_name')) {
                $this->session->set_flashdata('message', $this->upload->display_errors());
                redirect($url);
            } else {
                $pic_encript = $this->upload->data('file_name');
                $this->data = array(
                    "name" => $pic_encript,
                    "description" => $this->input->post('description'),
                    "plasma_id" => $this->input->post('plasma_id')
                );
            }
        } else if ($table == 'setting') {
            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg|image|ico';
            $config['max_size']  = '1024';
            // $config['max_width'] = '500';
            // $config['max_height'] = '500';
            $config['remove_space'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $url = 'main/setting';
            $this->load->library('upload', $config);
            if (!$this->upload->do_upload('image_icon')) {
                $this->session->set_flashdata('message', 'Icon' . $this->upload->display_errors());
                redirect($url);
            } else {
                $icon = $this->upload->data('file_name');
            }

            if (!$this->upload->do_upload('image_display')) {
                $this->session->set_flashdata('message', 'Image Display' . $this->upload->display_errors());
                redirect($url);
            } else {
                $image_display = $this->upload->data('file_name');
            }
            $this->data = array(
                "image_icon" => $icon,
                "image_display" => $image_display,
                "name" => $this->input->post('rs_name')
            );
        } else if ($table == 'specialist_doctor') {
            $url = 'main/specialist-doctor';
            $this->db->from($table);
            $this->db->where('specialist_name', $this->input->post('specialist_name'));
            $check_specialist_name = $this->db->get()->row();
            if ($check_specialist_name) {
                $this->session->set_flashdata('message', "Data Gagal Disimpan, Nama Spesialis tidak boleh sama");
                redirect($url);
            } else {
                $this->data = array(
                    "specialist_name" => $this->input->post('specialist_name'),
                    "doctor_oc_1" => $this->input->post('doctor_oc_1'),
                    "doctor_oc_2" => $this->input->post('doctor_oc_2'),
                    "plasma_id" => $this->input->post('plasma_id')
                );
            }
        }

        if ($this->db->insert($table, $this->data)) {
            $this->session->set_flashdata('message', "Data Berhasil Disimpan");
        } else {
            $this->session->set_flashdata('message', "Data Gagal Disimpan");
        }
        redirect($url);
        // var_dump($this->db->last_query());
    }

    public function update($table)
    {

        if ($table == 'user') {
            $this->data = array(
                "username" => $this->input->post('username'),
                "group_id" => $this->input->post('user_group')
            );
            $url = 'main/user';
        } else if ($table == 'visit_time') {
            $this->data = array(
                "noon" => $this->input->post('noon'),
                "afternoon" => $this->input->post('afternoon'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/jam-besuk';
        } else if ($table == 'doctor') {
            $this->data = array(
                "name" => $this->input->post('doctorname')
            );
            $url = 'main/doctor';
        } else if ($table == 'doctor_of_duty') {
            $this->data = array(
                "doctor_id" => $this->input->post('doctor_id'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/doctor-of-duty';
        } else if ($table == 'doctor_schedule') {
            if ($this->input->post('monday') != "") {
                $monday = $this->input->post('monday');
            } else {
                $monday = "-";
            }
            if ($this->input->post('tuesday') != "") {
                $tuesday = $this->input->post('tuesday');
            } else {
                $tuesday = "-";
            }
            if ($this->input->post('wednesday') != "") {
                $wednesday = $this->input->post('wednesday');
            } else {
                $wednesday = "-";
            }
            if ($this->input->post('thursday') != "") {
                $thursday = $this->input->post('thursday');
            } else {
                $thursday = "-";
            }
            if ($this->input->post('friday') != "") {
                $friday = $this->input->post('friday');
            } else {
                $friday = "-";
            }
            if ($this->input->post('saturday') != "") {
                $saturday = $this->input->post('saturday');
            } else {
                $saturday = "-";
            }
            if ($this->input->post('sunday') != "") {
                $sunday = $this->input->post('sunday');
            } else {
                $sunday = "-";
            }
            $this->data = array(
                "doctor_id" => $this->input->post('doctor_id'),
                "room_id" => $this->input->post('room_id'),
                "monday" => $monday,
                "tuesday" => $tuesday,
                "wednesday" => $wednesday,
                "thursday" => $thursday,
                "friday" => $friday,
                "saturday" => $saturday,
                "sunday" => $sunday
            );
            $url = 'main/doctor-schedule';
        } else if ($table == 'nurse') {
            $this->data = array(
                "name" => $this->input->post('nursename')
            );
            $url = 'main/nurse';
        } else if ($table == 'nurse_of_duty') {
            $this->data = array(
                "nurse_id" => $this->input->post('nurse_id'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/nurse';
        } else if ($table == 'doctor_room') {
            $this->data = array(
                "room_number" => $this->input->post('room_number'),
                "description" => $this->input->post('description'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/doctor-room';
        } else if ($table == 'pic_nurse') {
            $this->data = array(
                "name" => $this->input->post('pic_nursename'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/pic-nurse';
        } else if ($table == 'image_slide') {

            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg';
            $config['max_size']  = '1024';
            // $config['max_width'] = '500';
            // $config['max_height'] = '500';
            $config['remove_space'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $url = 'main/image-slide';
            $pic_old = $this->input->post('pic_old');
            $pic_name = $this->input->post('pic_name');
            $this->load->library('upload', $config);
            if (!$_FILES['pic_name']['name']) {
                $pic_name = $pic_old;
            } else {
                $this->upload->do_upload('pic_name');
                $pic_name = $this->upload->data('file_name');
            }
            $this->data = array(
                "name" => $pic_old,
                "description" => $this->input->post('description'),
                "plasma_id" => $this->input->post('plasma_id')
            );
        } else if ($table == 'setting') {
            $config['upload_path'] = './assets/images/uploads/';
            $config['allowed_types'] = 'jpg|png|jpeg|image|ico';
            $config['max_size']  = '1024';
            // $config['max_width'] = '500';
            // $config['max_height'] = '500';
            $config['remove_space'] = TRUE;
            $config['encrypt_name'] = TRUE;

            $url = 'main/setting';
            $this->load->library('upload', $config);
            $image_icon_old = $this->input->post('image_icon_old');
            $image_display_old = $this->input->post('image_display_old');
            if (!$_FILES['image_icon']['name']) {
                $image_icon = $image_icon_old;
            } else {

                if ($this->upload->do_upload('image_icon')) {
                    $image_icon = $this->upload->data('file_name');
                }
            }
            if (!$_FILES['image_display']['name']) {
                $image_display = $image_display_old;
            } else {
                if ($this->upload->do_upload('image_display')) {
                    $image_display = $this->upload->data('file_name');
                }
            }

            $this->data = array(
                "image_icon" => $image_icon,
                "image_display" => $image_display,
                "name" => $this->input->post('rs_name')
            );
        } else if ($table == 'specialist_doctor') {
            $this->data = array(
                "specialist_name" => $this->input->post('specialist_name'),
                "doctor_oc_1" => $this->input->post('doctor_oc_1'),
                "doctor_oc_2" => $this->input->post('doctor_oc_2'),
                "plasma_id" => $this->input->post('plasma_id')
            );
            $url = 'main/specialist-doctor';
        } else if ($table == 'plasma') {
            $this->data = array(
                "name" => $this->input->post('display_name'),
                "title" => $this->input->post('display_title'),
                "url" => $this->input->post('url'),
                "type_id" => $this->input->post('type_id')
            );
            $url = 'main/display-management';
        }
        $this->db->update($table, $this->data, array('id' => $this->input->post('id')));
        $this->session->set_flashdata('message', "Data Berhasil Diupdate");
        redirect($url);
        // var_dump($this->data);
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

    public function reset($table, $id)
    {
        $password =  md5($this->input->post('passwordNew'));
        $this->data = array(
            'password' => $password
        );
        $update = $this->db->update($table, $this->data, array('id' => $id));
        if ($update) {
            $this->session->set_flashdata('message', "Data Berhasil Update");
            redirect('main/user');
        } else {
            echo json_encode(array('message' => 'Data Gagal Update'));
        }
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

    function do_switch($table)
    {
        $mode           = $_POST['mode'];
        $id             = $_POST['id'];
        $value          = $_POST['value'];
        $field_name     = $_POST['toggle'];
        $this->data = array(
            $field_name => $value
        );
        if ($mode == 'true') {
            $this->db->update($table, $this->data, array('id' => $id));
            echo json_encode(array('success' => 'OK'));
            $this->session->set_flashdata('message', "Berhasil Di Aktifkan");
        } else if ($mode == 'false') {
            $this->db->update($table, $this->data, array('id' => $id));
            echo json_encode(array('success' => 'OK'));
            $this->session->set_flashdata('message', "Berhasil Di Non-aktifkan");
        }
    }
    function do_switch_once($table)
    {
        $mode           = $_POST['mode'];
        $id             = $_POST['id'];
        $value          = $_POST['value'];
        $field_name     = $_POST['toggle'];
        $this->data = array(
            $field_name => $value
        );
        if ($mode == 'true') {
            $this->db->update($table, array('is_active' => 0), array('is_active' => 1));
            $this->db->update($table, $this->data, array('id' => $id));
            echo json_encode(array('success' => 'OK'));
            $this->session->set_flashdata('message', "Berhasil Di Aktifkan");
        } else if ($mode == 'false') {
            $this->db->update($table, array('is_active' => 1), array('is_active' => 0));
            $this->db->update($table, $this->data, array('id' => $id));
            echo json_encode(array('success' => 'OK'));
            $this->session->set_flashdata('message', "Berhasil Di Non-aktifkan");
        }
    }

    function logout()
    {
        $this->session->sess_destroy();

        redirect('home', 'refresh');
    }
}
