<!DOCTYPE html>
<html>
<head>
	<base href="<?php echo base_url() ?>">
	<title>Cetak</title>
	<link rel="stylesheet" href="assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
</head>
<body onload="print()">


	<table style="font-weight: arial;">
		<tr>
			<td>
				<img src="image/logo.jpg" style="width: 70px; height: 70px;">
			</td>
			<td>
				&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;
			</td>
			<td><center>
				<h2>KEMENTERIAN AGAMA <br>
           KANTOR KOTA TANJUNGPINANG</h2>
			</center></td>
		</tr>
	</table>
	<hr>
	<center>
		<h2>Jadwal Ramadhan</h2>
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