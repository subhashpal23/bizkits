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
        <div class="row">
            <div class="col-lg-12 col-sm-12">
            <!-- Daterange picker -->
            <!-- /daterange picker -->
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
   <!-- <div class="input-group">
     <span class="input-group-addon">Search</span>
     <input type="text" name="search_text" id="search_text" placeholder="Search by Product Name Or SKU" class="form-control" />
     
    </div>-->
    
   </div>
   <br />
    <div class="alert alert-success "><i class="fa fa-exclamation-circle"></i>
		Thanks! Your order is successful <br>
		<?php $s=($bill)?'bill':'quote';?>
		<a href="<?php echo site_url()."Affiliate/Eshop_Orders/allOrders/".$s;?>">click here to view order details (order-id : <?php echo $order_id;?>)</a>
        <button type="button" class="close" data-dismiss="alert">&times;</button>
    </div>
   
    </div>
</div>
      <!-- Footer -->
      <?php //->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<script>
$('#search_text').keyup(function(){
  var search = $(this).val();
  if(search != '')
  {
   load_data(search);
  }
  else
  {
   load_data();
  }
 });
});

function deleteConfirm()
{
   if(window.confirm('Are you sure, you want to delete the member'))
   {
      return true;
   }
   else
   {
      return false;
   }
}
</script>