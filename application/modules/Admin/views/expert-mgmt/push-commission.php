            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Commission</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Admin">Home</a>
                        </li>
                        <li>Referal Commission</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- Admit Form Area Start Here -->
                <div class="card height-auto">
                    <div class="card-title" style="color:green">
                        <?php echo $this->session->flashdata('flash_msg');?>
                    </div>
                    <div class="card-title" style="color:red">
                        <?php echo $this->session->flashdata('error_msg');?>
                    </div>
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Push Commission</h3>
                            </div>
                            <div class="dropdown">
                                <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown"
                                    aria-expanded="false">...</a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-times text-orange-red"></i>Close</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                    <a class="dropdown-item" href="#"><i
                                            class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                </div>
                            </div>
                        </div>
                        <?php 
            //////////////Personal information////////////////////
            $first_name=(!empty($user_details->first_name))?$user_details->first_name:'';
            $last_name=(!empty($user_details->last_name))?$user_details->last_name:'';
            $email=(!empty($user_details->email))?$user_details->email:'';
            $contact_no=(!empty($user_details->contact_no))?$user_details->contact_no:'';
            $gender=(!empty($user_details->gender=='1'))?'Male':'Female';
            if(!empty($user_details->date_of_birth))
            {
               $date_of_birth=date(date_formats(),strtotime($user_details->date_of_birth));
            }
            else
            {
               $date_of_birth='';
            }
            $address_line1=(!empty($user_details->address_line1))?$user_details->address_line1:'';
            $address_line2=(!empty($user_details->address_line2))?$user_details->address_line2:'';
            $country=(!empty($user_details->country))?$user_details->country:'';
            $state=(!empty($user_details->state))?$user_details->state:'';
            $city=(!empty($user_details->city))?$user_details->city:'';
            $zip_code=(!empty($user_details->zip_code))?$user_details->zip_code:'';
            
            /////////Account information//////
            $bank_name=(!empty($user_details->bank_name))?$user_details->bank_name:'';
            $branch_name=(!empty($user_details->branch_name))?$user_details->branch_name:'';
            $account_holder_name=(!empty($user_details->account_holder_name))?$user_details->account_holder_name:'';
            $account_no=(!empty($user_details->account_no))?$user_details->account_no:'';
            ////////Social Media Information//////////
            $facebook_link=(!empty($user_details->facebook_link))?$user_details->facebook_link:'';
            $twitter_link=(!empty($user_details->twitter_link))?$user_details->twitter_link:'';
            $linkedin_link=(!empty($user_details->linkedin_link))?$user_details->linkedin_link:'';
            $google_plus_link=(!empty($user_details->google_plus_link))?$user_details->google_plus_link:'';
            
            ?>
                        
                            <form class="new-added-form" action="<?php echo ci_site_url();?>Admin/Member/pushCommission" method='post' enctype='multipart/form-data'>
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Sponsor User ID/Username</label>
                                    <input type="text" name='sponsor_name' value="<?php echo $sponsor_name;?>" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Downline ID/ Username</label>
                                    <input type="text" name="downline_name" value="<?php echo $downline_name;?>" class="form-control">
                                </div>
                               
                               
                                
                                
                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit" name="submit" value="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Push Referal Commission</button>
                                    
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Admit Form Area End Here -->
                