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
               <h5 class="card-title">Stock With Clients</h5>
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
               <form action="<?php echo base_url();?>Admin/Eshop_orders/returnStocks/<?php echo $product_id;?>/<?php echo $user_id;?>" method="post">
                <div class="table-responsive">
                <table class="table table--light style--two">
                   <thead>
                      <tr>
                         
                         <th>Sr.No</th>
                          <th>Member Name</th>
                         <th>Product</th>
                         <!--<th>Monthly Quantity</th>-->
                         <th>Stock Quantity</th>
                         <th>Return Quantity</th>
                         <th>Action</th>
                      </tr>
                   </thead>
                   <tbody>
                      <?php 
                      //pr($allstcoks);
                         if(!empty($allstcoks) && count($allstcoks)>0)
                         {
                            $sno=0;
                            foreach ($allstcoks as $order) 
                            {
                            $sno++;  
                            if($order->qty){$color='green';}
                            else
                            {
                                $color='red';
                            }
                            $d=get_user_details($order->stockist_id);
                         ?>
                            <tr style="color:<?php echo $color;?>">
                              <td><?php echo $sno;?></td>
                              <td><?php echo $d->first_name.' '.$d->last_name;?></td>
                              <td><?php echo $order->title;?></td>
                              <!--<td><?php echo $order->quantity;?></td>-->
                              <td><?php echo $order->qty;//echo $callfunc->getproductquantity($order->product_id);?></td>
                              <td><input type="text" name="return" onkeyup="checkquantity(this.value,<?php echo $order->qty;?>)" value="<?php echo $order->qty;?>"></input></td>
                              <td>
                                <button type="submit" name="returnbtn" id="returnbtn" value="returnbtn" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Return</button>
                              </td>
                              </tr>
                              <?php
                          }
                         ?>
                      
                      <?php    
                         
                         }
                         ?>
                   </tbody>
                </table>
                </div>
               </form>
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
function checkquantity(rqt,qt)
{
    console.log(rqt+'=='+qt);
    if(rqt>qt)
    {
        document.getElementById("returnbtn").disabled = true;
        return false;
    }
    else if(rqt<0)
    {
        document.getElementById("returnbtn").disabled = true;
        return false;
    }
    else if(rqt=='')
    {
        document.getElementById("returnbtn").disabled = true;
        return false;
    }
    else if(isNaN(rqt))
    {
        document.getElementById("returnbtn").disabled = true;
        return false;
    }
    else
    {
        document.getElementById("returnbtn").disabled = false;
        return true;
    }
}
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