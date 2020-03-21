
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Jenis Kelamin <?php echo form_error('jenis_kelamin') ?></label>
            <input type="text" class="form-control" name="jenis_kelamin" id="jenis_kelamin" placeholder="Jenis Kelamin" value="<?php echo $jenis_kelamin; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Pekerjaan <?php echo form_error('pekerjaan') ?></label>
            <input type="text" class="form-control" name="pekerjaan" id="pekerjaan" placeholder="Pekerjaan" value="<?php echo $pekerjaan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Kantor <?php echo form_error('kantor') ?></label>
            <input type="text" class="form-control" name="kantor" id="kantor" placeholder="Kantor" value="<?php echo $kantor; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat_rumah">Alamat Rumah <?php echo form_error('alamat_rumah') ?></label>
            <textarea class="form-control" rows="3" name="alamat_rumah" id="alamat_rumah" placeholder="Alamat Rumah"><?php echo $alamat_rumah; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Telp <?php echo form_error('telp') ?></label>
            <input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
        </div>
	    <input type="hidden" name="id_mubaligh" value="<?php echo $id_mubaligh; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('mubaligh') ?>" class="btn btn-default">Cancel</a>
	</form>
   