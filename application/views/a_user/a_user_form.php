
        <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
	    <div class="form-group">
            <label for="varchar">Nama Lengkap <?php echo form_error('nama_lengkap') ?></label>
            <input type="text" class="form-control" name="nama_lengkap" id="nama_lengkap" placeholder="Nama Lengkap" value="<?php echo $nama_lengkap; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Username <?php echo form_error('username') ?></label>
            <input type="text" class="form-control" name="username" id="username" placeholder="Username" value="<?php echo $username; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Password <?php echo form_error('password') ?></label>
            <input type="text" class="form-control" name="password" id="password" placeholder="Password" value="<?php echo $password; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">Level <?php echo form_error('level') ?></label>
            <!-- <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" /> -->
            <select name="level" class="form-control" id="level">
                <option value="<?php echo $level ?>"><?php echo $level ?></option>
                <option value="1">Admin</option>
                <option value="2">Masjid</option>
                <option value="3">Mubaligh</option>
            </select>
        </div>
        <div class="form-group" style="display: none;" id="mubaligh">
            <label for="varchar">Mubaligh</label>
            <!-- <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" /> -->
            <select name="id_mubaligh" class="form-control" id="id_mubaligh">
                <option value="<?php echo $id_mubaligh ?>"><?php echo $id_mubaligh ?></option>
                <?php foreach ($this->db->get('mubaligh')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_mubaligh ?>"><?php echo $rw->nama ?></option>
                <?php endforeach ?>
            </select>
        </div>
        <div class="form-group">
            <label for="varchar">Masjid</label>
            <!-- <input type="text" class="form-control" name="level" id="level" placeholder="Level" value="<?php echo $level; ?>" /> -->
            <select name="masjid" class="form-control" id="masjid">
                <option value="<?php echo $masjid ?>"><?php echo $masjid ?></option>
                <option value="0">Semua Masjid</option>
                <?php foreach ($this->db->get('masjid')->result() as $rw): ?>
                    <option value="<?php echo $rw->id_masjid ?>"><?php echo $rw->nama_masjid ?></option>
                <?php endforeach ?>
            </select>
        </div>
	    <div class="form-group">
            <label for="varchar">Foto <?php echo form_error('foto') ?></label>
            <input type="file" class="form-control" name="foto" id="foto" placeholder="Foto" value="<?php echo $foto; ?>" />
        </div>
	    <input type="hidden" name="id_user" value="<?php echo $id_user; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('a_user') ?>" class="btn btn-default">Cancel</a>
	</form>
   
   <script type="text/javascript">
       $(document).ready(function() {
           $('#level').change(function(event) {
            var level=$(this).val();
                if (level == '3') {
                    $('#mubaligh').show();
                }else if(level == '2' || level == '1') {
                    $('#mubaligh').hide();
                }      
           });

           $('#id_mubaligh').change(function(event) {
                var id_mubaligh=$(this).val();
                $.ajax({
                     url: 'app/get_mubaligh/'+id_mubaligh,
                     type: 'GET',
                     dataType: 'html',
                 })
                 .done(function(hasil) {
                     console.log("success");
                     $('#nama_lengkap').val(hasil);
                     $('#masjid').val('0');
                 })
                 .fail(function() {
                     console.log("error");
                 })
                 .always(function() {
                     console.log("complete");
                 });
                      
           });
       });
   </script>