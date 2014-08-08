<style>
    #save{
        position: relative;
        float: left;
        left: 270px;
    }
    #cancel{
        position: relative;
        float: left;
    }
</style>
<?php
$success = $this->session->flashdata('success');
$error = $this->session->flashdata('error');
echo empty($success)?'':'<div class="alert alert-success">'.$success.'</div>';
echo empty($error)?'':'<div class="alert alert-error">'.$error.'</div>';
?>
<h3>Edit Data Pegawai</h3>
<form class="form-horizontal" action="<?php echo base_url();?>admin/index_admin/save_data" method="POST">
    <div class="control-group">
        <label class="control-label">ID Pegawai : </label>
            <div class="controls"><?php echo $details->id_pegawai;?>
                <input type="hidden" name="id" value="<?php echo $details->id_pegawai;?>">
            </div>
    </div>
    <div class="control-group">
        <label class="control-label">Nama Pegawai : </label>
        <div class="controls">
            <input type="text" name="nama" value="<?php echo $details->nama;?>">
            <input type="hidden" name="table" value="pegawai">
        </div>
    </div>
            <button id="save" type="submit" class="btn btn-primary">Save</button>
</form>
            <button id="cancel" class="btn" onClick="window.location.href='<?php echo base_url();?>admin/index_admin/view_data/pegawai'">Back</button>
