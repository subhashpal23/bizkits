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
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="card card-body">
            <div class="card-heading">
               <h5 class="card-title"><?php echo $title;?></h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
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
               ?>
            <table class="table datatable-responsive table-bordered table-striped table-hover" >
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Order Id</th>
                     <th>Buyer Type</th>
                     <th>Buyer Id</th>
                     <th>Username</th>
                     <th>Email</th>
                     <th>Contact No.</th>
                     <th>Final Price</th>
                     <th>Order Date</th>
                     <th>Status</th>
                     <th>Action</th>
                     <th>View Details</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     if(!empty($all_orders) && count($all_orders)>0)
                     {
                        $sno=0;
                        foreach ($all_orders as $order) 
                        {
                        $sno++;  
                        
                     if($order->order_status=='0')
                     {
                     $status='Pending';
                     $color='red';
                     }
                     else if($order->order_status=='1')
                     {
                     $status='Confirmed';
                     $color='green';
                     }
                     else if($order->order_status=='2')
                     {
                     $status='Rejected';
                     $color='orange';
                     }
                     else if($order->order_status=='3')
                     {
                     $status='Delivered';
                     $color='blue';
                     }
                     $buyer_type=($order->role=='2')?'MLM MEMBER':'GUEST';
                     //////////
                     $buyer_user_id=($order->role=='2')?$order->user_id:$order->guest_id;
                       
                     $buyer_details=($order->role=='2')?eshop_get_user_details(
                     $buyer_user_id):eshop_get_guest_details($buyer_user_id);
                     ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $order->order_id;?></td>
                     <td><?php echo $buyer_type;?></td>
                     <td><?php echo $order->user_id;?></td>
                     <td>
                        <?php 
                           if($order->role=='2')
                           {
                           echo $buyer_details->username; 
                           }
                           else 
                           {
                            echo 'NULL';
                           }
                           ?>
                     </td>
                     <td><?php echo $buyer_details->email;?></td>
                     <td><?php echo $buyer_details->contact_no;?></td>
                     <td><?php echo $order->final_price.' '.currency();?></td>
                     <td><?php echo $order->order_date;?></td>
                     <td><span style='color:white;padding: 9px;border-radius: 10px;background-color:<?php echo $color; ?>'><?php echo $status;?></span></td>
                     <td>
                        <select class="form-control myclass change_status" order_id="<?php echo $order->order_id;?>">
                           <option value="0" <?php if($order->order_status=='0'){ echo "selected"; } ?> >Pending</option>
                           <option value="1" <?php if($order->order_status=='1'){ echo "selected"; } ?>>Confirmed</option>
                           <option value="2" <?php if($order->order_status=='2'){ echo "selected"; } ?> >Rejected</option>
                           <option value="3" <?php if($order->order_status=='3'){ echo "selected"; } ?>>Delivered</option>
                        </select>
                     </td>
                     <td>
                        <a href="javascript:void(0);" class="view_order_details" order_id="<?php echo $order->order_id; ?>">
                        <i class="icon-eye"></i>
                        </a>
                     </td>
                  </tr>
                  <?php    
                     }
                     }
                     ?>
               </tbody>
            </table>
         </div>
      </div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<div id="view_order_details_modal"  class="modal fade">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header bg-success">
            <h6 class="modal-title" id="view_booking_product_name">Order No: <b></b</h6>
         </div>
         <div class="modal-body" id="preview_info_body">
            <!-------------------------->
            
            <!--------------------------->
         </div>
         <div class="modal-footer">
            <!--
               <button type="button" onclick="print_invoice();" class="btn btn-default btn-xs heading-btn"><i class="icon-printer position-left"></i> Print</button>
               -->
            <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>
