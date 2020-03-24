
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Kegiatan <?php echo form_error('kegiatan') ?></label>
            <input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="Kegiatan" value="<?php echo $kegiatan; ?>" />
        </div>
	    <input type="hidden" name="id_kegiatan" value="<?php echo $id_kegiatan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kegiatan') ?>" class="btn btn-default">Cancel</a>
	</form>
   