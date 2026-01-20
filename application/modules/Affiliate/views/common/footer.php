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
<script src="<?php echo base_url();?>assets/ckeditor/ckeditor.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
<script>
    $('.select2').select2();
    $(document).ready(function () {
        $('#item').select2({
            placeholder: "Select Products", // Placeholder text
            allowClear: true            // Allow clear button
        });
    });
</script>
<script>
CKEDITOR.replace( 'editor1' );
CKEDITOR.replace( 'editor2' );

//$('#exampleModal').modal('show');

  $(document).ready(function(){
  	$("#submitBtn").click(function(){
  	$("#valid_old_password").text('').css('display','none');	
  	$("#valid_new_password").text('').css('display','none');	
  	$("#valid_confirm_password").text('').css('display','none');	
     if($("#old_password").val()=="")
     {
     	$("#valid_old_password").text("Please enter old password!").css('display','');
     	return false;
     }

     if($("#new_password").val()=="")
     {
     	$("#valid_new_password").text("Please enter new password!").css('display','');
     	return false;
     }

     if($("#confirm_password").val()=="")
     {
     	$("#valid_confirm_password").text("Please enter old password!").css('display','');
     	return false;
     }

     if($("#new_password").val()!=$("#confirm_password").val())
     {
     	$("#valid_confirm_password").text("Sorry confirm password does not match!").css('display','');
     	return false;
     }
     return true;
  	});//end submit btn click here
  });//end ready
</script>
<script>
$(document).ready(function(){
   $("#deposit_amount").keyup(function()
   {
    $("#show_amount_div").html(null);
      var deposit_amount=parseInt($(this).val());
      var wallet_amount=parseInt($("#wallet_amount").val());
    if(isNaN($(this).val()))
    {
    $("#valid_deposit_amount").text("Please enter valid deposit amount!").css('display','');
    return false;
    }
    $("#valid_deposit_amount").text(null).css('display','none');
    var rem_amount=wallet_amount+deposit_amount;
    var rem_msg="Your Amount Will Be: "+rem_amount;
    $("#show_amount_div").html(rem_msg);
   });//end keyUp
   $("#submit_btn").click(function(){
         var deposit_amount=parseInt($("#deposit_amount").val());
         var wallet_amount=parseInt($("#wallet_amount").val());
       if($("#deposit_amount").val()=='' || $("#deposit_amount").val()==null)
       {
       $("#valid_deposit_amount").text("Please enter deposit amount!").css('display','');
       return false;
       }
       if($("#deposit_proof").val()=="" || $("#deposit_proof").val()==null)
       {
       $("#valid_deposit_proof").text("Please upload deposit proof!").css('display','');
       return false;
       }
       return true;


   });//end submit btn click here
});//end ready
</script>  
<script>
$(document).ready(function(){
   $("#request_amount").keyup(function()
   {
    $("#rem_amount_div").html(null);
      var request_amount=parseInt($(this).val());
      var wallet_amount=parseInt($("#wallet_amount").val());
    if(request_amount>wallet_amount)
    {

    $("#valid_request_amount").html("<b>Request Amount can't be more than wallet amount!</b>").css('display','');
    return false;
    }
    $("#valid_request_amount").text(null).css('display','none');
    var rem_amount=wallet_amount-request_amount;
    var rem_msg="Remaining Amount Will Be: "+rem_amount;
    $("#rem_amount_div").html(rem_msg);
   });//end keyUp
   $("#submit_btn_withdraw").click(function(){
         var request_amount=parseInt($("#request_amount").val());
         var wallet_amount=parseInt($("#wallet_amount").val());
       if($("#request_amount").val()=='' || $("#request_amount").val()==null)
       {
       $("#valid_request_amount").html("<b>Please enter request amount!</b>").css('display','');
       return false;
       }
       if(request_amount>wallet_amount)
       {
       $("#valid_request_amount").html("<b>Request Amount can't be more than wallet amount!</b>").css('display','');
       return false;
       }
       return true;


   });//end submit btn click here
});//end ready
</script>   

