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
		<th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $start = 0;
            $jadwal_data = $this->db->get_where('jadwal', array('id_masjid'=>$id_masjid));
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
			<td>
                <a href="#" data-toggle="modal" data-target="#cek_<?php echo $jadwal->id_jadwal ?>" class="btn btn-xs btn-info">SET KEHADIRAN</a>   

                <!-- Modal -->
                <div id="cek_<?php echo $jadwal->id_jadwal ?>" class="modal fade" role="dialog">
                  <div class="modal-dialog">

                    <!-- Modal content-->
                    <div class="modal-content">
                      <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Yakin Akan simpan ini ?</h4>
                      </div>
                      <div class="modal-body">
                        <form action="app/set_hadir/<?php echo $jadwal->id_jadwal ?>" method="post">
                            <input type="radio" name="hadir" value="ya" required=""> YA 
                            <input type="radio" name="hadir" value="tidak" required="">TIDAK
                            <br><br>
                            <button type="submit" class="btn btn-success btn-block">SIMPAN</button>
                        </form>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                      </div>
                    </div>

                  </div>
                </div>   

            </td>
		</tr>
                <?php
            }
            ?>
            </tbody>
        </table>
    </div>