
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama Kelurahan <?php echo form_error('nama_kelurahan') ?></label>
            <input type="text" class="form-control" name="nama_kelurahan" id="nama_kelurahan" placeholder="Nama Kelurahan" value="<?php echo $nama_kelurahan; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kecamatan <?php echo form_error('id_kecamatan') ?></label>
            <!-- <input type="text" class="form-control" name="id_kecamatan" id="id_kecamatan" placeholder="Id Kecamatan" value="<?php echo $id_kecamatan; ?>" /> -->
            <select class="form-control select2" name="id_kecamatan">
                <option value="<?php echo $id_kecamatan ?>"><?php echo get_data('kecamatan','id_kecamatan',$id_kecamatan,'nama_kecamatan') ?></option>
                <?php foreach ($this->db->get('kecamatan')->result() as $key => $value): ?>
                    <option value="<?php echo $value->id_kecamatan ?>"><?php echo $value->nama_kecamatan ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <input type="hidden" name="id_kelurahan" value="<?php echo $id_kelurahan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('kelurahan') ?>" class="btn btn-default">Cancel</a>
	</form>
   