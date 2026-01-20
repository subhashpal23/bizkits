
               <div class="container">
         <div class="row justify-content-md-center">
            <div class="col-lg-12">
               <div class="card card-hero card-primary animated fadeInUp animation-delay-7">
                  <div class="card-body">
                     <h1 class="color-primary text-center">Upload Bank Wire Proof Of payment</h1>
                     
                   <form action="<?php echo site_url();?>Web/uploadBankWireProof" enctype="multipart/form-data" method="post" class="sky-form" style="width:100%">
        <header>Upload Bank Wire Proof Of payment</header>
        <br>
                              <?php echo $this->session->flashdata('flash_msg');?>
        
        <fieldset>
          <section>
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
                                       <input type="file" name="proof" required>
                                       </label>
                                    </div>
                                 </div>
          </section>
          
      
        </fieldset>
        <footer>
                              <button type="submit" name="btn" value="submit" class="button">Upload</button>
                           </footer>
      
      </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
            </div>
           