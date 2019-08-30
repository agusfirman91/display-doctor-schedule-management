<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Display extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('m_display');
    }

    public function index($name_url = null)
    { 
        // $data = array();
        // var_dump($data);
        $data['display'] = $this->m_display->getJoin('plasma',
                                                        'type_plasma',
                                                        '*',
                                                        'name as type_name',
                                                        'plasma.type_id = type_plasma.id',
                                                        'plasma.url="'.$name_url.'"',
                                                        'plasma.is_active = 1'
                                                    );
        $data['images'] = $this->m_display->getAllJoin('plasma',
                                                        'type_plasma',
                                                        'image_slide',
                                                        'id as id_plasma, type_id',
                                                        'name as type_name',
                                                        'name as pic_name',
                                                        'plasma.type_id = type_plasma.id',
                                                        'plasma.id= image_slide.plasma_id',
                                                        'plasma.url="'.$name_url.'"',
                                                        'plasma.is_active = 1'
                                                    );
        
        $data['list_doctor_of_duty'] = $this->m_display->getAllJoin('plasma',
                                                            'doctor_of_duty',
                                                            'doctor',
                                                            '*',
                                                            'doctor_id',
                                                            'name as doctor_name',
                                                            'plasma.id = doctor_of_duty.plasma_id',
                                                            'doctor_of_duty.doctor_id = doctor.id',
                                                            'plasma.url="'.$name_url.'"',
                                                            'plasma.is_active = 1'
                                                        );
        $data['list_nurse_of_duty'] = $this->m_display->getAllJoin('plasma',
                                                            'nurse_of_duty',
                                                            'nurse',
                                                            '*',
                                                            'nurse_id',
                                                            'name as nurse_name',
                                                            'plasma.id = nurse_of_duty.plasma_id',
                                                            'nurse_of_duty.nurse_id = nurse.id',
                                                            'plasma.url="'.$name_url.'"',
                                                            'plasma.is_active = 1'
                                                        );
        $data['list_pic_nurse'] = $this->m_display->getAllJoin('plasma',
                                                            'pic_nurse',
                                                            'nurse',
                                                            '*',
                                                            'nurse_id',
                                                            'name as nurse_name',
                                                            'plasma.id = pic_nurse.plasma_id',
                                                            'pic_nurse.nurse_id = nurse.id',
                                                            'plasma.url="'.$name_url.'"',
                                                            'plasma.is_active = 1'
                                                        );
        $data['list_nurse_spv'] = $this->m_display->getAllJoin('plasma',
                                                            'nurse_spv',
                                                            'nurse',
                                                            '*',
                                                            'nurse_id',
                                                            'name as nurse_name',
                                                            'plasma.id = nurse_spv.plasma_id',
                                                            'nurse_spv.nurse_id = nurse.id',
                                                            'plasma.url="'.$name_url.'"',
                                                            'plasma.is_active = 1'
                                                        );
        $type_name              = $data['display']['0']->type_name;
        $is_doctor_of_duty      = $data['display']['0']->is_doctor_of_duty;
        $is_specialist_doctor   = $data['display']['0']->is_specialist_doctor;
        $is_nurse               = $data['display']['0']->is_nurse;
        $is_pic_nurse           = $data['display']['0']->is_pic_nurse;
        $is_image_slide           = $data['display']['0']->is_image_slide;
        // $data['plasma'] = $this->m_display->getWhere('plasma', 'url="'.$name_url.'"');
        $data['setting'] = $this->m_display->getWhere('setting', 'is_active=1');
        if($type_name == 'igd'){
            if(($is_doctor_of_duty !=1) OR ($is_specialist_doctor !=1) OR ($is_pic_nurse !=1) OR ($is_image_slide !=1)){
                $this->session->set_flashdata('message', "Data Gagal Disimpan, Nama Spesialis tidak boleh sama");
                // echo "<script>
                // Swal.fire({title: 'Error!',text: 'Tampilan plasma tidak bisa di akses, Silahakan hubungi IT Department untuk cek konfigurasinya',type: 'error',confirmButtonText: 'OK'}).then(function() {window.location = '../home';});</script> ";
                
            }else{ 
                $data['list_igd'] = $this->m_display->getAllJoin('specialist_doctor',
                                                        'plasma',
                                                        'doctor',
                                                        '*',
                                                        'name as plasma_name',
                                                        'name',
                                                        'specialist_doctor.plasma_id=plasma.id',
                                                        'specialist_doctor.doctor_oc_1=doctor.id or specialist_doctor.doctor_oc_2=doctor.id',
                                                        'plasma.url="'.$name_url.'"',
                                                        'plasma.is_active = 1'
                                                    );
                $data['list_nurse'] = $this->m_display->getAllJoin('nurse',
                                                                'nurse_of_duty', 
                                                                'plasma', 
                                                                'name as nurse_name', 
                                                                'nurse_id',
                                                                'title',
                                                                'nurse_of_duty.nurse_id = nurse.id', 
                                                                'nurse_of_duty.plasma_id = plasma.id', 
                                                                'plasma.url="'.$name_url.'"',
                                                                'plasma.is_active = 1'
                                                            );
                $this->load->view('_partials/header', $data);
                $this->load->view('display/igd',  $data);
                $this->load->view('_partials/footer');
                // $this->output->enable_profiler(TRUE);
            }
        }else if ($type_name == 'rajal'){
        $c_day = date('l');  
        $data['rajal'] = $this->m_display->getAllJoin('plasma',
                                                        'doctor_room',
                                                        'doctor_schedule',
                                                        'url, is_active',
                                                        '*',
                                                        'doctor_id, ' . $c_day . ' as c_day',
                                                        'doctor_room.plasma_id=plasma.id',
                                                        'doctor_schedule.room_id=doctor_room.id',
                                                        'plasma.url="'.$name_url.'"',
                                                        'plasma.is_active = 1'
                                                    );
                $this->load->view('_partials/header', $data);
                $this->load->view('display/rajal',  $data);
                $this->load->view('_partials/footer');
        }else if ($type_name == 'ranap'){
        $data['visit_time'] = $this->m_display->getAllJoinRow('plasma',
                                                        'type_plasma',
                                                        'visit_time',
                                                        'id as id_plasma, type_id',
                                                        'name as type_name',
                                                        'noon,afternoon',
                                                        'plasma.type_id = type_plasma.id',
                                                        'plasma.id= visit_time.plasma_id',
                                                        'plasma.url="'.$name_url.'"',
                                                        'plasma.is_active = 1'
                                                    );  
                $this->load->view('_partials/header', $data);
                $this->load->view('display/ranap',  $data);
                $this->load->view('_partials/footer');
                // var_dump($data['visit_time']);
                // $this->output->enable_profiler(TRUE);
        }
        // $this->load->view('display/'.$type_name.'',  $data);
        // echo 'Type = '.$type_name.' - Dokter Jaga = '.$is_doctor_of_duty.' - Dokter Specialis = '.$is_specialist_doctor.' - Perawat ='.$is_nurse.' - Perawat Jaga ='.$is_pic_nurse;
        // redirect('home');
    }
}
