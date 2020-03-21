<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Setting_jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Setting_jadwal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'setting_jadwal/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'setting_jadwal/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'setting_jadwal/index.html';
            $config['first_url'] = base_url() . 'setting_jadwal/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Setting_jadwal_model->total_rows($q);
        $setting_jadwal = $this->Setting_jadwal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'setting_jadwal_data' => $setting_jadwal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'setting_jadwal/setting_jadwal_list',
            'konten' => 'setting_jadwal/setting_jadwal_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Setting_jadwal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id' => $row->id,
		'awal_ramadhan' => $row->awal_ramadhan,
		'akhir_ramadhan' => $row->akhir_ramadhan,
	    );
            $this->load->view('setting_jadwal/setting_jadwal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_jadwal'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'setting_jadwal/setting_jadwal_form',
            'konten' => 'setting_jadwal/setting_jadwal_form',
            'button' => 'Create',
            'action' => site_url('setting_jadwal/create_action'),
	    'id' => set_value('id'),
	    'awal_ramadhan' => set_value('awal_ramadhan'),
	    'akhir_ramadhan' => set_value('akhir_ramadhan'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {
            $data = array(
		'awal_ramadhan' => $this->input->post('awal_ramadhan',TRUE),
		'akhir_ramadhan' => $this->input->post('akhir_ramadhan',TRUE),
	    );

            $this->Setting_jadwal_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('setting_jadwal'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Setting_jadwal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'setting_jadwal/setting_jadwal_form',
                'konten' => 'setting_jadwal/setting_jadwal_form',
                'button' => 'Update',
                'action' => site_url('setting_jadwal/update_action'),
		'id' => set_value('id', $row->id),
		'awal_ramadhan' => set_value('awal_ramadhan', $row->awal_ramadhan),
		'akhir_ramadhan' => set_value('akhir_ramadhan', $row->akhir_ramadhan),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_jadwal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id', TRUE));
        } else {
            $data = array(
		'awal_ramadhan' => $this->input->post('awal_ramadhan',TRUE),
		'akhir_ramadhan' => $this->input->post('akhir_ramadhan',TRUE),
	    );

            $this->Setting_jadwal_model->update($this->input->post('id', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('setting_jadwal'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Setting_jadwal_model->get_by_id($id);

        if ($row) {
            $this->Setting_jadwal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('setting_jadwal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('setting_jadwal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('awal_ramadhan', 'awal ramadhan', 'trim|required');
	$this->form_validation->set_rules('akhir_ramadhan', 'akhir ramadhan', 'trim|required');

	$this->form_validation->set_rules('id', 'id', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Setting_jadwal.php */
/* Location: ./application/controllers/Setting_jadwal.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-03-20 13:41:21 */
/* https://jualkoding.com */