<h3><?php echo $artikel[0]->judul?></h3>
<br><br>
<?php echo $artikel[0]->isi_artikel?>
<br><br><br>
<?php if($this->uri->segment(4)=='comment'): ?>
<div class="navbar">
    <div class="navbar-inner">
    <span class="pull-left"><?php echo 'Posted by : '.$artikel[0]->author.' on '.$artikel[0]->date_added?></span>
    <span class="pull-right"><a href="#"><i class="icon-comment"></i><?php echo count($komentar)?></a></span>
    </div>
</div>
<?php echo $this->session->flashdata('message')?>
<form action="<?php echo base_url().'artikel_controller/post_comment/'.$artikel[0]->id_artikel ?>" method="POST" class="form-inline">
    Leave a Comment : <br><br>
    <textarea name="komentar"></textarea><br><br>
    <input type="text" name="email" placeholder="Email (required)"><br><br>
    <?php echo $this->session->flashdata('email_form_error') ?>
    <input type="text" name="nama" placeholder="Name (required)"><br><br>
    <?php echo $this->session->flashdata('name_form_error') ?>
    <input type="submit" name="submit" value="Post Comment" class="btn">
</form>
<?php if(!empty($komentar)){
    foreach($komentar as $comment){
        echo '<hr>';
        echo '<h5>'.$comment->author.'</h5>';
        echo '<span style="font-size:12px">'.$comment->date_added.'</span><br>';
        echo $comment->komentar;
    }
}
?>
<?php else:?>
<div class="navbar">
    <div class="navbar-inner">
    <span class="pull-left"><?php echo 'Posted by : '.$artikel[0]->author.' on '.$artikel[0]->date_added?></span>
    <span class="pull-right"><a href="<?php echo base_url().'artikel_controller/view/'.$artikel[0]->id_artikel.'/comment'?>"><i class="icon-comment"></i><?php echo 'Leave a comment'?></a></span>
    </div>
</div>
<?php endif; ?>