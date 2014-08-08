<div class="pull-left"><h3>Daftar Anggota</h3></div>
<div class="pull-right" style="margin-top: 10px">
<form class="form-inline">
    <input type="text" name="nama_anggota" placeholder="nama anggota..." class="input-medium">
    <button>Cari</button>
</form>
</div>
<div class="clearfix"></div>
<div class="pull-left" style="margin-top:10px"><a class="btn" href="<?php echo base_url()?>admin/anggota_controller/tambah">Tambah Anggota</a></div>
<div class="pagination pull-right">
<?php echo $this->pagination->create_links();?>
</div>
<table class="table table-bordered">
    <thead><th>ID</th><th>Nama Anggota</th></thead>
    <tbody>
        <?php foreach($anggota as $a):?>
        <tr><td><?php echo $a->id_member?></td>
            <td><p><a href="<?php echo base_url()?>admin/anggota_controller/detail/<?php echo $a->id_member;?>" style="font-size:16px;"><?php echo $a->nama_member?></a></p>
            <p style="font-size: 12px;"><a href="<?php echo base_url()?>admin/anggota_controller/ubah/<?php echo $a->id_member?>">Ubah</a>
             | <a href="<?php echo base_url()?>admin/anggota_controller/hapus/<?php echo $a->id_member;?>">Hapus</a></p></td>
        </tr>
        <?php endforeach;?>
    </tbody>
</table>