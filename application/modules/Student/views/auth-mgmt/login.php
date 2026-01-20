
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Crypo</title>
  <link rel="icon" href="<?php echo base_url();?>front_assets/img/favicon.png" type="image/x-icon">
  <link rel="stylesheet" href="<?php echo base_url();?>front_assets/css/style.css">

<body id="dark">
<header class="dark-bb">
    <nav class="navbar navbar-expand-lg">
      <a class="navbar-brand" href="exchange-dark.html"><img src="<?php echo base_url();?>front_assets/img/logo-light.svg" alt="logo"></a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#headerMenu"
        aria-controls="headerMenu" aria-expanded="false" aria-label="Toggle navigation">
        <i class="icon ion-md-menu"></i>
      </button>

      <div class="collapse navbar-collapse" id="headerMenu">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>" role="button" >
              Home
            </a>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>exchange" role="button">
              Exchange
            </a>
            
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url();?>market" role="button">
              Market
            </a>
            
          </li>

          
        </ul>
        <ul class="navbar-nav ml-auto">
          <a href="<?php echo base_url();?>user" class="btn-1">Sign In</a>
          <a href="<?php echo base_url();?>join-us" class="btn-2">Sign Up</a>
        </ul>
      </div>
    </nav>
  </header>
  <div class="vh-100 d-flex justify-content-center">
    <div class="form-access my-auto">
	<form action="<?php echo ci_site_url();?>user/auth/login" method="post">
        <span>Sign In</span>
		<?php 
			                        echo $this->session->flashdata('res');
			                    ?>
        <div class="form-group">
		<input type="text" name="username" class="form-control" placeholder="Username" required="" />
        </div>
        <div class="form-group">
		<input type="password" name="password" class="form-control" placeholder="Password" required="" />
        </div>
        <div class="text-right">
          <a href="javascript:void(0);">Forgot Password?</a>
        </div>
        <div class="custom-control custom-checkbox">
          <input type="checkbox" class="custom-control-input" id="form-checkbox">
          <label class="custom-control-label" for="form-checkbox">Remember me</label>
        </div>
        <button type="submit" class="btn btn-primary">Sign In</button>
      </form>
      <h2>Don't have an account? <a href="<?php echo base_url();?>join-us">Sign up here</a></h2>
    </div>
  </div>

  <script src="<?php echo base_url();?>front_assets/js/jquery-3.4.1.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/popper.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/bootstrap.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/amcharts-core.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/amcharts.min.js"></script>
  <script src="<?php echo base_url();?>front_assets/js/custom.js"></script>
</body>

</html>