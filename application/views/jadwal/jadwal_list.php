
        <div class="row" style="margin-bottom: 10px">
            <div class="col-md-4">
                <?php echo anchor(site_url('jadwal/create'),'Create', 'class="btn btn-primary"'); ?>
            </div>
            <div class="col-md-4 text-center">
                <div style="margin-top: 8px" id="message">
                    <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
                </div>
            </div>
            <div class="col-md-1 text-right">
            </div>
            <div class="col-md-3 text-right">
                <form action="<?php echo site_url('jadwal/index'); ?>" class="form-inline" method="get">
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
                </form>
            </div>
        </div>
        <table class="table table-bordered" style="margin-bottom: 10px">
            <tr>
                <th>No</th>
		<th>Kegiatan</th>
		<th>Mubaligh</th>
		<th>Masjid</th>
		<th>Malam Ke</th>
		<!-- <th>Date</th> -->
		<th>Action</th>
            </tr><?php
            foreach ($jadwal_data as $jadwal)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $jadwal->kegiatan ?></td>
			<td><?php echo get_data('mubaligh','id_mubaligh',$jadwal->id_mubaligh,'nama') ?></td>
			<td><?php echo get_data('masjid','id_masjid',$jadwal->id_masjid,'nama_masjid') ?></td>
			<td><?php echo $jadwal->malam_ke ?></td>
			<!-- <td><?php echo $jadwal->date ?></td> -->
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
        </table>
        <div class="row">
            <div class="col-md-6">
                <a href="#" class="btn btn-primary">Total Record : <?php echo $total_rows ?></a>
	    </div>
            <div class="col-md-6 text-right">
                <?php echo $pagination ?>
            </div>
        </div>
    