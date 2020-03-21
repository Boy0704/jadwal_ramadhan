
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Kecamatan <?php echo form_error('nama_kecamatan') ?></label>
            <input type="text" class="form-control" name="nama_kecamatan" id="nama_kecamatan" placeholder="Nama Kecamatan" value="<?php echo $nama_kecamatan; ?>" />
        </div>
	    <input type="hidden" name="id_kecamatan" value="<?php echo $id_kecamatan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kecamatan') ?>" class="btn btn-default">Cancel</a>
	</form>
   