  
    	          <!-- ========== END OF HEADER  ========== -->         
    	          <!-- ==================================== -->           
    	          <!---------- Sub Header ---------->           
    	          <!---------- Sub Header ---------->                 
    	          <div class="vc_row wpb_row vc_row-fluid sec-padding section-light">       
    	          <div class="container">   <div class="card card-hero animated slideInUp animation-delay-8 mb-6">      <div class="card-body">                                                                     
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
    	          <hr class="dotted">               </div>  
    	          </div>
    	          </div>
    	          </div>           
    	            
    	          </div>    
    	          </div>  
