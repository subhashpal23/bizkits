
   
   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
   <div class="content">
      <!-- Main charts -->
      <div class="row">
         <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
             <form method="post" action="<?php echo base_url();?>Admin/Eshop/StockistDashboard">
          <div class="col-sm-6 col-md-4" style="float:left;">
             <select name="stockist" id="stockist" class="form-control" >
                 <option value="">Select Stockist</option>
                 <?php
                foreach($all_category as $key=>$val)
                {
                    if($val->user_id==$owner_user_id)
                    {
                        $sel="selected";
                    }
                    else
                    {
                        $sel='';
                    }
                    echo '<option value="'.$val->user_id.'" '.$sel.'>'.$val->username.'</option>';
                }
                 ?>
                 
             </select>
             
             </div>
             <div class="col-sm-6 col-md-6"  style="float:left;">
             From:    <input type="text" name="fromdate" id="datepicker" value="<?php echo $from_date;?>">
             
            To:     <input type="text" name="todate" id="datepicker1" value="<?php echo $to_date;?>">
             
             </div>
         <div class="col-sm-6 col-md-2"  style="float:right;">
             <button type="submit" name="btn" value="btn" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Search</button>
             </div>
        
        </form>
        </div>
        </div>
        </div>
       </div>
         <script>
             function showdashboard(stockist_id)
             {
                // window.location.href='<?php echo base_url();?>Admin/Eshop/StockistDashboard/'+stockist_id;
             }
         </script>
          <div class="row">
         <div class="col-sm-6 col-md-4">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-body">
                     <h3 class="no-margin"><?php echo 'Orders:'.$order_data['total_order']; ?>
                     <?php echo "<br>"; echo currency().''.$order_data['total_price'];?>
                     <?php echo "<br>"; echo 'Quantity:'.($order_data['total_price']/10000);?></h3>
                     <span class="text-uppercase">Total Order</span>
                  </div>
                  <div class="media-right media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-4">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right" style="color:red">
                     <h3 class="no-margin"><?php echo 'Orders:'.$order_data['pending_order']; ?>
                     <?php echo "<br>"; echo currency().''.$order_data['pending_price'];?>
                     <?php echo "<br>"; echo 'Quantity:'.($order_data['pending_price']/10000);?></h3>
                     <span class="text-uppercase">Total Pending Order</span>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-6 col-md-4">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right"  style="color:green">
                     <h3 class="no-margin"><?php echo 'Orders:'.$order_data['confirmed_order']; ?>
                     <?php echo "<br>"; echo currency().''.$order_data['confirmed_price'];?>
                     <?php echo "<br>"; echo 'Quantity:'.($order_data['confirmed_price']/10000);?></h3>
                     <span class="text-uppercase">Total Confirmed Order</span>
                  </div>
               </div>
            </div>
         </div>
		 <!--<div class="col-sm-6 col-md-3">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['rejected_order']; ?></h3>
                     <span class="text-uppercase">Total Rejected Order</span>
                  </div>
               </div>
            </div>
         </div>
		 <div class="col-sm-6 col-md-3">
            <div class="card card-body bg-silver-400 has-bg-image">
               <div class="media no-margin">
                  <div class="media-left media-middle">
                     <i class="icon-cart icon-2x opacity-75"></i>
                  </div>
                  <div class="media-body text-right">
                     <h3 class="no-margin"><?php echo $order_data['delivered_order']; ?></h3>
                     <span class="text-uppercase">Total Delivered Order</span>
                  </div>
               </div>
            </div>
         </div>-->
      </div>
	
    
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->