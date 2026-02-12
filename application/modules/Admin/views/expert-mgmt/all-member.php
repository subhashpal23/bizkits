<div class="dashboard-content-one">
    <!-- Breadcubs Area Start Here -->
    <div class="breadcrumbs-area">
        <h3>Expert Management Dashboard</h3>
        <ul>
            <li>
                <a href="<?php echo base_url();?>Admin">Home</a>
            </li>
            <li>
                <a href="<?php echo base_url();?>Admin/Expert/viewAllMember">Expert Management</a>
            </li>
            <li>Experts</li>
        </ul>
    </div>
    <!-- Breadcubs Area End Here -->
    <div class="card height-auto">
        <div class="card-body">
            <form action="<?php echo base_url();?>Admin/Member/viewAllMember" method="post">

                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="user_id" class="form-control" placeholder="UserID"
                            value="<?php echo $conditions['user_id'];?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input type="text" name="username" class="form-control" placeholder="Username"
                            value="<?php echo $conditions['username'];?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <button type="submit" name="search" value="search"
                            class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Search</button>
                    </div>
                </div>
            </form>
            <div class="heading-layout1">
                <div class="item-title">
                    <h3>All Experts Data</h3>
                </div>

                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addFieldModal">
                    Add New Expert
                </button>
            </div>
            <div class="card-title" style="color:green">
                <?php echo $this->session->flashdata('flash_msg');?>
            </div>
            <div class="card-title" style="color:red">
                <?php echo $this->session->flashdata('error_msg');?>
            </div>

            <div class="table-responsive">
                <div id="DataTables_Table_0_wrapper" class="dataTables_wrapper no-footer">
                    <table class="table display data-table text-nowrap dataTable no-footer" id="DataTables_Table_0"
                        role="grid">
                        <thead>

                            <tr role="row">
                                <th class="sorting">S.No.</th>
                                <th class="sorting">Username</th>
                                <th class="sorting">User ID</th>
                                <th class="sorting">Name</th>
                                <th class="sorting">Phone</th>
                                <th class="sorting">Joining Date</th>

                                <th class="sorting">Status</th>

                                <th class="sorting">Action</th>
                                <!--<th class="sorting_disabled" rowspan="1" colspan="1" aria-label="" style="width: 47.55px;"></th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                 //echo "<pre>";print_r($all_members['data']);
                                 foreach($all_members['data'] as $key=>$val)
                                 {
                                 ?>
                            <tr role="row" class="odd">
                                <?php
                                        foreach($val as $key1=>$val1)
                                        {
                                        ?>
                                <td><?php echo $val1;?></td>
                                <?php
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
            <!-- Render pagination links -->
            <div class="pagination">
                <?php echo $this->pagination->create_links(); ?>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="addFieldModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Expert</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span>&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- Form fields -->
                    <form id="addForm" method="post" action="<?php echo base_url('Admin/Expert/register'); ?>">

                        <div class="form-group">
                            <input type="text" name="username" required="" onblur="check_username(this.value)"
                                id="username" class="form-control required" placeholder="Username">
                            <span id="check_username"></span>
                        </div>
                        <div class="form-group">
                            <input required="" type="text" id="first_name" class="form-control required"
                                name="first_name" placeholder="Name">
                            <span id="matchpassword"></span>
                        </div>
                        <div class="form-group">
                            <input type="text" required="" name="email" class="form-control required"
                                placeholder="Email">
                        </div>
                        <div class="form-group">
                            <input required="" type="text" id="contact_no" class="form-control required"
                                name="contact_no" placeholder="Phone">
                            <span id="matchpassword"></span>
                        </div>
                        <div class="form-group">
                            <input required="" type="password" id="password" class="form-control required"
                                name="password" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <input required="" type="password" id="confirm_password" class="form-control required"
                                name="confirm_password" onblur="matchPassword();" placeholder="Confirm password">
                            <span id="matchpassword"></span>
                        </div>
                        <div class="form-group">
                            <select onchange="print_state('state',this.selectedIndex);" id="country" name ="country" class="form-control">
								<option value="">--select country--</option>
                               
                            </select>
                        </div>
                        <div class="form-group">
                            <select name ="state" id ="state" class="form-control required"><option value="">--Select State--</option></select>
                        </div>
                        <div class="form-group">
                             <input required="" type="text" id="city" class="form-control required"
                                name="city"  placeholder="City">
                        </div>
                        <div class="form-group mb-30">
                            <button type="submit" class="btn btn-primary btn-block hover-up" name="login"
                                value="login">Submit</button>
                        </div>

                    </form>
                </div>

            </div>
        </div>
    </div>
			    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
    function check_username(username) {
        //var loader_image='<img src="https://honewebsolutions.com/bizkits/front_assets/images/loader.gif" width="auto">';
        if (username == '') {
            $("#check_username").children().remove();
            $("#check_username").append('<div>Please enter login Id!</div>').css({
                'font-weight': 'bold',
                'color': 'red',
                'margin': '0',
                'padding': '0',
                'float': 'left',
                'font-size': '13px'
            }); //end css
            //$("#sponsor_id").focus();
        } else {
            //$("#check_username").append(loader_image);
            $.ajax({
                type: 'POST',
                url: "<?php echo base_url('Web/isUserNameExists'); ?>",
                data: {
                    username: username,
                    requestType: 'new_user'
                },
                async: false,
                beforeSend: function() {
                    //$("#load").css("display", "block");
                    $("#overlay").fadeIn(300);
                },
                success: function(res) {
                    $("#check_username").children().remove();
                    if (res.exist == '1') {

                        $("#check_username").append('<div class="text-danger">Sorry ' + username +
                            ' already exists!</div>').css({
                            'font-weight': 'bold',
                            'color': 'red',
                            'margin': '0',
                            'padding': '0',
                            'float': 'left',
                            'font-size': '14px'
                        }); //end css
                    } //end if
                    else {
                        $("#check_username").append('<div class="text-success">' + username +
                            ' available!</div>').css({
                            'font-weight': 'bold',
                            'color': 'green',
                            'margin': '0',
                            'padding': '0',
                            'float': 'left',
                            'font-size': '14px'
                        }); //end css
                    }
                }, //end success
                complete: function() {
                    //$("#load").css("display", "none");
                    $("#overlay").fadeOut(300);
                }
            }); //end ajax
        }
    }
    </script>
    <script src="<?php echo base_url();?>assets/js/countries.js"></script>

    <script language="javascript">print_country("country");</script>

