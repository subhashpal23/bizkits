<div class="breadcumb-wrapper" data-bg-src="<?php echo base_url();?>frontassets/images/bg.jpg">
            <div class="container">
                <div class="breadcumb-content">
                    <h1 class="breadcumb-title" style="color:#fff;">Payment Methods</h1>
                    <ul class="breadcumb-menu">
                        <li>
                            <a href="<?php echo base_url();?>" style="color:#fff;">Home</a>
                        </li>
                        <li style="color:#fff;">Payment Methods</li>
                    </ul>
                </div>
            </div>
        </div>











        <div class="overflow-hidden overflow-hidden space" id="about-sec">
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-xl-12 mb-30 mb-xl-0">
                       <form action="" class="sky-form">        <header>Pay Via Bank Wire</header>    
    	          <fieldset>          <section>            <div class="row">			                        
    	          <p><b>Dear User Please Make the Payment on Below Bank Detail</b></p>			   
    	          <br>             
    	          <?php                 $account_no=(!empty($bank_wire_detail->account_no))?$bank_wire_detail->account_no:null;            
    	          $bank_name=(!empty($bank_wire_detail->bank_name))?$bank_wire_detail->bank_name:null;             
    	          $account_holder_name=(!empty($bank_wire_detail->account_holder_name))?$bank_wire_detail->account_holder_name:null;              ?>	
    	          <table class='table table-bordered table-striped table-hover'> 		
    	          <tr>		              <td style='text-align:left'>Bank Name : </td><td> <?php echo $bank_name;?></td>			</tr>	
    	          <tr>              <td style='text-align:left'>Account Holder Name : </td><td> <?php echo $account_holder_name;?></td>			</tr>	
    	          <tr>              <td style='text-align:left'>Account No. : </td><td> <?php echo $account_no;?></td>			  </tr>         
    	          </table>  			<br>              <?php               echo $this->session->userdata('flash_msg');              ?>             
    	          </div>          </section>                        </fieldset>            </form>  
                    </div>
                   
                </div>
            </div>
        </div>


