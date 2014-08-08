<table class="">
    <?php foreach($artikel as $art):?>
    <tr>
        <td><h4><a href="<?php echo base_url().'artikel_controller/view/'.$art->id_artikel?>"><?php echo $art->judul;  ?></a></h4>
            <span class="clearfix pull-right"><?php echo $art->date_added?></span></td>
    </tr>
    <tr><td><p><?php echo substr($art->isi_artikel,0,440).'...'?></p>
            <p class="pull-right"><a href="<?php echo base_url().'artikel_controller/view/'.$art->id_artikel?>">Read More</a></p></td></tr>
    <?php endforeach;?>  
</table>
