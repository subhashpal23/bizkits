<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Eshop</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Invoice</li>
                    </ul>
                </div>
      <div class="row">
         <div class="card card-flat" style="min-width:100% !important;">
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
            <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
           
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.min.js"></script>
<script type="text/javascript" src="https://html2canvas.hertzen.com/dist/html2canvas.js"></script>
<div class="container html-content">
   <div class="col-md-12">
      <div class="invoice">
         <!-- begin invoice-company -->
         <div class="invoice-company text-inverse f-w-600">
            <span class="pull-right hidden-print">
            <a href="javascript:void(0);" onclick="CreatePDFfromHTML()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-file t-plus-1 text-danger fa-fw fa-lg"></i> Export as PDF</a>
            <a href="javascript:void(0);" onclick="window.print()" class="btn btn-sm btn-white m-b-10 p-l-5"><i class="fa fa-print t-plus-1 fa-fw fa-lg"></i> Print</a>
            </span>
            <img src="<?php echo base_url();?>assets/images/logoIcon/logo.png" style="width: 9%;">
         </div>
         <!-- end invoice-company -->
         <!-- begin invoice-header -->
         <div class="invoice-header">
            <div class="invoice-from">
               <small>from</small>
               <address class="m-t-5 m-b-5">
                  <strong class="text-inverse">Fortress Barn.</strong><br>
                  Street Address<br>
                  City, Zip Code<br>
                  Phone: (123) 456-7890<br>
                  Email: (123) 456-7890
               </address>
            </div>
            <div class="invoice-to">
               <small>to</small>
               <address class="m-t-5 m-b-5">
                   <?php
                   $binfo=json_decode($billinginfo->address_info);
                   ?>
                  <strong class="text-inverse"><?php echo $binfo->fname.' '.$binfo->lname;?></strong><br>
                  <?php echo $binfo->address;?><br><?php echo $binfo->address1;?><br>
                  <?php echo $binfo->city;?><br><?php echo $binfo->state.' '.$binfo->country;?><br>
                  Phone: <?php echo $binfo->phoneno;?><br>
                  Email: <?php echo $binfo->email;?>
               </address>
            </div>
            <div class="invoice-date">
               <small>Invoice </small>
               <div class="date text-inverse m-t-5"><?php echo date('F d,Y',strtotime($info->order_date));?></div>
               <div class="invoice-detail">
                  #<?php echo $info->order_id;?><br>
                  Services Product
               </div>
            </div>
         </div>
         <!-- end invoice-header -->
         <!-- begin invoice-content -->
         <div class="invoice-content">
            <!-- begin table-responsive -->
            <div class="table-responsive">
               <table class="table table-invoice">
                  <thead>
                     <tr>
                         <th>&nbsp;</th>
                        <th>Product</th>
                        <th>
                            Price
                        </th>
                        <th>Quantity</th>
                        <th class="text-center" width="10%">Total</th>
                        
                     </tr>
                  </thead>
                  <tbody>
                      <?php
					$cart=json_decode($info->order_details);
					$grant_total_amount=0;
							$total_qty=0;
							$cart=(array)$cart;
						//pr($cart);   
							?>
							<?php 
				
				    foreach($cart as $key=>$all_product)
						   {
						       $all_product=(array)$all_product;
				?>
									<tr class="product-row">
										<td>
											<figure class="product-image-container">
												<a href="<?php echo base_url();?>estore/product/<?php echo $all_product['product_id'];?>" class="product-image">
													<img src="<?php echo base_url();?>/product_images/<?php echo $all_product['product_image']; ?>"  alt="product" style="width:100px; height:100px;">
												</a>

													</figure>
											
										</td>
										<td class="product-col">
											<h5 class="product-title">
												<a href="javascript:void(0)"><?php echo $all_product['product_name']; ?></a>
											</h5>
											
										</td>
										<td class="product-col">
										<?php echo $all_product['product_price']; ?>
										</td>
										<td class="product-col">
											<?php echo $all_product['qty']; ?>
										</td>
										
										<td class="text-right"><span class="subtotal-price"><?php echo currency().($all_product['product_price']*$all_product['qty']); ?></span></td>
									</tr>
                <?php
                $total=$total+($all_product['product_price']*$all_product['qty']);
						   }
				
                ?>
                  </tbody>
               </table>
            </div>
            <!-- end table-responsive -->
            <!-- begin invoice-price -->
            <div class="invoice-price">
               <div class="invoice-price-left">
                  <!--<div class="invoice-price-row">
                     <div class="sub-price">
                        <small>SUBTOTAL</small>
                        <span class="text-inverse"><?php echo currency().''.$grant_total_amount;?></span>
                     </div>
                     <div class="sub-price">
                        <i class="fa fa-plus text-muted"></i>
                     </div>
                     <div class="sub-price">
                        <small>Transaction Fee</small>
                        <span class="text-inverse"><?php 
											$tfees='0.30';
											echo currency().''.$tfees=$info->transaction_fees;?></span>
                     </div>
                     <div class="sub-price">
                        <small>Handling Fees(2.90%)</small>
                        <span class="text-inverse"><?php 
											$hfees=$info->handling_fees;//($grant_total_amount*2.9)/100;
											echo currency().''.$hfees;?></span>
                     </div>
                  </div>-->
               </div>
               <div class="invoice-price-right">
                  <small>TOTAL</small> <span class="f-w-600"><?php echo currency().$info->final_price;?></span>
               </div>
            </div>
            <!-- end invoice-price -->
         </div>
         <!-- end invoice-content -->
         <!-- begin invoice-note -->
         <!--<div class="invoice-note">
            * Make all cheques payable to [Your Company Name]<br>
            * Payment is due within 30 days<br>
            * If you have any questions concerning this invoice, contact  [Name, Phone Number, Email]
         </div>
         
         <div class="invoice-footer">
            <p class="text-center m-b-5 f-w-600">
               THANK YOU FOR YOUR BUSINESS
            </p>
            <p class="text-center">
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-globe"></i> matiasgallipoli.com</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-phone-volume"></i> T:016-18192302</span>
               <span class="m-r-10"><i class="fa fa-fw fa-lg fa-envelope"></i> rtiemps@gmail.com</span>
            </p>
         </div>-->
         <!-- end invoice-footer -->
      </div>
   </div>
