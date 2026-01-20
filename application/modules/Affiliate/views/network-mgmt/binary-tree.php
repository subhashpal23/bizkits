        <!--Genealogy css and js start from here-->
        <!--<link type="text/css" rel="stylesheet" href="<?php echo base_url();?>admin_assets/genealogy-css/font-awesome.min.css" media="all">

        <link type="text/css" rel="stylesheet" href="<?php echo base_url();?>admin_assets/genealogy-css/css_BHWeeI0xKIKe4u5vMgb6pFHD47mgvH8H-mu1Vaq-Lfg.css" media="all">
       
        <script type="text/javascript" src="<?php echo base_url();?>admin_assets/genealogy-js/jquery-tree-1.2.1.min.js"></script>
        
        <script type="text/javascript" src="<?php echo base_url();?>admin_assets/genealogy-js/genelogy_ajax_user_click_tree.js"></script>-->
        
        <link rel="stylesheet" href="<?php echo base_url();?>assets/custom.css">
        
      <!--Genealogy css and js end over here-->

               <div class="content col-md-8">
                  
                  <!-- Wizard with validation -->
                  <div class="panel panel-white">
                     <div class="panel-heading">
                        <h6 class="panel-title">Genealogy</h6>
						
                        
                     </div>
                     <!--Genealogy tree start from here-->
                     <div class="row">
                    <div class="col-md-12">
                        <div class="genealogy-body" style="overflow: scroll !important;">
   <div class="genealogy_tree_view_sec" style="overflow: hidden; user-select: none; touch-action: none;">
      <div class="genealogy-tree" id="tree-view-head" data-height="240px" style="cursor: move; user-select: none; touch-action: none; transform-origin: 50% 50%; transition: transform 200ms ease-in-out 0s;overflow: scroll; ">
         <ul class="node head" id="node" data-isnode="0">
            <li id="node-id-1">
               <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img onmouseover="myFunction('<?php echo $user_details->user_id;?>')" onmouseout="myFunction1('<?php echo $user_details->user_id;?>')" data-serialtip="example-1" id="node-img-1" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $user_details->username;?></span></a>
                    <div class="popup" >
                      <span class="popuptext" id="<?php echo $referal_id=$user_details->user_id;?>">
                          Username:<?php echo $user_details->username;?><br>
                          MemberID:<?php echo $user_details->user_id;?><br>
                          Name:<?php echo $user_details->username;?>
                          </span>
                    </div>
               <ul>
                   <?php
                   if(count($binarylistleft)>0)
                   {
                       foreach($binarylistleft as $key=>$val)
                       {
                           $user_details=get_user_details($val->down_id);
                           
                           $userlist=$callfun->getleveltree($val->down_id,'left');
                       ?>
                        <li id="node-id-2">
                         <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img onmouseover="myFunction('<?php echo $user_details->user_id;?>')" onmouseout="myFunction1('<?php echo $user_details->user_id;?>')" data-serialtip="example-2" id="node-img-2" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $user_details->username;?></span></a>
                            <div class="popup" >
                              <span class="popuptext" id="<?php echo $user_details->user_id;?>">
                                  Username:<?php echo $user_details->username;?><br>
                                  MemberID:<?php echo $user_details->user_id;?><br>
                                  Name:<?php echo $user_details->first_name;?>
                                  </span>
                            </div>
                            
                            <ul>
                                <?php
                                if(count($userlist)>0)
                                {
                                foreach($userlist as $key1=>$val1)
                                {
                                    $user_details=get_user_details($val1->down_id);
                                ?>
                                <li id="node-id-4">
                                   <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img onmouseover="myFunction('<?php echo $user_details->user_id;?>')" onmouseout="myFunction1('<?php echo $user_details->user_id;?>')" data-serialtip="example-4" id="node-img-4" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $user_details->username;?></span></a>
                                    <div class="popup" >
                                      <span class="popuptext" id="<?php echo $user_details->user_id;?>">
                                          Username:<?php echo $user_details->username;?><br>
                                          MemberID:<?php echo $user_details->user_id;?><br>
                                          Name:<?php echo $user_details->first_name;?>
                                          </span>
                                    </div>
                                </li>
                                <?php
                                }
                                }
                                else
                               {
                                   ?>
                                   <li><a href="<?php echo base_url();?>Web/register_upline/<?php echo $user_details->user_id;?>/Left/<?php echo $referal_id;?>" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                                   <?php
                               }
                                ?>
                                <?php
                                    $userlist=$callfun->getleveltree($val->down_id,'right');
                                    if(count($userlist)>0)
                                    {
                                        foreach($userlist as $key1=>$val1)
                                        {
                                        $user_details=get_user_details($val1->down_id);
                                    ?>
                                    <li id="node-id-4">
                                       <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img onmouseover="myFunction('<?php echo $user_details->user_id;?>')" onmouseout="myFunction1('<?php echo $user_details->user_id;?>')" data-serialtip="example-4" id="node-img-4" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $user_details->username;?></span></a>
                                        <div class="popup" >
                                          <span class="popuptext" id="<?php echo $user_details->user_id;?>">
                                              Username:<?php echo $user_details->username;?><br>
                                              MemberID:<?php echo $user_details->user_id;?><br>
                                              Name:<?php echo $user_details->first_name;?>
                                              </span>
                                        </div>
                                    </li>
                                    <?php
                                        }
                                    }
                                    else
                                    {
                                       ?>
                                       <li><a href="<?php echo base_url();?>Web/register_upline/<?php echo $user_details->user_id;?>/Left/<?php echo $referal_id;?>" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                                       <?php
                                    }
                                 ?>
                                <!--<li id="node-id-6">
                                   <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img ondblclick="searchUser(6)" data-serialtip="example-6" id="node-img-6" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $root_left_right_object->username;?></span></a>
                                   <div class="popup" >
                                      <span class="popuptext" id="<?php echo $root_left_right_object->user_id;?>">
                                          Username:<?php echo $root_left_right_object->username;?><br>
                                          MemberID:<?php echo $root_left_right_object->user_id;?><br>
                                          Name:<?php echo $root_left_right_object->username;?>
                                          </span>
                                    </div>
                                   <ul>
                                      <li><a href="<?php echo base_url();?>admin/register/INF75414044/1" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                                   </ul>
                                </li>-->
                            </ul>
                            
                        </li>
                      <?php
                       }
                   }
                   else
                   {
                       ?>
                       <li><a href="<?php echo base_url();?>Web/register_upline/<?php echo $user_details->user_id;?>/Left/<?php echo $referal_id;?>" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                       <?php
                   }
                  ?>
                  
                  <?php
                  if(count($binarylistright)>0)
                  {
                   foreach($binarylistright as $key=>$val)
                   {
                       $user_details=get_user_details($val->down_id);
                       
                       $userlist=$callfun->getleveltree($val->down_id,'left');
                       
                   ?>
                    <li id="node-id-2">
                     <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img onmouseover="myFunction('<?php echo $user_details->user_id;?>')" onmouseout="myFunction1('<?php echo $user_details->user_id;?>')" data-serialtip="example-2" id="node-img-2" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $user_details->username;?></span></a>
                        <div class="popup" >
                          <span class="popuptext" id="<?php echo $user_details->user_id;?>">
                              Username:<?php echo $user_details->username;?><br>
                              MemberID:<?php echo $user_details->user_id;?><br>
                              Name:<?php echo $user_details->first_name;?>
                              </span>
                        </div>
                        
                        <ul>
                            <?php
                            if(count($userlist)>0)
                            {
                                foreach($userlist as $key1=>$val1)
                                {
                                    $user_details=get_user_details($val1->down_id);
                                ?>
                                <li id="node-id-4">
                                   <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img onmouseover="myFunction('<?php echo $user_details->user_id;?>')" onmouseout="myFunction1('<?php echo $user_details->user_id;?>')" data-serialtip="example-4" id="node-img-4" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $user_details->username;?></span></a>
                                    <div class="popup" >
                                      <span class="popuptext" id="<?php echo $user_details->user_id;?>">
                                          Username:<?php echo $user_details->username;?><br>
                                          MemberID:<?php echo $user_details->user_id;?><br>
                                          Name:<?php echo $user_details->first_name;?>
                                          </span>
                                    </div>
                                </li>
                                <?php
                                }
                            }
                            else
                           {
                               ?>
                               <li><a href="<?php echo base_url();?>Web/register_upline/<?php echo $user_details->user_id;?>/Right/<?php echo $referal_id;?>" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                               <?php
                           }
                            ?>
                            <?php
                                $userlist=$callfun->getleveltree($val->down_id,'right');
                                if(count($userlist)>0)
                            {
                                foreach($userlist as $key1=>$val1)
                                {
                                $user_details=get_user_details($val1->down_id);
                            ?>
                            <li id="node-id-4">
                               <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img onmouseover="myFunction('<?php echo $user_details->user_id;?>')" onmouseout="myFunction1('<?php echo $user_details->user_id;?>')" data-serialtip="example-4" id="node-img-4" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $user_details->username;?></span></a>
                                <div class="popup" >
                                  <span class="popuptext" id="<?php echo $user_details->user_id;?>">
                                      Username:<?php echo $user_details->username;?><br>
                                      MemberID:<?php echo $user_details->user_id;?><br>
                                      Name:<?php echo $user_details->first_name;?>
                                      </span>
                                </div>
                            </li>
                            <?php
                                }
                   }
                   else
                   {
                       ?>
                       <li><a href="<?php echo base_url();?>Web/register_upline/<?php echo $user_details->user_id;?>/Right/<?php echo $referal_id;?>" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                       <?php
                   }
                   
                            ?>
                            <!--<li id="node-id-6">
                               <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img ondblclick="searchUser(6)" data-serialtip="example-6" id="node-img-6" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $root_left_right_object->username;?></span></a>
                               <div class="popup" >
                                  <span class="popuptext" id="<?php echo $root_left_right_object->user_id;?>">
                                      Username:<?php echo $root_left_right_object->username;?><br>
                                      MemberID:<?php echo $root_left_right_object->user_id;?><br>
                                      Name:<?php echo $root_left_right_object->username;?>
                                      </span>
                                </div>
                               <ul>
                                  <li><a href="<?php echo base_url();?>admin/register/INF75414044/1" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                               </ul>
                            </li>-->
                        </ul>
                        
                    </li>
                    
                    
                  <?php
                   }
                  }
                   else
                   {
                       ?>
                       <li><a href="<?php echo base_url();?>Web/register_upline/<?php echo $user_details->user_id;?>/Right/<?php echo $referal_id;?>" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                       <?php
                   }
                  ?>
                  <!--<li id="node-id-3">
                     <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img ondblclick="searchUser(3)" data-serialtip="example-3" id="node-img-3" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username "><?php echo $root_right_object->username;?></span></a>
                     <div class="popup" >
                          <span class="popuptext" id="<?php echo $root_right_object->user_id;?>">
                              Username:<?php echo $root_right_object->username;?><br>
                              MemberID:<?php echo $root_right_object->user_id;?><br>
                              Name:<?php echo $root_right_object->username;?>
                              </span>
                        </div>
                     <ul>
                        <li id="node-id-7">
                           <a href="<?php echo base_url();?>Affiliate/MyGenealogy/myTeamTree/<?php echo $user_details->user_id;?>" class="node-element"><img ondblclick="searchUser(7)" data-serialtip="example-7" id="node-img-7" class="tooltipKey user-image" src="<?php echo base_url();?>assets/images/users/avatar-1.jpg" alt="Card image"><span class="tree-username ">INF19480442</span></a>
                           <ul>
                              <li><a href="<?php echo base_url();?>admin/register/INF19480442/1" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                           </ul>
                        </li>
                        <li><a href="<?php echo base_url();?>admin/register/INF19120376/2" target="_blank"><img class="add-image" src="<?php echo base_url();?>assets/images/add.png" alt="Card image"><span class="label add-btn">Add</span></a></li>
                     </ul>
                  </li>-->
               </ul>
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
  //popup.classList.toggle("show");
  //document.getElementById(id).style.display='block';
}
function myFunction1(id) {
  var popup = document.getElementById(id);
  popup.classList.toggle("hide");
  //document.getElementById(id).style.display='none';
}
</script>
                 