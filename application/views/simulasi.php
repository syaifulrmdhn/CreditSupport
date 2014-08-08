<h3>Simulasi</h3>
<form class="form-horizontal" method="POST" action="<?php echo base_url()?>index/simulasi">
    <div class="control-group">
        <label class="control-label">Jumlah Pinjaman : </label>
        <div class="controls"><input type="text" name="jml_pinjaman"></div>
    </div>
    <div class="control-group">
        <label class="control-label">Jangka Waktu : </label>
        <div class="controls"><input type="text" name="jangka_wkt"> bulan</div>
    </div>
    <div class="control-group">
        <label class="control-label">Bunga : </label>
        <div class="controls"><input type="text" name="bunga"> (persentase dalam desimal)</div>
    </div>
   
    <button class="btn">Hitung</button>
</form>

Hasil simulasi:

<table class="table table-bordered">
    <thead><th>Bulan</th><th>Sisa Pokok</th><th>Porsi Pokok</th><th>Porsi Bunga</th><th>Jumlah Cicilan</th><th>Sisa Saldo</th></thead>
    <?php if(!empty($simulasi)):?>
<tbody>
    <?php foreach($simulasi as $kredit):?>
<tr>
    <td><?php echo $kredit['bulan']?></td>
    <td><?php echo $kredit['sisa_pokok']?></td>
    <td><?php echo $kredit['porsi_pokok']?></td>
    <td><?php echo $kredit['porsi_bunga']?></td>
    <td><?php echo $kredit['jml_cicilan']?></td>
    <td><?php echo $kredit['saldo']?></td>
</tr>
    <?php endforeach;?>
    <?php endif; ?>
</tbody>
</table>