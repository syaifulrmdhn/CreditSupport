<h3>Detail Rule</h3>
<form action="<?php echo base_url();?>admin/spk/update_rule" method="POST"> 
<input type="hidden" name="id_atribut" value="<?=$id_atribut?>">
<table class="table table-bordered" id="rule">
    <thead>
        <?php
        $value_atr = explode(',', $atribut->atribut);
        $count = count($value_atr);
        foreach($value_atr as $value){
            echo '<th>'.htmlentities($pertanyaan[$value]).'</th>';
        }
        ?>
    <th>Kredit Disetujui</th>
    <th>Delete</th>
    </thead>
    <tbody>
        <?php
        if(!empty($rules)){
            $j = 0;
            foreach($rules as $field){
            $rule_explode = explode(',', $field->rule);
            echo '<tr>';
                for($i=0;$i<$count;$i++){
                    echo '<td>';
                    echo '<input type="text" name="rules['.$j.'][]" class="input-small" value="'.$rule_explode[$i].'">';
                    echo '</td>';
                }
                $j++;
            echo '<td><input type="text" name="result[]" value="'.$field->result.'" class="input-small"></td>';
            echo '<td><a href="#" onclick="confirm_delete('.$field->id.','.$id_atribut.')">Delete</a>';
            echo '<input type="hidden" name="id_rule[]" value="'.$field->id.'"></td>';
            echo '</tr>';
            }
        }else{
            echo "<script>alert('Belum ada rule yang bisa diedit')</script>";
        }
        ?>
    </tbody>
</table>
<!--    <a onclick="tambah_field('<?php //echo $count;?>')" class="btn">Tambah Field</a>-->
    <button type="submit" class="btn btn-primary">Simpan Rule</button>
</form>
<script>
    
    function confirm_delete(id1,id2) {
    var id_rule = id1;
    var id_atribut = id2;
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
      window.location.href = "<?php echo base_url();?>admin/spk/delete_rule/"+id_rule+"/"+id_atribut;
    });

    confirmModal.modal('show');     
  };
</script>