<script>
function proceedtopay()
{
    //var payment_mode= $("input[name='payment_mode']:checked"). val();
    window.location.href='<?php echo site_url().$module_name."/Eshop/generateInvoice/ewallet";?>';
}
function proceedtopay1()
{
    var payment_mode= $("input[name='payment_mode']:checked"). val();
    var center_leader=$("#center_leader").val();
    // check center leader is mandatory
    
    if(payment_mode=='ewallet')
    {
    window.location.href='<?php echo site_url().$module_name."/Eshop/ewalletPayment/";?>';
    }
    if(payment_mode=='paytm')
    {
    window.location.href='<?php echo site_url().$module_name."/Eshop/paytmPayment/";?>';
    }
}
function addtocart(query)
{
    $.ajax({
   url:"<?php echo base_url().$module_name; ?>/Eshop/addToCart",
   method:"POST",
   data:{query:query},
   success:function(response){
       $('#result').html(response);
       $('#finalResult').hide();
   }
  })
}
function removefromcartrepurchase(query)
{
    //alert(query);
    $.ajax({
   url:"<?php echo base_url().$module_name; ?>/Cart/removeItemOfCart",
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
   url:"<?php echo base_url().$module_name; ?>/Cart/updateItemOfCart",
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
   url:"<?php echo base_url().$module_name; ?>/Eshop/fetchProducts",
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
   $(document).ready(function(){
   	$(".view_order_details").click(function(){
		var order_id=$(this).attr('order_id');
		jQuery.ajax({
                  type:'post',
                  url:'<?php echo site_url();?>Affiliate/Eshop_Orders/getOrderDetails/',
				  data:{'order_id':order_id},
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
		
		
		
   	})
	/////////////////////////
	$(".change_status").change(function(){
		
		if(window.confirm('Are you Sure? you want to change the product status.'))
		{
			var order_id=$(this).attr('order_id');
		    var order_status=$(this).val();
			var url='allOrders';
			window.location.href='<?php echo site_url();?>Affiliate/Eshop_Orders/change_status/'+order_id+"/"+order_status+"/"+url;
		}
		else 
		{
			return false;
		}
	});
	
	$(".change_status_stockist").change(function(){
		if(window.confirm('Are you Sure? you want to change the product status.'))
		{
			var order_id=$(this).attr('order_id');
		    var order_status=$(this).val();
			var url='allStockistOrders';
			jQuery.ajax({
                  type:'post',
                  url:'<?php echo site_url();?>Affiliate/Eshop_Orders/checkStock/',
				  data:{'order_id':order_id},
                  async:false,
                  beforeSend: function () {
                       //$.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
                  success:function(res){
                      //console.log(res)
                      res=res.replace(/\s/g, "");
                       //console.log(res)
                      if(res=='success')
                      {
                          //alert(res);
                          window.location.href='<?php echo site_url();?>Affiliate/Eshop_Orders/change_status_stockist/'+order_id+"/"+order_status+"/"+url;
                      }
                      else
                      {
                          alert('Product not in stock. Please check stock before confirm order.');
                      }
					  //$("#preview_info_body").html(res);
					  //$("#view_order_details_modal").modal('show');
                  },//end success
                  complete: function () {
                       //$.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                   }
             });//end ajax
			//window.location.href='<?php echo site_url();?>Affiliate/Eshop_Orders/change_status_stockist/'+order_id+"/"+order_status+"/"+url;
		}
		else 
		{
			return false;
		}
	});
	/////////////////////////
   });

$("#createbtn").hide();
$('.showproducts').hide();
function addtocart(id)
    {
        //alert(id);
        var pkg = $('#diff_package_amount').val();
        var qty = $('#qty_'+id).val();
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Affiliate/Cart/addToCart/'+id+"/"+pkg+"/"+qty,
           data: {product_id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               
            console.log(res);
            var res1=JSON.parse(res);
            console.log(res1.total);
            if(parseInt(pkg)==parseInt(res1.total_cost))
            {
                $("#createbtn").show();
            }
            else
            {
                $("#createbtn").hide();
            }
             if(res1.total>=1)
             {
                 if(res1.reason=='')
                 {
                    $('#removecart_'+id).show();
                    $('#addcart_'+id).hide();
                    $('#qty_'+id).hide();
                 }
                 else
                 {
                    $('#removecart_'+id).hide();
                    $('#addcart_'+id).show();
                    $('#qty_'+id).show();
                 }
              $("#total_message").html(res1.msg).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html(res1.reason).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
               $("#total_cost").html("Total Amount:<?php echo currency();?>"+res1.total_cost).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_product").html("Total Products:"+res1.total).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }//end if
             else 
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                $("#total_product").html('').css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_cost").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              
              $("#total_message").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }
           },//end success
          complete: function () {
       
            } 
      });//end ajax
        
    }
    
    function removefromcart(id)
    {
        //alert(id);
        var pkg = $('#diff_package_amount').val();
        var qty = $('#qty_'+id).val();
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Affiliate/Cart/removeItemFromCart/'+id+'/'+pkg+'/Removed',
           data: {product_id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
            console.log(res);
            var res1=JSON.parse(res);
            console.log(res1.total);
            if(parseInt(pkg)==parseInt(res1.total_cost))
            {
                $("#createbtn").show();
            }
            else
            {
                $("#createbtn").hide();
            }
             if(res1.total>=1)
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                 $("#total_message").html(res1.msg).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_reason").html(res1.reason).css({
               'font-weight': 'bold',
               'color': 'red',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
               $("#total_cost").html("Total Amount:<?php echo currency();?>"+res1.total_cost).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_product").html("Total Products:<?php echo currency();?>"+res1.total).css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }//end if
             else 
             {
                 $('#removecart_'+id).hide();
                 $('#addcart_'+id).show();
                 $('#qty_'+id).show();
                $("#total_product").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
              $("#total_cost").html('').css({
               'font-weight': 'bold',
               'color': 'green',
               'margin': '0',
               'padding': '0',
               'float': 'left',
               'font-size': '14px'
              });//end css
             }
           },//end success
          complete: function () {
       
            } 
      });//end ajax
        
    }
    
    function showStockistStateWise(state_id)
    {
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/showStockistStateWise/'+state_id,
           data: {state_id:state_id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               //alert(res);
            $("#stockist").html(res);
           },//end success
          complete: function () {
       
            } 
      });//end ajax
    }
    
    
    
    function showStockistStateWise(state_id)
    {
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/showStockistStateWise/'+state_id,
           data: {state_id:state_id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               //alert(res);
            $("#stockist").html(res);
           },//end success
          complete: function () {
       
            } 
      });//end ajax
    }
    function showStockist(id)
    {
        $.ajax({
           type:'POST',
           url:'<?php echo site_url();?>Web/showStockist/'+id,
           data: {id:id,requestType:'addCart'},
           async:false,
           beforeSend: function () {
                
              },
           success:function(res){
               //alert(res);
            $("#showstockistdetails").html(res);
            $('.showproducts').show();
           },//end success
          complete: function () {
       
            } 
      });//end ajax
    }
    
    print_country("country");
</script>