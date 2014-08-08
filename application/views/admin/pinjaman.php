<h3>Data Pinjaman</h3>
<?php echo $this->session->flashdata('message');?>
<a class="btn pull-left" href="<?php echo base_url()?>admin/pinjaman_controller/tambah_pinjaman">Tambah</a>
<form action="<?php echo base_url()?>admin/pinjaman_controller/index" method="POST" class="form-inline pull-right">
<input type="text" name="keyword" placeholder="Keywords.." class="input-medium"> <label>By</label>
<select name="category" class="span4">
    <option value="nama_member">Nama Anggota</option>
    <option value="tgl_pinjaman">Tanggal</option>
</select>
<button type="submit" class="btn" name="cari">Cari</button>
</form>
<div class="clearfix"></div>
<div class="pagination pull-right">
<?php echo $this->pagination->create_links();?>
</div>
<table class="table table-bordered">
    <thead><th>Jumlah Pinjaman</th><th>Tanggal Pinjaman</th><th>Bunga</th><th>Jangka Waktu</th>
    <th>Nama Anggota</th><th colspan="2">Kelola</th></thead>
<tbody>
    <?php foreach($pinjaman as $p):?>
    <tr>
        <td><?php echo $p->total_pinjaman;?></td>
        <td><?php echo $p->tgl_pinjaman;?></td>
        <td><?php echo $p->bunga;?></td>
        <td><?php echo $p->jangka_waktu;?></td>
        <td><?php echo $p->nama_member;?></td>
        <td><a href="<?php echo base_url();?>admin/pinjaman_controller/ubah_pinjaman/<?php echo $p->id_pinjaman;?>">Ubah</a></td>
        <td><a href="#" onclick="confirm_delete(<?php echo $p->id_pinjaman;?>)">Hapus</a></td>
    </tr>
    <?php endforeach;?>
</tbody>
</table>
<script>
function confirm_delete(id) {
    var id_pinjaman = id;
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
      window.location.href = "<?php echo base_url();?>admin/pinjaman_controller/hapus_pinjaman/"+id_pinjaman;
    });

    confirmModal.modal('show');     
  };
</script>