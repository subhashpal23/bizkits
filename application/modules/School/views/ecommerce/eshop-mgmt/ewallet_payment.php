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
               <div class="alert alert-danger alert-styled-right alert-arrow-right alert-bordered">
                  <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
                  <?php echo $this->session->flashdata('error_msg');?>
               </div>
               <?php    
                  }
         
                  ?>
		 <div class="card card-flat">
            <div class="card-heading">
               <h5 class="card-title">Ewallet Payment</h5>
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
            <div class="card-body">
                
                <form action="<?php echo site_url();?>user/eshop/ewalletPaymentConfirm/" method="post" enctype="multipart/form-data" class="form-horizontal">
                     <div class="form-group ">
                        <label class="col-sm-6 control-label" for="input-to-email">Enter Transaction Password : </label>
                        <div class="col-sm-6">
                           <input type="password" name="t_password" required value=""  class="form-control" placeholder="Enter Transaction Password">
                        </div>
                     </div>
                     <div class="form-group">
                        <label class="col-sm-6 control-label" for="input-message"><span></span></label>
                        <div class="col-sm-6">
                           <button type="submit" name="ewallet_payment_btn" value="Submit" class="btn btn-info">Payment</button>
                        </div>
                     </div>
                  </form>
               								
            </div>
        
		
      </div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
<script>
function proceedtopay()
{
    var payment_mode= $("input[name='payment_mode']:checked"). val();
    window.location.href='<?php echo site_url().$module_name."/eshop/generateInvoice/";?>'+payment_mode;
}
function proceedtopay1()
{
    var payment_mode= $("input[name='payment_mode']:checked"). val();
    if(payment_mode=='ewallet')
    {
    window.location.href='<?php echo site_url().$module_name."/eshop/ewalletPayment/";?>';
    }
    if(payment_mode=='paytm')
    {
    window.location.href='<?php echo site_url().$module_name."/eshop/paytmPayment/";?>';
    }
}
function addtocart(query)
{
    $.ajax({
   url:"<?php echo base_url().$module_name; ?>/eshop/addToCart",
   method:"POST",
   data:{query:query},
   success:function(response){
       $('#result').html(response);
       $('#finalResult').hide();
   }
  })
}
function removefromcart(query)
{
    //alert(query);
    $.ajax({
   url:"<?php echo base_url().$module_name; ?>/cart/removeItemFromCart",
   method:"POST",
   data:{query:query},
   success:function(response){
       //$('#result').html(response);
       window.location=response;
   }
  })
}
function updatecart(query,qty)
{
    alert(query+'--'+qty);
    $.ajax({
   url:"<?php echo base_url().$module_name; ?>/cart/updateItemInCart",
   method:"POST",
   data:{query:query,qty:qty},
   success:function(response){
       //$('#finalResult').html(response);
        window.location=response;
   }
  })
}
$(document).ready(function(){

 //load_data();

 function load_data(query)
 {
     $('#finalResult').show();
  $.ajax({
   url:"<?php echo base_url().$module_name; ?>/eshop/fetchProducts",
   method:"POST",
   data:{query:query},
   success:function(response){
       //alert(response)
       $('#finalResult').html(response);
    //$('#result').html(data);
   
   }
  })
 }

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

</script>
<script>

function deleteConfirm(){

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