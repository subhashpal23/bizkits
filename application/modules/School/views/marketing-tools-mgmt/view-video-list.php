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
                                <a href="<?php echo ci_site_url();?>School/MarketingTools/addMarketingVideo" class="btn btn-success"><i class="icon-comment-discussion position-left"></i>Add Marketing Video</a>
                            </div>
                            
                        </div>
                        
         <div class="table-responsive">
                            <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer"><table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0" role="grid">
                               
            <thead>
               <tr>
                  <th>S.No</th>
                  <th>Name</th>
                  <th>Status</th>
                  <th>Date</th>
                  <th class="text-center">Actions</th>
               </tr>
            </thead>
            <tbody>
               <?php 
               if(!empty($all_videos) && count($all_videos)>0)
               {
                  $sno=0;
                  foreach ($all_videos as $video) 
                  {
                    $sno++; 
                    $status_label=($video->status=='0')?'Unpublished':'Published';
                    $status_label_class=($video->status=='0')?'label-danger':'label-success';
               ?>
               <tr>
                  <!--<td><input type="checkbox" class="styled"></td>-->
                  <td><?php echo $sno;?></td>
                  <td><a href="#"><?php echo $video->title;?></a></td>
                  <td><span class="label <?php echo $status_label_class;?>"><?php echo $status_label;?></span></td>
                  <td><?php echo date(date_formats(),strtotime($video->create_date));?></td>
                  <td class="text-center">
                     <?php 
                              if($video->status=='0')
                              {
                              ?>
                              <a title="click to Publish" href="<?php echo ci_site_url();?>School/MarketingTools/changeVideoStatus/<?php echo ID_encode($video->id);?>/1"><i class="icon-eye"></i> Publish</a>
                              <?php    
                              }
                              else 
                              {
                              ?>
                              <a title="click to Unpublish" href="<?php echo ci_site_url();?>School/MarketingTools/changeVideoStatus/<?php echo ID_encode($video->id);?>/0"><i class="icon-eye-blocked"></i> Unpublished</a>
                              <?php    
                              }
                              ?>&nbsp;&nbsp;
                              <a href="<?php echo ci_site_url();?>School/MarketingTools/deleteVideo/<?php echo ID_encode($video->id);?>"><i class="fa fa-trash"></i></a>
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