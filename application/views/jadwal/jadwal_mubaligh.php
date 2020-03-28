<div class="table-responsive">
<table class="table table-bordered" style="margin-bottom: 10px" id="example1">
            <thead>
            <tr>
                <th>No</th>
		<th>Kegiatan</th>
		<th>Mubaligh</th>
		<th>Masjid</th>
		<!-- <th>Malam Ke</th> -->
        <th>Tanggal</th>
		<th>Kehadiran</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            $jadwal_data = $this->db->get_where('jadwal', array('id_mubaligh'=>$id_user));
            foreach ($jadwal_data->result() as $jadwal)
            {
                ?>
                <tr>
			<td width="80px"><?php echo ++$start ?></td>
			<td><?php echo $jadwal->kegiatan ?></td>
			<td><?php echo get_data('mubaligh','id_mubaligh',$jadwal->id_mubaligh,'nama') ?></td>
			<td><?php echo get_data('masjid','id_masjid',$jadwal->id_masjid,'nama_masjid') ?></td>
			<!-- <td><?php echo $jadwal->malam_ke ?></td> -->
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
			
		</tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>