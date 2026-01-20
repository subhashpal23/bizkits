<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Eshop</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Student">Home</a>
                        </li>
                        <li>Eshop</li>
                    </ul>
                </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
            <!-- Daterange picker -->
            <!-- /daterange picker -->
            <div class="row">
               
    		 <div class="card card-body">
                <div class="card-heading">
                   <h5 class="card-title">View All Product</h5>
                   <div class="heading-elements">
                      <ul class="icons-list">
                         <li><a data-action="collapse"></a></li>
                         <li><a data-action="reload"></a></li>
                         <li><a data-action="close"></a></li>
                      </ul>
                   </div>
                </div>
             <div class="form-group">
                  <?php 
                      if(!empty($this->session->flashdata('flash_msg')))
                      {
                      ?>
                   <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                      <?php echo $this->session->flashdata('flash_msg');?>
                   </div>
                   <?php    
                      }
                      if(!empty($this->session->flashdata('error_msg')))
                      {
                      ?>
                   <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
                      <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                      <?php echo $this->session->flashdata('error_msg');?>
                   </div>
                   <?php    
                      }
                    //$cart_item=$this->session->userdata('cart');
	                //pr($cart_item); exit;
                ?>
               <!-- <div class="input-group">
                 <span class="input-group-addon">Search</span>
                 <input type="text" name="search_text" id="search_text" placeholder="Search by Product Name Or SKU" class="form-control" />
                 
                </div>-->
    <ul id="finalResult"></ul>
   </div>
   <br />
   <div id="result">
       <?php echo $cartlistdetail;?>
   </div>
   
   <style>
        

        #finalResult {
            position:relative;
            margin: 0px;
             padding-left: 0px;
        }

       #finalResult  li {
           cursor:pointer;
            list-style: none;
            background-color: lightgray;
            margin: 1px;
            padding: 1px;
            -moz-border-radius: 3px;
            -webkit-border-radius: 3px;
            border-radius: 3px;
        }
         #finalResult  li:hover{
             color:blue;
         }
    </style>
      </div>
      </div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
