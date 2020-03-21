
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Masjid <?php echo form_error('nama_masjid') ?></label>
            <input type="text" class="form-control" name="nama_masjid" id="nama_masjid" placeholder="Nama Masjid" value="<?php echo $nama_masjid; ?>" />
        </div>
	    <div class="form-group">
            <label for="alamat">Alamat <?php echo form_error('alamat') ?></label>
            <textarea class="form-control" rows="3" name="alamat" id="alamat" placeholder="Alamat"><?php echo $alamat; ?></textarea>
        </div>
	    <div class="form-group">
            <label for="varchar">Pengurus <?php echo form_error('pengurus') ?></label>
            <input type="text" class="form-control" name="pengurus" id="pengurus" placeholder="Pengurus" value="<?php echo $pengurus; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Telp <?php echo form_error('telp') ?></label>
            <input type="text" class="form-control" name="telp" id="telp" placeholder="Telp" value="<?php echo $telp; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Id Kelurahan <?php echo form_error('id_kelurahan') ?></label>
            <input type="text" class="form-control" name="id_kelurahan" id="id_kelurahan" placeholder="Id Kelurahan" value="<?php echo $id_kelurahan; ?>" />
        </div>
	    <input type="hidden" name="id_masjid" value="<?php echo $id_masjid; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('masjid') ?>" class="btn btn-default">Cancel</a>
	</form>
   