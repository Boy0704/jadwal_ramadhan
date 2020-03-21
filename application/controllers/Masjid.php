<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Masjid extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Masjid_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'masjid/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'masjid/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'masjid/index.html';
            $config['first_url'] = base_url() . 'masjid/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Masjid_model->total_rows($q);
        $masjid = $this->Masjid_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'masjid_data' => $masjid,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'masjid/masjid_list',
            'konten' => 'masjid/masjid_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Masjid_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_masjid' => $row->id_masjid,
		'nama_masjid' => $row->nama_masjid,
		'alamat' => $row->alamat,
		'pengurus' => $row->pengurus,
		'telp' => $row->telp,
		'id_kelurahan' => $row->id_kelurahan,
	    );
            $this->load->view('masjid/masjid_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('masjid'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'masjid/masjid_form',
            'konten' => 'masjid/masjid_form',
            'button' => 'Create',
            'action' => site_url('masjid/create_action'),
	    'id_masjid' => set_value('id_masjid'),
	    'nama_masjid' => set_value('nama_masjid'),
	    'alamat' => set_value('alamat'),
	    'pengurus' => set_value('pengurus'),
	    'telp' => set_value('telp'),
	    'id_kelurahan' => set_value('id_kelurahan'),
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
		'nama_masjid' => $this->input->post('nama_masjid',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'pengurus' => $this->input->post('pengurus',TRUE),
		'telp' => $this->input->post('telp',TRUE),
		'id_kelurahan' => $this->input->post('id_kelurahan',TRUE),
	    );

            $this->Masjid_model->insert($data);
            $this->session->set_flashdata('message', 'Create Record Success');
            redirect(site_url('masjid'));
        }
    }
    
    public function update($id) 
    {
        $row = $this->Masjid_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'masjid/masjid_form',
                'konten' => 'masjid/masjid_form',
                'button' => 'Update',
                'action' => site_url('masjid/update_action'),
		'id_masjid' => set_value('id_masjid', $row->id_masjid),
		'nama_masjid' => set_value('nama_masjid', $row->nama_masjid),
		'alamat' => set_value('alamat', $row->alamat),
		'pengurus' => set_value('pengurus', $row->pengurus),
		'telp' => set_value('telp', $row->telp),
		'id_kelurahan' => set_value('id_kelurahan', $row->id_kelurahan),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('masjid'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_masjid', TRUE));
        } else {
            $data = array(
		'nama_masjid' => $this->input->post('nama_masjid',TRUE),
		'alamat' => $this->input->post('alamat',TRUE),
		'pengurus' => $this->input->post('pengurus',TRUE),
		'telp' => $this->input->post('telp',TRUE),
		'id_kelurahan' => $this->input->post('id_kelurahan',TRUE),
	    );

            $this->Masjid_model->update($this->input->post('id_masjid', TRUE), $data);
            $this->session->set_flashdata('message', 'Update Record Success');
            redirect(site_url('masjid'));
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Masjid_model->get_by_id($id);

        if ($row) {
            $this->Masjid_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('masjid'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('masjid'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('nama_masjid', 'nama masjid', 'trim|required');
	$this->form_validation->set_rules('alamat', 'alamat', 'trim|required');
	$this->form_validation->set_rules('pengurus', 'pengurus', 'trim|required');
	$this->form_validation->set_rules('telp', 'telp', 'trim|required');
	$this->form_validation->set_rules('id_kelurahan', 'id kelurahan', 'trim|required');

	$this->form_validation->set_rules('id_masjid', 'id_masjid', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Masjid.php */
/* Location: ./application/controllers/Masjid.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-03-20 13:41:11 */
/* https://jualkoding.com */