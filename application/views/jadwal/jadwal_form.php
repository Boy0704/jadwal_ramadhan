
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Kegiatan <?php echo form_error('kegiatan') ?></label>
            <!-- <input type="text" class="form-control" name="kegiatan" id="kegiatan" placeholder="Kegiatan" value="<?php echo $kegiatan; ?>" /> -->
            <select name="kegiatan" class="form-control select2">
                <option value="<?php echo $kegiatan ?>"><?php echo $kegiatan ?></option>
                <?php foreach ($this->db->get('kegiatan')->result() as $rw): ?>
                    <option value="<?php echo $rw->kegiatan ?>"><?php echo $rw->kegiatan ?></option>
                <?php endforeach ?>
                
            </select>
        </div>
	    <div class="form-group">
            <label for="int">Mubaligh <?php echo form_error('id_mubaligh') ?></label>
            <!-- <input type="text" class="form-control" name="id_mubaligh" id="id_mubaligh" placeholder="Id Mubaligh" value="<?php echo $id_mubaligh; ?>" /> -->
            <select name="id_mubaligh" class="form-control select2">
                <option value="<?php echo $id_mubaligh ?>"><?php echo $id_mubaligh ?></option>
                <?php foreach ($this->db->get('mubaligh')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_mubaligh ?>"><?php echo $rw->nama ?></option>
                <?php endforeach ?>
                
            </select>
        </div>
	    <div class="form-group">
            <label for="int">Masjid <?php echo form_error('id_masjid') ?></label>
            <!-- <input type="text" class="form-control" name="id_masjid" id="id_masjid" placeholder="Id Masjid" value="<?php echo $id_masjid; ?>" /> -->
            <select name="id_masjid" class="form-control select2">
                <option value="<?php echo $id_masjid ?>"><?php echo $id_masjid ?></option>
                <?php foreach ($this->db->get('masjid')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_masjid ?>"><?php echo $rw->nama_masjid ?></option>
                <?php endforeach ?>
                
            </select>
        </div>
	    <!-- <div class="form-group">
            <label for="int">Malam Ke <?php echo form_error('malam_ke') ?></label>
            <input type="text" class="form-control" name="malam_ke" id="malam_ke" placeholder="1" value="<?php echo $malam_ke; ?>" />
        </div> -->
	    <div class="form-group">
            <label for="date">Tanggal <?php echo form_error('date') ?></label>
            <input type="date" class="form-control" name="date" id="date" placeholder="Date" value="<?php echo $date; ?>" />
        </div>
	    <input type="hidden" name="id_jadwal" value="<?php echo $id_jadwal; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('jadwal') ?>" class="btn btn-default">Cancel</a>
	</form>
   