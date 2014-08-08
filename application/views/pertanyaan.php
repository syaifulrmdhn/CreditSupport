<?php
//$pertanyaan = explode(',', $spk->atribut);
//$string = ">500000";
//$answer = 600000;
//$eval = eval(sprintf("return(%d %s);",$answer, $string));
//echo ($eval)?'yes':'no';
?>
<h3>Form Pengecekan Pengajuan Kredit</h3>
<form action="<?php echo base_url();?>index/spk" method="POST" class="form-horizontal">
    <input type="hidden" name="id_atribut" value="<?php echo $id_atribut;?>">
    
    <?php foreach($spk as $s):?>
        <div class="control-group">
        <label class="control-label"><?php echo $pertanyaan[$s]['pertanyaan']?></label>
<!--        //echo '<div class="controls"><input type="text" name="jawaban[]">';-->
        <input type="hidden" name="jawaban[]" value="<?php echo $pertanyaan[$s]['jawaban']?>">
        <div class="controls"><select name="pil_jawaban[]">
        <?php foreach($jawaban[$s] as $pil_jawab):?>
            <option><?php echo $pil_jawab ?></option>
        <?php endforeach;?>
        </select>
        </div></div>
    <?php endforeach;?>
    <button class="btn btn-primary">Submit</button>
</form>
<?php echo empty($result)?'':$result; ?>