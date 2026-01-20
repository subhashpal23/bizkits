        <!--Genealogy css and js start from here-->
        <!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>admin_assets/genealogy-css/font-awesome.min.css" media="all">

        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>admin_assets/genealogy-css/css_BHWeeI0xKIKe4u5vMgb6pFHD47mgvH8H-mu1Vaq-Lfg.css" media="all">
       
        <script type="text/javascript" src="<?php echo base_url();?>admin_assets/genealogy-js/jquery-tree-1.2.1.min.js"></script>
        
        <script type="text/javascript" src="<?php echo base_url();?>admin_assets/genealogy-js/genelogy_ajax_user_click_tree.js"></script>-->
        
        <link rel="stylesheet" href="<?php echo base_url();?>assets/custom.css">
        
      <!--Genealogy css and js end over here-->


<div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Network</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Network</li>
                    </ul>
                </div>
                <?php
                //pr($level2_info);
                ?>
                     <!--Genealogy tree start from here-->
                     <div class="row">
                    <div class="col-md-12">
                        <div class="genealogy-body" style="overflow: visible;">
   <div class="genealogy_tree_view_sec" style="overflow: hidden; user-select: none; touch-action: none;">
      <div class="genealogy-tree" id="tree-view-head" data-height="240px" style="cursor: move; user-select: none; touch-action: none; transform-origin: 50% 50%; transition: transform 200ms ease-in-out 0s; ">
         <ul class="node head" id="node" data-isnode="0">
            <li id="node-id-1">
               <a href="javascript:void(0)" class="node-element"><img onmouseover="myFunction('<?php echo $main_user_id;?>')" data-serialtip="example-1" id="node-img-1" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $main_username;?></span></a>
               <div class="popup" >
                      <span class="popuptext" id="<?php echo $main_user_id;?>">
                          Username:<?php echo $main_username;?><br>
                        
                          </span>
                    </div>
               <?php
               if(count($level1_info)>0)
               {
               ?>
               <ul>
                   <?php
                   foreach($level1_info as $key=>$val)
                   {
                   ?>
                  <li id="node-id-2">
                     <a href="javascript:void(0)" class="node-element"><img onmouseover="myFunction('<?php echo $val->user_id;?>')" data-serialtip="example-2" id="node-img-2" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $val->username;?></span></a>
                     <div class="popup" >
                      <span class="popuptext" id="<?php echo $val->user_id;?>">
                          Username:<?php echo $val->username;?><br>
                          MemberID:<?php echo $val->user_id;?><br>
                          Name:<?php echo $val->first_name;?>
                          </span>
                    </div>
                     <?php
                        $level2_info=$callfun->getlevelusers($val->user_id,1);
                       if(count($level2_info)>0)
                       {
                       ?>
                     <ul>
                         <?php
                           foreach($level2_info as $key2=>$val2)
                           {
                           ?>
                        <li id="node-id-4">
                           <a href="javascript:void(0)" class="node-element"><img onmouseover="myFunction('<?php echo $val2->user_id;?>')" data-serialtip="example-4" id="node-img-4" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $val2->username;?></span></a>
                           <div class="popup" >
                              <span class="popuptext" id="<?php echo $val2->user_id;?>">
                                  Username:<?php echo $val2->username;?><br>
                                  MemberID:<?php echo $val2->user_id;?><br>
                                  Name:<?php echo $val2->first_name;?>
                                  </span>
                            </div>
                           <?php
                           $level3_info=$callfun->getlevelusers($val2->user_id,1);
                           if(count($level3_info)>0)
                           {
                           ?>
                           <ul>
                               <?php
                               foreach($level3_info as $key3=>$val3)
                               {
                               ?>
                              <li id="node-id-5">
                                 <a href="javascript:void(0)" class="node-element"><img onmouseover="myFunction('<?php echo $val3->user_id;?>')" data-serialtip="example-5" id="node-img-5" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $val3->username;?></span></a>
                                 <div class="popup" >
                                  <span class="popuptext" id="<?php echo $val3->user_id;?>">
                                      Username:<?php echo $val3->username;?><br>
                                      MemberID:<?php echo $val3->user_id;?><br>
                                      Name:<?php echo $val3->first_name;?>
                                      </span>
                                </div>
                                 <?php
                                 $level4_info=$callfun->getlevelusers($val3->user_id,1);
                               if(count($level4_info)>0)
                               {
                               ?>
                                 <ul>
                                     <?php
                                   foreach($level4_info as $key4=>$val4)
                                   {
                                   ?>
                                    <li id="node-id-8">
                                       <a href="javascript:void(0)" class="node-element"><img onmouseover="myFunction('<?php echo $val4->user_id;?>')" data-serialtip="example-8" id="node-img-8" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $val4->username;?></span></a>
                                       <div class="popup" >
                                  <span class="popuptext" id="<?php echo $val3->user_id;?>">
                                      Username:<?php echo $val4->username;?><br>
                                      MemberID:<?php echo $val4->user_id;?><br>
                                      Name:<?php echo $val4->first_name;?>
                                      </span>
                                </div>
                                    </li>
                                    <?php
                                   }
                                    ?>
                                 </ul>
                                 <?php
                               }
                                 ?>
                              </li>
                             <?php 
                             }
                             ?> 
                           </ul>
                           <?php
                           }
                           ?>
                        </li>
                        <?php
                        }
                        ?>
                        <!--<li id="node-id-6">
                           <a href="javascript:void(0)" class="node-element"><img ondblclick="searchUser(6)" data-serialtip="example-6" id="node-img-6" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username ">INF75414044</span></a>
                           <ul>
                              <li><a href="<?php echo base_url();?>admin/register/INF75414044/1" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                           </ul>
                        </li>-->
                     </ul>
                     <?php
                       }
                     ?>
                  </li>
                  <?php
                   }
                  ?>
                  
               </ul>
               <?php
               }
               ?>
            </li>
         </ul>
      </div>
   </div>
</div>
                    </div>
                </div>
<style>
/* Popup container - can be anything you want */
.popup {
  position: relative;
  display: inline-block;
  cursor: pointer;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* The actual popup */
.popup .popuptext {
  visibility: hidden;
  width: 160px;
  background-color: #555;
  color: #fff;
  text-align: center;
  border-radius: 6px;
  padding: 8px 0;
  position: absolute;
  z-index: 1;
  bottom: 125%;
  left: 50%;
  margin-left: -80px;
}

/* Popup arrow */
.popup .popuptext::after {
  content: "";
  position: absolute;
  top: 100%;
  left: 50%;
  margin-left: -5px;
  border-width: 5px;
  border-style: solid;
  border-color: #555 transparent transparent transparent;
}

/* Toggle this class - hide and show the popup */
.popup .show {
  visibility: visible;
  -webkit-animation: fadeIn 1s;
  animation: fadeIn 1s;
}

/* Add animation (fade in the popup) */
@-webkit-keyframes fadeIn {
  from {opacity: 0;} 
  to {opacity: 1;}
}

@keyframes fadeIn {
  from {opacity: 0;}
  to {opacity:1 ;}
}
</style>
<script>
// When the user clicks on div, open the popup
function myFunction(id) {
  var popup = document.getElementById(id);
  popup.classList.toggle("show");
}
</script>