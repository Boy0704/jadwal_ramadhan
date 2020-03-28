<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class App extends CI_Controller {

	public $image = '';
	
	public function index()
	{
        if ($this->session->userdata('level') == '') {
            redirect('login');
        }
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }

    public function search_input()
    {
        if ($_POST) {
            $masjid = $this->input->post('masjid');
            redirect('jadwal/index/'.$masjid,'refresh');
        } else {
            $data = array(
                'konten' => 'jadwal/search_input',
                'judul_page' => 'search input',
            );
            $this->load->view('v_index', $data);
        }
    }

    public function jadwal_mubaligh($id_user)
    {
        if ($this->session->userdata('level') == '') {
            redirect('app/login');
        }
        $data = array(
            'konten' => 'jadwal/jadwal_mubaligh',
            'judul_page' => 'Jadwal mubaligh',
            'id_user' => $id_user,
        );
        $this->load->view('v_index', $data);
    }

    public function get_mubaligh($id_mubaligh)
    {
        $nama = get_data('mubaligh','id_mubaligh',$id_mubaligh,'nama');
        echo $nama;
    }

    public function admin()
	{
        // if ($this->session->userdata('username') == '') {
        //     redirect('app/login');
        // }
		$data = array(
			'konten' => 'home_admin',
            'judul_page' => 'Dashboard',
		);
		$this->load->view('v_index', $data);
    }

    public function jadwal_masjid($id_masjid)
    {
    	$data = array(
			'konten' => 'jadwal_masjid',
            'judul_page' => 'Jadwal Masjid',
            'id_masjid' => $id_masjid,
		);
		$this->load->view('v_index', $data);
    }

    public function set_hadir($id)
    {
    	$hadir = $this->input->post('hadir');
    	$this->db->where('id_jadwal', $id);
    	$this->db->update('jadwal', array('hadir'=>$hadir));
    	$this->session->set_flashdata('message', alert_biasa('Kehadiran berhasil disimpan','success'));
		redirect('app/jadwal_masjid/'.$this->session->userdata('masjid'),'refresh');
    }
    public function cetak()
    {
    	$data = array(
			'konten' => 'cetak/view',
            'judul_page' => 'Form Cetak',
		);
		$this->load->view('v_index', $data);
    }

    public function cetak_masjid()
    {
        $masjid = $this->input->post('masjid');
        $data['sql'] = $this->db->query("SELECT * FROM jadwal where id_masjid='$masjid' ");
        $this->load->view('cetak/print', $data);
    }

    public function cetak_mubaligh()
    {
        $mubaligh = $this->input->post('mubaligh');
        $data['sql'] = $this->db->query("SELECT * FROM jadwal where id_mubaligh='$mubaligh' ");
        $this->load->view('cetak/print', $data);
    }

    public function cetak_kegiatan()
    {
        $kegiatan = $this->input->post('kegiatan');
        $data['sql'] = $this->db->query("SELECT * FROM jadwal where kegiatan='$kegiatan' ");
        $this->load->view('cetak/print', $data);
    }  

    public function cetak_tgl()
    {
        $tgl1 = $this->input->post('tgl1');
        $tgl2 = $this->input->post('tgl2');
        $data['sql'] = $this->db->query("SELECT * FROM jadwal where date between '$tgl1' and '$tgl2' ");
        $this->load->view('cetak/print', $data);
    }   
	

	

	
}
