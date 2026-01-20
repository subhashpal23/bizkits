
   
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
                
   <div class="content">
					<!-- Horizontal form options -->
					<div class="row">
						<div class="col-md-12">
							<!-- Basic layout-->
								<div class="card card-body">
									<div class="card-heading">
										<h5 class="card-title">Add New Customer</h5>
										<div class="heading-elements">
											<ul class="icons-list">
						                		<li><a data-action="collapse"></a></li>
						                		<li><a data-action="reload"></a></li>
						                		<li><a data-action="close"></a></li>
						                	</ul>
					                	</div>
									<a class="heading-elements-toggle"><i class="icon-menu"></i></a></div>
										<?php 
 echo form_open(site_url().$module_name."/Eshop/addNewSale",array('method'=>'post','class'=>'form-horizontal', 'enctype'=>'multipart/form-data'));
										?>
										
											<div class="card-body">
											
											
												<div class="form-group">
													<label class="col-lg-3 control-label">Customer Name:</label>
													<div class="col-lg-9">
													    <select name="customer_id" class="form-control select2">
													        <option value="">Select Customer</option>
													        <?php
													        foreach($all_customers as $key=>$val)
													        {
													            echo "<option value='".$val['id']."'>".$val['category_name']."</option>";
													        }
													        ?>
													    </select>
											            
													</div>
												</div>
										
												<div class="form-group">
													<label class="col-lg-3 control-label">Products:</label>
													<div class="col-lg-9">
													    <select id="item" onchange="updatePrice()" name="items[]" multiple class='form-control'>
                                                           <!-- <option value="">-Select Items-</option> -->
                                						      <?php
                                                              foreach($all_products as $cat)
                                                              {
                                                              ?>
                                                                <option value="<?php echo $cat['id']; ?>" itemname="<?php echo $cat['title']; ?>" itemqty="<?php echo $cat['qty']; ?>" itemunit="<?php echo $cat['unit']; ?>"><?php echo $cat['title'].'('.$cat['qty'].''.$cat['unit'].')'; ?></option>
                                                              <?php														
                                                              }
                                                              ?>
                                                        </select>
											            
													</div>
												</div>
												<div class="form-group" >
                     <label class="col-lg-3 control-label">Add Items Comptions<span class="required-field">*</span>:</label>
                     <div class="col-lg-9" id="showitems">
                     </div>
                  </div>
                  <script>
                     function updatePrice()
                     {
                        const select = document.getElementById('item');
                        // Use selectedOptions to get all selected options
                        const selectedOptions = Array.from(select.selectedOptions);
                        // Map over the options to get their values
                        const values = selectedOptions.map(option => option.value);
                        // Display the selected values
                        /*var str = "<table style='width:100%'><thead><tr><th>Item Name</th><th>Consumptions</th><th>Cost</th></tr></thead><tbody>";
                        str=str+"</tbody></table>";*/
                        var str = "<div class='row'><div class='col-md-4'>Item Name</div><div class='col-md-4'>Consumptions</div><div class='col-md-4'>Cost</div>";
                        // Loop through selected options
                        selectedOptions.forEach(option => {
                            // Get the value and text of each option
                            const value = option.value;
                            const text = option.text;
                            const itemname = option.getAttribute("itemname");
                            const itemqty = option.getAttribute("itemqty");
                            const itemunit = option.getAttribute("itemunit");
                            var str1 = "<div class='col-md-4'><input type='text' readonly name='item_name["+value+"]' value='"+itemname+"' class='form-control'></div><div class='col-md-4'><input type='number' name='item_consumption["+value+"]' value='"+itemqty+"' class='form-control'>"+itemunit+"</div><div class='col-md-4'><input type='number' name='item_cost["+value+"]' value='"+0+"' class='form-control'></div>";
                            str=str+str1;
                            // Add the values to the output list
                            /*const listItem = document.createElement("li");
                            listItem.textContent = `Value: ${value}, Text: ${text}`;
                            outputList.appendChild(listItem);*/
                        });
                        str=str+"</div>";
                        document.getElementById('showitems').innerHTML = str;
                        //document.getElementById('showitems').textContent = 'Selected: ' + values.join(', ');
                     }
                  </script>
												<div class="form-group">
													<label class="col-lg-3 control-label">Active Status:</label>
													<div class="col-lg-9">
														<select class='form-control' name='active_status'>
														<option value='1'>Active</option>
														<option value='0'>Inctive</option>
														</select>
													</div>
										      </div>
												
												<div class="text-right">
     <button type="submit" name="btn" value="addNewcategory" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Add <i class="icon-arrow-right14 position-right"></i></button>
												</div>
											</div>
										<!--</form>-->
										<?php echo form_close();?>
								</div>
								<!-- /basic layout -->
						</div>
					</div>
					<!-- /vertical form options -->
					<!-- Footer -->
	                  <?php
	                  //$this->load->view("common/footer-text");
	                  ?>
                     <!-- /footer -->
				</div>
				<!-- /content area -->
			</div>
	<script>
	CKEDITOR.replace( 'description');
	</script>