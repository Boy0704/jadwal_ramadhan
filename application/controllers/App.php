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

    public function import_data()
    {
        include APPPATH.'third_party/PHPExcel/PHPExcel.php';

        // Fungsi untuk melakukan proses upload file
        $return = array();
        // $this->load->library('upload'); // Load librari upload
            
        // $config['upload_path'] = './upload/import_data/';
        // $config['allowed_types'] = 'xlsx';
        // $config['max_size'] = '2048';
        // $config['overwrite'] = true;
        // $config['file_name'] = 'import_soal';
    
        // $this->upload->initialize($config); // Load konfigurasi uploadnya
        // if($this->upload->do_upload('uploadexcel')){ // Lakukan upload dan Cek jika proses upload berhasil
        //     // Jika berhasil :
        //     $return = array('result' => 'success', 'file' => $this->upload->data(), 'error' => '');
        //     // return $return;
        // }else{
        //     // Jika gagal :
        //     $return = array('result' => 'failed', 'file' => '', 'error' => $this->upload->display_errors());
        //     // return $return;
        // }
        // // print_r($return);exit();
        
        $excelreader = new PHPExcel_Reader_Excel2007();
        $loadexcel = $excelreader->load('upload/import_data/import_jadwal_ramadhan.xlsx'); // Load file yang telah diupload ke folder excel
        $sheet = $loadexcel->getActiveSheet()->toArray(null, true, true ,true);
        // Buat sebuah variabel array untuk menampung array data yg akan kita insert ke database
        $data = array();

        // log_r($sheet);


        ?>
        <table>
            <?php 
            $numrow = 1;
            $id_masjid = '';
            $id_mubaligh = '';
            $color_ms = '';
            $color_mb = '';
            foreach ($sheet as $value) {
                if($numrow > 1){
                $masjid = $value['B'];
                $mb = $value['A'];
                // log_data($masjid);
                // $this->db->like('nama_masjid', $masjid, 'BOTH');
                $this->db->where('nama_masjid', $masjid);
                $cek_masjid = $this->db->get('masjid');
                $cek_mubaligh = $this->db->query("SELECT id_mubaligh FROM mubaligh WHERE id_mubaligh='$mb' ");
                
                // log_r($cek_masjid->num_rows());
                if ($cek_masjid->num_rows() == 0) {
                    $color_ms = 'color: red;';
                } elseif ($cek_masjid->num_rows() > 1) {
                    $color_ms = 'color: red;';
                }

                else {
                    $color_ms = '';
                }

                if ($value['A'] == 'x') {
                    $color_mb = '';
                    $mb = '';
                } elseif ($value['A'] !='x' and $cek_mubaligh->num_rows() == 0) {
                    $color_mb = 'color: red;';
                }
             ?>
            <tr>
                <td style="<?php echo $color_mb ?>"><?php echo $mb ?></td>
                <td style="<?php echo $color_ms ?>"><?php echo $masjid ?></td>
                <td><?php echo $value['C'] ?></td>
                <td><?php echo $cek_masjid->row()->id_masjid ?></td>
                <td>
                <?php 
                $dt = array(
                    'kegiatan' => 'Ceramah Sholat Terawih',
                    'id_mubaligh' => $mb,
                    'id_masjid' => $cek_masjid->row()->id_masjid,
                    'malam_ke' => $value['C'],
                   
                );
                if ($mb == '') {
                    $this->db->insert('jadwal_copy', $dt);
                } else {
                    $cek_jadwal = $this->db->get_where('jadwal_copy', array('id_mubaligh'=>$mb,'id_masjid'=>$cek_masjid->row()->id_masjid,'malam_ke'=>$value['C']));
                    if ($cek_jadwal->num_rows() > 0) {
                        echo "<b>data sudah ada</b>";
                    } else {
                        $this->db->insert('jadwal_copy', $dt);
                    }
                }

                 ?>
                </td>
            </tr>
            <?php }
            $numrow++;} ?>
        </table>

        <?php
        // $this->db->insert_batch('jadwal_copy', $data);
        // log_r()
        exit;
        
        $numrow = 1;
        foreach($sheet as $row){
            // Cek $numrow apakah lebih dari 1
            // Artinya karena baris pertama adalah nama-nama kolom
            // Jadi dilewat saja, tidak usah diimport
            
            if($numrow > 1){
                // Kita push (add) array data ke variabel data
                
                // $actualdate_du = date('Y-m-d',$temp_du);
                array_push($data, array(
                    'kegiatan' => 'Ceramah Sholat Terawih',
                    'id_mubaligh' => $mb,
                    'id_masjid' => $cek_masjid->row()->id_masjid,
                    'malam_ke' => $value['C'],
                   
                ));
            }
            
            $numrow++; // Tambah 1 setiap kali looping
        }
        // echo "<pre>";
        // print_r($data);exit;

        // Panggil fungsi insert_multiple yg telah kita buat sebelumnya di model
        $this->db->insert_batch('jadwal_copy', $data);
        
        // $this->session->set_flashdata('message',alert_biasa('Import data excel berhasil','success'));
        // redirect('soal/detail_soal/'.$soal_id.'/'.$status_soal,'refresh');
    }

    public function cek_tanggal()
    {
        foreach ($this->db->get('jadwal')->result() as $rw) {
            $this->db->where('id_jadwal', $rw->id_jadwal);
            $this->db->update('jadwal', array('date'=>cek_tanggal($rw->malam_ke)));
        }
        echo 'berhasil update';
    }
	

	

	
}
