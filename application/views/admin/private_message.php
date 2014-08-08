<div class="span8">  
<ul class="nav nav-pills">  
<li <?php echo (strpos(uri_string(),'inbox'))?'class="active"':'';?>><a href="<?php echo base_url();?>admin/message/inbox">Inbox <?php echo '('.$inbox_total.')';?></a></li>     
<li <?php echo (strpos(uri_string(),'outbox'))?'class="active"':'';?>><a href="<?php echo base_url();?>admin/message/outbox">Outbox</a></li>  
<li <?php echo (strpos(uri_string(),'compose'))?'class="active"':'';?>><a href="<?php echo base_url();?>admin/message/compose">Compose</a></li>   
</ul>  
    <?php 
    $this->load->view($msg_content);
    ?>
    
</div> 

