<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url();?>frontassets/images/bg.jpg">
            <div class="container">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title" style="color:#fff;">Login</h1>
                    <ul class="breadcumb-menu">
                        <li>
                            <a href="<?php echo base_url();?>" style="color:#fff;">Home</a>
                        </li>
                        <li style="color:#fff;">Login</li>
                    </ul>
                </div>
            </div>
        </div>

   

        <!--<div class="space">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-6 col-md-7">
                        <div class="title-area text-center">
                            <h2 class="sec-title">Contact Information</h2>
                            <p class="sec-text">Get Meeting with us Now. We will definitely get back to you</p>
                        </div>
                    </div>
                </div>
                <div class="row gy-4 justify-content-center">
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="contact-feature">
                            <div class="box-icon">
                            <i class="fa-solid fa-location-dot"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="box-title">Our Address</h3>
                                <p class="box-text">1, Anisere Street, Business Complex, Anisere Bus Stop, Governor Road, Ikotun Lagos State, Nigeria.</p>
                            </div>
                        </div>
                    </div>
                
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="contact-feature">
                            <div class="box-icon bg-title">
                            <i class="fa-solid fa-envelope"></i>
                            </div>
                            <div class="media-body">
                                <h3 class="box-title">Email Address</h3>
                                <p class="box-text">
                                    <a href="mailto:contact@i3empire.com">contact@xyz.com</a>
                                    <a href="mailto:info@i3empire.com">info@xyz.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                                  
                    <div class="col-xl-3 col-lg-4 col-md-6">
                        <div class="contact-feature">
                            <div class="media-body">
                                <h3 class="box-title">Follow Social Media</h3>
                                <div class="th-social">
                                <a href="https://web.facebook.com/">
                                    <i class="fab fa-facebook-f"></i>
                                     </a>
                                    <a href="https://www.instagram.com/">
                                    <i class="fab fa-instagram"></i>
                                     </a>
                                     <a href="https://youtube.com/">
                                       <i class="fab fa-youtube"></i>
                                     </a>
                                   <a href="#">
                                  <i class="fa-brands fa-telegram"></i>
                                      </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>-->
        <div class="space-bottom">
            <div class="container">
                <form action="<?php echo base_url();?>Web/login" method="POST" class="contact-form input-smoke">
                    <!--<h2 class="sec-title">Get In Touch</h2>-->
                    <div class="row">
                        <div class="form-group col-md-6">
                            <input type="text" class="form-control" name="username" id="username" placeholder="Username">
                            <i class="fa-solid fa-user"></i>
                        </div>
                        <div class="form-group col-md-6">
                            <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                            <i class="fa-solid fa-lock"></i>
                        </div>
                        <div class="form-btn col-4"></div>
                        <div class="form-btn col-4">
                            <button class="th-btn btn-fw" type="submit" name="login" value="login">
                                Login<i class="fa-solid fa-paper-plane ms-2"></i>
                            </button>
                        </div>
                        <div class="form-btn col-4">
                            
                        </div>
                        <div class="form-btn col-12">
                            <label><a href="#">Forgot Password? </a></label>   <label><a href="<?php echo base_url();?>Web/register">Register Here </a></label> 
                        </div>
                    </div>
                    <p class="form-messages mb-0 mt-3"></p>
                </form>
            </div>
        </div>