<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Kelurahan extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Kelurahan_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'kelurahan/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'kelurahan/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'kelurahan/index.html';
            $config['first_url'] = base_url() . 'kelurahan/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Kelurahan_model->total_rows($q);
        $kelurahan = $this->Kelurahan_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'kelurahan_data' => $kelurahan,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'kelurahan/kelurahan_list',
            'konten' => 'kelurahan/kelurahan_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Kelurahan_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_kelurahan' => $row->id_kelurahan,
		'nama_kelurahan' => $row->nama_kelurahan,
		'id_kecamatan' => $row->id_kecamatan,
	    );
            $this->load->view('kelurahan/kelurahan_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelurahan'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'kelurahan/kelurahan_form',
            'konten' => 'kelurahan/kelurahan_form',
            'button' => 'Create',
            'action' => site_url('kelurahan/create_action'),
	    'id_kelurahan' => set_value('id_kelurahan'),
	    'nama_kelurahan' => set_value('nama_kelurahan'),
	    'id_kecamatan' => set_value('id_kecamatan'),
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
		'nama_kelurahan' => $this->input->post('nama_kelurahan',TRUE),
		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
	    );

            $this->Kelurahan_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('kelurahan'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Kelurahan_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'kelurahan/kelurahan_form',
                'konten' => 'kelurahan/kelurahan_form',
                'button' => 'Update',
                'action' => site_url('kelurahan/update_action'),
		'id_kelurahan' => set_value('id_kelurahan', $row->id_kelurahan),
		'nama_kelurahan' => set_value('nama_kelurahan', $row->nama_kelurahan),
		'id_kecamatan' => set_value('id_kecamatan', $row->id_kecamatan),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelurahan'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_kelurahan', TRUE));
        } else {
            $data = array(
		'nama_kelurahan' => $this->input->post('nama_kelurahan',TRUE),
		'id_kecamatan' => $this->input->post('id_kecamatan',TRUE),
	    );

            $this->Kelurahan_model->update($this->input->post('id_kelurahan', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('kelurahan'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Kelurahan_model->get_by_id($id);

        if ($row) {
            $this->Kelurahan_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('kelurahan'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('kelurahan'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_kelurahan', 'nama kelurahan', 'trim|required');
	$this->form_validation->set_rules('id_kecamatan', 'id kecamatan', 'trim|required');

	$this->form_validation->set_rules('id_kelurahan', 'id_kelurahan', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Kelurahan.php */
/* Location: ./application/controllers/Kelurahan.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-03-20 13:41:05 */
/* https://jualkoding.com */