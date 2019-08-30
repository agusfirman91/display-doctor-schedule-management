<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

	public function __construct()
    {
        parent::__construct();
		$this->load->model('m_login');
		$this->load->model('m_main');
		$this->load->model('m_display');
    }


	public function index()
	{
		$data['title'] = 'Halaman Home - Hospital Information';
		$data['plasma'] = $this->m_main->getWhere('plasma','is_active=1');
        $data['setting'] = $this->m_display->getWhere('setting', 'is_active=1');
		$this->load->view('_partials/header', $data);
		$this->load->view('home', $data);
		$this->load->view('_partials/footer');
	}
}
