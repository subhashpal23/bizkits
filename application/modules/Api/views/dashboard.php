           <?php
           $currency=currency();
           ?>
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                
                <div class="row gutters-20" style="margin-top:5px;">
                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                               
                    <ul style="float: left;">
                            <li>
                                 <a href="#" style="color:#1f1f1f;font-size: 15px;font-weight: bold;">WELCOME <?php echo $user_details->first_name.' '.$user_details->last_name;?> &nbsp;&nbsp;|</a>
                                 &nbsp;&nbsp;
                                 <a href="#" style="color:#1f1f1f;font-size: 15px;font-weight: bold;">MEMBER ID : <?php echo $user_details->user_id;?> <!--<i class="fa fa-copy"></i>-->
                                 </a>
                            </li>
                        </ul>
                   <!-- <ul>
                        <li>
                            <a href="<?php echo base_url();?>Affiliate">Home</a>
                        </li>
                        <li>Affiliate</li>
                    </ul>-->
                   
                                
                            </div>
                        </div>
                    </div>
                   
                </div>
                
                <!-- Breadcubs Area End Here -->
                <!-- Dashboard summery Start Here -->
                
                
                <div class="row gutters-20">
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="item-icon bg-light-red">
                                        <i class="flaticon-money text-red"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="item-content">
                                        <div class="item-title">Total Order</div>
                                        <div class="item-number"><span><?php echo $currency;?></span><span class="counter" data-num="<?php echo $ewallet_balance;?>"><?php echo $ewallet_balance;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="item-icon bg-light-red">
                                        <i class="flaticon-money text-red"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="item-content">
                                        <div class="item-title">Total Sale</div>
                                        <div class="item-number"><span><?php echo $currency;?></span><span class="counter" data-num="<?php echo $twallet_balance;?>"><?php echo $twallet_balance;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="item-icon bg-light-green">
                                        <i class="flaticon-money text-green"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="item-content">
                                        <div class="item-title">Purchase Order</div>
                                        <div class="item-number"><span><?php echo $currency;?></span><span class="counter" data-num="<?php echo $direct_commission;?>"><?php echo $direct_commission;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="dashboard-summery-one mg-b-20">
                            <div class="row align-items-center">
                                <div class="col-4">
                                    <div class="item-icon bg-light-blue ">
                                        <i class="flaticon-books text-blue"></i>
                                    </div>
                                </div>
                                <div class="col-8">
                                    <div class="item-content">
                                        <div class="item-title">Remaining Stock</div>
                                        <div class="item-number"><span><?php echo $currency;?></span><span class="counter" data-num="<?php echo $level_commission;?>"><?php echo $level_commission;?></span></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                   
                    
                </div>
                <!-- Dashboard summery End Here -->
                <!-- Dashboard Content Start Here -->
                
                <!-- Dashboard Content End Here -->
                <!-- Social Media Start Here -->
                
                <!-- Social Media End Here -->
                <!-- Button trigger modal -->
<!--<button type="button" class="btn btn-primary" id="shwmodl" data-toggle="modal" data-target="#exampleModal" >
  
</button>-->

<!-- Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="height:600px; overflow:scroll;">
    <span class="close">&times;</span>
    <img src="<?php echo base_url();?>schooldocuments/<?php echo $notice->image;?>" style="width:100%">
    <?php
        
        echo "<br>";
        echo $notice->confidential_value;
        ?>
  </div>
</div>


<div id="myModal1" class="modal">

  <!-- Modal content -->
  <div class="modal-content" style="height:600px; overflow:scroll;">
    <span class="close1">&times;</span>
    <img src="<?php echo base_url();?>schooldocuments/<?php echo $notice1->image;?>" style="width:100%">
    <?php
        
        echo "<br>";
        echo $notice1->confidential_value;
        ?>
  </div>
</div>

<!--<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Notice</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <?php
       /* echo $notice->image;
        echo "<br>";
        echo $notice->confidential_value;*/
        ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        
      </div>
    </div>
  </div>

</div>-->

<style>

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 999; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  background-color: #fefefe;
  margin: auto;
  padding: 20px;
  border: 1px solid #888;
  width: 80%;
}

/* The Close Button */
.close {
  color: #aaaaaa;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}
</style>
<script>
   
function myFunction() 
{
  /* Get the text field */
  var copyText = document.getElementById("ref");

 
  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Your Referral Link is copied");
}

function openreflink(url)
{
    window.open(url,'_blank');
}
/*$(document).ready(function(){
    $("#ref").click(function()
	{
        var url=$(this).val();
		window.open(url,'_blank');
    });
});*/

function myFunction1() 
{
  /* Get the text field */
  var copyText = document.getElementById("ref1");

 
  /* Select the text field */
  copyText.select();

  /* Copy the text inside the text field */
  document.execCommand("copy");

  /* Alert the copied text */
  alert("Your Referral Link is copied");
}
/*$(document).ready(function(){
    $("#ref1").click(function()
	{
        var url=$(this).val();
		window.open(url,'_blank');
    });
});*/
</script>
<script>

</script>
<style>
    .dashboard-summery-one .item-content .item-title {
    color: #283d1f !important;
}
.boldfonts{
    color:#1f1f1f;font-size: 15px;font-weight: bold;
}
</style>