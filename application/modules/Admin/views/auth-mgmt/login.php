
<!doctype html>
<html class="no-js" lang="">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Ecommerce | Login</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="<?php echo base_url();?>frontassets/images/logo.png">
    <!-- Normalize CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/normalize.css">
    <!-- Main CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/main.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/bootstrap.min.css">
    <!-- Fontawesome CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/all.min.css">
    <!-- Flaticon CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/fonts/flaticon.css">
    <!-- Animate CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/css/animate.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="<?php echo base_url();?>assets/style.css">
    <!-- Modernize js -->
    <script src="<?php echo base_url();?>assets/js/modernizr-3.6.0.min.js"></script>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <!-- Login Page Start Here -->
    <div class="login-page-wrap" style="position: relative;
    background: #d2e4e4;
    padding: 27px 0px 27px;
    border-top: 4px solid var(--primary-color-one);
    text-align:center">
        <div class="item-logo" >
                    <img src="<?php echo base_url();?>frontassets/images/logo.png" alt="logo" style="width:150px;">
                </div>
        <div class="login-page-content">
            <div class="login-box" style="height:auto !important;">
                
                
                <form action="<?php echo ci_site_url();?>Admin/Auth/login" class="login-form" method="post">
                    <span><?php echo $this->session->flashdata('res');?></span>
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" placeholder="Enter usrename" class="form-control" required="">
                        <i class="far fa-envelope"></i>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter password" class="form-control" required="">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div class="form-group d-flex align-items-center justify-content-between">
                        <!--<div class="form-check">
                            <input type="checkbox" class="form-check-input" id="remember-me">
                            <label for="remember-me" class="form-check-label">Remember Me</label>
                        </div>-->
                        <!--<a href="#" class="forgot-btn">Forgot Password?</a>-->
                    </div>
                    <div class="form-group">
                        <button type="submit" class="login-btn">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Login Page End Here -->
    <!-- jquery-->
    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="<?php echo base_url();?>assets/js/plugins.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="<?php echo base_url();?>assets/js/jquery.scrollUp.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url();?>assets/js/main.js"></script>

</body>
</html>