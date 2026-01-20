<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url();?>frontassets/images/bg.jpg">
            <div class="container">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title" style="color:#fff;">Payment Methods</h1>
                    <ul class="breadcumb-menu">
                        <li>
                            <a href="<?php echo base_url();?>" style="color:#fff;">Home</a>
                        </li>
                        <li style="color:#fff;">Payment Methods</li>
                    </ul>
                </div>
            </div>
        </div>











        <div class="overflow-hidden overflow-hidden space" id="about-sec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 mb-30 mb-xl-0">
                       <form action="<?php echo site_url();?>Web/uploadBankWireProof" enctype="multipart/form-data" method="post"  style="width:100%">
        <header>Upload Bank Wire Proof Of payment</header>
        <br>
                              <?php echo $this->session->flashdata('flash_msg');?>
       
            <div class="row">
                                    <label class="label col col-2">Username</label>
                                    <div class="col col-6">
                                       <label class="input">
                                       <i class="icon-append icon-user"></i>
                                       <?php 
                                       if(!empty($username))
                                       {
                                       ?>
                                       <input type="text" disabled value="<?php echo $username;?>">
                                       <input type="hidden" name="username" value="<?php echo $username;?>">
                                       <?php  
                                       }
                                       else
                                       {
                                       ?>
                                       <input type="text" name="username" required>
                                       <?php 
                                       }
                                       ?>
                                       </label>
                                    </div>
                                 </div>
                 <br>
                                  <div class="row">
                                    <label class="label col col-2">Proof</label>
                                    <div class="col col-6">
                                       <label class="input">
                                       <i class="icon-append icon-user"></i>
                                       <input type="file" name="proof" class="file-upload" required>
                                       </label>
                                    </div>
                                 </div>
          
       
                              <button type="submit" name="btn" value="submit" onclick="showupload();" class="th-btn btn-fw">Upload</button>
                          
      </form>
                    </div>
                   
                </div>
            </div>
        </div>
<script>
    function showupload()
    {
        //alert("Hello");
    }
</script>