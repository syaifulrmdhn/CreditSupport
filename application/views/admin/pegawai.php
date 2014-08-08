<?php
$success = $this->session->flashdata('success');
$error = $this->session->flashdata('error');
echo empty($success)?'':'<div class="alert alert-success">'.$success.'</div>';
echo empty($error)?'':'<div class="alert alert-error">'.$error.'</div>';
?>
<h3>Data Pegawai</h3>
<div class="pagination">
<?php echo $this->pagination->create_links();?>
</div>
<table class="table">
    <thead><th>No. ID</th><th>Nama Pegawai</th><th colspan="2">Action</th></thead>
    <tbody>
    <?php 
    foreach($data_db as $data){
        echo '<tr><td>'.$data->id_pegawai.'</td>
            <td><a href="'.base_url().'admin/index_admin/detail_data/pegawai/'.$data->id_pegawai.'">'.$data->nama.'</a></td>
            <td><a href="'.base_url().'admin/index_admin/edit_data/pegawai/'.$data->id_pegawai.'"><i class="icon-pencil"></i></a></td>
            <td><a href="#" onClick="confirm(\'Delete Confirmation\',\'Are you sure you want to delete this user?\',\'Cancel\',
            \'OK\',\''.$data->id_pegawai.'\')"><i class="icon-trash"></i></a></td></tr>';
    }
    ?>
    </tbody>
</table>
<script>
  function confirm(heading, question, cancelButtonTxt, okButtonTxt, id) {
    var id = id;
    var confirmModal = 
      $('<div class="modal hide fade">' +    
          '<div class="modal-header">' +
            '<a class="close" data-dismiss="modal" >&times;</a>' +
            '<h3>' + heading +'</h3>' +
          '</div>' +

          '<div class="modal-body">' +
            '<p>' + question + '</p>' +
          '</div>' +

          '<div class="modal-footer">' +
            '<a href="#" class="btn" data-dismiss="modal">' + 
              cancelButtonTxt + 
            '</a>' +
            '<a href="#" id="okButton" class="btn btn-primary">' + 
              okButtonTxt + 
            '</a>' +
          '</div>' +
        '</div>');

    confirmModal.find('#okButton').click(function(event) {
      confirmModal.modal('hide');
      window.location.href="<?php echo base_url();?>admin/index_admin/delete_data/pegawai/"+id;
    });

    confirmModal.modal('show');     
  };

</script>
