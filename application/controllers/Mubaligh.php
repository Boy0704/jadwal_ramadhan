<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Mubaligh extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Mubaligh_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'mubaligh/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'mubaligh/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'mubaligh/index.html';
            $config['first_url'] = base_url() . 'mubaligh/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Mubaligh_model->total_rows($q);
        $mubaligh = $this->Mubaligh_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'mubaligh_data' => $mubaligh,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'mubaligh/mubaligh_list',
            'konten' => 'mubaligh/mubaligh_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Mubaligh_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_mubaligh' => $row->id_mubaligh,
		'nama' => $row->nama,
		'jenis_kelamin' => $row->jenis_kelamin,
		'pekerjaan' => $row->pekerjaan,
		'kantor' => $row->kantor,
		'alamat_rumah' => $row->alamat_rumah,
		'telp' => $row->telp,
	    );
            $this->load->view('mubaligh/mubaligh_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mubaligh'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'mubaligh/mubaligh_form',
            'konten' => 'mubaligh/mubaligh_form',
            'button' => 'Create',
            'action' => site_url('mubaligh/create_action'),
	    'id_mubaligh' => set_value('id_mubaligh'),
	    'nama' => set_value('nama'),
	    'jenis_kelamin' => set_value('jenis_kelamin'),
	    'pekerjaan' => set_value('pekerjaan'),
	    'kantor' => set_value('kantor'),
	    'alamat_rumah' => set_value('alamat_rumah'),
	    'telp' => set_value('telp'),
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
		'nama' => $this->input->post('nama',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'pekerjaan' => $this->input->post('pekerjaan',TRUE),
		'kantor' => $this->input->post('kantor',TRUE),
		'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
		'telp' => $this->input->post('telp',TRUE),
	    );

            $this->Mubaligh_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('mubaligh'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Mubaligh_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'mubaligh/mubaligh_form',
                'konten' => 'mubaligh/mubaligh_form',
                'button' => 'Update',
                'action' => site_url('mubaligh/update_action'),
		'id_mubaligh' => set_value('id_mubaligh', $row->id_mubaligh),
		'nama' => set_value('nama', $row->nama),
		'jenis_kelamin' => set_value('jenis_kelamin', $row->jenis_kelamin),
		'pekerjaan' => set_value('pekerjaan', $row->pekerjaan),
		'kantor' => set_value('kantor', $row->kantor),
		'alamat_rumah' => set_value('alamat_rumah', $row->alamat_rumah),
		'telp' => set_value('telp', $row->telp),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mubaligh'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_mubaligh', TRUE));
        } else {
            $data = array(
		'nama' => $this->input->post('nama',TRUE),
		'jenis_kelamin' => $this->input->post('jenis_kelamin',TRUE),
		'pekerjaan' => $this->input->post('pekerjaan',TRUE),
		'kantor' => $this->input->post('kantor',TRUE),
		'alamat_rumah' => $this->input->post('alamat_rumah',TRUE),
		'telp' => $this->input->post('telp',TRUE),
	    );

            $this->Mubaligh_model->update($this->input->post('id_mubaligh', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('mubaligh'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Mubaligh_model->get_by_id($id);

        if ($row) {
            $this->Mubaligh_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('mubaligh'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('mubaligh'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama', 'nama', 'trim|required');
	$this->form_validation->set_rules('jenis_kelamin', 'jenis kelamin', 'trim|required');
	$this->form_validation->set_rules('pekerjaan', 'pekerjaan', 'trim|required');
	$this->form_validation->set_rules('kantor', 'kantor', 'trim|required');
	$this->form_validation->set_rules('alamat_rumah', 'alamat rumah', 'trim|required');
	$this->form_validation->set_rules('telp', 'telp', 'trim|required');

	$this->form_validation->set_rules('id_mubaligh', 'id_mubaligh', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Mubaligh.php */
/* Location: ./application/controllers/Mubaligh.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-03-20 13:41:17 */
/* https://jualkoding.com */