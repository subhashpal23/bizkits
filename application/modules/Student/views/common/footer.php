<!-- Footer Area Start Here -->
                <footer class="footer-wrap-layout1">
                    <!--<div class="copyright">© Copyrights <a href="#">Interschool</a> 2023. All rights reserved. </div>-->
                </footer>
                <!-- Footer Area End Here -->
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="<?php echo base_url();?>assets/js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="<?php echo base_url();?>assets/js/plugins.js"></script>
    <!-- Popper js -->
    <script src="<?php echo base_url();?>assets/js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="<?php echo base_url();?>assets/js/bootstrap.min.js"></script>
    <!-- Select 2 Js -->
    <script src="<?php echo base_url();?>assets/js/select2.min.js"></script>
    <!-- Date Picker Js -->
    <script src="<?php echo base_url();?>assets/js/datepicker.min.js"></script>
    <!-- Counterup Js -->
    <script src="<?php echo base_url();?>assets/js/jquery.counterup.min.js"></script>
    <!-- Moment Js -->
    <script src="<?php echo base_url();?>assets/js/moment.min.js"></script>
    <!-- Waypoints Js -->
    <script src="<?php echo base_url();?>assets/js/jquery.waypoints.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="<?php echo base_url();?>assets/js/jquery.scrollUp.min.js"></script>
    <!-- Full Calender Js -->
    <script src="<?php echo base_url();?>assets/js/fullcalendar.min.js"></script>
    <!-- Chart Js -->
    <script src="<?php echo base_url();?>assets/js/Chart.min.js"></script>
    <!-- Custom Js -->
    <script src="<?php echo base_url();?>assets/js/main.js"></script>

</body>

</html>
<script>
   
 
   	function view_products_details(product_id){
   	    
   	    //alert(product_id);
		jQuery.ajax({
                  type:'post',
                  url:'<?php echo site_url();?>Student/Eshop/getProductViewDetails',
				  data:{'order_id':product_id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
					  $("#preview_info_body").append(res);
					  $("#view_order_details_modal").modal('show');
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax	
		
   	}	
		
   

   function loadDoc(product_id) 
   {
   url='<?php echo site_url();?>Student/Cart/addToCart/'+product_id+'/'+'eshop';
     var xhttp = new XMLHttpRequest();
     xhttp.onreadystatechange = function() 
     {
      if (this.readyState == 4 && this.status == 200) 
     {
   		
         window.location=this.responseText;
       }
     };
     xhttp.open("GET", url, true);
     xhttp.send();
   }
</script>
<script>
function proceedtopay()
{
    //var payment_mode= $("input[name='payment_mode']:checked"). val();
    window.location.href='<?php echo site_url()."Student/Eshop/generateInvoice/ewallet";?>';
}
function proceedtopay1()
{
    var payment_mode= $("input[name='payment_mode']:checked"). val();
    var center_leader=$("#center_leader").val();
    // check center leader is mandatory
    
    if(payment_mode=='ewallet')
    {
    window.location.href='<?php echo site_url()."Student/Eshop/ewalletPayment/";?>'+center_leader;
    }
    if(payment_mode=='paytm')
    {
    window.location.href='<?php echo site_url()."Student/Eshop/paytmPayment/";?>';
    }
}
function addtocart(query)
{
    $.ajax({
   url:"<?php echo base_url(); ?>Student/Eshop/addToCart",
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
   url:"<?php echo base_url(); ?>Student/Cart/removeItemFromCart",
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
   //alert(query+'--'+qty);
   $.ajax({
   url:"<?php echo base_url(); ?>Student/Cart/updateItemInCart",
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
   url:"<?php echo base_url(); ?>Student/Eshop/fetchProducts",
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