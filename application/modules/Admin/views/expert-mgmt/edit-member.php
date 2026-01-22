            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>Expert</h3>
                    <ul>
                        <li>
                            <a href="<?php echo base_url();?>Admin">Home</a>
                        </li>
                        <li>Edit Expert</li>
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
                                <h3>Edit Expert</h3>
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

                        <form class="new-added-form"
                            action="<?php echo ci_site_url();?>Admin/Expert/updatePersonalInformation/<?php echo ID_encode($user_id);?>"
                            method='post' enctype='multipart/form-data'>
                            <div class="row">
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>First Name *</label>
                                    <input type="text" name='first_name' value="<?php echo $first_name;?>"
                                        class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Last Name *</label>
                                    <input type="text" name="last_name" value="<?php echo $last_name;?>"
                                        class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Address </label>
                                    <input type="text" name="address_line1" value="<?php echo $address_line1;?>"
                                        class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Address2</label>
                                    <input type="text" name="address_line2" value="<?php echo $address_line2;?>"
                                        class="form-control">
                                </div>

                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>E-Mail</label>
                                    <input type="text" name="email" value="<?php echo $email;?>" class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Country</label>
                                    <!-- <?php 
                                                   $country_array=array(
                                                      'India'=>'India'
                                                      );
                                                   ?>
                                                   <select name='country' class="form-control">
                                                      <?php 
                                                      foreach ($country_array as $key => $value) 
                                                      {
                                                          $sel="";
                                                         if($value==$country)
                                                         {
                                                             $sel="selected";
                                                         }
                                                      ?>
                                                      <option value="<?php echo $value;?>" <?php echo $sel;?>><?php echo $key;?></option>
                                                      <?php       
                                                      }
                                                      ?>
                                                   </select> -->
                                    <select id="country_list" name="country" class="form-control">
                                        <option value="">--select country--</option>

                                        <?php if (!empty($country_list)) : ?>
                                        <?php foreach ($country_list as $row) : ?>
                                        <option value="<?= $row->name ?>"
                                            <?= (!empty($country) && $country == $row->name) ? 'selected' : '' ?>>
                                            <?= $row->name ?>
                                        </option>
                                        <?php endforeach; ?>
                                        <?php endif; ?>
                                    </select>

                                </div>

                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>State/Province</label>
                                    <!-- <input type="text" name="state" value="<?php echo $state;?>" class="form-control"> -->
                                    <select id="state" name="state" class="form-control">
                                        <option value="">--select state--</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>City</label>
                                    <!-- <input type="text" name="city" value="<?php echo $city;?>" class="form-control"> -->
                                    <select id="city" name="city" class="form-control">
                                        <option value="">--select city--</option>
                                    </select>
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Zipcode </label>
                                    <input type="text" name="zip_code" value="<?php echo $zip_code;?>"
                                        class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 form-group">
                                    <label>Phone No</label>
                                    <input type="text" name="contact_no" value="<?php echo $contact_no;?>"
                                        class="form-control">
                                </div>
                                <div class="col-xl-3 col-lg-6 col-12 mg-t-30">
                                    <label>Profile Pic</label>
                                    <input type='hidden' name='profile_pic_old' value='<?php echo $profile_pic_old;?>'>
                                    <input type="file" name='profile_pic' class="file-styled">
                                    <span class="help-block">Accepted formats: gif, png, jpg. Max file size 2Mb</span>
                                </div>


                                <div class="col-12 form-group mg-t-8">
                                    <button type="submit"
                                        class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Admit Form Area End Here -->
                <!-- Bank settings -->
                <div class="card height-auto">

                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>Username Setting</h3>
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
                        <form class="new-added-form"
                            action="<?php echo site_url();?>Admin/Member/updateUserInformation/<?php echo ID_encode($user_id);?>"
                            method="post">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Username</label>
                                        <input type="text" name="username" value="<?php echo $username;?>"
                                            placeholder="Enter User Name" class="form-control">
                                    </div>

                                </div>

                            </div>

                            <div class="text-right">
                                <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Update
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /Bank Detail settings -->
                <!-- Admit Form Area End Here -->
                <!-- Bank settings -->
                <!--<div class="card height-auto">
                                    
                                    <div class="card-body">
                                        <div class="heading-layout1">
                                            <div class="item-title">
                                                <h3>Bank Detail Setting</h3>
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
                                       <form class="new-added-form" action="<?php echo site_url();?>Admin/Member/updateBankInformation/<?php echo ID_encode($user_id);?>" method="post">
                                          <div class="form-group">
                                             <div class="row">
                                                <div class="col-md-6">
                                                   <label>Bank Name</label>
                                                   <input type="text" name="bank_name" value="<?php echo $bank_name;?>" placeholder="Bank Name" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Branch Name</label>
                                                   <input type="text" name="branch_name" value="<?php echo $branch_name;?>" placeholder="Branch Name" class="form-control">
                                                </div>
                                             </div>
                                              <div class="row">
                                                <div class="col-md-6">
                                                   <label>Account Holder Name</label>
                                                   <input type="text" name="account_holder_name" value="<?php echo $account_holder_name;?>" placeholder="Account Holder Name" class="form-control">
                                                </div>
                                                <div class="col-md-6">
                                                   <label>Account No</label>
                                                   <input type="text" name="account_no" value="<?php echo $account_no;?>" placeholder="Account No." class="form-control">
                                                </div>
                                             </div>
                                          </div>
                                          
                                          <div class="text-right">
                                             <button type="submit" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save </button>
                                          </div>
                                       </form>
                                    </div>
                                 </div>-->
                <!-- /Bank Detail settings -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                <script>
                $('#country_list').change(function() {
                    var country_id = $(this).val();
                    $.ajax({
                        url: "<?= base_url('location/get_states') ?>",
                        type: "POST",
                        data: {
                            country_id: country_id
                        },
                        success: function(data) {
                            $('#state').html(data);
                            $('#city').html('<option value="">Select City</option>');
                        }
                    });
                });
                $('#state').change(function() {
                    var state_id = $(this).val();
                    $.ajax({
                        url: "<?= base_url('location/get_cities') ?>",
                        type: "POST",
                        data: {
                            state_id: state_id
                        },
                        success: function(data) {
                            $('#city').html(data);
                        }
                    });
                });
                </script>