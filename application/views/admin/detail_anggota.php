<h3><?php echo $anggota[0]->nama_member?></h3>

<table class="table table-bordered">
    <tr><td rowspan="3"><img src="<?php base_url()?>images/profile.jpg" alt="profile picture"></td><td>Nama</td></tr>
    <tr><td>Pekerjaan</td></tr>
    <tr><td>Usia</td></tr>
</table>

<h3>Detail Pinjaman</h3>
<table class="table table-bordered">
    <tbody>
    <?php foreach($pinjaman as $p):?>
    <tr>
        <td rowspan="2">
            <p><strong>Tanggal Pinjaman</strong>
            <p><?php echo $p->tgl_pinjaman?></p>
        </td>
        <td colspan="4">
            <strong>Jumlah Pinjaman : </strong>
            <?php echo 'Rp. '.number_format($p->total_pinjaman, '0', '', '.')?>
        </td>
        <td colspan="4">
            <strong>Jangka waktu : </strong>
            <?php echo $p->jangka_waktu.' bulan'?>
        </td>
        <td colspan="4">
            <strong>Bunga : </strong>
            <?php echo $p->bunga * 100 .'%'?>
        </td>
    </tr>
    <tr>
        <?php for($i=1;$i<=12;$i++):?>
        <td><?php echo 'Angsuran ke-'.$i?></td>
        <?php endfor;?>
    </tr>
    <?php endforeach;?>
    </tbody>
</table>