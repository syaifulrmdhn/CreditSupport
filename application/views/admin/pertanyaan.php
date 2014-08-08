<?php
echo '<p>'.$this->session->flashdata('message').'</p>';
?>
<br><br>
<a href="<?php echo base_url();?>admin/pertanyaan/tambah_pertanyaan" class="btn">Tambah Pertanyaan</a>
<br><br>
<form action="<?php echo base_url();?>admin/spk/set_rule" method="POST">
<table class="table table-bordered">
    <thead><th>ID</th><th>Pertanyaan</th><th>Set sebagai SPK</th>
    <th colspan="2">Kelola Pertanyaan</th><th colspan="2">Kelola Jawaban</th></thead>
    <tbody>
        <?php
        foreach($pertanyaan as $p){
            echo '<tr><td>'.$p->id_pertanyaan.'</td>';
            echo '<td>'.$p->pertanyaan.'</td>';
            echo '<td><input type="checkbox" value="'.$p->id_pertanyaan.'" name="pertanyaan[]"
                '.(($p->as_spk == 1)?'checked':'').'></td>';
            echo '<td><a href="'.base_url().'admin/pertanyaan/ubah_pertanyaan/'.$p->id_pertanyaan.'">Ubah</a></td>';
            echo ' <td><a href="#" onclick="confirm_delete('.$p->id_pertanyaan.')">Hapus</a></td>';
            echo '<td><a href="'.base_url().'admin/jawaban/tambah_jawaban/'.$p->id_pertanyaan.'">Tambah</a></td>';
            echo '<td><a href="'.base_url().'admin/jawaban/ubah_jawaban/'.$p->id_pertanyaan.'" >Ubah</a></td>
                </tr>';
        }
        ?>
    </tbody>
</table>
    <button class="btn btn-primary">Simpan</button>
</form>
<script>
function confirm_delete(id) {
    var id_atribut = id;
    var confirmModal = 
      $('<div class="modal hide fade">' +    
          '<div class="modal-header">' +
            '<a class="close" data-dismiss="modal" >&times;</a>' +
            '<h3>' + 'Delete Confirmation' +'</h3>' +
          '</div>' +

          '<div class="modal-body">' +
            '<p>' + 'Are you sure to delete??' + '</p>' +
          '</div>' +

          '<div class="modal-footer">' +
            '<a href="#" class="btn" data-dismiss="modal">' + 
              'Cancel' + 
            '</a>' +
            '<a href="#" id="okButton2" class="btn btn-primary">' + 
              'OK' + 
            '</a>' +
          '</div>' +
        '</div>');

    confirmModal.find('#okButton2').click(function(event) {
      confirmModal.modal('hide');
      window.location.href = "<?php echo base_url();?>admin/pertanyaan/hapus_pertanyaan/"+id_atribut;
    });

    confirmModal.modal('show');     
  };
</script>