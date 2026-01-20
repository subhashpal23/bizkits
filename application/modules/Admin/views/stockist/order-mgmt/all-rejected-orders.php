<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Eshop</span> - Orders</h4>
         </div>
         <div class="heading-elements">
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url().$module_name;?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Orders</a></li>
            <li class="active"><?php echo $title;?></li>
         </ul>
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
         <div class="panel panel-flat">
            <div class="panel-heading">
               <h5 class="panel-title"><?php echo $title;?></h5>
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
      <?php $this->load->view('common/footer-text') ?>
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
<script>
   $(document).ready(function(){
   	$(".view_order_details").click(function(){
		var order_id=$(this).attr('order_id');
		jQuery.ajax({
                  type:'post',
                  url:'<?php echo site_url();?>admin/eshop_orders/getOrderDetails/',
				  data:{'order_id':order_id},
                  async:false,
                  beforeSend: function () {
                       $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
					  $("#preview_info_body").append(res);
					  $("#view_order_details_modal").modal('show');
                  },//end success
                  complete: function () {
                       $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax	
		
		
		
   	})
	/////////////////////////
	$(".change_status").change(function(){
		
		if(window.confirm('Are you Sure? you want to change the product status.'))
		{
			var order_id=$(this).attr('order_id');
		    var order_status=$(this).val();
			var url='allRejectedOrders';
			window.location.href='<?php echo site_url();?>admin/eshop_orders/change_status/'+order_id+"/"+order_status+"/"+url;
		}
		else 
		{
			return false;
		}
	});	
	/////////////////////////
   });

</script>					
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