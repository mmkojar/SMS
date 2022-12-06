<!DOCTYPE html>
<html dir="ltr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo base_url('assets/images/favicon.ico') ?>">
    <title>Stock Management System - Login</title>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">    
    <link href="https://fonts.googleapis.com/css2?family=Varela+Round&display=swap" rel="stylesheet">
    <style type="text/css">       
        body {
            font-family: 'Varela Round', sans-serif !important;
        }
        .form-control:focus,button:focus,.btn:focus {
            box-shadow: none;
            outline: none;
        }
        .btn-dark:not(:disabled):not(.disabled).active:focus, .btn-dark:not(:disabled):not(.disabled):active:focus, .show>.btn-dark.dropdown-toggle:focus {
            box-shadow: none;
        }
        .error{
            color:red;
        }
    </style>
</head>

<body>    
  
     <div class="container">
       <div class="row justify-content-center align-items-center" style="height:100vh">
          <div class="col-lg-5 col-md-8">
             <div class="card o-hidden border-0 shadow-lg">                
                <div class="card-body p-0">
                   <div class="py-5 px-3">
                      <div class="text-center">
                      <!-- <img src="<?php echo base_url('assets/images/login_logo.png') ?>" class="img-fluid mb-2" height="140px" width="140px"> -->
                         <h1 class="h4 text-gray-900 mb-3">Welcome !</h1>
                      </div>
                      <hr>
                      <?php if($message != ""): ?>
                       <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <?php echo $message;?>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <?php endif; ?>
                        <!-- <div class="p-3 mb-2 text-white d-none" id="login_msessages"></div> -->
                      <?php echo form_open("auth/login", array('class'=>'form-horizontal','id'=>'login_form'));?>
                        <div class="form-group">
                           <?php echo form_input($identity);?>                         
                           <?php echo form_error('identity','<p class="error">', '</p>'); ?>
                        </div>
                        <div class="form-group">                         
                           <?php echo form_input($password);?>
                          <?php echo form_error('password','<p class="error">', '</p>'); ?>
                        </div>
                        <?php echo form_hidden($csrf); ?>
                        <button class="btn btn-dark btn-block" id="submit_login">Login</button>
                        <!-- <p class="text-center mt-2"><a href="<?php echo base_url('auth/create_user') ?>">Not A Member! Register</a></p> -->
                      <?php echo form_close();?>
                   </div>
                </div>
             </div>
          </div>
       </div>
    </div>

</body>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>

</html>