<form action="<?php echo base_url();?>admin/index/proses_login" method="GET">
     <?php echo '<span class="text-warning">'.$this->session->flashdata('message').'</span>';?>
                                 <label>Username</label><input type="text" name="username" placeholder="Type username here..">
                                 <?php echo form_error('username','<p class="text-error">','</p>');?>
                                 <br>
                                 <label>Password</label><input type="password" name="password" placeholder="Type password here...">
                                 <?php echo form_error('password','<p class="text-error">','</p>')?>
                                 <br>
                                 <button class="btn btn-primary">Login</button> 
</form>