<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $q = urldecode($this->input->get('q', TRUE));
        $start = intval($this->input->get('start'));
        
        if ($q <> '') {
            $config['base_url'] = base_url() . 'jadwal/index.html?q=' . urlencode($q);
            $config['first_url'] = base_url() . 'jadwal/index.html?q=' . urlencode($q);
        } else {
            $config['base_url'] = base_url() . 'jadwal/index.html';
            $config['first_url'] = base_url() . 'jadwal/index.html';
        }

        $config['per_page'] = 10;
        $config['page_query_string'] = TRUE;
        $config['total_rows'] = $this->Jadwal_model->total_rows($q);
        $jadwal = $this->Jadwal_model->get_limit_data($config['per_page'], $start, $q);

        $this->load->library('pagination');
        $this->pagination->initialize($config);

        $data = array(
            'jadwal_data' => $jadwal,
            'q' => $q,
            'pagination' => $this->pagination->create_links(),
            'total_rows' => $config['total_rows'],
            'start' => $start,
            'judul_page' => 'jadwal/jadwal_list',
            'konten' => 'jadwal/jadwal_list',
        );
        $this->load->view('v_index', $data);
    }

    public function read($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);
        if ($row) {
            $data = array(
		'id_jadwal' => $row->id_jadwal,
		'kegiatan' => $row->kegiatan,
		'id_mubaligh' => $row->id_mubaligh,
		'id_masjid' => $row->id_masjid,
		'malam_ke' => $row->malam_ke,
		'date' => $row->date,
	    );
            $this->load->view('jadwal/jadwal_read', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }

    public function create() 
    {
        $data = array(
            'judul_page' => 'jadwal/jadwal_form',
            'konten' => 'jadwal/jadwal_form',
            'button' => 'Create',
            'action' => site_url('jadwal/create_action'),
	    'id_jadwal' => set_value('id_jadwal'),
	    'kegiatan' => set_value('kegiatan'),
	    'id_mubaligh' => set_value('id_mubaligh'),
	    'id_masjid' => set_value('id_masjid'),
	    'malam_ke' => set_value('malam_ke'),
	    'date' => set_value('date'),
	);
        $this->load->view('v_index', $data);
    }
    
    public function create_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->create();
        } else {

            //cek_jadwal

            $mubaligh = get_data('mubaligh','id_mubaligh',$this->input->post('id_mubaligh'),'nama');

            $cek = $this->db->get_where('jadwal', array(
                'id_mubaligh'=>$this->input->post('id_mubaligh'),
                'date'=>$this->input->post('date'),
            ));
            if ($cek->num_rows() > 0) {
                $this->session->set_flashdata('message', alert_biasa($mubaligh.' Sudah ada jadwal di tanggal '.$this->input->post('date').', silahkan cek lagi data anda !','warning'));
                redirect('jadwal','refresh');
            } else {

                    $data = array(
        		'kegiatan' => $this->input->post('kegiatan',TRUE),
        		'id_mubaligh' => $this->input->post('id_mubaligh',TRUE),
        		'id_masjid' => $this->input->post('id_masjid',TRUE),
        		'malam_ke' => $this->input->post('malam_ke',TRUE),
        		'date' => $this->input->post('date',TRUE),
        	    );

                $this->Jadwal_model->insert($data);
                $this->session->set_flashdata('message', 'Create Record Success');
                redirect(site_url('jadwal'));
            }
        }
    }
    
    public function update($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $data = array(
                'judul_page' => 'jadwal/jadwal_form',
                'konten' => 'jadwal/jadwal_form',
                'button' => 'Update',
                'action' => site_url('jadwal/update_action'),
		'id_jadwal' => set_value('id_jadwal', $row->id_jadwal),
		'kegiatan' => set_value('kegiatan', $row->kegiatan),
		'id_mubaligh' => set_value('id_mubaligh', $row->id_mubaligh),
		'id_masjid' => set_value('id_masjid', $row->id_masjid),
		'malam_ke' => set_value('malam_ke', $row->malam_ke),
		'date' => set_value('date', $row->date),
	    );
            $this->load->view('v_index', $data);
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }
    
    public function update_action() 
    {
        $this->_rules();

        if ($this->form_validation->run() == FALSE) {
            $this->update($this->input->post('id_jadwal', TRUE));
        } else {

            //cek_jadwal

            $mubaligh = get_data('mubaligh','id_mubaligh',$this->input->post('id_mubaligh'),'nama');

            $cek = $this->db->get_where('jadwal', array(
                'id_mubaligh'=>$this->input->post('id_mubaligh'),
                'date'=>$this->input->post('date'),
            ));
            if ($cek->num_rows() > 0) {
                $this->session->set_flashdata('message', alert_biasa($mubaligh.' Sudah ada jadwal di tanggal '.$this->input->post('date').', silahkan cek lagi data anda !','warning'));
                redirect('jadwal','refresh');
            } else {

                $data = array(
    		'kegiatan' => $this->input->post('kegiatan',TRUE),
    		'id_mubaligh' => $this->input->post('id_mubaligh',TRUE),
    		'id_masjid' => $this->input->post('id_masjid',TRUE),
    		'malam_ke' => $this->input->post('malam_ke',TRUE),
    		'date' => $this->input->post('date',TRUE),
    	    );

                $this->Jadwal_model->update($this->input->post('id_jadwal', TRUE), $data);
                $this->session->set_flashdata('message', 'Update Record Success');
                redirect(site_url('jadwal'));
            }
        }
    }
    
    public function delete($id) 
    {
        $row = $this->Jadwal_model->get_by_id($id);

        if ($row) {
            $this->Jadwal_model->delete($id);
            $this->session->set_flashdata('message', 'Delete Record Success');
            redirect(site_url('jadwal'));
        } else {
            $this->session->set_flashdata('message', 'Record Not Found');
            redirect(site_url('jadwal'));
        }
    }

    public function _rules() 
    {
	$this->form_validation->set_rules('kegiatan', 'kegiatan', 'trim|required');
	$this->form_validation->set_rules('id_mubaligh', 'id mubaligh', 'trim|required');
	$this->form_validation->set_rules('id_masjid', 'id masjid', 'trim|required');
	// $this->form_validation->set_rules('malam_ke', 'malam ke', 'trim|required');
	$this->form_validation->set_rules('date', 'date', 'trim|required');

	$this->form_validation->set_rules('id_jadwal', 'id_jadwal', 'trim');
	$this->form_validation->set_error_delimiters('<span class="text-danger">', '</span>');
    }

}

/* End of file Jadwal.php */
/* Location: ./application/controllers/Jadwal.php */
/* Please DO NOT modify this information : */
/* Generated by Boy Kurniawan 2020-03-24 04:45:56 */
/* https://jualkoding.com */