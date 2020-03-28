<div class="row">
	<div class="col-md-12">
		<div class="panel panel-info">
	      <div class="panel-heading">Cari Masjid</div>
	      <div class="panel-body">
	      	<form action="" method="POST">
	      		<label>Berdasarkan Masjid</label>
	      		<select name="masjid" class="form-control select2" required="">
	      			<option value="">--Pilih Masjid--</option>
	      			<?php foreach ($this->db->get('masjid')->result() as $rw): ?>
	      				<option value="<?php echo $rw->id_masjid ?>"><?php echo $rw->nama_masjid ?></option>
	      			<?php endforeach ?>
	      		</select><br><br>
	      		<button type="submit" class="btn btn-primary"><i class="fa fa-search">Cari</i></button>
	      	</form>
	      </div>
	    </div>
	 </div>
	</div>