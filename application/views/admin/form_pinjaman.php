<h3>Form Pinjaman</h3>
<?php if($this->uri->segment(3)=='ubah_pinjaman'):?>
<form action="<?php echo base_url();?>admin/pinjaman_controller/ubah_pinjaman/<?php echo $id_pinjaman?>" method="POST" class="form-horizontal">
<?php else: ?>    
<form action="<?php echo base_url();?>admin/pinjaman_controller/tambah_pinjaman" method="POST" class="form-horizontal">
    <?php endif;?>
    <div class="control-group">
        <label class="control-label">Nama Anggota</label>
        <div class="controls">
            <input type="text" name="nama_anggota" id="nama_anggota" data-provider="typeahead" data-items="4" autocomplete="off" value="<?php echo empty($pinjaman)?'':$pinjaman[0]->nama_member;?>">
                <input type="hidden" name="id_anggota" id="id_anggota" value="<?php echo empty($pinjaman)?'':$pinjaman[0]->id_anggota;?>"/>
        </div>
    </div>
    <div class="control-group">
    <label class="control-label">Jumlah Pinjaman</label>
    <div class="controls">
        <input type="text" name="jml_pinjaman" value="<?php echo empty($pinjaman)?'':$pinjaman[0]->total_pinjaman;?>"/>
    </div></div>
    <div class="control-group">
    <label class="control-label">Bunga</label>
    <div class="controls"><input type="text" name="bunga" value="<?php echo empty($pinjaman)?'':$pinjaman[0]->bunga;?>"/>(persentase dalam desimal)
    </div></div>
    <div class="control-group">
    <label class="control-label">Tanggal Pinjaman</label>
    <div class="controls"><input type="text" name="tgl_pinjaman" id="tgl_pinjaman" value="<?php echo empty($pinjaman)?'':$pinjaman[0]->tgl_pinjaman;?>"/>
    <a href="javascript:NewCssCal('tgl_pinjaman','MMddyyyy','dropdown',true,'24',true)">
        <img src="<?php echo base_url();?>img/cal.gif">
    </a></div></div>
    <div class="control-group">
        <label class="control-label">Jangka Waktu</label>
        <div class="controls"><input type="text" name="jangka_waktu" value="<?php echo empty($pinjaman)?'':$pinjaman[0]->jangka_waktu;?>"> bulan</div></div>
   <?php if($this->uri->segment(3)=='ubah_pinjaman'):?>
    <button class="btn btn-primary">Simpan</button>
    <?php else: ?>
    <button class="btn btn-primary">Tambah</button>
    <?php endif;?>
</form>
<script>
    var anggota = <?php echo $anggota;?>;
    $("#nama_anggota").typeahead({
       source : anggota,
       updater: function(selection){
        var values = selection;
        $.ajax({
            url:"<?php echo base_url();?>admin/pinjaman_controller/ambil_id_anggota",
            type:"post",
            dataType:"json",
            data:{"nama_anggota":values},
            success:function(data){
                var id_anggota = data.id;
                $("#id_anggota").val(id_anggota);
            }
        });
        return selection;
    }
    });
</script>