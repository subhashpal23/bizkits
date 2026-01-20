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
            <div class="table-responsive">
            <table class="table table--light style--two">
               <thead>
                  <tr>
                     
                     <th>Sr.No</th>
                     <th>Date</th>
                     <th>Stock Quantity</th>
                     
                  </tr>
               </thead>
               <tbody>
                  <?php 
                     if(!empty($allstcoks) && count($allstcoks)>0)
                     {
                        $sno=0;
                        foreach ($allstcoks as $order) 
                        {
                        
                        $arr[$order->monthdate]=$order->order_details;
                        }
                     }
                     foreach($arr as $order)
                     {
                         $sno++;  
                     ?>
                  <tr style="color:<?php echo $color;?>">
                    
                          <td><?php echo $sno;?></td>
                     <td><?php echo $order->monthdate;?></td>
                     <td><?php echo $order->order_details;?></td>
                     
                          
                  </tr>
                 <?php
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