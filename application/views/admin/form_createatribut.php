<h3>Tambah Atribut dan Pertanyaan</h3>
<form class="form-inline" method="POST" action="<?php echo base_url();?>admin/spk/create_newatribut">
    Atribut :  <input type="text" name="atribut[]">   
    Pertanyaan : <input type="text" name="pertanyaan[]">
    Jawaban : <input type="text" name="jawaban[]">
    <br><br>
    <div id="add_atribut"></div>
    <a onclick="tambah_field()" class="btn">Tambah Atribut</a>
    <button type="submit" name="submit_atr" class="btn btn-primary">Simpan</button>
</form>
<script>
    function tambah_field(){
        var html  = 'Atribut : <input type="text" name="atribut[]">'+
            ' Pertanyaan : <input type="text" name="pertanyaan[]">'+
            ' Jawaban : <input type="text" name="jawaban[]">'+
            '<br><br>';
        $("#add_atribut").append(html);
    }
</script>
