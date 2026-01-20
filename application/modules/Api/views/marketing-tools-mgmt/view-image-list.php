<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Marketing Tools</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Marketing Tools</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <?php 
               if(!empty($this->session->flashdata('flash_msg')))
               {
               ?>
            <div class="alert alert-success alert-styled-right alert-arrow-right alert-bordered">
               <button type="button" class="close" data-dismiss="alert"><span>×</span><span class="sr-only">Close</span></button>
               <!--
                  <span class="text-semibold">Well done!</span> Amount Added Successfully in User Wallet
                  -->
               <?php 
                  echo $this->session->flashdata('flash_msg');
                  ?>
            </div>
            <?php    
               }
            ?>
                <div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Marketing Tool</h3>
                                <a href="<?php echo ci_site_url();?>Affiliate/MarketingTools/addMarketingImage/" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add Marketing Image</a>
                            </div>
                            
                        </div>
                        <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                                <thead>
                                    <tr>
                  <!--<th><input type="checkbox" class="styled"></th>-->
                  <th>S.No</th>
                  <th>Preview</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th class="text-center">Actions</th>
               </tr>
                                </thead>
                                <tbody>
                                 <?php
                                 //print_r($all_images);
               if(!empty($all_images) && count($all_images)>0)
               {
                  $sno=0;
                  foreach($all_images as $image) 
                  {
                    $sno++; 
                    $status_label=($image->status=='0')?'Unpublished':'Published';
                    $status_label_class=($image->status=='0')?'label-danger':'label-success';
               ?>
               <tr>
                  <!--<td><input type="checkbox" class="styled"></td>-->
                  <td><?php echo $sno;?></td>
                  <td>
                     <img src="<?php echo base_url();?>images/<?php echo $image->image_path;?>" alt="" class="img-rounded img-preview" style="width:100px">
                    
                  </td>
                  <td><a href="#"><?php echo $image->title;?></a></td>
                  <td><span class="label <?php echo $status_label_class;?>"><?php echo $status_label;?></span></td>
                  <td><?php echo date(date_formats(),strtotime($image->create_date));?></td>
                  <td class="text-center">
                     <?php 
                              if($image->status=='0')
                              {
                              ?>
                              <a title="click to Publish" href="<?php echo ci_site_url();?>Affiliate/MarketingTools/changeStatus/<?php echo ID_encode($image->id);?>/1"><i class="icon-eye"></i> Publish</a>
                              <?php    
                              }
                              else 
                              {
                              ?>
                              <a title="click to Unpublish" href="<?php echo ci_site_url();?>Affiliate/MarketingTools/changeStatus/<?php echo ID_encode($image->id);?>/0"><i class="icon-eye-blocked"></i> Unpublished</a>
                              <?php    
                              }
                              ?>
                              &nbsp;&nbsp;
                              <a href="<?php echo ci_site_url();?>Affiliate/MarketingTools/deleteImage/<?php echo ID_encode($image->id);?>"><i class="fa fa-trash"></i></a>
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
                         
                      
                    </div>
                </div>
                

<script>
   function deleteConfirm()
   {
   
      if(window.confirm("Are you sure, you want to delete"))
       return true;
     else 
       return false;
   }
</script>
<!-- Main content -->

<!-- /content wrapper -->

