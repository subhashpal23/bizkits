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
            <form action="<?php echo base_url();?>Admin/Eshop_orders/allStocks" method="post">
                            
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
                                    <button type="submit" name="search" value="search" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Search</button>
                                </div>
                            </div>
                        </form>
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
            <div class="table-responsive">
            <table class="table table--light style--two">
               <thead>
                  <tr>
                     
                     <th>Sr.No</th>
                      <th>Member Name</th>
                     <th>Product</th>
                     <!--<th>Monthly Quantity</th>-->
                     <th>Stock Quantity</th>
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
                     
                    <td><?php $tstock=$callfunc->getproductquantity($order->id,$order->stockist_id);echo ($tstock)?$tstock:0;?></td>
                    <td><a href="<?php echo site_url();?>Admin/Eshop_orders/allStockHistory/<?php echo $order->id;?>/<?php echo $order->stockist_id;?>"><i class="fa fa-eye"></i></a>
                    &nbsp;&nbsp;
                    <?php
                    $diff=strtotime(date($_POST['year'].'-'.$_POST['month'].'-t'))-time();
                    if($diff>0)
                    {
                    ?>
                    <a href="<?php echo site_url();?>Admin/Eshop_orders/stockReturn/<?php echo $order->id;?>/<?php echo $order->stockist_id;?>"><i class="fa fa-reply"></i></a></td>
                          <?php
                    }
                      }
                     ?>
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