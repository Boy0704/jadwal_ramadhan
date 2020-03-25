<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
	      <div class="panel-heading">Form Cetak</div>
	      <div class="panel-body">
	      	<form action="app/cetak_masjid" method="POST">
	      		<label>Berdasarkan Masjid</label>
	      		<select name="masjid" class="form-control select2" required="">
	      			<option value="">--Pilih Masjid--</option>
	      			<?php foreach ($this->db->get('masjid')->result() as $rw): ?>
	      				<option value="<?php echo $rw->id_masjid ?>"><?php echo $rw->nama_masjid ?></option>
	      			<?php endforeach ?>
	      		</select><br><br>
	      		<button type="submit" class="btn btn-primary"><i class="fa fa-print">Print</i></button>
	      	</form>

	      	<hr>

	      	<form action="app/cetak_mubaligh" method="POST">
	      		<label>Berdasarkan Mubaligh</label>
	      		<select name="mubaligh" class="form-control select2" required="">
	      			<option value="">--Pilih Mubaligh--</option>
	      			<?php foreach ($this->db->get('mubaligh')->result() as $rw): ?>
	      				<option value="<?php echo $rw->id_mubaligh ?>"><?php echo $rw->nama ?></option>
	      			<?php endforeach ?>
	      		</select><br><br>
	      		<button type="submit" class="btn btn-primary"><i class="fa fa-print">Print</i></button>
	      	</form>

	      	<hr>

	      	<form action="app/cetak_kegiatan" method="POST">
	      		<label>Berdasarkan Kegiatan</label>
	      		<select name="kegiatan" class="form-control select2" required="">
	      			<option value="">--Pilih Kegiatan--</option>
	      			<?php foreach ($this->db->get('kegiatan')->result() as $rw): ?>
	      				<option value="<?php echo $rw->kegiatan ?>"><?php echo $rw->kegiatan ?></option>
	      			<?php endforeach ?>
	      		</select><br><br>
	      		<button type="submit" class="btn btn-primary"><i class="fa fa-print">Print</i></button>
	      	</form>


	      	<hr>

	      	<form action="app/cetak_tgl" method="POST">
	      		<label>Dari Tanggal</label>
	      		<input type="date" name="tgl1" class="form-control">
	      		<label>Sampai Tanggal</label>
	      		<input type="date" name="tgl2" class="form-control"><br><br>
	      		<button type="submit" class="btn btn-primary"><i class="fa fa-print">Print</i></button>
	      	</form>

	      </div>
	    </div>
	</div>
</div>