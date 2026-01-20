<main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> Pages <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="<?php echo base_url();?>frontassets/imgs/page/login-1.png" alt="">
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Forgot Password</h1>
                                            <p class="mb-30">Don't have an account? <a href="<?php echo base_url();?>join-us">Create Account</a></p>
                                        </div>
                                        <?php if($this->session->flashdata('res')): ?>
                                        <div class="alert alert-info">
                                        <?php echo $this->session->flashdata('res'); ?>
                                        </div>
                                        <?php endif; ?>

                                        <form action="<?php echo base_url();?>Web/forgetpassword" method="POST">
                                            <div class="form-group">
                                                <input type="text" required="" name="email" id="email" placeholder="Email Address">
                                            </div>
                                            
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up" name="login" value="btn">Submit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
