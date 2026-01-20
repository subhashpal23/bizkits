<!-- Main content -->
<div class="content-wrapper">
   <!-- Page header -->
   <div class="page-header page-header-default">
      <div class="page-header-content">
         <div class="page-title">
            <h4><i class="icon-arrow-left52 position-left"></i> <span class="text-semibold">Eshop</span> - BV</h4>
         </div>
         <div class="heading-elements">
         </div>
      </div>
      <div class="breadcrumb-line">
         <ul class="breadcrumb">
            <li><a href="<?php echo site_url().$module_name;?>"><i class="icon-home2 position-left"></i> Home</a></li>
            <li><a href="#">BV</a></li>
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
                <select name="level" id="level" onchange="showlistlevel(this.value)">
                   <?php
                   echo "<option value='All'>All Level</option>";
                   echo "<option value='0'>Self</option>";
                   for($i=1;$i<=100;$i++)
                   {
                       if($i==$level)
                       {
                           $sel="selected";
                       }
                       else
                       {
                           $sel="";
                       }
                       echo "<option value='".$i."' ".$sel."> Level ".$i."</option>";
                   }
                   ?>
                </select>
                  
                <select name="month" id='month' onchange="showlistmonth(this.value)">
                   <?php
                   echo "<option value='All'>All Month</option>";
                   $arr=array('','Jan','Feb','March','April','May','June','July','Aug','Sept','Oct','Nov','Dec');
                   for($i=1;$i<=12;$i++)
                   {
                       if($i==$month)
                       {
                           $sel="selected";
                       }
                       else
                       {
                           $sel="";
                       }
                       echo "<option value='".$i."' ".$sel.">".$arr[$i]."</option>";
                   }
                   ?>
                </select>
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
            <table class="table datatable-responsive table-bordered table-striped table-hover" id="preview_info_body">
               <thead>
                  <tr>
                     <th>Sr.No</th>
                     <th>Down Member</th>
                     <th>Member</th>
                     <th>Level</th>
                     <th>BV</th>
                     <th>Date</th>
                     <th>Status</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     if(!empty($all_orders) && count($all_orders)>0)
                     {
                        $sno=0;
                        $pv=0;
                        foreach ($all_orders as $order) 
                        {
                        $sno++;  
                        
                     if($order->status=='0')
                     {
                     $status='Pending';
                     $color='red';
                     }
                     else if($order->status=='1')
                     {
                     $status='Confirmed';
                     $color='green';
                     }
                     else if($order->status=='2')
                     {
                     $status='Rejected';
                     $color='orange';
                     }
                     else if($order->status=='3')
                     {
                     $status='Delivered';
                     $color='blue';
                     }
                     $buyer_type=($order->role=='2')?'MLM MEMBER':'GUEST';
                     //////////
                     $buyer_user_id=($order->role=='2')?$order->income_id:$order->guest_id;
                       
                     $buyer_details=($order->role=='2')?eshop_get_user_details(
                     $buyer_user_id):eshop_get_guest_details($buyer_user_id);
                     
                     $pv=$pv+$order->pv;
                     ?>
                  <tr>
                     <td><?php echo $sno;?></td>
                     <td><?php echo get_user_name($order->down_id);?></td>
                     <td><?php echo get_user_name($order->income_id);?></td>
                     <td><?php echo $order->level;?></td>
                     <td><?php echo $order->pv;?></td>
                     <td><?php echo $order->l_date;?></td>
                     <td><span style='color:white;padding: 9px;border-radius: 10px;background-color:<?php echo $color; ?>'><?php echo $status;?></span></td>
                    
                  </tr>
                  <?php    
                     }
                     }
                     ?>
               </tbody>
               <tfooter>
                   <tr>
                       <td colspan="4">Total BV</td>
                       <td colspan="3"><?php echo $pv;?></td>
                   </tr>
               </tfooter>
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
            <h6 class="modal-title" >Order No: <b></b</h6>
         </div>
         <div class="modal-body" >
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
function showlistlevel(str)
{
    var month=$("#month").val();
    var level=str;
    window.location.href='<?php echo site_url();?>'+'user/eshop_orders/getBVList/'+month+'/'+level;
}

function showlistmonth(str)
{
    var level=$("#level").val();
    var month=str;
    window.location.href='<?php echo site_url();?>'+'user/eshop_orders/getBVList/'+month+'/'+level;
}

$(document).ready(function(){
   $(".view_order_details").click(function(){
	    var order_id=$(this).attr('order_id');
	    jQuery.ajax({
              type:'post',
              url:'<?php echo site_url();?>user/eshop_orders/getOrderDetails/',
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
   });
});
   
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