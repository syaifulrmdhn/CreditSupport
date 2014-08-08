<?php
echo '<p>'.$this->session->flashdata('message').'</p>';
?>
<table class="table table-bordered">
    <thead><th>ID</th><th>Atribut-atribut per Kelompok</th><th>Set Default</th><th>Action Atribut</th>
    <th colspan="2">Action Rule</th></thead>
    <tbody>
        <?php
        foreach($atribut as $attr){
            echo '<tr '.(($attr->set_as == 'default')?'style="background-color:#eee"':'').'>
                <td>'.$attr->id_atribut.'</td>
                <td>'.$attr->atribut.'</td>';
            echo '<td><a href="'.base_url().'admin/spk/setdefault_atribut/'.$attr->id_atribut.'" >Set Default</a></td>';
            echo '<td><a href="#" onclick="confirm_delete('.$attr->id_atribut.')">Delete Kombinasi Pertanyaan</a></td>';
            echo '<td><a href="'.base_url().'admin/spk/edit_rule/'.$attr->id_atribut.'">Edit Rule</a></td>';
            echo '<td><a href="'.base_url().'admin/spk/add_rule/'.$attr->id_atribut.'">Tambah Rule</a></td>
                  </tr>';
        }
        ?>
    </tbody>
</table>
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
      window.location.href = "<?php echo base_url();?>admin/spk/delete_atribut/"+id_atribut;
    });

    confirmModal.modal('show');     
  };
</script>