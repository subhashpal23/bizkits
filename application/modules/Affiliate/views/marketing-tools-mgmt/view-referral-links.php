
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
                <!--<div class="card height-auto">
                    <div class="card-body">
                        <div class="heading-layout1">
                            <div class="item-title">
                                <h3>My Referral Link</h3>
                            </div>
                            
                        </div>
                			<input type='text' style='width:35%'  value='<?php echo $referral_link;?>' class='form-control btn btn-primary' id='ref'/>
                			<a href="javascript:void();" id='copyy' onclick='myFunction()' class='btn btn-success'>Copy Referral Link</a>
                    </div>
                </div>-->
                <div class="row gutters-20">
                    <div class="col-xl-6 col-sm-6 col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Referral Link</h3>
                                    </div>
                                </div>
                        			<input type='text' style='width:65%'  value='<?php echo $referral_affiliate_link;?>' class='form-control btn btn-primary' id='ref'/>
                        			<a href="javascript:void();" id='copyy' onclick='myFunction()' class='btn btn-success'>Copy Referral Link</a>
                            </div>
                        </div>
                    </div>
                    
                </div>
                
                
    <div class="toolTip-div">
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
$(document).ready(function(){
    $("#ref").click(function()
	{
        var url=$(this).val();
		window.open(url,'_blank');
    });
});

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
$(document).ready(function(){
    $("#ref1").click(function()
	{
        var url=$(this).val();
		window.open(url,'_blank');
    });
});
</script>