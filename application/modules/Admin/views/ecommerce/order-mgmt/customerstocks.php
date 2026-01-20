<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Eshop</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Eshop</li>
                    </ul>
                </div>
    <div class="card height-auto">
        <div class="card-body">
            
            <div class="card-heading">
               <h5 class="card-title">Stock With Client</h5>
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
                     
                     <th>Sr.No</th>
                      <th>Member Name</th>
                     <th>Product</th>
                     <!--<th>Monthly Quantity</th>-->
                     <th>Stock Quantity</th>
                     <th>Action</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  //pr($allstcoks);
                     if(!empty($allstcoks) && count($allstcoks)>0)
                     {
                        $sno=0;
                        foreach ($allstcoks as $order) 
                        {
                        $sno++;  
                        if($order->qty){$color='green';}
                        else
                        {
                            $color='red';
                        }
                        $d=get_user_details($order->stockist_id);
                     ?>
                  <tr style="color:<?php echo $color;?>">
                    
                          <td><?php echo $sno;?></td>
                           <td><?php echo $d->first_name.' '.$d->last_name;?></td>
                     <td><?php echo $order->title;?></td>
                     <!--<td><?php echo $order->quantity;?></td>-->
                     
                    <td><?php $tstock=$callfunc->getproductquantity($order->id,$order->stockist_id);echo ($tstock)?$tstock:0;?></td>
                    <td><a href="<?php echo site_url();?>Admin/Eshop_orders/allStockHistory/<?php echo $order->id;?>/<?php echo $order->stockist_id;?>"><i class="fa fa-eye"></i></a>
                    &nbsp;&nbsp;
                    <?php
                    $diff=strtotime(date($_POST['year'].'-'.$_POST['month'].'-t'))-time();
                    if($diff>0)
                    {
                    ?>
                    <a href="<?php echo site_url();?>Admin/Eshop_orders/stockReturn/<?php echo $order->id;?>/<?php echo $order->stockist_id;?>"><i class="fa fa-reply"></i></a></td>
                          <?php
                    }
                      }
                     ?>
                  </tr>
                  <?php    
                     
                     }
                     ?>
               </tbody>
            </table>
            </div>
            
            <div class="table-responsive">
            <table class="table datatable-responsive table-bordered table-striped table-hover" >
               <thead>
                  <tr>
                     
                          <th>Sr.No</th>
                     <th>Return Id</th>
                     
                     <th>Buyer Id</th>
                     <th>Username</th>
                     <!--<th>Stockist Id</th>
                     <th>Stockist Name</th>-->
                     <!--<th>Email</th>-->
                     <th>Contact No.</th>
                     <th>Final Price</th>
                     <!--<th>BV</th>-->
                     <th>Return Date</th>
                     <th>Status</th>
                     
                    
                     
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
                     $status='Order Placed';
                     $color='danger';
                     }
                     else if($order->order_status=='1')
                     {
                     $status='Confirm Order';
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
                     $quote=($order->quote)?'Quote':'';
                     $bill=($order->bill)?'Billed':'';
                     //////////
                     //$buyer_user_id=($order->role=='2')?$order->user_id:$order->guest_id;
                       $buyer_user_id=$order->user_id;
                       $buyer_details=get_user_details($buyer_user_id);
                    // $buyer_details=($order->role=='2')?eshop_get_user_details($buyer_user_id):eshop_get_guest_details($buyer_user_id);
                     ?>
                  <tr>
                                               
                          <td><?php echo $sno;?></td>
                     <td><?php echo $order->order_id;?></td>
                     
                     <td><?php echo $order->user_id;?></td>
                     <td>
                        <?php 
                           
                           echo $buyer_details->username; 
                           ?>
                     </td>
                     <!--<td><?php echo $order->owner_user_id;?></td>
                     <td><?php echo get_user_name($order->owner_user_id);?></td>-->
                     <!--<td><?php echo $buyer_details->email;?></td>-->
                     <td><?php echo $buyer_details->contact_no;?></td>
                     <td><?php echo $order->final_price.' '.currency();?></td>
                     <!--<td><?php echo $order->final_pv;?></td>-->
                     <td><?php echo $order->order_date;?></td>
                     <td><span class='btn btn-<?php echo $color; ?>' >Returned</span></td>
                     
                     
                    
                     <td>
                        <a href="javascript:void(0);" class="view_return_details" order_id="<?php echo $order->order_id; ?>">
                        <i class="fa fa-eye"></i>
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