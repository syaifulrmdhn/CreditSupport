<!-- <img src="<?php echo base_url();?>img/logo.png" id="old_file">
<a onClick="change_pic();" class="btn">Change Picture</a> -->
<script>
function change_pic(){
    var confirmModal = 
      $('<div class="modal hide fade">' +    
          '<div class="modal-header">' +
            '<a class="close" data-dismiss="modal" >&times;</a>' +
            '<h3>' + 'Change Picture' +'</h3>' +
          '</div>' +

          '<div class="modal-body">' +
          '<form enctype="multipart/form-data">'+
           '<input type="file" id="img_new"></form>'+
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
      var filepath = $('#img_new').val();
      $('#old_file').attr('src','<?php echo base_url();?>img/'+filepath);
    });
     confirmModal.modal('show');     
  };
</script>
<h3>Tambah Artikel</h3>
<form action="<?php echo base_url()?>admin/artikel_controller/tambah" method="POST" class="form-inline" enctype="form/multipart-data">
    <input type="text" name="judul" placeholder="Ketik Judul Disini..." style="width: 500px">
    <br><br>
    <textarea name="isi_artikel" id="text" style="width: 500px; height: 300px"></textarea>
    <br><br><br>
    <input class="btn" type="submit" name="submit" value="submit">
</form>
<script>
    $("#text").wysihtml5();
</script>