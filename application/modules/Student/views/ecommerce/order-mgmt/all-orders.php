<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Eshop</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Order</li>
                    </ul>
                </div>
         <div class="card height-auto">
                    <div class="card-body">
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
            <div class="table-responsive">
            <table class="table table--light style--two">
               <thead>
                  <tr>
                      <?php
                      if($order_type=='tax')
                      {
                         ?>
                         <th>Sr.No</th>
                     <th>Order Id</th>
                     <th>Order From</th>
                     
                     <th>Username</th>
                     <th>Tax %</th>
                     <th>Final Price</th>
                     
                     <th>Order Date</th>
                     
                         <?php
                      }
                      else
                      {
                          ?>
                          <th>Sr.No</th>
                     <th>Order Id</th>
                     <!--<th>Order From</th>
                     <th>Buyer Id</th>
                     <th>Username</th>
                     
                     <th>Contact No.</th>-->
                     <th>Final Price</th>
                     <!--<th>BV</th>-->
                     <th>Order Date</th>
                     <th>Status</th>
                     <th>Action</th>
                     <th>View Details</th>
                          <?php
                      }
                      ?>
                     
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
                     $status='Order Placed';
                     $color='danger';
                     }
                     else if($order->order_status=='1')
                     {
                     $status='Order Confirmed';
                     $color='warning';
                     }
                     else if($order->order_status=='2')
                     {
                     $status='Order Shipped';
                     $color='primary';
                     }
                     else if($order->order_status=='3')
                     {
                     $status='Order Delivered';
                     $color='success';
                     }
                     $buyer_type=($order->payment_method=='1')?'STOCKIST':'WEB';
                     //////////
                     //$buyer_user_id=($order->role=='2')?$order->user_id:$order->guest_id;
                       $buyer_user_id=$order->user_id;
                       $buyer_details=get_user_details($buyer_user_id);
                    // $buyer_details=($order->role=='2')?eshop_get_user_details($buyer_user_id):eshop_get_guest_details($buyer_user_id);
                     ?>
                  <tr>
                      <?php
                      if($order_type=='tax')
                      {
                      ?>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $order->order_id;?></td>
                     <td><?php echo $buyer_type;?></td>
                     
                     <td>
                        <?php 
                           
                           echo $buyer_details->username; 
                           ?>
                     </td>
                    <td>0%</td>
                     <td><?php echo $order->final_bv.' '.currency();?></td>
                     <td><?php echo $order->order_date;?></td>
                     
                     <?php
                      }
                      else
                      {
                          ?>
                          <td><?php echo $sno;?></td>
                     <td><?php echo $order->order_id;?></td>
                     <!--<td><?php echo $buyer_type;?></td>
                     <td><?php echo $order->user_id;?></td>
                     <td>
                        <?php 
                           
                           echo $buyer_details->username; 
                           ?>
                     </td>
                     
                     <td><?php echo $buyer_details->contact_no;?></td>-->
                     <td><?php echo $order->final_price.' '.currency();?></td>
                     <!--<td><?php echo $order->final_bv;?></td>-->
                     <td><?php echo $order->order_date;?></td>
                     <td><span class='btn btn-<?php echo $color; ?>' ><?php echo $status;?></span></td>
                     <td>
                        <select class="form-control myclass change_status" order_id="<?php echo $order->order_id;?>">
                           <option value="0" <?php if($order->order_status=='0'){ echo "selected"; } ?> >Order Placed</option>
                           <option value="1" <?php if($order->order_status=='1'){ echo "selected"; } ?>>Order Confirmed</option>
                           <option value="2" <?php if($order->order_status=='2'){ echo "selected"; } ?> >Order Shipped</option>
                           <option value="3" <?php if($order->order_status=='3'){ echo "selected"; } ?>>Order Delivered</option>
                        </select>
                     </td>
                     <td>
                        <a href="<?php echo base_url();?>user/eshop_orders/invoice/<?php echo $order->order_id;?>"  order_id="<?php echo $order->order_id; ?>">
                        <i class="fa fa-eye"></i>
                        </a>
                     </td>
                          <?php
                      }
                     ?>
                  </tr>
                  <?php    
                     }
                     }
                     ?>
               </tbody>
            </table>
            </div>
         </div>
      </div>
      
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
					
<script>
   function print_invoice()
   {
   var printpage = window.open('','','width=1000,height=400');
   printpage.document.open("text/html");
   printpage.document.write(document.getElementById('preview-info-body1').innerHTML);
   printpage.document.close();
   printpage.print();
   printpage.close();
   }
</script>