</div>
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
            <h6 class="modal-title" id="view_booking_product_name">Order Details <b></b></h6>
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
			var url='allOrders';
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
<style>
    body{
    margin-top:20px;
    background:#eee;
}

.invoice {
    background: #fff;
    padding: 20px
}

.invoice-company {
    font-size: 20px
}

.invoice-header {
    margin: 0 -20px;
    background: #f0f3f4;
    padding: 20px
}

.invoice-date,
.invoice-from,
.invoice-to {
    display: table-cell;
    width: 1%
}

.invoice-from,
.invoice-to {
    padding-right: 20px
}

.invoice-date .date,
.invoice-from strong,
.invoice-to strong {
    font-size: 16px;
    font-weight: 600
}

.invoice-date {
    text-align: right;
    padding-left: 20px
}

.invoice-price {
    background: #f0f3f4;
    display: table;
    width: 100%
}

.invoice-price .invoice-price-left,
.invoice-price .invoice-price-right {
    display: table-cell;
    padding: 20px;
    font-size: 20px;
    font-weight: 600;
    width: 75%;
    position: relative;
    vertical-align: middle
}

.invoice-price .invoice-price-left .sub-price {
    display: table-cell;
    vertical-align: middle;
    padding: 0 20px
}

.invoice-price small {
    font-size: 12px;
    font-weight: 400;
    display: block
}

.invoice-price .invoice-price-row {
    display: table;
    float: left
}

.invoice-price .invoice-price-right {
    width: 25%;
    background: #2d353c;
    color: #fff;
    font-size: 28px;
    text-align: right;
    vertical-align: bottom;
    font-weight: 300
}

.invoice-price .invoice-price-right small {
    display: block;
    opacity: .6;
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 12px
}

.invoice-footer {
    border-top: 1px solid #ddd;
    padding-top: 10px;
    font-size: 10px
}

.invoice-note {
    color: #999;
    margin-top: 80px;
    font-size: 85%
}

.invoice>div:not(.invoice-footer) {
    margin-bottom: 20px
}

.btn.btn-white, .btn.btn-white.disabled, .btn.btn-white.disabled:focus, .btn.btn-white.disabled:hover, .btn.btn-white[disabled], .btn.btn-white[disabled]:focus, .btn.btn-white[disabled]:hover {
    color: #2d353c;
    background: #fff;
    border-color: #d9dfe3;
}
</style>
<script>
    //Create PDf from HTML...
function CreatePDFfromHTML() {
    var HTML_Width = $(".html-content").width();
    var HTML_Height = $(".html-content").height();
    var top_left_margin = 15;
    var PDF_Width = HTML_Width + (top_left_margin * 2);
    var PDF_Height = (PDF_Width * 1.5) + (top_left_margin * 2);
    var canvas_image_width = HTML_Width;
    var canvas_image_height = HTML_Height;

    var totalPDFPages = Math.ceil(HTML_Height / PDF_Height) - 1;

    html2canvas($(".html-content")[0]).then(function (canvas) {
        var imgData = canvas.toDataURL("image/jpeg", 1.0);
        var pdf = new jsPDF('p', 'pt', [PDF_Width, PDF_Height]);
        pdf.addImage(imgData, 'JPG', top_left_margin, top_left_margin, canvas_image_width, canvas_image_height);
        for (var i = 1; i <= totalPDFPages; i++) { 
            pdf.addPage(PDF_Width, PDF_Height);
            pdf.addImage(imgData, 'JPG', top_left_margin, -(PDF_Height*i)+(top_left_margin*4),canvas_image_width,canvas_image_height);
        }
        pdf.save("invoice.pdf");
        //$(".html-content").hide();
        //window.location.href='index.php';
    });
}
//window.print();
//CreatePDFfromHTML();
</script>