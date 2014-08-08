<h3>Tambah Pertanyaan</h3>
<?php echo $this->session->flashdata('message'); ?>
<?php if($this->uri->segment(3)=='ubah_pertanyaan'): ?>
<form class="form-horizontal" action="<?php echo base_url();?>admin/pertanyaan/ubah_pertanyaan/<?php echo $id_pertanyaan;?>" method="POST">
<div class="control-group" id="add_pertanyaan">
    <label class="control-label">Pertanyaan : </label>
        <div class="controls">
            <input type="text" name="pertanyaan" value="<?php echo $pertanyaan->pertanyaan;?>">
        </div><br>
</div>
<?php else: ?>
<form class="form-horizontal" action="<?php echo base_url();?>admin/pertanyaan/tambah_pertanyaan" method="POST">
    <div class="control-group" id="add_pertanyaan">
        <label class="control-label">Pertanyaan : </label>
        <div class="controls">
            <input type="text" name="pertanyaan[]">
        </div><br>
    </div>
<?php endif;?>
    <?php if($this->uri->segment(3)=='tambah_pertanyaan'): ?>
      <a onclick="tambah_field()" class="btn ">Tambah Field</a>
      <?php endif;?>
      <a onclick="window.location.href='<?php echo base_url()?>admin/pertanyaan'" class="btn">Batal</a>
      <button type="submit" name="tambah_pertanyaan" class="btn btn-primary">Simpan</button>
      
</form>
<script>
    function tambah_field(){
        var html = '<label class="control-label">Pertanyaan : </label>'+
                    '<div class="controls"><input type="text" name="pertanyaan[]"></div><br>';
        $("#add_pertanyaan").append(html);
    }
</script>
