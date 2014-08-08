<style>
    label{
        position: relative;
        float: left;
        width: 150px;
    }
</style>
<h3>Detail Pegawai</h3>
<fieldset>
    <label>ID Pegawai</label><label>: <?php echo $details->id_pegawai;?></label>
</fieldset>
<fieldset>
    <label>Nama Pegawai</label><label>: <?php echo $details->nama;?></label>
</fieldset>
<fieldset>
    <a class="btn btn-primary" href="<?php echo  base_url();?>admin/index_admin/edit_data/pegawai/<?php echo $details->id_pegawai;?>">Edit</a>
    <a class="btn" href="<?php echo base_url();?>admin/index_admin/view_data/pegawai">Back</a>
</fieldset>
