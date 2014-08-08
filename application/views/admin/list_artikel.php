<a href="<?php echo base_url()?>admin/artikel_controller/tambah" class="btn">Tambah_artikel</a>
<br><br><br>
<table class="table">
<?php foreach($artikel as $art):
?>
    <tr>
        <td><p>Author : <?php echo $art->author?></p>
            <p>Date Added : <?php echo $art->date_added?></p>
        </td>
        <td>
            <p><?php echo $art->judul?></p>
            <p><?php echo substr($art->isi_artikel,0,140).'...'?></p>
            <p><a href="#">Edit</a> | <a href="#">Delete</a></p>
        </td>
        <td><a href="<?php echo base_url().'artikel_controller/view/'.$art->id_artikel.'/comment'?>"><i class="icon-comment"></i></a><?php echo (empty($komentar[$art->id_artikel])?0:(count($komentar[$art->id_artikel])))?></td>
    </tr>    
<?php endforeach;?>
</table>