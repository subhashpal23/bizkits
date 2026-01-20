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
            <form action="<?php echo base_url();?>Admin/Eshop_orders/monthlyBill" method="post">
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <select name="user_id" class="form-control select2">
                                        <option value="">Select Client</option>
                                        <?php
                                        foreach($allusers as $key=>$val)
                                        {
                                            $sel='';
                                            if($_POST['user_id']==$val->user_id)
                                            {
                                                $sel='selected';
                                            }
                                            echo '<option value="'.$val->user_id.'" '.$sel.'>'.$val->first_name.' '.$val->last_name.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <?php
                                    $months
                                    ?>
                                    <select name="month" class="form-control select2">
                                        <option value="">Select Month</option>
                                        <?php
                                        for($i=1;$i<=12;$i++)
                                        {
                                            $sel='';
                                            if($_POST['month']==$i)
                                            {
                                                $sel='selected';
                                            }
                                            echo '<option value="'.$i.'" '.$sel.'>'.date("F", mktime(0, 0, 0, $i, 1)).'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <select name="year" class="form-control select2">
                                        <option value="">Select Year</option>
                                        <?php
                                        for($i=2025;$i>2000;$i--)
                                        {
                                            $sel='';
                                            if($_POST['year']==$i)
                                            {
                                                $sel='selected';
                                            }
                                            echo '<option value="'.$i.'" '.$sel.'>'.$i.'</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button type="submit" name="search" value="search" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Generate Bill</button>
                                    
                                </div>
                            </div>
                        </form>
            <div class="card-heading">
                <?php if($_POST['user_id']!='' && $_POST['month']!='' && $_POST['year']!='')
                {?>
                <a style="float:right" href="<?php echo base_url();?>Admin/Eshop_orders/printBill/<?php echo $_POST['user_id'];?>/<?php echo $_POST['month'];?>/<?php echo $_POST['year'];?>"><i class="fa fa-print"></i>Print Bill</a>
              <?php
                }
              ?>
               <h5 class="card-title">Monthly Bills</h5>
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
                      <th>Member Name</th>
                      <th>Invoice No</th>
                     <th>Amount</th>
                     <th>Discount</th>
                     <th>Tax</th>
                     <!--<th>Monthly Quantity</th>-->
                     <th>Total</th>
                     <th>Order/Return Date</th>
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  //pr($allstcoks);
                     if(!empty($trasfered) && count($trasfered)>0)
                     {
                        $sno=0;
                        foreach ($trasfered as $order) 
                        {
                        $sno++;  
                        if($order->qty){$color='green';}
                        else
                        {
                            $color='red';
                        }
                        $d=get_user_details($order->user_id);
                        $total=$order->final_pv+$order->final_price-$order->discount;
                        $dtotal=$dtotal+$total;
                     ?>
                  <tr style="color:green">
                    
                          <td><?php echo $sno;?></td>
                           <td><?php echo $d->first_name.' '.$d->last_name;?></td>
                           <td><?php echo $order->order_id;?></td>
                     <td><?php echo currency().$order->final_price;?></td>
                     <td><?php echo currency().$order->discount;?></td>
                     <td><?php echo currency().$order->final_pv;?></td>
                     <td><?php echo currency().$total;?></td>
                     <td><?php echo $order->order_date;?></td>
                  </tr>
                  <?php    
                        }
                        ?>
                         <tr style="color:green;font-size:14px; font-weight:800">
                    
                          <td colspan="6">Total</td>
                     <td><?php echo currency().$dtotal;?></td>
                     <td>&nbsp;</td>
                     
                  </tr>
                        <?php
                     
                     }
                     ?>
                     <?php 
                  //pr($allstcoks);
                     if(!empty($returned) && count($returned)>0)
                     {
                        $sno=0;
                        foreach ($returned as $order) 
                        {
                        $sno++;  
                        
                        $d=get_user_details($order->user_id);
                        $total=$order->final_pv+$order->final_price-$order->discount;
                        $rtotal=$rtotal+$total;
                     ?>
                  <tr style="color:red;">
                    
                          <td><?php echo $sno;?></td>
                           <td><?php echo $d->first_name.' '.$d->last_name;?></td>
                           <td><?php echo $order->order_id;?></td>
                     <td><?php echo currency().$order->final_price;?></td>
                     <td><?php echo currency().$order->discount;?></td>
                     <td><?php echo currency().$order->final_pv;?></td>
                     <td><?php echo currency().($total);?></td>
                     <td><?php echo $order->order_date;?></td>
                  </tr>
                  <?php    
                        }
                     ?>
                     <tr style="color:red;font-size:14px; font-weight:800">
                    
                          <td colspan="6">Total</td>
                     <td><?php echo currency().$rtotal;?></td>
                     <td>&nbsp;</td>
                  </tr>
                     <?php
                     }
                     ?>
               </tbody>
               <tfoot>
                   <tr style="color:green; font-size:14px; font-weight:800">
                    
                          <td colspan="6">Total Bill</td>
                     <td><?php echo currency().($dtotal-$rtotal);?></td>
                     <td>&nbsp;</td>
                  </tr>
               </tfoot>
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