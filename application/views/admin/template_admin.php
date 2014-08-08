<!DOCTYPE HTML>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/datepicker.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/bootstrap-wysihtml5-0.0.2.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/token-input.css">
        <link rel="stylesheet" type="text/css" href="<?php echo base_url();?>css/token-input-facebook.css">
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery-1.7.1.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/datetimepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-datepicker.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/wysihtml5-0.3.0_rc2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/bootstrap-wysihtml5-0.0.2.min.js"></script>
        <script type="text/javascript" src="<?php echo base_url();?>js/jquery.tokeninput.js"></script>
        <script>
            $(document).ready(function(){
               $('.dropdown-toggle').dropdown();
               $('.dropdown input, .dropdown label').click(function(e){
                  e.stopPropagation(); 
               });
               $('#some-text').wysihtml5();
            });
        </script>
        <title>KMS Kredit</title>
     </head>
     
    <body>
        <!-- Top Navigation Bar-->
        <div class="navbar navbar-fixed-top navbar-inverse">
            <div class="navbar-inner">
                <a class="brand"><?php echo $title;?></a>
                <div class="nav-collapse">
                <ul class="nav">
                    <li <?php echo (uri_string()=='admin')?'class="active"':'';?>><a href="<?php echo base_url();?>admin"><i class="icon-home icon-white"></i> Home</a></li>
                    <?php if($this->session->userdata('isAdmin') == TRUE){?>
                    <li <?php echo (uri_string()=='admin/profile')?'class="active"':'';?>><a href="<?php echo base_url();?>admin/index_admin/view/profile_user"><i class="icon-user icon-white"></i> Profile</a></li>
                    <li <?php  echo ( strpos(uri_string(),'message'))?'class="active"':'';?>><a href="<?php echo base_url();?>admin/message"><i class="icon-envelope icon-white"></i> Inbox</a></li>
                    <?php } ?>
                </ul>
                 <ul class="nav pull-right">
                     <?php if(($this->session->userdata('isAdmin') != TRUE)){?>
                     <li class="dropdown"><a href="#" class="dropdown-toggle"><i class="icon-user icon-white"></i> Login<b class="caret"></b></a>
                         <div class="dropdown-menu" style="padding: 15px;">
                             <form action="<?php echo base_url();?>login/proses_login" method="POST">
                                 <?php echo '<span class="text-warning">'.$this->session->flashdata('message').'</span>';?>
                                 <label>Username</label><input type="text" name="username" placeholder="Type username here..">
                                 <?php echo form_error('username','<p class="text-error">','</p>');?>
                                 <label>Password</label><input type="password" name="password" placeholder="Type password here...">
                                 <?php echo form_error('password','<p class="text-error">','</p>')?>
                                 <button class="btn btn-primary">Login</button>   
                             </form>
                         </div>
                        <?php 
                        $script_flash = $this->session->flashdata('script');
                        echo empty($script)?'':$script; 
                        echo empty($script_flash)?'':$script_flash; 
                        ?> 
                     </li>
                     <?php } else{ ?>
                     <li><a href="#">Welcome, <?php echo $this->session->userdata('adminname');?></a></li>
                     <li><a href="<?php echo base_url();?>login/logout">Logout</a></li>
                     <?php } ?>
                 </ul>
                </div>
            </div>
        </div> <!-- end of top navigation bar -->
        <!-- Hero Unit -->
        <div class="hero-unit">
            <img src="<?php echo base_url();?>img/logo.png" width="100" height="100">Welcome to KMS Kredit Back-end Admin Page!!
        </div>
        <!-- End of hero unit -->
        <br>
        <!-- Container-->
        <div class="container-fluid">
            <div class="row-fluid">
                <!-- Sidebar menu -->
                <div class="span2">
                    <div class="sidebar-nav">
                        <?php if(($this->session->userdata('isAdmin') == TRUE)){ ?>
                        <ul class="nav nav-list">
                            <!-- Menu Khusus admin -->
                            <li><a href="#">Pengguna</a>
                                <ul>
                                    <li><a href="<?php echo base_url();?>admin/anggota_controller">Anggota</a></li>
                                    <li><a href="<?php echo base_url();?>admin/index_admin/view_data/pegawai">Expert</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url()?>admin/pinjaman_controller">Pinjaman</a></li>
                            <li><a href="<?php echo base_url()?>admin/angsuran_controller">Angsuran</a></li>
                            <li><a href="<?php echo base_url()?>admin/index_admin/view_data/profil_perusahaan">Profil Perusahaan</a></li>
                            <li><a href="<?php echo base_url();?>admin/index_admin/view_data/simulasi">Simulasi</a></li>
                            <li><a href="#">SPK</a>
                                <ul>
                                    <li><a href="<?php echo base_url();?>admin/spk/atribut">Atribut</a></li>
                                    <li><a href="<?php echo base_url();?>admin/pertanyaan">Pertanyaan</a></li>
                                </ul>
                            </li>
                            <li><a href="<?php echo base_url();?>admin/artikel_controller/index">Artikel</a></li>
                            <li><a href="<?php echo base_url();?>admin/index_admin/view_data/pengguna">Dokumen</a></li>
                        </ul>
                        <?php } ?>
                    </div>
                </div><!-- sidebar menu -->
                <!-- main content -->
                <div class="span10">
                    <?php 
                    if($this->session->userdata('isAdmin') == TRUE)
                    empty($content)?'':($this->load->view($content));
                    ?>
                </div><!-- end of main content-->
            </div>
            <footer>&copy; Copyright 2012 </footer>
        </div><!-- container-fluid -->
    </body>
</html>