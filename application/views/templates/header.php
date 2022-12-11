<?php 
    $link = $_SERVER['PHP_SELF'];
    $link_array = explode('/',$link);
    $page = end($link_array);        
?>
<!DOCTYPE html>
<html dir="ltr" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="text/html; charset=utf-8" http-equiv=Content-Type>
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Stock Management System">
    <meta name="author" content="Info2Ideas">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" href="<?php echo base_url() ?>/assets/images/favicon.ico"/>
	<link rel="apple-touch-icon image_src" href="<?php echo base_url() ?>/assets/images/favicon.ico" />
    <title>Stock Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/style.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/dataTables.bootstrap4.css" rel="stylesheet">
        <!-- <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.dataTables.min.css"> -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/custom.css">
    <link rel="stylesheet" type="text/css" href="<?php echo base_url(); ?>assets/css/select2.min.css">     
           
    <style type="text/css">         
        .mdi.mdi-refresh{
            font-size:20px;
        }
        #add_float_btn .btn-fab{
            position: fixed !important;
            right: 20px;
            bottom: 20px;
            border-radius: 50%;
            font-size: 24px;
            height: 50px;
            width: 50px;
            padding: 0;
            z-index: 1200;
        }
        #add_float_btn .btn.btn-fab i.material-icons {
            color:#fff;
            position: absolute;
            top: 20%;
            left: 26%;
        }
    </style>
</head>

<body>
    <div class="preloader">
        <div class="lds-ripple">
            <div class="lds-pos"></div>
            <div class="lds-pos"></div>
        </div>
    </div>
   
    <div id="main-wrapper">
        <header class="topbar" data-navbarbg="skin5">
            <nav class="navbar top-navbar navbar-expand-md navbar-dark">
                <div class="navbar-header" data-logobg="skin5">
                    <a class="nav-toggler waves-effect waves-light d-block d-md-none" href="javascript:void(0)">
                        <i class="mdi mdi-menu"></i></a>
                   
                    <a class="navbar-brand" href="<?php echo base_url(); ?>">
                        <b class="logo-icon p-l-10">
                            <img src="<?php echo base_url(); ?>/assets/images/logo-icon.png" alt="homepage" class="light-logo" />
                        </b>
                        <span class="logo-text">
                            <h4 class="pt-2">SMS</h4>
                        </span>
                    </a>
                    
                    <a class="topbartoggler d-block d-md-none waves-effect waves-light" href="javascript:void(0)" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><i class="ti-more"></i></a>
                </div>
                
                <div class="navbar-collapse collapse" id="navbarSupportedContent" data-navbarbg="skin5">
                   
                    <ul class="navbar-nav float-left">
                        <li class="nav-item d-none d-md-block"><a class="nav-link sidebartoggler waves-effect waves-light" href="javascript:void(0)" data-sidebartype="mini-sidebar"><i class="mdi mdi-menu font-24"></i></a></li>
                    </ul>
                    <h5 class="text-center text-white m-auto"><?php echo $this->ion_auth->user()->row()->first_name.' '.$this->ion_auth->user()->row()->last_name ?></h5>                    
                </div>

            </nav>
        </header>
       
       <?php $this->load->view('templates/sidebar', isset($pagename) && $pagename) ?>
       
        <div class="page-wrapper">    
            <div class="container-fluid">
            
            <!-- <div class="modal fade" id="notify_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">                                    
                      <div class="modal-body">
                            <h3></h3>
                      </div>                    
                </div>
              </div>
            </div> -->

            <?php $this->load->view('templates/msg') ?>

                <div class="row">            
