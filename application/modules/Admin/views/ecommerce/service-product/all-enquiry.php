   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Service Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Service</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
   <div class="content">
      <!-- Daterange picker -->
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
      <!-- /daterange picker -->
      <div class="row">
         
		 <div class="card card-body">
            
            <div class="card-heading">

               <h5 class="card-title">View All Enquiry</h5>
             
            </div>
             
            <table class="table datatable-responsive table-bordered table-striped table-hover">
               <thead>
                  <tr>
                     <th>Sr.No</th>
					 <th>Service Name</th>	
                     <th>Customer Name</th>
                     <th>Customer Email Id</th>
                     <th>Customer Phone</th>
                     <th>Customer Message</th>
					 <th>Seen Status</th>
                     <th>Date</th>
                     <!--<th>Action</th>-->
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
                     $active_status_class=($prod['seen']=='1')?'label-success':'label-danger';
                     $active_status_label=($prod['seen']=='1')?'Seen':'Un-seen';
					 				   
                  ?>
                  <tr data-id="<?php echo $prod['id']; ?>" class="enquiry-row">
                     <td><?php echo $sno;?></td>
                     <td><?php echo $prod['service_name'];?></td>
                     <td><?php echo $prod['name'];?></td>
                     <td><?php echo $prod['email'];?></td>
                     <td><?php echo $prod['phone'];?></td>
                     <td><?php echo $prod['message'];?></td>
                     
                     
					 
					 
					 <td><span class="label <?php echo $active_status_class;?>"><?php echo $active_status_label;?></span></td>
                     <td><?php echo $prod['created_at'];?></td>
                     <td>
                        <ul class="icons-list">
                          
						   <!--
						   <li>
                              <a onclick='return confirm("Are you sure?");' href="<?php echo site_url().$module_name;?>/eshop/deleteProduct/<?php echo ID_encode($prod['id']);?>" data-popup="tooltip" title="" data-original-title="Delete Product"><i class="icon-trash"></i></a>
                           </li>
						   -->
                           
                        </ul>
                     </td>
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
      <?php //$this->load->view('common/footer-text') ?>
      <!-- /footer -->
   </div>
   <!-- /content area -->
</div>
<!-- /main content -->
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

    document.addEventListener("DOMContentLoaded", function () {
        // Select all rows with the "enquiry-row" class
        const rows = document.querySelectorAll(".enquiry-row");

        rows.forEach(function (row) {
            row.addEventListener("click", function () {
                const enquiryId = this.getAttribute("data-id");

                // Send AJAX request to update the "seen" status
                fetch("<?php echo site_url($module_name . '/ServiceProduct/updateSeenStatus'); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-Requested-With": "XMLHttpRequest", // For CodeIgniter to detect as AJAX
                    },
                    body: JSON.stringify({ id: enquiryId }),
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            // Update the "Seen" label in the clicked row
                            const label = this.querySelector("span.label");
                            label.classList.remove("label-danger");
                            label.classList.add("label-success");
                            label.textContent = "Seen";
                        } else {
                            alert("Failed to update status.");
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            });
        });
    });

</script>
<style>
    span.label.label-danger {
    color: green;
}
</style>
