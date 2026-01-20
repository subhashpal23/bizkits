   <style>
        #fileInput {
            display: none;
        }
        .import-btn {
            /*padding: 10px 15px;*/
            background-color: #007bff;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 15px;
            border-radius: 5px;
        }
        .import-btn:hover {
            background-color: #0056b3;
        }
        .error p{
            color: red;
        }
   </style>
   <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Products Dashboard</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>">Home</a>
                        </li>
                        <li>Products</li>
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
                    <?php if ($this->session->flashdata('success')): ?>
                        <p style="color: green;"><?php echo $this->session->flashdata('success'); ?></p>
                    <?php endif; ?>
                    <?php if ($this->session->flashdata('error')): ?>
                        <div class="error"><?php echo $this->session->flashdata('error'); ?></div>
                    <?php endif; ?>
                <!--<div style="float: right; margin-left: 10px;">-->
                <!--    <button class="import-btn" onclick="document.getElementById('fileInput').click();">Import Product</button>-->
                <!--    <form action="<?php echo base_url('Admin/Eshop/uploadCSV'); ?>" method="post" enctype="multipart/form-data">-->
                <!--        <input type="file" id="fileInput" name="csv_file" onchange="this.form.submit();">-->
                <!--    </form>-->
                <!--</div>-->
                <a href="<?php echo site_url().$module_name;?>/Eshop/addNewProduct" style="float:right"><i class="fa fa-plus"></i> Add New</a>
               <h5 class="card-title">View All Product</h5>
             
            </div>
            
            <!-- Keep it hidden -->
            <button id="delete_selected" class="btn btn-danger" style="display:none;">
                Delete Selected
            </button>



             
            <table class="table datatable-responsive table-bordered table-striped table-hover">
               <thead>
                  <tr>
                      <th><input type="checkbox" id="selectAll"></th>
                     <th>Sr.No</th>
					 <th>Product/Service Name</th>	
					 <th>Basic</th>
					 <th>Pro</th>
					 <th>Enterprices</th>
                     <th>Image</th>
					 <!--<th>Discount</th>-->
                     <th>Status</th>
                     <th>Date</th>
                     <th>Action</th>
                     <!--<th>View</th>-->
                  </tr>
               </thead>
               <tbody>
                  <?php 
                  if(!empty($all_products) && count($all_products)>0)
                  {
                     $sno=0;
                     $currency=currency();
                     foreach ($all_products as $prod) 
                     {
                     $sno++;  
                     $active_status_class=($prod['status']=='1')?'label-success':'label-danger';
                     $active_status_label=($prod['status']=='1')?'Active':'Inactive';
					 				   
                  ?>
                  <tr>
                      <td><input type="checkbox" class="product_checkbox" name="product_ids[]" value="<?php echo $prod['id']; ?>"></td>
                     <td><?php echo $sno;?></td>
                     <td><?php echo $prod['title'];?></td>
                     <td><?php echo $currency.$prod['price1'];?></td>
                     <td><?php echo $currency.$prod['price2'];?></td>
                     <td><?php echo $currency.$prod['price3'];?></td>
                     
                     <td><img src="<?php echo base_url(); ?>product_images/<?php echo $prod['product_image'];?>" width='50' /></td>
					 <!--<td><?php echo $prod['qty'];?></td>-->
					 
					 <!--<td><?php echo $currency;					 if($prod['discount_per']=='per'){echo ($prod['new_price']*$prod['discount'])/100;} else{ echo $prod['discount'];}?></td>-->
					 <td><span class="label <?php echo $active_status_class;?>"><?php echo $active_status_label;?></span></td>
                     <td><?php echo $prod['created_date'];?></td>
                     <td>
                        
                              <a href="<?php echo site_url().$module_name;?>/Eshop/editProduct/<?php echo ID_encode($prod['id']);?>" data-popup="tooltip" title="Edit Product" data-original-title=""><i class="fa fa-edit"></i></a>
                           
                              <a onclick='return confirm("Are you sure?");' href="<?php echo site_url().$module_name;?>/Eshop/deleteProduct/<?php echo ID_encode($prod['id']);?>" data-popup="tooltip" title="Delete Product" data-original-title=""><i class="fa fa-trash"></i></a>
                         
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

</script>
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>

<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.flash.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>
 <script>
// jQuery(document).ready(function($) {
//     $('.datatable-responsive').DataTable({
//         "pageLength": 10, // Number of entries per page
//         "order": [[ 0, "asc" ]], // Default sorting
//         responsive: true,
//     });
// });
 </script>
<script>
jQuery(document).ready(function($) {
    $('.datatable-responsive').DataTable({
        "pageLength": 10,
        "order": [[ 1, "asc" ]],
         "columnDefs": [
            { "orderable": false, "targets": 0 } // Disable sorting on 0th column (checkbox)
        ],
        responsive: true,
        language: {
            search: "", // Removes the "Search:" label
            searchPlaceholder: "Search..." // Optional: adds a placeholder inside the input box
        },
        dom: '<"row align-items-center mb-2"<"col-md-6"l><"col-md-4 text-right"B><"col-md-2"f>>rtip',
        buttons: [
            {
                text: '<i class="fa fa-trash"></i> Delete Selected',
                className: 'btn btn-danger',
                action: function ( e, dt, node, config ) {
                    // Trigger click of the original delete button
                    $("#delete_selected").click();
                }
            }
        ]
    });
});
</script>

<script>
$(document).ready(function() {

    // Select All
    $("#selectAll").click(function(){
        $('.product_checkbox').prop('checked', $(this).prop('checked'));
    });

    // Delete selected
    $("#delete_selected").click(function(){
        var ids = [];
        $(".product_checkbox:checked").each(function(){
            ids.push($(this).val());
        });

        if(ids.length == 0){
            alert("Please select at least one product to delete.");
            return;
        }

        if(confirm("Are you sure you want to delete selected products?")){
            $.ajax({
                url: "<?php echo site_url().$module_name;?>/Eshop/multipleDeleteProducts",
                type: "POST",
                data: { ids: ids },
                success: function(response){
                    location.reload();
                }
            });
        }
    });
});
</script>

