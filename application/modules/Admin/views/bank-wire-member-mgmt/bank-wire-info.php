<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Admin Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Admin</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                <div class="row gutters-20">
                <div class="content">
      <div class="card card-body">
         <div class="card-heading">
            <h5 class="card-title">Bank Wire Details</h5>
            <h3 style="color:green"><?php echo $this->session->flashdata('flash_msg');?></h3>
            <div class="heading-elements">
               <ul class="icons-list">
                  <li><a data-action="collapse"></a></li>
                  <li><a data-action="reload"></a></li>
                  <li><a data-action="close"></a></li>
               </ul>
            </div>
         </div>
         <table class="table">
            <thead>
               <tr>
                  <th>SNo.</th>
                  <th>Acccount Holder Name</th>
                  <th>Account No</th>
                  <th>Bank Name</th>
                  <th>Branch Name</th>
				  <th>Branch Code</th>
                  <th>Action</th>
               </tr>
            </thead>
            <?php 
               //$bank_name=(!empty($bank_wire_payment_details->bank_name))?$bank_wire_payment_details->bank_name:'--';
               //$account_name=(!empty($bank_wire_payment_details->account_name))?$bank_wire_payment_details->account_name:'--';
               //$account_no=(!empty($bank_wire_payment_details->account_no))?$bank_wire_payment_details->account_no:'--';
               ?>
            <tbody>
               <?php 
               if(!empty($bank_wire_payment_details) && count($bank_wire_payment_details)>0)
               {
                  $sno=0;
                  foreach ($bank_wire_payment_details as $details) 
                  {
                     $sno++;
               ?>
               <tr>
                  <td><?php echo $sno;?></td>
                  <td><?php echo $details->account_holder_name;?></td>
                  <td><?php echo $details->account_no;?></td>
                  <td><?php echo $details->bank_name;?></td>
                  <td><?php echo $details->branch_name;?></td>
				   <td><?php echo $details->branch_code;?></td>
                  <td>
                     <a href="<?php echo ci_site_url();?>Admin/BankWireMemberReport/editBankWirePaymentDetails/<?php echo ID_encode($details->id);?>">Edit</a>
                     &nbsp;&nbsp;&nbsp;

                  </td>
                  </td>
               </tr>
               <?php       
                  }
               }
               ?>
            </tbody>
         </table>
      </div>
      <!-- Footer -->
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
               <!-- /content area -->
            </div>
<script>
function editConfirm()
  {
    if(window.confirm("Are you sure, you want to edit bank wire details"))
      return true;
    else 
      return false;
  }
</script>            