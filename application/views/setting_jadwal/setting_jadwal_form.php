
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="date">Awal Ramadhan <?php echo form_error('awal_ramadhan') ?></label>
            <input type="text" class="form-control" name="awal_ramadhan" id="awal_ramadhan" placeholder="Awal Ramadhan" value="<?php echo $awal_ramadhan; ?>" />
        </div>
	    <div class="form-group">
            <label for="date">Akhir Ramadhan <?php echo form_error('akhir_ramadhan') ?></label>
            <input type="text" class="form-control" name="akhir_ramadhan" id="akhir_ramadhan" placeholder="Akhir Ramadhan" value="<?php echo $akhir_ramadhan; ?>" />
        </div>
	    <input type="hidden" name="id" value="<?php echo $id; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('setting_jadwal') ?>" class="btn btn-default">Cancel</a>
	</form>
   