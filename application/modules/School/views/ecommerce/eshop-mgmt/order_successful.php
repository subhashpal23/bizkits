<div class="body-wrapper">
            <div class="bodywrapper__inner">

        <div class="row align-items-center mb-30 justify-content-between">
            <div class="col-lg-6 col-sm-6">
                <h6 class="page-title">Eshop</h6>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-sm-12">
            <!-- Daterange picker -->
            <!-- /daterange picker -->
		 <div class="card card-flat">
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
		<a href="<?php echo site_url()."user/eshop_orders/allOrders/";?>">click here to view order details (order-id : <?php echo $order_id;?>)</a>
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