<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Eshop</span> - Product Stocks</h4>
         </div>
         <div class="heading-elements">
            <div class="heading-elements">
            <div class="heading-btn-group">
            </div>
                     </div>
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url();?>admin"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">Eshop</a></li>
            <li class="active">Stock</li>
         </ul>
         
      </div>
   </div>
   <!-- /page header -->
   <!-- Content area -->
   <div class="content">
      <!-- Daterange picker -->
      <!-- /daterange picker -->
      <div class="row">
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
		 <div class="panel panel-flat">
            
            <div class="panel-heading">

               <h5 class="panel-title"><?php echo $stockist_detail->username.'('.$stockist_detail->name.')';?></h5>
              
               <div class="heading-elements">
                  <ul class="icons-list">
                     <li><a data-action="collapse"></a></li>
                     <li><a data-action="reload"></a></li>
                     <li><a data-action="close"></a></li>
                  </ul>
               </div>
            </div>
             
            <table class="table datatable-responsive table-bordered table-striped table-hover">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th>Title</th>	
					 <th>SKU</th>	
                     <th>Image</th>
					 <th>Quantity</th>
					 <th>Web Qty</th>
					 <th>Stickist Qty</th>
					 <th>Tax(%)</th>
                     <th>Price</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_products) && count($all_products)>0)
                  {
                     $sno=0;
                     foreach ($all_products as $prod) 
                     {
                     $sno++;  
                     $active_status_class=($prod['status']=='1')?'label-success':'label-danger';
                     $active_status_label=($prod['status']=='1')?'Active':'Inactive';
					 $products=	$controller_name->getProduct($prod['id']);	
					 $stockistdetail=$controller_name->getStockistQty($prod['id'],$stockist_id);
					 //print_r($stockistdetail);
                  ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $products->title;?></td>
                     <td><?php echo $products->sku;?></td>
                     <td><img src="<?php echo base_url(); ?>product_images/<?php echo $products->product_image;?>" width='50' /></td>
					 
					 <td><?php //echo $prod['qty'];?>
					 <input type="readonly" id="qty_<?php echo $prod['id'];?>" value="<?php echo $prod['qty'];?>" style="width:50px; border:0px;">
					 
					 </td>
					 <td><?php echo $prod['assign_web'];?>
					 <input type="hidden" id="assign_web_<?php echo $prod['id'];?>" value="<?php echo $prod['assign_web'];?>">
					 <input type="hidden" id="assign_stockist_old_<?php echo $prod['id'];?>" value="<?php echo $stockistdetail->qty;?>">
					 </td>
					 <td>
					      <span id="showstockistqty_<?php echo $prod['id'];?>"><?php echo $stockistdetail->qty;?></span>
					      <input type="text" name="assign_stockist_<?php echo $prod['id'];?>" id="assign_stockist_<?php echo $prod['id'];?>" value="0" style="width:50px">
					 <a href="javascript:updateqty('assign_stockist','<?php echo $prod['id'];?>');"><i class="icon-pencil7" aria-hidden="true"></i></a>
					 </td>
					 <td>
					      
					      <input type="text" name="tax_stockist_<?php echo $prod['id'];?>" id="tax_stockist_<?php echo $prod['id'];?>" value="<?php echo $stockistdetail->taxper;?>" style="width:50px">
					 <a href="javascript:updatetax('tax_stockist_','<?php echo $prod['id'];?>');"><i class="icon-pencil7" aria-hidden="true"></i></a>
					 </td>
                     <td><?php echo currency().$products->new_price;?></td>
                    
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
<script>
function updatetax(type,id)
{
    var stockist_id='<?php echo $stockist_id;?>';
    var tax_stockist=$("#tax_stockist_"+id).val();
    jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>admin/stockist/setAjaxStockistTax',
				  data:{'tax_stockist':tax_stockist,'stockist_id':stockist_id,'type':type,'id':id},
                  async:false,
                  beforeSend: function () {
                       $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
				  success:function(d){
				      //alert(d);
				      var res = JSON.parse(d);
				      alert(res.msg);
				      $("#tax_stockist"+id).val(tax_stockist);
				      
                  },//end success
                  complete: function () 
                  {
                     $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                  }
             });//end ajax
}
function updateqty(type,id)
{
    var qty=$("#qty_"+id).val();
    var assign_web=$("#assign_web_"+id).val();
    var assign_stockist=$("#assign_stockist_"+id).val();
    var assign_stockist_old=$("#assign_stockist_old_"+id).val();
    var stockist_id='<?php echo $stockist_id;?>';
    //alert(qty+'--'+stockist_id+'--'+id);
	    jQuery.ajax({
                  type:'POST',
                  url:'<?php echo site_url();?>admin/stockist/setAjaxStockistAll',
				  data:{'qty':qty,'assign_web':assign_web,'assign_stockist':assign_stockist,'assign_stockist_old':assign_stockist_old,'stockist_id':stockist_id,'type':type,'id':id},
                  async:false,
                  beforeSend: function () {
                       $.loader("on", '<?php echo site_url();?>admin_assets/images/default.svg');
                     },
				  success:function(d){
				      //alert(d);
				      var res = JSON.parse(d);
				      alert(res.msg);
				      if(res.status=='success')
				      {
				          $("#qty_"+id).val(res.qty);
                          $("#assign_stockist_"+id).val(res.assign_stockist);
                          $("#assign_stockist_old_"+id).val(res.assign_stockist_old);
                          $("#showstockistqty_"+id).html(res.assign_stockist_old);
				      }
				      else
				      {
				          $("#qty_"+id).val(qty);
                          $("#assign_stockist_"+id).val(assign_stockist);
				      }
				      
                  },//end success
                  complete: function () 
                  {
                     $.loader("off", '<?php echo site_url();?>admin_assets/images/default.svg');
                  }
             });//end ajax
}
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