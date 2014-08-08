<h3>Form Jawaban</h3>
<?php echo $this->session->flashdata('message'); ?>
<?php echo '<strong style="margin-left:75px">Pertanyaan : '.$pertanyaan->pertanyaan.'? </strong>';?>
<br><br>
<?php if($this->uri->segment(3)=='ubah_jawaban'): ?>
<form class="form-horizontal" action="<?=base_url();?>admin/jawaban/ubah_jawaban" method="POST">
    <div class="control-group">
        <label class="control-label">Jawaban : </label>
        <div class="controls">
            <input type="hidden" name="id_pertanyaan" value="<?php echo $pertanyaan->id_pertanyaan;?>">
            <input type="text" name="jawaban" value="<?php echo $pertanyaan->jawaban;?>">
        </div>
    </div>
    <div class="control-group" id="add_jawaban">
        <?php foreach($jawaban as $j):?>
    <label class="control-label">Pilihan Jawaban : </label>
        <div class="controls">
            <input type="text" name="pil_jawaban[]" value="<?php echo $j->pilihan_jawaban?>">
            <input type="hidden" name="id_jawaban[]" value="<?php echo $j->id_jawaban?>">
            <a href="<?php echo base_url()?>admin/jawaban/hapus_jawaban/<?php echo $j->id_jawaban?>/<?php echo $pertanyaan->id_pertanyaan?>">Delete</a>
        </div><br>
    <?php endforeach;?>
        </div>
<!-- ------------------------------------------------------------------------------------------------------------------------- -->
<?php else: ?>
<form class="form-horizontal" action="<?=base_url();?>admin/jawaban/tambah_jawaban" method="POST">
    <div class="control-group">
        <label class="control-label">Jawaban : </label>
        <div class="controls">
            <input type="text" name="jawaban" <?php echo ((!empty($pertanyaan->jawaban))?'value="'.$pertanyaan->jawaban.'" readonly':'')?>>
        </div>
    </div>
      <div class="control-group">
        <?php foreach($jawaban as $j):?>
    <label class="control-label">Pilihan Jawaban : </label>
        <div class="controls">
            <input type="text" name="pil_jawaban[]" value="<?php echo $j->pilihan_jawaban?>" readonly>
            <input type="hidden" name="id_jawaban[]" value="<?php echo $j->id_jawaban?>" readonly>
        </div><br>
    <?php endforeach;?>
        </div>
    <div class="control-group" id="add_jawaban">
        <label class="control-label">Pilihan Jawaban : </label>
        <div class="controls">
            <input type="hidden" name="id_pertanyaan" value="<?php echo $pertanyaan->id_pertanyaan;?>">
            <input type="text" name="pil_jawaban[]">
        </div><br>
    </div>
<?php endif;?>
 <?php if($this->uri->segment(3)=='tambah_jawaban'): ?>   
      <a onclick="tambah_field()" class="btn ">Tambah Field</a>
 <?php endif;?>
      <a onclick="window.location.href='<?php echo base_url()?>admin/pertanyaan'" class="btn">Batal</a>
      <button type="submit" name="tambah_jawaban" class="btn btn-primary">Simpan</button>
      
</form>
<script>
    function tambah_field(){
        var html = '<label class="control-label">Pilihan Jawaban : </label>'+
                    '<div class="controls"><input type="text" name="pil_jawaban[]"></div><br>';
        $("#add_jawaban").append(html);
    }
</script>
