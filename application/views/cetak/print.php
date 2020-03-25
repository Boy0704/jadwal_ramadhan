<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak</title>
	<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body>
	<center>
		<h2>CETAK JADWAL</h2>
	</center>
	<hr>

	<table class="table table-bordered">
		<tr>
			<th>No</th>
			<th>Kegiatan</th>
			<th>Mubaligh</th>
			<th>Masjid</th>
			<th>Tanggal</th>
			<th>Kehadiran</th>
		</tr>
		<?php 
		$no = 1;
		foreach ($sql->result() as $rw) {
		 ?>
		<tr>
			<td><?php echo $no; ?></td>
			<td><?php echo $rw->kegiatan ?></td>
			<td><?php echo get_data('mubaligh','id_mubaligh',$rw->id_mubaligh,'nama'); ?></td>
			<td><?php echo get_data('masjid','id_masjid',$rw->id_masjid,'nama_masjid'); ?></td>
			<td><?php echo $rw->date ?></td>
			<td><?php echo $rw->hadir ?></td>
		</tr>
		<?php $no++; } ?>
	</table>
</body>
</html>