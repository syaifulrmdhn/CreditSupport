<h3>Form Edit Atribut</h3>
<form action="<?php echo base_url();?>admin/spk/update_atribut" method="POST" class="form-inline">
    <input type="hidden" name="id_atribut" value="<?php echo $id;?>">
    <?php
    $total = $spk->total_atribut;
    $atribut = explode(',', $spk->atribut);
    $pertanyaan = explode(',',$spk->pertanyaan);
    $jawaban = explode(',',$spk->jawaban);
    for($i=0;$i<$total;$i++) {
        echo 'Atribut : <input type="text" name="atribut[]" value="'.(empty($atribut[$i])?'':$atribut[$i]).'"> 
              Pertanyaan : <input type="text" name="pertanyaan[]" value="'.(empty($pertanyaan[$i])?'':$pertanyaan[$i]).'">
              Jawaban : <input type="text" name="jawaban[]" value="'.((empty($jawaban[$i]))?'':$jawaban[$i]).'" ><br><br>
                  ';
    }
    ?>
    <div id="add_field2"></div>
    <a onclick="tambah_field()" class="btn">Tambah Field</a>
    <button class="btn btn-primary" type="submit">Simpan</button>
</form>
<script>
    function tambah_field(){
        var html = 'Atribut : <input type="text" name="atribut[]" > '+
                   'Pertanyaan : <input type="text" name="pertanyaan[]">'+
                   'Jawaban : <input type="text" name="jawaban[]" >'+
                   '<br><br>';
        $("#add_field2").append(html);
    }
</script>