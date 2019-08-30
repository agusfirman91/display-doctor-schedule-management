<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Login extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_login');
    }


    public function index()
    {
        if ($this->m_login->logged_id()) {
            //jika memang session sudah terdaftar, maka redirect ke halaman dahsboard
            redirect("main");
        } else {

            //jika session belum terdaftar

            //set form validation
            $this->form_validation->set_rules('username', 'Username', 'required');
            $this->form_validation->set_rules('password', 'Password', 'required');

            //set message form validation
            $this->form_validation->set_message('required', '<div class="alert alert-danger" style="margin-top: 3px">
                <div class="header"><b><i class="fa fa-exclamation-circle"></i> {field}</b> harus diisi</div></div>');

            //cek validasi
            if ($this->form_validation->run() == TRUE) {

                //get data dari FORM
                $username = $this->input->post("username", TRUE);
                $password = MD5($this->input->post('password', TRUE));

                //checking data via model
                $checking = $this->m_login->check_login('user', array('username' => $username), array('password' => $password));

                $userdata = $this->m_login->getJoin('user', 'groups', '*', '*', 'user.group_id= groups.id', 'user.username = "' . $username . '" ');
                //jika ditemukan, maka create session
                if ($checking != FALSE) {
                    foreach ($checking as $apps) {

                        $session_data = array(
                            'user_id'   => $apps->id,
                            'user_name' => $apps->username,
                            'group_id' => $userdata->group_id,
                        );
                        //set session userdata
                        $this->session->set_userdata($session_data);
                        // $this->output->enable_profiler(TRUE);
                        redirect('main');
                    }
                } else {

                    $this->session->set_flashdata('message', "ERROR, username atau password salah!");
                    $data['error'] = '<div class="alert alert-danger" style="margin-top: 3px">
                    <div class="header"></div></div>';
                    redirect('home');
                }
            } else {
                redirect('home');
            }
        }
    }
}
