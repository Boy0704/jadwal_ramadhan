
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('jadwal/create/'.$this->uri->segment(3)),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <!-- <form action="<?php echo site_url('jadwal/index'); ?>" class="form-inline" method="get">
                    <div class="input-group">
                        <input type="text" class="form-control" name="q" value="<?php echo $q; ?>">
                        <span class="input-group-btn">
                            <?php 
                                if ($q <> '')
                                {
                                    ?>
                                    <a href="<?php echo site_url('jadwal'); ?>" class="btn btn-default">Reset</a>
                                    <?php
                                }
                            ?>
                          <button class="btn btn-primary" type="submit">Search</button>
                        </span>
                    </div>
                </form> -->
            </div>
        </div>
        <div class="table-responsive">

        <table class="table table-bordered" style="margin-bottom: 10px" id="example1">
            <thead>
            <tr>
                <th>No</th>
		<th>Kegiatan</th>
		<th>Mubaligh</th>
		<th>Masjid</th>
		<th>Malam Ke</th>
        <th>Tanggal</th>
		<th>Kehadiran</th>
		<th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $this->db->where('id_masjid', $this->uri->segment(3));
            $jadwal_data = $this->db->get('jadwal');
            foreach ($jadwal_data->result() as $jadwal)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $jadwal->kegiatan ?></td>
			<td><?php echo get_data('mubaligh','id_mubaligh',$jadwal->id_mubaligh,'nama') ?></td>
			<td><?php echo get_data('masjid','id_masjid',$jadwal->id_masjid,'nama_masjid') ?></td>
			<td><?php echo $jadwal->malam_ke ?></td>
            <td><?php echo $jadwal->date ?></td>
			<td>
                <?php 
                if ($jadwal->hadir == 'not set') {
                    ?>
                    <span class="label label-warning"><?php echo $jadwal->hadir ?></span>
                    <?php
                } elseif ($jadwal->hadir == 'ya') {
                    ?>
                    <span class="label label-success"><?php echo $jadwal->hadir ?></span>
                    <?php
                } else {
                    ?>
                    <span class="label label-danger"><?php echo $jadwal->hadir ?></span>
                    <?php
                }

                 ?>         
            </td>
			<td style="text-align:center" width="100px">
				<?php 
				echo anchor(site_url('jadwal/update/'.$jadwal->id_jadwal),'<span class="label label-info">Ubah</span>'); 
				echo ' | '; 
				echo anchor(site_url('jadwal/delete/'.$jadwal->id_jadwal),'<span class="label label-danger">Hapus</span>','onclick="javasciprt: return confirm(\'Are You Sure ?\')"'); 
				?>
			</td>
		</tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>
        <!-- <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div> -->
    