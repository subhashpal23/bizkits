<?php 
/*
@author : Aditya
@param  : none
@desc   : It's used to generate the unique user id
@return int(user id)
*/
if(!function_exists('generateUserId'))
{
	function generateUserId()
	{
		$obj=& get_instance();
		$encypt1=uniqid(rand(100000,999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$pre_userid = substr($usid1, 0, 7);
		$query=$obj->db->select('user_id')->from('user_login')->where(array('user_id'=>$pre_userid))->get();
		if($query->num_rows()>0)
		{
		 generateUserId();
		}
		else
		{
		 return $pre_userid;
	    }
	}//end function    
}//end function exists
/*
@author : Aditya
@param  : int(referral userid/sponsor user id)
@desc   : It's used to identify the weaker leg position, in case of default leg user registration system
@return string(leg position)
*/
if(!function_exists('getLegPosition'))
{
 function getLegPosition($ref_id123)
  {
	$obj=& get_instance();
	$posi=null;
	$leftCondition=array('income_id'=>$ref_id123,'leg'=>'left');
	$rightCondition=array('income_id'=>$ref_id123,'leg'=>'right');
	$left=$obj->db->select('id')->from('level_income_binary')->where($leftCondition)->get();
	$right=$obj->db->select('id')->from('level_income_binary')->where($rightCondition)->get();
	$count_left_count=$left->num_rows();
	$count_right_count=$right->num_rows();
	// if both leg same 
	if($count_left_count==$count_right_count)
	{
		$posi='left';
	}
	else
	{
	// find the weeker leg
	   $min=min($count_left_count,$count_right_count);
	   if($min==$count_left_count)
		{
		  $posi='left';
	    }
	   if($min==$count_right_count)
	    {
		  $posi='right';
	    }
	}
	return $posi;
  }//end function
}//end function exists

function getLegPosition1($sponserid)
{
			global $nom_id1,$lev,$leg_pos;
			$obj=& get_instance();
			foreach($sponserid as $key => $val)
			{
			$query1=$obj->db->select('*')->from('user_registration')->where('nom_id',$val)->order_by('id','ASC')->get();
			$num_ro1[]=$query1->num_rows();
			//$num_ro1[]=mysql_num_rows($result1);
			foreach($query1->result() as $row)
				{
					$rclid1[]=$row->user_id;
				}//end while
			}//end foreach
			foreach($num_ro1 as $key11 => $valu)
			{
				if($valu < 2)
				{
				$key1=$key11;
				break;
				}
			}//end foreach
			switch ($valu)
			{
			    case '0':
				    $leg_pos="left";
					break;
			    case '1':
				   	$leg_pos="right";
					break;
				case '2':
					if(!empty($nom_id1))
					{
					 break;
					}
			    getLegPosition1($rclid1);
			}//end switch
			return $leg_pos;
}//end function

if(!function_exists('getMatrixNom'))
{
	function getMatrixNom($sponserid)
	{
			global $nom_id1,$lev;
			$obj=& get_instance();
			foreach($sponserid as $key => $val)
			{
			//$query1="select * from user_registration where nom_id='$val' order by id asc";
			//$result1=mysql_query($query1);
			$query1=$obj->db->select('*')->from('user_registration')->where('nom_id',$val)->order_by('id','ASC')->get();
			$num_ro1[]=$query1->num_rows();
			//$num_ro1[]=mysql_num_rows($result1);
			foreach($query1->result() as $row)
				{
					$rclid1[]=$row->user_id;
				}//end while
			}//end foreach
			foreach($num_ro1 as $key11 => $valu)
			{
				if($valu < 2)
				{
				$key1=$key11;
				break;
				}
			}//end foreach
			switch ($valu)
			{
			    case '0':
				    $nom_id1=$sponserid[$key1];
					break;
			    case '1':
				   	$nom_id1=$sponserid[$key1];
					break;
				case '2':
					if(!empty($nom_id1))
					{
					 break;
					}
			    getMatrixNom($rclid1);
			}//end switch
			return $nom_id1;
	}//end function
}//end function exists

if(!function_exists('getNom'))
{
	function getNom($sponserid)
	{
			global $nom_id1,$lev;
			$obj=& get_instance();
			foreach($sponserid as $key => $val)
			{
			//$query1="select * from user_registration where nom_id='$val' order by id asc";
			//$result1=mysql_query($query1);
			$query1=$obj->db->select('*')->from('user_registration')->where(array('nom_id'=>$val))->order_by('id','ASC')->get();
			$num_ro1[]=$query1->num_rows();
			//$num_ro1[]=mysql_num_rows($result1);
			foreach($query1->result() as $row)
				{
					$rclid1[]=$row->user_id;
				}//end while
			}//end foreach
			foreach($num_ro1 as $key11 => $valu)
			{
				if($valu < 2)
				{
				$key1=$key11;
				break;
				}
			}//end foreach
			switch ($valu)
			{
			    case '0':
					 {
					  $nom_leg_position="Left";
					  $nom_id1=$sponserid[$key1];
					  break;
					 }
			    case '1':
					{
					  $nom_leg_position="Right";
					  $nom_id1=$sponserid[$key1];
					  break;
					}
				case '2':
					if(!empty($nom_id1))
					{
					 break;
					}
				getNom($rclid1);
			}//end switch
			$nom_id_info['nom_leg_position']=$nom_leg_position;
			$nom_id_info['nom_id']=$nom_id1;
			if(!empty($nom_id1) && !empty($nom_leg_position))
			{
			  $_SESSION['nom_id']=$nom_id1;
			  $_SESSION['nom_leg_position']=$nom_leg_position;
			}
			return $nom_id_info;
			exit;
	}//end function
}//end function exists
if(!function_exists('getFollowMeMatrixNom'))
{
	function getBinaryNom($sponserid=null,$posi=null)
	{
		$nom_id=null;
		$obj=& get_instance();
	    $query=$obj->db->select('*')->from('user_registration')->where(array('nom_id'=>$sponserid,'binary_pos'=>$posi))->get();
        if($query->num_rows()>0)
        {
	        $query_obj=$query->row();
		    $rclid1=$query_obj->user_id;
			$left_query=$obj->db->select('*')->from('user_registration')->where(array('nom_id'=>$rclid1,'binary_pos'=>'Left'))->get();
			$left_count=$left_query->num_rows();
			
			$right_query=$obj->db->select('*')->from('user_registration')->where(array('nom_id'=>$rclid1,'binary_pos'=>'Right'))->get();
			$right_count=$right_query->num_rows();
			
			if($left_count>0 && $right_count>0)
			{ 
				$posi=$query_obj->ref_leg_position;
				
				if($rclid1!="")
				{
				   $ref_id123[]=$left_query->row()->user_id;
				   $ref_id123[]=$right_query->row()->user_id;
				   $nom_id_info=getNom($ref_id123);
				}
				else 
				{
					$nom_id_info['nom_id']=$sponserid;
			        $nom_id_info['nom_leg_position']=$posi;
				} 
			}
			else 
			{
			  //$nom_id=$query_obj->user_id; 
			  $nom_id_info['nom_id']=$query_obj->user_id;
			  if($left_count<=0)
			  {
			    $posi="Left";
			  }
			  else if($right_count<=0)
			  {
				$posi="Right";
			  }
			  else 
			  {
				$posi="Left";
			  }
			  $nom_id_info['nom_leg_position']=$posi;
			}
        }
		else 
		{
			$nom_id_info['nom_id']=$sponserid;
			$nom_id_info['nom_leg_position']=$posi;
		}
		if(empty($_SESSION['nom_id']))
		$_SESSION['nom_id']=$nom_id_info['nom_id'];
		if(empty($_SESSION['nom_leg_position']))
		$_SESSION['nom_leg_position']=$nom_id_info['nom_leg_position'];
		return $nom_id_info;
	}//end function
}//end function exists
/*function to show user on which level code ends here*/
if(!function_exists('level_countdd'))
{
	function level_countdd($user_id,$income_id)
	{
		$level=null;
		$obj=& get_instance();
		$query_obj=$obj->db->select('*')->from('user_registration')->where('user_id',$user_id)->get()->row();
		$nom_id=$query_obj->nom_id;
		$level=1;
		if($nom_id!=$income_id)
		{
			level_countdd($nom_id,$income_id);
			$level++;
		}
		else
		{
			$level=1;
		}
		return $level;
	}//end function
}//end function exists
/*function to show user on which level code ends here*/
/*
@author : Aditya
@param  : int(referral userid/sponsor user id), int($pkg_id)
@desc   : It's used to update the sponser rank and provide bonus for updated rank all the upliner rank
@return int(nom_id)
*/
if(!function_exists('updateRank'))
{
	function updateRank()
	{
      $obj=& get_instance();
      $query=$obj->db->select('*')->from('user_registration')->order_by('id')->get();
      foreach ($query->result() as $userObj) 
      {
      	$all_team_query=$obj->db->select('id')->from('level_income_binary')->where(array('income_id ='=>$userObj->user_id))->get();
      	$all_ref_query=$obj->db->select('user_id')->from('user_registration')->where(array('ref_id ='=>$userObj->user_id))->get();
      	$total_team_member=$all_team_query->num_rows();
      	$total_direct_member=$all_ref_query->num_rows();
      	$rank_obj=getRankDetails($total_direct_member,$total_team_member);
	    if(!empty($rank_obj) && $rank_obj!=null)
	      	{
			    if($userObj->rank_id!=$rank_obj->id)
			    {
			          ///////
			      	   $user_id=$userObj->user_id;
			      	   $bonus_amount=$rank_obj->bonus_amount;
			      	   $rank_name=$rank_obj->rank_name;
			           $obj->db->update('user_registration',array('rank_id'=>$rank_obj->id,'rank_name'=>$rank_name),array('user_id'=>$user_id));
			           //@Desc:It's used to manage rank log
			           //////////
			           $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$user_id)->get()->row();
				       
				       $balance=$query_obj->amount+$bonus_amount;
				       $obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id));


					   ///////////
					   //'1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
					   /*
			           Note: status field '0'=>debit,'1'=>credit
			           */
			           $transaction_no=generateUniqueTranNo();

					   $obj->db->insert('credit_debit',array(
						    'transaction_no'=>$transaction_no,
						    'user_id'=>$user_id,
						    'credit_amt'=>$bonus_amount,
						    'debit_amt'=>'0',
						    'balance'=>$balance,
						    'admin_charge'=>'0',
						    'receiver_id'=>$user_id,
						    'sender_id'=>COMP_USER_ID,
						    'receive_date'=>date('d-m-Y'),
						    'ttype'=>'Rank bonus amount',
						    'TranDescription'=>'bonus amount for update rank '.$rank_name,
						    'Cause'=>'bonus amount for update rank '.$rank_name,
						    'Remark'=>'bonus amount for update rank '.$rank_name,
						    'invoice_no'=>'',
						    'product_name'=>'',
						    'status'=>'1',
						    'ewallet_used_by'=>'',
						    'current_url'=>ci_site_url(),
						    'reason'=>'10'
					        ));

					 	$obj->db->insert('rank_log',array(
			           	'user_id'=>$user_id,
			           	'rank_id'=>$rank_obj->id,
			           	'rank_name'=>$rank_name,
			           	'transaction_no'=>$transaction_no
			           	));
  
			    }//end if          		
      	    }//end empty if here!
      }//end foreach	
   }//end function
}//end function exists
/*
@author : Aditya
@param  : int(direct_members), int(team_members)
@desc   : It's used to get the rank details for any user on the basis on total direct_members and total team_members
@return : assoc array
*/

if(!function_exists('getRankDetails'))
{
	function getRankDetails($direct_members=null,$team_members=null)
	{
	$obj=& get_instance();
	$data=array();
	$match=null;
	$total_members=$direct_members+$team_members;
	//$rank_query=mysql_query("select *,(direct_member+team_member) as total_members from rank as r order by total_members desc") or die(mysql_error());
    $rank_query=$obj->db->query("select *,(direct_member+team_member) as total_members from rank as r order by total_members desc");
	$total_member=array();
	if($rank_query->num_rows()>0)
	{
			foreach($rank_query->result() as $objs)
			{
			  $total_member[]=$objs;
			}
    }//end if
	if($rank_query->num_rows()>0)
	{
		for($i=0;$i<count($total_member);$i++)
		{
			$total=$total_member[$i]->total_members;
			if($total_members==$total)
			{
				if($team_members>=$total_member[$i]->team_member and $direct_members>=$total_member[$i]->direct_member)
				{
				$match=$total_member[$i];
				break;
				}
			}
			else if($total_members>$total)
			{
				if($team_members>=$total_member[$i]->team_member and $direct_members>=$total_member[$i]->direct_member)
				{
			    $match=$total_member[$i];
				break;
				}    
			}
		}
	}//end if
	$data=$match;
	return $data;
    }//end function
}//end function exists
if(!function_exists('creditDirectCommissionUpgrade'))
{
	function creditDirectCommissionUpgrade($sponser_id,$user_id,$pkg_id,$old_pkg_id,$pkg_amount)
	{
		$obj= & get_instance();
		$commission_info=$obj->db->select('*')->from('direct_commission_upgrade')->where(array(
		'from_pkg_id'=>$old_pkg_id,
		'to_pkg_id'=>$pkg_id
		))->get()->row();
		if(!empty($commission_info->type) && $commission_info->type>0)
		{
		    $commission_per=$commission_info->commission_upgrade;
		    $commission_pv=$commission_info->pv_upgrade;
		    $commission_amount=($commission_pv*$commission_per)/100;
		    $ttype="Referral Upgrade Bonus";
		    $TranDescription=$ttype.' via Package Purchase by '.$user_id;
		}
		else
		{
		    $commission_amount=$commission_info->commission;
		    $ttype="Referral Upgrade Bonus";
		    $TranDescription=$ttype.' via Package Purchase by '.$user_id;
		}
		
		
		if(!empty($commission_amount) && $commission_amount>0)
		{
		    $userdetails=$obj->db->select('pkg_id,stage_name')->from('user_registration as u')->where('u.user_id', $user_id)->get()->row();
           
            $stage_key=$userdetails->stage_name;
            
		    $udetails=$obj->db->select('pkg_id,stage_name')->from('user_registration as u')->where('u.user_id', $sponser_id)->get()->row();
            $ref_pkg_id=$udetails->pkg_id;
            
			$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$sponser_id,'wallet_type'=>'main','wallet_type_id'=>1))->get()->row();
			$balance=$query_obj->amount+$commission_amount;
			$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id,'wallet_type'=>'main','wallet_type_id'=>1));
			$obj->db->insert('credit_debit',array(
			    'transaction_no'=>generateUniqueTranNo(),
			    'user_id'=>$sponser_id,
			    'credit_amt'=>$commission_amount,
			    'debit_amt'=>'0',
			    'balance'=>$balance,
			    'admin_charge'=>'0',
			    'receiver_id'=>$sponser_id,
				'pkg_id'=>$pkg_id,
				'ref_pkg_id'=>$ref_pkg_id,
				'pkg_amount'=>$pkg_amount,
			    'sender_id'=>$user_id,
			    'receive_date'=>date('Y-m-d'),
			    'ttype'=>$ttype,
			    'TranDescription'=>$TranDescription,
			    'Cause'=>$TranDescription,
			    'Remark'=>$TranDescription,
			    'unique_identity'=>$stage_key,
			    'invoice_no'=>'',
			    'product_name'=>'main',
			    'deposit_id'=>1,
			    'status'=>'1',
			    'ewallet_used_by'=>'Withdrawal Wallet',
			    'current_url'=>site_url(),
			    'reason'=>'5' //credit for matrix direct commission
		        ));
			
		}//end commission not empty if
	}//end function
}//end function exists if
if(!function_exists('creditDirectCommission'))
{
	function creditDirectCommission($sponser_id,$user_id,$pkg_id,$pkg_amount,$knowledge_points=null)
	{
		$obj= & get_instance();
		$commission_info=$obj->db->select('*')->from('direct_commission_meta')->where(array(
		'level'=>1
		))->get()->row();
		if(!empty($commission_info->type) && $commission_info->type>0)
		{
		    $commission_per=$commission_info->commission;
		    $commission_amount=($pkg_amount*$commission_per)/100;
		    $ttype="Referral Bonus";
		    $TranDescription=$ttype.' via Package Purchase by '.$user_id;
		}
		else
		{
		    $commission_amount=$commission_info->commission;
		    $ttype="Referral Bonus";
		    $TranDescription=$ttype.' via Package Purchase by '.$user_id;
		}
		
		//echo $sponser_id.",".$user_id.",".$pkg_id.",".$pkg_amount;
		//echo $commission_amount; exit;
		if(!empty($commission_amount) && $commission_amount>0)
		{
		    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$sponser_id,'wallet_type'=>'main','wallet_type_id'=>1))->get()->row();
			$balance=$query_obj->amount+$commission_amount;
			$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id,'wallet_type'=>'main','wallet_type_id'=>1));
			$obj->db->insert('credit_debit',array(
			    'transaction_no'=>generateUniqueTranNo(),
			    'user_id'=>$sponser_id,
			    'credit_amt'=>$commission_amount,
			    'debit_amt'=>'0',
			    'balance'=>$balance,
			    'receiver_id'=>$sponser_id,
				'pkg_id'=>$pkg_id,
				'pkg_amount'=>$pkg_amount,
			    'sender_id'=>$user_id,
			    'receive_date'=>date('Y-m-d'),
			    'ttype'=>$ttype,
			    'TranDescription'=>$TranDescription,
			    'Cause'=>$TranDescription,
			    'Remark'=>$TranDescription,
			    'product_name'=>'main',
			    'deposit_id'=>1,
			    'status'=>'1',
			    'level'=>'1',
			    'ewallet_used_by'=>'Withdrawal Wallet',
			    'current_url'=>site_url(),
			    'reason'=>'5' //credit for matrix direct commission
		        ));
		}//end commission not empty if
	}//end function
}//end function exists if
////////////
/*
@author : Aditya
@param  : none
@desc   : It's used to register the user via ewallet user registration method
@return none
*/
function generateUniqueDepositRequestId()
	{
		$obj=& get_instance();
	    $random_number="Invest".mt_rand(100000, 999999);
	    if($obj->db->select('deposit_id')->from('deposit_investment_amount_request')->where('deposit_id',$random_number)->get()->num_rows()>0)
	    {
	      generateUniqueDepositRequestId();
	    }
	    return $random_number;
	}
if(!function_exists('freeUserRegistration'))
{
   function freeUserRegistration($registration_info=null)
   {
        $obj=& get_instance();
    	validRegistrationMethod();
        //$registerData=$obj->session->all_userdata();//open  and close comment
         /***********Mandatory filed for user registartion in binary plan start from here******************/
        ////user_registration query
        /*Sponsor and account informtaion*/
    	$registration_info=$obj->session->userdata('registration_info');
    	$sponser_id=(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456';
    	
    	$ref_leg_position=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:'left';
    	//////////////////
    	//$leg_posi=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:null;
	 
	    //$leg_posi=$new_member_data['binary_pos'];
	 
	    $leg_posi='auto';
	 
	 /*if(empty($leg_posi) || $leg_posi==null || $leg_posi=='' || $leg_posi=='auto')
     {
     	//$leg_posi=getLegPosition($sponser_id);
     	$ref_id123[]=$sponser_id;
		$leg_posi=getLegPosition1($ref_id123);
		$nom_id=getMatrixNom($ref_id123);
		$nom_id1=$nom_id;
		$nom_id2=$nom_id;
		
	 }
	 else 
	 {
		 getBinaryNom($sponser_id,$leg_posi);
		 $nom_id=$_SESSION['nom_id'];
		 $nom_id1=$nom_id;
		 $nom_id2=$nom_id;
	     $leg_posi=$_SESSION['nom_leg_position'];
	     unset($_SESSION['nom_id']);
	     unset($_SESSION['nom_leg_position']);	
	 }
	 $ref_id123[]=$sponser_id;
	getNom($ref_id123);
	$nom_id=$_SESSION['nom_id'];
	$nom_id1=$nom_id;
	unset($_SESSION['nom_id']);
	//////////////////
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:1;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:10500;*/
	$username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'O';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id=generateUserId();
	//personal informtaion
	$first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
	$last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
	$email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
	$contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:null;
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null;
	$gender=(!empty($registration_info['personal_info']['gender']))?$registration_info['personal_info']['gender']:1;
	//bank account info
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:null;
	$account_type = $registration_info['sponsor_and_account_info']['account_type'];

	$deposit_info=$obj->session->userdata('deposite_info');
	//pr($deposit_info); exit;
	$deposit_title=$deposit_info['deposit_title'];
	$deposit_amount=$deposit_info['deposit_amount'];
	/////////////////////////
    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
    		/*'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,*/
    		'username'=>$username,
    		'password'=>$user_password,
    		/*'t_code'=>$transaction_pwd,*/
    		/*'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			'ref_leg_position'=>$ref_leg_position,
			
			'nom_leg_position'=>$nom_leg_position,*/
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 'gender'=>$gender,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
    		 ////////
    		 'registration_date'=>date('d-m-Y'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'0',
    		 'registration_status'=>'0',
    		 'registration_method'=>'2',
			 'registration_method_name'=>'Free',
			 /*'binary_pos'=>$ref_leg_position,*/
			 'member_type'=>$account_type
    		);
    $obj->db->insert('user_registration',$user_registration_data);
    $user_login_data=array(
        'user_id'=>$user_id,
        'username'=>$username,
    	'password'=>$user_password,
    	/*'t_code'=>$transaction_pwd,*/
        );
    $obj->db->insert('user_login',$user_login_data);
    $obj->db->insert('final_e_wallet',array('user_id'=>$user_id,'amount'=>0,'wallet_type'=>'main','wallet_type_id'=>1)); 
	$obj->db->insert('final_reward_wallet',array('user_id'=>$user_id,'amount'=>0));
    
	//sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_username);
	//$upliner_name=get_user_name($nom_id1);
	//sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);
	return $user_id;
   }//end function
}//end function exists0


if(!function_exists('bankWireUserRegistration'))
{
   function bankWireUserRegistration($id=null)
   {
        $obj=& get_instance();
    	//validRegistrationMethod();
        //$registerData=$obj->session->all_userdata();//open  and close comment
         /***********Mandatory filed for user registartion in binary plan start from here******************/
        ////user_registration query
        /*Sponsor and account informtaion*/
        $registration_info=$obj->db->select('*')->from('bank_wired_user_registration')->where('id',$id)->get()->row();
        //pr($registration_info); exit;
    	//$registration_info=$obj->session->userdata('registration_info');
    	$sponser_id=(!empty($registration_info->ref_id))?$registration_info->ref_id:'123456';
    	$upliner_id=(!empty($registration_info->upline_id))?$registration_info->upline_id:'123456';
    	
    	$ref_leg_position=(!empty($registration_info->ref_leg_position))?$registration_info->ref_leg_position:'Left';
    	//////////////////
    	$leg_posi=(!empty($registration_info->ref_leg_position))?$registration_info->ref_leg_position:'Left';
	 
	    //$leg_posi=$new_member_data['binary_pos'];
	 
	    //$leg_posi='auto';
	 //echo $registration_info->ref_leg_position; exit;
	 if(empty($leg_posi) || $leg_posi==null || $leg_posi=='' || $leg_posi=='auto')
     {
     	//$leg_posi=getLegPosition($sponser_id);
     	if($upliner_id!='')
     	{
     	   $ref_id123[]=$upliner_id; 
     	}
     	else
     	{
     	   $ref_id123[]=$sponser_id; 
     	}
     	
		$leg_posi=getLegPosition1($ref_id123);
		$nom_id=getMatrixNom($ref_id123);
		//echo $nom_id; exit;
		$nom_id1=$nom_id;
		$nom_id2=$nom_id;
		
	 }
	 else 
	 {
	     if($upliner_id!='')
     	{
     	   $sponser_id123=$upliner_id; 
     	}
     	else
     	{
     	   $sponser_id123=$sponser_id; 
     	}
		 getBinaryNom($sponser_id123,$leg_posi);
		 $nom_id=$_SESSION['nom_id'];
		 $nom_id1=$nom_id;
		 $nom_id2=$nom_id;
	     $leg_posi=$_SESSION['nom_leg_position'];
	     unset($_SESSION['nom_id']);
	     unset($_SESSION['nom_leg_position']);	
	 }
	//$ref_id123[]=$sponser_id;
	//getNom($ref_id123);
	//$nom_id=$_SESSION['nom_id'];
	//echo $nom_id; exit;
	//$nom_id1=$nom_id;
	//unset($_SESSION['nom_id']);
	//////////////////
	$pkg_id=(!empty($registration_info->platform))?$registration_info->platform:1;
	$pkg_amount=(!empty($registration_info->package_fee))?$registration_info->package_fee:10500;
	$username=(!empty($registration_info->username))?$registration_info->username:'O';
	$user_password=(!empty($registration_info->password))?$registration_info->password:'123';
	$transaction_pwd=(!empty($registration_info->t_code))?$registration_info->t_code:'123';
    $user_id=generateUserId();
	//personal informtaion
	$first_name=(!empty($registration_info->first_name))?$registration_info->first_name:null;
	$last_name=(!empty($registration_info->last_name))?$registration_info->last_name:null;
	$email=(!empty($registration_info->email))?$registration_info->email:null;
	$contact_no=(!empty($registration_info->contact_no))?$registration_info->contact_no:null;
	$country=(!empty($registration_info->country))?$registration_info->country:null;
	$state=(!empty($registration_info->state))?$registration_info->state:null;
	$city=(!empty($registration_info->city))?$registration_info->city:null;
	$zip_code=(!empty($registration_info->zip_code))?$registration_info->zip_code:null;
	$address_line1=(!empty($registration_info->address_line1))?$registration_info->address_line1:null;
	$date_of_birth=(!empty($registration_info->date_of_birth))?$registration_info->date_of_birth:null;
	$gender=(!empty($registration_info->gender))?$registration_info->gender:1;
	//bank account info
	$account_holder_name=(!empty($registration_info->account_holder_name))?$registration_info->account_holder_name:null;
	$account_no=(!empty($registration_info->account_no))?$registration_info->account_no:null;
	$bank_name=(!empty($registration_info->bank_name))?$registration_info->bank_name:null;
	$branch_name=(!empty($registration_info->branch_name))?$registration_info->branch_name:null;
	$ifsc_code=(!empty($registration_info->ifsc_code))?$registration_info->ifsc_code:null;
    $stockist_id=(!empty($registration_info->stockist_id))?$registration_info->stockist_id:null;

	/////////////////////////
    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'parent_id'=>$stockist_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			'ref_leg_position'=>$ref_leg_position,
			'nom_leg_position'=>$nom_leg_position,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 'gender'=>$gender,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
    		 ////////
    		 'registration_date'=>date('d-m-Y'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
    		 'registration_status'=>'0',
    		 'registration_method'=>'2',
			 'registration_method_name'=>'Free',
			 'binary_pos'=>$leg_posi,
			 'member_type'=>'1'
    		);
    		
    		//pr($user_registration_data); exit;
    $obj->db->insert('user_registration',$user_registration_data);
    $user_login_data=array(
        'user_id'=>$user_id,
        'username'=>$username,
    	'password'=>$user_password,
    	't_code'=>$transaction_pwd,
        );
    $obj->db->insert('user_login',$user_login_data);
    $obj->db->insert('final_e_wallet',array('user_id'=>$user_id,'amount'=>0,'wallet_type'=>'main','wallet_type_id'=>1)); 
	$obj->db->insert('final_product_wallet',array('user_id'=>$user_id,'amount'=>0));
	$obj->db->insert('final_reward_wallet',array('user_id'=>$user_id,'amount'=>0));
    
    $spninfo=$obj->db->select('idno')->from('user_registration')->where(array('user_id'=>$sponser_id))->get()->row();
    /////Inserting Data into user_package_log table///////////
    $obj->db->insert('user_package_log',array(
    	'user_id'=>$user_id,
    	'new_package_id'=>$pkg_id,
    	'active_status'=>'1',
    	'purchased_date'=>date('Y-m-d H:i:s')
    	));

	$obj->db->insert('package_sold_amount',array(
	'user_id'=>$user_id,
	'pkg_id'=>$pkg_id,
	'pkg_amount'=>$pkg_amount
	));

	$tran_password=$transaction_pwd;
	
     /***********Mandatory filed for user registartion in matrix plan end over here******************/
    $level=1;
	 ///inserting data into level income binary with status zero from here
	$level_income_binary_data=array();
	$nom_id_forpv=$nom_id;
	$leg_posibinary=$leg_posi;
	while($nom_id!='cmp')
	{
				if($nom_id!='cmp')
				{
    				$level_income_binary_data[]=array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posibinary,'status'=>'0','level'=>$level);
    				//$obj->db->insert('level_income_binary',array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posi,'status'=>'0','level'=>$level));
    				$level++;
    				$query_obj=$obj->db->select('*')->from('user_registration')->where('user_id',$nom_id)->get()->row();
    				$leg_posibinary=$query_obj->binary_pos;
    				$nom_id=$query_obj->nom_id;
    				//echo $obj->db->error()['message'];
				}
	}//end while $nom!=cmp
	$obj->db->insert_batch('level_income_binary',$level_income_binary_data);
	if($spninfo->idno=='Free')
	{
	    
	}
	else
	{
    	$levelpv=1;
    	$query_obj_pv=$obj->db->select('*')->from('package')->where('id',$pkg_id)->get()->row();
    	$pv=$query_obj_pv->pv;
    	$leg_posi_pv=$leg_posi;
    	while($nom_id_forpv!='cmp')
    	{
    				if($nom_id_forpv!='cmp')
    				{
    				    $pkg_obj=$obj->db->select('pkg_id')->from('user_registration')->where('user_id',$nom_id_forpv)->get()->row();
    				    $pkgid=$pkg_obj->pkg_id;
    				    if($pkgid>1)
    				    {
        				    $pv_data[]=array('down_id'=>$user_id,'income_id'=>$nom_id_forpv,'leg'=>$leg_posi_pv,'pv'=>$pv,'status'=>'0','type'=>'register','level'=>$levelpv);
    				    }
        				//$obj->db->insert('level_income_binary',array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posi,'status'=>'0','level'=>$level));
        				$levelpv++;
        				$query_obj=$obj->db->select('*')->from('user_registration')->where('user_id',$nom_id_forpv)->get()->row();
        				$leg_posi_pv=$query_obj->binary_pos;
        				$nom_id_forpv=$query_obj->nom_id;
        				//echo $obj->db->error()['message'];
    				}
    	}//end while $nom!=cmp
    	$obj->db->insert_batch('matrix_downline_pv',$pv_data);
	}
    $l=1;

    /***********Mandatory filed for user registartion in matrix plan end over here******************/
   
	
$l=1;
    $drefid_id=$sponser_id;
    while($drefid_id!='cmp')
	{
        if($drefid_id!='cmp')
        {
        	$direct_downline_data[]=array(
        		'down_id'=>$user_id,
        		'income_id'=>$drefid_id,
        		'l_date'=>date('Y-m-d H:i:s'),
        		'status'=>'0',
        		'level'=>$l,
        		'pay_status'=>'Unpaid',
        		'plan_type'=>$pkg_id
        		);
        		
			$l++;
             $nom_info=$obj->db->select('ref_id')->from('user_registration')->where('user_id',$drefid_id)->get()->row();
             $drefid_id=$nom_info->ref_id;
			}
	}
	$obj->db->insert_batch('direct_matrix_downline',$direct_downline_data);
	
	//matrix_commission_level($user_id,'matrix_downline',$pkg_id);
	//creditDirectCommission($sponser_id,$user_id,$pkg_id,$pkg_amount);
	//////////Code for level pay status//////////////
	if($spninfo->idno=='Free')
	{
	    
	}
	else
	{
    	matrix_commission_direct($user_id,'direct_matrix_downline',$pkg_id,$pkg_amount);
    	fast_start_bonus($sponser_id);
    	//creditBinaryLevelCommission($user_id);
	}
	/*matrix_commission_direct($user_id,'direct_matrix_downline',$pkg_id,$pkg_amount);
	fast_start_bonus($sponser_id);
	creditBinaryLevelCommission($user_id);*/
	///////////////////////////
	//check_upliners1($user_id,$pkg_id);
	$cart_reg=(!empty($registration_info->cart_reg))?$registration_info->cart_reg:null;
	$cart_reg_final_price=0;
	$total_products=(!empty($registration_info->total_products))?$registration_info->total_products:null;
	if(!empty($cart_reg) && !empty($total_products))
				{
				$cart_reg1=json_decode($cart_reg);
				$cart=(object)$cart_reg1;
				$order_id=generateUniqueOrderId();
				//	pr($cart); exit;
				$bonus_date=date('Y-m-d');
				$total_pv=0;
				foreach($cart as $product)
				{
					$product=(object)$product;
					$product_stock_info=$obj->db->select(array('qty','total_order','guest_point','new_price'))->from('eshop_products')->where('id',$product->product_id)->get()->row();
					$final_stock=$product_stock_info->qty-$product->qty;
					$total_order=$product_stock_info->total_order+1;
					$guest_point=$product_stock_info->guest_point;
					$new_price=$product_stock_info->new_price;
					$cart_reg_final_price=$cart_reg_final_price+($product_stock_info->new_price*$product->qty);
				    $obj->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product->product_id));
				
					$product_id=$product->product_id;
					//$cart_final_price=$cart_reg_final_price;
					$pv=$guest_point*$product->qty;
					$total_pv=$total_pv+$pv;
				}
				//exit;
				
				
				$cart_final_price=$cart_reg_final_price;
				//$cart_final_bv=$this->session->userdata('cart_final_bv');
				$obj->db->insert('eshop_orders',array(
				'order_id'=>$order_id,
				'role'=>(string)$role,
				'user_id'=>$user_id,
				'owner_user_id'=>$stockist_id,
				'guest_id'=>$guest_id,
				'order_details'=>$cart_reg,
				'order_from'=>'register',
				'total_products'=>$total_products,
				'discount'=>0,
				'final_price'=>$cart_final_price,
				'final_pv'=>$total_pv,
				'payment_method'=>'2'
				));
				
				
				/////////////////////
				$nom_info=$obj->db->select('*')->from('user_registration')->where(array('user_id'=>$user_id))->get()->row();
				$obj->db->insert('eshop_guest_delivery_address',array(
					'role'=>2,
					'guest_id'=>$user_id,
					'name'=>$nom_info->first_name.' '.$nom_info->last_name,
					'mobile_no'=>$nom_info->contact_no,
					'address'=>$nom_info->address,
					'city'=>$nom_info->city,
					'order_id'=>$order_id,
					'state'=>$nom_info->state,
					'crate_date'=>date('Y-m-d'),
					'type'=>'0'
					));
				
			}
	/*************/
	$sponsor_username=get_user_name($sponser_id);
	//sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_username);
	//$upliner_name=get_user_name($nom_id1);
	//sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);
	return $user_id;
   }//end function
}//end function exists0

function generateUniqueOrderId()
	{
	    $obj=& get_instance();
	    $random_number="OR".mt_rand(100000, 999999);
	    if($obj->db->select('order_id')->from('eshop_orders')->where('order_id',$random_number)->get()->num_rows()>0)
	    {
	      $obj->generateUniqueOrderId();
	    }
	    return $random_number;
	}
	
if(!function_exists('affiliateUserRegistration'))
{
   function affiliateUserRegistration($registration_info=null)
   {
        $obj=& get_instance();
    	validRegistrationMethod();
        //$registerData=$obj->session->all_userdata();//open  and close comment
         /***********Mandatory filed for user registartion in binary plan start from here******************/
        ////user_registration query
        /*Sponsor and account informtaion*/
    	$registration_info=$obj->session->userdata('registration_info');
    	
    	$sponser_id=(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456';
    	$upliner_id=(!empty($registration_info['sponsor_and_account_info']['upline_id']))?$registration_info['sponsor_and_account_info']['upline_id']:'123456';
    	
    	$ref_leg_position=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:'Left';
    	//////////////////
    	$leg_posi=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:'Left';
	    //echo $leg_posi; exit;
	    //$leg_posi=$new_member_data['binary_pos'];
	 
	    //$leg_posi='auto';
	 //echo $sponser_id.','.$leg_posi; exit;
    	 if(empty($leg_posi) || $leg_posi==null || $leg_posi=='' || $leg_posi=='auto')
         {
         	//$leg_posi=getLegPosition($sponser_id);
         	if($upliner_id!='')
         	{
         	   $ref_id123[]=$upliner_id; 
         	}
         	else
         	{
         	   $ref_id123[]=$sponser_id; 
         	}
         	
    		$leg_posi=getLegPosition1($ref_id123);
    		$nom_id=getMatrixNom($ref_id123);
    		//echo $nom_id; exit;
    		$nom_id1=$nom_id;
    		$nom_id2=$nom_id;
    		
    	 }
    	 else 
    	 {
    	     if($upliner_id!='')
         	{
         	   $sponser_id123=$upliner_id; 
         	}
         	else
         	{
         	   $sponser_id123=$sponser_id; 
         	}
    		 getBinaryNom($sponser_id123,$leg_posi);
    		 $nom_id=$_SESSION['nom_id'];
    		 $nom_id1=$nom_id;
    		 $nom_id2=$nom_id;
    	     $leg_posi=$_SESSION['nom_leg_position'];
    	     unset($_SESSION['nom_id']);
    	     unset($_SESSION['nom_leg_position']);	
    	 }
	 
	 
	 /*$ref_id123[]=$sponser_id;
	getNom($ref_id123);
	$nom_id=$_SESSION['nom_id'];
	$nom_id1=$nom_id;
	unset($_SESSION['nom_id']);*/
	//////////////////
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:1;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:20;
	$username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'O';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id=generateUserId();
	//personal informtaion
	$first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
	$last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
	$email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
	$contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:null;
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null;
	$gender=(!empty($registration_info['personal_info']['gender']))?$registration_info['personal_info']['gender']:1;
	//bank account info
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:null;

    $stockist_id=(!empty($registration_info['sponsor_and_account_info']['stockist_id']))?$registration_info['sponsor_and_account_info']['stockist_id']:1;
	

	/////////////////////////
    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'parent_id'=>$stockist_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			'ref_leg_position'=>$ref_leg_position,
			'nom_leg_position'=>$ref_leg_position,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 'gender'=>$gender,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
    		 ////////
    		 'registration_date'=>date('d-m-Y'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
    		 'registration_status'=>'0',
    		 'registration_method'=>'2',
			 'registration_method_name'=>'Free',
			 'binary_pos'=>$leg_posi,
			 'member_type'=>'1'
    		);
    		
    		//pr($user_registration_data); exit;
    $obj->db->insert('user_registration',$user_registration_data);
    $user_login_data=array(
        'user_id'=>$user_id,
        'username'=>$username,
    	'password'=>$user_password,
    	't_code'=>$transaction_pwd,
        );
    $obj->db->insert('user_login',$user_login_data);
    $obj->db->insert('final_e_wallet',array('user_id'=>$user_id,'amount'=>0,'wallet_type'=>'main','wallet_type_id'=>1)); 
	$obj->db->insert('final_product_wallet',array('user_id'=>$user_id,'amount'=>0));
	$obj->db->insert('final_reward_wallet',array('user_id'=>$user_id,'amount'=>0));
    
    $spninfo=$obj->db->select('idno')->from('user_registration')->where(array('user_id'=>$sponser_id))->get()->row();
    /////Inserting Data into user_package_log table///////////
    $obj->db->insert('user_package_log',array(
    	'user_id'=>$user_id,
    	'new_package_id'=>$pkg_id,
    	'active_status'=>'1',
    	'purchased_date'=>date('Y-m-d H:i:s')
    	));

	$obj->db->insert('package_sold_amount',array(
	'user_id'=>$user_id,
	'pkg_id'=>$pkg_id,
	'pkg_amount'=>$pkg_amount
	));

	$tran_password=$transaction_pwd;
	
     /***********Mandatory filed for user registartion in matrix plan end over here******************/
    $level=1;
	 ///inserting data into level income binary with status zero from here
	$level_income_binary_data=array();
	$nom_id_forpv=$nom_id;
	$leg_posibinary=$leg_posi;
	while($nom_id!='cmp')
	{
				if($nom_id!='cmp')
				{
    				$level_income_binary_data[]=array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posibinary,'status'=>'0','level'=>$level);
    				//$obj->db->insert('level_income_binary',array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posi,'status'=>'0','level'=>$level));
    				$level++;
    				$query_obj=$obj->db->select('*')->from('user_registration')->where('user_id',$nom_id)->get()->row();
    				$leg_posibinary=$query_obj->binary_pos;
    				$nom_id=$query_obj->nom_id;
    				//echo $obj->db->error()['message'];
				}
	}//end while $nom!=cmp
	$obj->db->insert_batch('level_income_binary',$level_income_binary_data);
	if($spninfo->idno=='Free')
	{
	    
	}
	else
	{
    	$levelpv=1;
    	$query_obj_pv=$obj->db->select('*')->from('package')->where('id',$pkg_id)->get()->row();
    	$pv=$query_obj_pv->pv;
    	$leg_posi_pv=$leg_posi;
    	while($nom_id_forpv!='cmp')
    	{
    				if($nom_id_forpv!='cmp')
    				{
    				    $pkg_obj=$obj->db->select('pkg_id')->from('user_registration')->where('user_id',$nom_id_forpv)->get()->row();
    				    $pkgid=$pkg_obj->pkg_id;
    				    if($pkgid>1)
    				    {
        				    $pv_data[]=array('down_id'=>$user_id,'income_id'=>$nom_id_forpv,'leg'=>$leg_posi_pv,'pv'=>$pv,'status'=>'0','type'=>'register','level'=>$levelpv);
    				    }
        				//$obj->db->insert('level_income_binary',array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posi,'status'=>'0','level'=>$level));
        				$levelpv++;
        				$query_obj=$obj->db->select('*')->from('user_registration')->where('user_id',$nom_id_forpv)->get()->row();
        				$leg_posi_pv=$query_obj->binary_pos;
        				$nom_id_forpv=$query_obj->nom_id;
        				//echo $obj->db->error()['message'];
    				}
    	}//end while $nom!=cmp
    	$obj->db->insert_batch('matrix_downline_pv',$pv_data);
    }
    $l=1;

    /***********Mandatory filed for user registartion in matrix plan end over here******************/
   
	
$l=1;
    $drefid_id=$sponser_id;
    while($drefid_id!='cmp')
	{
        if($drefid_id!='cmp')
        {
        	$direct_downline_data[]=array(
        		'down_id'=>$user_id,
        		'income_id'=>$drefid_id,
        		'l_date'=>date('Y-m-d H:i:s'),
        		'status'=>'0',
        		'level'=>$l,
        		'pay_status'=>'Unpaid',
        		'plan_type'=>$pkg_id
        		);
        		
			$l++;
             $nom_info=$obj->db->select('ref_id')->from('user_registration')->where('user_id',$drefid_id)->get()->row();
             $drefid_id=$nom_info->ref_id;
			}
	}
	$obj->db->insert_batch('direct_matrix_downline',$direct_downline_data);
	
	//matrix_commission_level($user_id,'matrix_downline',$pkg_id);
	//creditDirectCommission($sponser_id,$user_id,$pkg_id,$pkg_amount);
	//////////Code for level pay status//////////////
	/*matrix_commission_direct($user_id,'direct_matrix_downline',$pkg_id,$pkg_amount);
	fast_start_bonus($sponser_id);
	creditBinaryLevelCommission($user_id);*/
	
	if($spninfo->idno=='Free')
	{
	    $obj->db->insert('userfreelog',array('ref_id'=>$sponser_id,'user_id'=>$user_id));
	}
	else
	{
    	matrix_commission_direct($user_id,'direct_matrix_downline',$pkg_id,$pkg_amount);
    	fast_start_bonus($sponser_id);
    	//creditBinaryLevelCommission($user_id);
	}
	///////////////////////////
	//check_upliners1($user_id,$pkg_id);
	
	$cart_reg=(!empty($registration_info['sponsor_and_account_info']['cart_reg']))?$registration_info['sponsor_and_account_info']['cart_reg']:1;//(!empty($registration_info->cart_reg))?$registration_info->cart_reg:null;
	$cart_reg_final_price=0;
	$total_products=(!empty($registration_info['sponsor_and_account_info']['total_products']))?$registration_info['sponsor_and_account_info']['total_products']:1;//(!empty($registration_info->total_products))?$registration_info->total_products:null;
	if(!empty($cart_reg) && !empty($total_products))
	{
				$cart_reg1=json_decode($cart_reg);
				$cart=(object)$cart_reg1;
				$order_id=generateUniqueOrderId();
				//	pr($cart); exit;
				$bonus_date=date('Y-m-d');
				$total_pv=0;
				foreach($cart as $product)
				{
					$product=(object)$product;
					$product_stock_info=$obj->db->select(array('qty','total_order','guest_point','new_price'))->from('eshop_products')->where('id',$product->product_id)->get()->row();
					$final_stock=$product_stock_info->qty-$product->qty;
					$total_order=$product_stock_info->total_order+1;
					$guest_point=$product_stock_info->guest_point;
					$new_price=$product_stock_info->new_price;
					$cart_reg_final_price=$cart_reg_final_price+($product_stock_info->new_price*$product->qty);
				    $obj->db->update('eshop_products',array('qty'=>$final_stock,'total_order'=>$total_order),array('id'=>$product->product_id));
				
					$product_id=$product->product_id;
					//$cart_final_price=$cart_reg_final_price;
					$pv=$guest_point*$product->qty;
					$total_pv=$total_pv+$pv;
				}
				//exit;
				
				
				$cart_final_price=$cart_reg_final_price;
				//$cart_final_bv=$this->session->userdata('cart_final_bv');
				$obj->db->insert('eshop_orders',array(
				'order_id'=>$order_id,
				'role'=>(string)$role,
				'user_id'=>$user_id,
				'owner_user_id'=>$stockist_id,
				/*'guest_id'=>$guest_id,*/
				'order_from'=>'register',
				'order_details'=>$cart_reg,
				'total_products'=>$total_products,
				'discount'=>0,
				'final_price'=>$cart_final_price,
				'final_pv'=>$total_pv,
				'payment_method'=>'2'
				));
				
				
				/////////////////////
				$nom_info=$obj->db->select('*')->from('user_registration')->where(array('user_id'=>$user_id))->get()->row();
				$obj->db->insert('eshop_guest_delivery_address',array(
					'role'=>2,
					'guest_id'=>$user_id,
					'name'=>$nom_info->first_name.' '.$nom_info->last_name,
					'mobile_no'=>$nom_info->contact_no,
					'address'=>$nom_info->address,
					'city'=>$nom_info->city,
					'order_id'=>$order_id,
					'state'=>$nom_info->state,
					'crate_date'=>date('Y-m-d'),
					'type'=>'0'
					));
				
			}
	
	$sponsor_username=get_user_name($sponser_id);
	//sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_username);
	//$upliner_name=get_user_name($nom_id1);
	//sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);
	return $user_id;
   }//end function
}//end function exists0

if(!function_exists('schoolUserRegistration'))
{
   function schoolUserRegistration($registration_info=null)
   {
        $obj=& get_instance();
    	validRegistrationMethod();
        //$registerData=$obj->session->all_userdata();//open  and close comment
         /***********Mandatory filed for user registartion in binary plan start from here******************/
        ////user_registration query
        /*Sponsor and account informtaion*/
    	$registration_info=$obj->session->userdata('registration_info');
    	$sponser_id=(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456';
    	
    	$ref_leg_position=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:'left';
    	//////////////////
    	$leg_posi=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:null;
	 
	    //$leg_posi=$new_member_data['binary_pos'];
	 
	    //$leg_posi='auto';
	 
	 /*if(empty($leg_posi) || $leg_posi==null || $leg_posi=='' || $leg_posi=='auto')
     {
     	//$leg_posi=getLegPosition($sponser_id);
     	$ref_id123[]=$sponser_id;
		$leg_posi=getLegPosition1($ref_id123);
		$nom_id=getMatrixNom($ref_id123);
		$nom_id1=$nom_id;
		$nom_id2=$nom_id;
		
	 }
	 else 
	 {
		 getBinaryNom($sponser_id,$leg_posi);
		 $nom_id=$_SESSION['nom_id'];
		 $nom_id1=$nom_id;
		 $nom_id2=$nom_id;
	     $leg_posi=$_SESSION['nom_leg_position'];
	     unset($_SESSION['nom_id']);
	     unset($_SESSION['nom_leg_position']);	
	 }*/
	//////////////////
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:1;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:10500;
	$username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'O';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id=generateUserId();
	//personal informtaion
	$first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
	$last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
	$email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
	$contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:null;
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null;
	$gender=(!empty($registration_info['personal_info']['gender']))?$registration_info['personal_info']['gender']:1;
	
	$contact_person=(!empty($registration_info['personal_info']['contact_person']))?$registration_info['personal_info']['contact_person']:null;
	$contact_person_email=(!empty($registration_info['personal_info']['contact_person_email']))?$registration_info['personal_info']['contact_person_email']:null;
	$contact_person_phone=(!empty($registration_info['personal_info']['contact_person_phone']))?$registration_info['personal_info']['contact_person_phone']:null;
	
	//bank account info
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:null;

	$deposit_info=$obj->session->userdata('deposite_info');
	//pr($deposit_info); exit;
	$deposit_title=$deposit_info['deposit_title'];
	$deposit_amount=$deposit_info['deposit_amount'];
	/////////////////////////
    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
    		'ref_id'=>$sponser_id,
    		/*'nom_id'=>$nom_id,*/
    		'username'=>$username,
    		'password'=>$user_password,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			'contact_person'=>$contact_person,
			'contact_person_email'=>$contact_person_email,
			'contact_person_phone'=>$contact_person_phone,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 'gender'=>$gender,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
    		 ////////
    		 'registration_date'=>date('d-m-Y'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
    		 'registration_status'=>'0',
    		 'registration_method'=>'2',
			 'registration_method_name'=>'E-Pin',
			 'member_type'=>'2'
    		);
    $obj->db->insert('user_school',$user_registration_data);
    $obj->db->insert('user_login',array('user_id'=>$user_id,'username'=>$username,'password'=>$user_password,'status'=>2,'active_status'=>1));
    $obj->db->insert('final_e_wallet',array('user_id'=>$user_id,'amount'=>0,'wallet_type'=>'main','wallet_type_id'=>1)); 
	//$obj->db->insert('shopping_e_wallet',array('user_id'=>$user_id,'amount'=>0));
    
    
    /////Inserting Data into user_package_log table///////////
    /*$obj->db->insert('user_package_log',array(
    	'user_id'=>$user_id,
    	'new_package_id'=>$pkg_id,
    	'active_status'=>'1',
    	'purchased_date'=>date('Y-m-d H:i:s')
    	));

	$obj->db->insert('package_sold_amount',array(
	'user_id'=>$user_id,
	'pkg_id'=>$pkg_id,
	'pkg_amount'=>$pkg_amount
	));*/

	$tran_password=$transaction_pwd;
	
     /***********Mandatory filed for user registartion in matrix plan end over here******************/
    $level=1;
	 ///inserting data into level income binary with status zero from here
	
    /***********Mandatory filed for user registartion in matrix plan end over here******************/
    $l=1;
	
	
    /*$l=1;
    while($sponser_id!='cmp')
	{
        if($sponser_id!='cmp')
        {
        	$direct_downline_data[]=array(
        		'down_id'=>$user_id,
        		'income_id'=>$sponser_id,
        		'l_date'=>date('Y-m-d H:i:s'),
        		'status'=>'0',
        		'level'=>$l,
        		'pay_status'=>'Unpaid',
        		'plan_type'=>$pkg_id
        		);
        		
			$l++;
             $nom_info=$obj->db->select('ref_id')->from('user_registration')->where('user_id',$sponser_id)->get()->row();
             $sponser_id=$nom_info->ref_id;
			}
	}*/
	//$obj->db->insert_batch('direct_matrix_downline',$direct_downline_data);
	//matrix_commission_level($user_id,'matrix_downline',$pkg_id);
	//creditDirectCommission($sponser_id,$user_id,$pkg_id,$pkg_amount);
	//////////Code for level pay status//////////////
	//matrix_commission_level($user_id,'matrix_downline',$pkg_id);
	///////////////////////////
	//check_upliners1($user_id,$pkg_id);
	/*************/
	$sponsor_username=get_user_name($sponser_id);
	//sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_username);
	//$upliner_name=get_user_name($nom_id1);
	//sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);
	return $user_id;
   }//end function
}//end function exists0

if(!function_exists('ewalletUserRegistration'))
{
   function ewalletUserRegistration($registration_info=null)
   {
    $obj=& get_instance();
    //$registerData=$obj->session->all_userdata();//open  and close comment
     /***********Mandatory filed for user registartion in binary plan start from here******************/
    ////user_registration query
    /*Sponsor and account informtaion*/
    if(empty($registration_info))
	{
		$registration_info=$obj->session->userdata('registration_info');
	}
	$sponser_id=(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456';
	 
	 $leg_posi=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:null;
	 
	 //$leg_posi=$new_member_data['binary_pos'];
	 
	 $leg_posi='auto';
	 
	 if(empty($leg_posi) || $leg_posi==null || $leg_posi=='' || $leg_posi=='auto')
     {
     	//$leg_posi=getLegPosition($sponser_id);
     	$ref_id123[]=$sponser_id;
		$leg_posi=getLegPosition1($ref_id123);
		$nom_id=getMatrixNom($ref_id123);
		$nom_id1=$nom_id;
		$nom_id2=$nom_id;
		
	 }
	 else 
	 {
		 getBinaryNom($sponser_id,$leg_posi);
		 $nom_id=$_SESSION['nom_id'];
		 $nom_id1=$nom_id;
		 $nom_id2=$nom_id;
	     $leg_posi=$_SESSION['nom_leg_position'];
	     unset($_SESSION['nom_id']);
	     unset($_SESSION['nom_leg_position']);	
	 }
	/*********************/
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:1;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:2000;
	$knowledge_points=(!empty($registration_info['sponsor_and_account_info']['knowledge_points']))?$registration_info['sponsor_and_account_info']['knowledge_points']:2000;
	$package_fee=$pkg_amount;
	$username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'A4';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id=generateUserId();
	//personal informtaion
	$first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
	$last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
	$email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
	$contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:null;
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null;
	//bank account info
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:null;
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
	/////

    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			'binary_pos'=>$leg_posi,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
    		 ////////
    		 'registration_date'=>date('d-m-Y'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
			 'registration_method'=>'1',
			 'registration_method_name'=>'E-Wallet'
    		);
    $obj->db->insert('user_registration',$user_registration_data);
    $obj->db->insert('final_e_wallet',array('user_id'=>$user_id,'amount'=>0,'wallet_type_id'=>1,'wallet_type'=>'main')); 
	//$obj->db->insert('secondry_e_wallet',array('user_id'=>$user_id,'amount'=>0));
	//$obj->db->insert('point_e_wallet',array('user_id'=>$user_id,'amount'=>0));	
       
	$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$sponser_id,'wallet_type_id'=>1))->get()->row();
	
	$balance=$query_obj->amount-$pkg_amount;
	
	$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id,'wallet_type_id'=>1));
	
	
	
	//'1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
	/*
	Note:status field '0'=>debit,'1'=>credit
	*/
	$obj->db->insert('credit_debit',array(
	    'transaction_no'=>generateUniqueTranNo(),
	    'user_id'=>$sponser_id,
	    'credit_amt'=>'0',
	    'debit_amt'=>$pkg_amount,
	    'balance'=>$balance,
	    'admin_charge'=>'0',
	    'receiver_id'=>$user_id,
	    'sender_id'=>$sponser_id,
	    'receive_date'=>date('Y-m-d'),
	    'ttype'=>'Package Purchased',
	    'TranDescription'=>'Package Purchase by '.$user_id,
	    'Cause'=>'Package Purchase by '.$user_id,
	    'Remark'=>'Package Purchase by '.$user_id,
	    'invoice_no'=>'',
	    'product_name'=>'main',
	    'deposit_id'=>1,
	    'status'=>'0',
	    'ewallet_used_by'=>'Withdrawal Wallet',
	    'current_url'=>ci_site_url(),
	    'reason'=>'1'
        ));
	//////////////Sign Up Bonus////////////////	
		$sign_up_bonus=($pkg_amount*10)/100;
		
	/////Inserting Data into user_package_log table///////////
	$obj->db->insert('user_package_log',array(
    	'user_id'=>$user_id,
    	'new_package_id'=>$pkg_id,
    	'active_status'=>'1',
    	'purchased_date'=>date('Y-m-d H:i:s')
		));
		
	//$query_obj=$obj->db->select('amount')->from('point_e_wallet')->where('user_id',$sponser_id)->get()->row();
	
	//$balance=$query_obj->amount+1200;
	
	//$obj->db->update('point_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id));	
	/***********Mandatory filed for user registartion in binary plan end over here******************/
	$level=1;
	 ///inserting data into level income binary with status zero from here
	$level_income_binary_data=array();
	while($nom_id!='cmp')
	{
				if($nom_id!='cmp')
				{
    				$level_income_binary_data[]=array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posi,'status'=>'0','level'=>$level);
    				//$obj->db->insert('level_income_binary',array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posi,'status'=>'0','level'=>$level));
    				$level++;
    				$query_obj=$obj->db->select('*')->from('user_registration')->where('user_id',$nom_id)->get()->row();
    				$leg_posi=$query_obj->binary_pos;
    				$nom_id=$query_obj->nom_id;
				}
	}//end while $nom!=cmp
	$obj->db->insert_batch('level_income_binary',$level_income_binary_data);
	

    
     /***********Mandatory filed for user registartion in matrix plan end over here******************/
    $l=1;
	$nom_id=$nom_id1;
	while($nom_id!='cmp')
	{
        if($nom_id!='cmp')
        {
        	$matrix_downline_data[]=array(
        		'down_id'=>$user_id,
        		'income_id'=>$nom_id,
        		'l_date'=>date('Y-m-d H:i:s'),
        		'status'=>'0',
        		'level'=>$l,
        		'pay_status'=>'Unpaid',
        		'plan_type'=>$pkg_id,
				'binary_pos'=>$leg_posi
        		);
			$l++;
             $nom_info=$obj->db->select('nom_id')->from('user_registration')->where('user_id',$nom_id)->get()->row();
             $nom_id=$nom_info->nom_id;
			}
	}	
	$obj->db->insert_batch('matrix_downline',$matrix_downline_data);
	if(count($matrix_downline_data)>0)
	{
	    $obj->db->insert_batch('matrix_downline',$matrix_downline_data);
    }
	/*Inserting Record of BV in manage bv table for all upliners code starts here*/
	
	// $package_fee 
	$pkg_info=$obj->db->select('*')->from('package')->where(array('id'=>$pkg_id))->get()->row();
	$pkg_info->id;
	$package_fee=$pkg_info->amount;
	$knowledge_points=$pkg_info->knowledge_points;
	$upliners_query=$obj->db->select('*')->from('level_income_binary')->where('down_id',$user_id)->get();
	//while($upline=mysql_fetch_array($upliners))
	$bvdata=array();
	foreach($upliners_query->result_array() as $upline)
	{
		$income_id=$upline['income_id'];
		$position=$upline['leg'];
		//$user_level=level_countdd($user_id,$income_id); 
		$user_level=$upline['level']; 
		/*
		$obj->db->insert("manage_bv_history",array(
			'income_id'=>$income_id,
			'downline_id'=>$user_id,
			'level'=>$user_level,
			'bv'=>$package_fee,
			'position'=>$position,
			'description'=>'package purchase amount',
			'date'=>date('Y-m-d'),
			'status'=>0,
			));
		*/	
		$bvdata[]=array(
			'income_id'=>$income_id,
			'downline_id'=>$user_id,
			'level'=>$user_level,
			'bv'=>$package_fee,
			'knowledge_points'=>$knowledge_points,
			'position'=>$position,
			'description'=>'package purchase amount',
			'date'=>date('Y-m-d'),
			'status'=>0,
			);
	}
	if(count($bvdata)>0)
	{
	    $obj->db->insert_batch('manage_bv_history',$bvdata);
    }
    $l=1;
    $dref_id=$sponser_id;
    while($dref_id!='cmp')
	{
        if($dref_id!='cmp')
        {
        	$direct_downline_data[]=array(
        		'down_id'=>$user_id,
        		'income_id'=>$dref_id,
        		'l_date'=>date('Y-m-d H:i:s'),
        		'status'=>'0',
        		'level'=>$l,
        		'pay_status'=>'Unpaid',
        		'plan_type'=>$pkg_id
        		);
        		
			$l++;
             $nom_info=$obj->db->select('ref_id')->from('user_registration')->where('user_id',$dref_id)->get()->row();
             $dref_id=$nom_info->ref_id;
			}
	}
	if(count($direct_downline_data)>0)
	{
	    $obj->db->insert_batch('direct_matrix_downline',$direct_downline_data);
    }
	
	/*Inserting Record of BV in manage bv table for all upliners code ends here*/
	//////function call for update the rank of all the upliners as well as provide updated rank bonus
	//updateRank();

	////function call for credit commission using their sponser_id,pkg id and rank
	//echo $pkg_id;
	$commission_info=$obj->db->select('*')->from('direct_commission_meta')->where(array(
		'pkg_id'=>$pkg_id
		))->get()->row();
		//pr($commission_info); exit;
		if(!empty($commission_info->type) && $commission_info->type>0)
		{
		    $commission_per=$commission_info->commission;
		    $commission_amount=($pkg_amount*$commission_per)/100;
		    $ttype="Referral Bonus";
		    $TranDescription=$ttype.' via Package Purchase by '.$user_id;
		}
		else
		{
		    $commission_amount=$commission_info->commission;
		    $ttype="Referral Bonus";
		    $TranDescription=$ttype.' via Package Purchase by '.$user_id;
		}
		//echo $commission_amount; exit;
		if(!empty($commission_amount) && $commission_amount>0)
		{
		    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$sponser_id,'wallet_type'=>'main','wallet_type_id'=>1))->get()->row();
			$balance=$query_obj->amount+$commission_amount;
			$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$sponser_id,'wallet_type'=>'main','wallet_type_id'=>1));
			$obj->db->insert('credit_debit',array(
			    'transaction_no'=>generateUniqueTranNo(),
			    'user_id'=>$sponser_id,
			    'credit_amt'=>$commission_amount,
			    'debit_amt'=>'0',
			    'balance'=>$balance,

			    'receiver_id'=>$sponser_id,
				'pkg_id'=>$pkg_id,
				
				'pkg_amount'=>$pkg_amount,
			    'sender_id'=>$user_id,
			    'receive_date'=>date('Y-m-d'),
			    'ttype'=>$ttype,
			    'TranDescription'=>$TranDescription,
			    'Cause'=>$TranDescription,
			    'Remark'=>$TranDescription,
			    
			 
			    'product_name'=>'main',
			    'deposit_id'=>1,
			    'status'=>'1',
			    'ewallet_used_by'=>'Withdrawal Wallet',
			    'current_url'=>site_url(),
			    'reason'=>'5' //credit for matrix direct commission
		        ));
		        //echo $obj->db->last_query(); exit;
		        
			
		}//end commission not empty if
	//creditDirectCommission($sponser_id,$user_id,$pkg_id,$pkg_amount);

	/*$commission_permission=$obj->db->select('status')->from('commission_permission')->where(array('comm_type_id'=>'4', 'pkg_id'=>$pkg_id))->get()->row();//'comm_type_id'=>'1' is used for unilevel commission type
	if($commission_permission->status=='1' && !empty($package_status->status) && $package_status->status=='1')
	{
	creditUnilevelCommission($pkg_id,$user_id,$package_fee);
    }*/

	//$sponsor_user_name=get_user_name($sponser_id);
	//sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_user_name);
	//$upliner_name=get_user_name($nom_id2);
	//sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);

	return $user_id;
   }//end function
}//end function exists0
/*
@author : Aditya
@param  : none
@desc   : It's used to register the user via ewallet user registration method
@return none
*/
if(!function_exists('epinUserRegistration'))
{
   function epinUserRegistration($registration_info=null)
   {
    $obj=& get_instance();
    //$registerData=$obj->session->all_userdata();//open  and close comment
     /***********Mandatory filed for user registartion in binary plan start from here******************/
    ////user_registration query
    /*Sponsor and account informtaion*/
    if(empty($registration_info))
	{
		$registration_info=$obj->session->userdata('registration_info');
	}
	$sponser_id=(!empty($registration_info['sponsor_and_account_info']['ref_id']))?$registration_info['sponsor_and_account_info']['ref_id']:'123456';
	
	$leg_posi=(!empty($registration_info['sponsor_and_account_info']['ref_leg_position']))?$registration_info['sponsor_and_account_info']['ref_leg_position']:null;
	if(empty($leg_posi) || $leg_posi==null || $leg_posi=='' || $leg_posi=='auto')
     {
     	//$leg_posi=getLegPosition($sponser_id);
     	$ref_id123[]=$sponser_id;
		$leg_posi=getLegPosition1($ref_id123);
		$nom_id=getMatrixNom($ref_id123);
		$nom_id1=$nom_id;
		$nom_id2=$nom_id;
		
	 }
	 else 
	 {
		 getBinaryNom($sponser_id,$leg_posi);
		 $nom_id=$_SESSION['nom_id'];
		 $nom_id1=$nom_id;
		 $nom_id2=$nom_id;
	     $leg_posi=$_SESSION['nom_leg_position'];
	     unset($_SESSION['nom_id']);
	     unset($_SESSION['nom_leg_position']);	
	 }
	 ////////////////////////////////////
	$pkg_id=(!empty($registration_info['sponsor_and_account_info']['pkg_id']))?$registration_info['sponsor_and_account_info']['pkg_id']:22;
	$pkg_amount=(!empty($registration_info['sponsor_and_account_info']['pkg_amount']))?$registration_info['sponsor_and_account_info']['pkg_amount']:100;
	$knowledge_points=(!empty($registration_info['sponsor_and_account_info']['knowledge_points']))?$registration_info['sponsor_and_account_info']['knowledge_points']:2000;
	$package_fee=$pkg_amount;
	$username=(!empty($registration_info['sponsor_and_account_info']['username']))?$registration_info['sponsor_and_account_info']['username']:'A';
	$user_password=(!empty($registration_info['sponsor_and_account_info']['password']))?$registration_info['sponsor_and_account_info']['password']:'123';
	$transaction_pwd=(!empty($registration_info['sponsor_and_account_info']['t_code']))?$registration_info['sponsor_and_account_info']['t_code']:'123';
    $user_id=generateUserId();
	
	
	//personal informtaion
	$first_name=(!empty($registration_info['personal_info']['first_name']))?$registration_info['personal_info']['first_name']:null;
	$last_name=(!empty($registration_info['personal_info']['last_name']))?$registration_info['personal_info']['last_name']:null;
	$email=(!empty($registration_info['sponsor_and_account_info']['email']))?$registration_info['sponsor_and_account_info']['email']:null;
	$contact_no=(!empty($registration_info['personal_info']['contact_no']))?$registration_info['personal_info']['contact_no']:null;
	$country=(!empty($registration_info['personal_info']['country']))?$registration_info['personal_info']['country']:null;
	$state=(!empty($registration_info['personal_info']['state']))?$registration_info['personal_info']['state']:null;
	$city=(!empty($registration_info['personal_info']['city']))?$registration_info['personal_info']['city']:null;
	$zip_code=(!empty($registration_info['personal_info']['zip_code']))?$registration_info['personal_info']['zip_code']:null;
	$address_line1=(!empty($registration_info['personal_info']['address_line1']))?$registration_info['personal_info']['address_line1']:null;
	$date_of_birth=(!empty($registration_info['personal_info']['date_of_birth']))?$registration_info['personal_info']['date_of_birth']:null;
	//bank account info
	$account_no=(!empty($registration_info['bank_account_info']['account_no']))?$registration_info['bank_account_info']['account_no']:null;
	$branch_name=(!empty($registration_info['bank_account_info']['branch_name']))?$registration_info['bank_account_info']['branch_name']:null;
	$bank_name=(!empty($registration_info['bank_account_info']['bank_name']))?$registration_info['bank_account_info']['bank_name']:null;
	$ifsc_code=(!empty($registration_info['bank_account_info']['ifsc_code']))?$registration_info['bank_account_info']['ifsc_code']:null;
	$account_holder_name=(!empty($registration_info['bank_account_info']['account_holder_name']))?$registration_info['bank_account_info']['account_holder_name']:null;
	/////
	$registration_info['sponsor_and_account_info']['account_type'];
	
    $user_registration_data=array(
    		/*Sponsor and account informtaion*/
    		'user_id'=>$user_id,
    		'ref_id'=>$sponser_id,
    		'nom_id'=>$nom_id,
    		'username'=>$username,
    		'password'=>$user_password,
    		't_code'=>$transaction_pwd,
    		'pkg_id'=>$pkg_id,
    		'pkg_amount'=>$pkg_amount,
			'binary_pos'=>$leg_posi,
    		 /*Personal informtaion*/
    		 'first_name'=>$first_name,
    		 'last_name'=>$last_name,
    		 'email'=>$email,
    		 'contact_no'=>$contact_no,
    		 'country'=>$country,
    		 'state'=>$state,
    		 'city'=>$city,
    		 'zip_code'=>$zip_code,
    		 'address_line1'=>$address_line1,
    		 'address_line1'=>$date_of_birth,
    		 /*Bank Account information*/
    		 'account_no'=>$account_no,
    		 'branch_name'=>$branch_name,
    		 'bank_name'=>$bank_name,
    		 'ifsc_code'=>$ifsc_code,
    		 'account_holder_name'=>$account_holder_name,
    		 ////////
    		 'registration_date'=>date('d-m-Y'),
    		 'current_login_status'=>'0', 
    		 'active_status'=>'1',
			 'registration_method'=>'2',
			 'registration_method_name'=>'E-Pin'
    		);
    $obj->db->insert('user_registration',$user_registration_data);
    $obj->db->insert('final_e_wallet',array('user_id'=>$user_id,'amount'=>0,'wallet_type_id'=>1,'wallet_type'=>'main')); 
	
	
	//$obj->db->insert('point_e_wallet',array('user_id'=>$user_id,'amount'=>0));	
	//////////////Sign Up Bonus////////////////	
		//reason enum filed '1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
		/*
		Note: status field '0'=>debit,'1'=>credit
		*/
		
		
	/////Inserting Data into user_package_log table///////////
	$obj->db->insert('user_package_log',array(
    	'user_id'=>$user_id,
    	'new_package_id'=>$pkg_id,
    	'active_status'=>'1',
    	'purchased_date'=>date('Y-m-d H:i:s')
		));
		
	
	/***********Mandatory filed for user registartion in binary plan end over here******************/
	$level=1;
	 ///inserting data into level income binary with status zero from here
	$level_income_binary_data=array();
	while($nom_id!='cmp')
	{
				if($nom_id!='cmp')
				{
				$level_income_binary_data[]=array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posi,'status'=>'0','level'=>$level);
				//$obj->db->insert('level_income_binary',array('down_id'=>$user_id,'income_id'=>$nom_id,'leg'=>$leg_posi,'status'=>'0','level'=>$level));
				$level++;
				$query_obj=$obj->db->select('*')->from('user_registration')->where('user_id',$nom_id)->get()->row();
				$leg_posi=$query_obj->binary_pos;
				$nom_id=$query_obj->nom_id;
				}
	}//end while $nom!=cmp
	$obj->db->insert_batch('level_income_binary',$level_income_binary_data);
	

    
     /***********Mandatory filed for user registartion in matrix plan end over here******************/
    $l=1;
	$nom_id=$nom_id1;
	while($nom_id!='cmp')
	{
        if($nom_id!='cmp')
        {
        	$matrix_downline_data[]=array(
        		'down_id'=>$user_id,
        		'income_id'=>$nom_id,
        		'l_date'=>date('Y-m-d H:i:s'),
        		'status'=>'0',
        		'level'=>$l,
        		'pay_status'=>'Unpaid',
        		'plan_type'=>$pkg_id,
				'binary_pos'=>$leg_posi
        		);
			$l++;
             $nom_info=$obj->db->select('nom_id')->from('user_registration')->where('user_id',$nom_id)->get()->row();
             $nom_id=$nom_info->nom_id;
			}
	}	
	$obj->db->insert_batch('matrix_downline',$matrix_downline_data);
	
	/*Inserting Record of BV in manage bv table for all upliners code starts here*/
	//$upliners=mysql_query("select * from level_income_binary where down_id='$user_id'");
	$upliners_query=$obj->db->select('*')->from('level_income_binary')->where('down_id',$user_id)->get();
	//while($upline=mysql_fetch_array($upliners))
	$bvdata=array();
	foreach($upliners_query->result_array() as $upline)
	{
		$income_id=$upline['income_id'];
		$position=$upline['leg'];
		//$user_level=level_countdd($user_id,$income_id); 
		$user_level=$upline['level']; 
		
		$bvdata[]=array(
			'income_id'=>$income_id,
			'downline_id'=>$user_id,
			'level'=>$user_level,
			'bv'=>$package_fee,
			'knowledge_points'=>$knowledge_points,
			'position'=>$position,
			'description'=>'package purchase amount',
			'date'=>date('Y-m-d'),
			'status'=>0,
			);
	}
	if(count($bvdata)>0)
	{
	$obj->db->insert_batch('manage_bv_history',$bvdata);
    }
	/*Inserting Record of BV in manage bv table for all upliners code ends here*/
	//////function call for update the rank of all the upliners as well as provide updated rank bonus
	//updateRank();

	////function call for credit commission using their sponser_id,pkg id and rank
	
	// welcome bonus
	creditWelcomeBonus($user_id,$pkg_id,$pkg_amount,$knowledge_points);
	creditDirectCommission($sponser_id,$user_id,$pkg_id,$pkg_amount,$knowledge_points);
	$sponsor_user_name=get_user_name($sponser_id);
	sendWelcomeEmailToUser($user_id,$username,$user_password,$transaction_pwd,$email,$sponsor_user_name);
	$upliner_name=get_user_name($nom_id2);
	//sendNewRegistrationEmailToAdmin($user_id,$username,$user_password,$sponsor_username,$upliner_name,$email);

	return true;
   }//end function
}//end function exists0

function creditWelcomeBonus($user_id,$pkg_id,$pkg_amount,$knowledge_points)
{
    $obj=& get_instance();
    $ttype="Welcome Bonus";
    $TranDescription="Welcome Bonus";
    $commission_amount=($knowledge_points*12)/100;
    $query_obj=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$user_id,'wallet_type'=>'main','wallet_type_id'=>1))->get()->row();
	$balance=$query_obj->amount+$commission_amount;
	$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id,'wallet_type'=>'main','wallet_type_id'=>1));
	$obj->db->insert('credit_debit',array(
	    'transaction_no'=>generateUniqueTranNo(),
	    'user_id'=>$user_id,
	    'credit_amt'=>$commission_amount,
	    'debit_amt'=>'0',
	    'balance'=>$balance,
	    'receiver_id'=>$user_id,
		'pkg_id'=>$pkg_id,
		'pkg_amount'=>$pkg_amount,
	    'sender_id'=>$user_id,
	    'receive_date'=>date('Y-m-d'),
	    'ttype'=>$ttype,
	    'TranDescription'=>$TranDescription,
	    'Cause'=>$TranDescription,
	    'Remark'=>$TranDescription,
	    'product_name'=>'main',
	    'deposit_id'=>1,
	    'status'=>'1',
	    'ewallet_used_by'=>'Withdrawal Wallet',
	    'current_url'=>site_url(),
	    'reason'=>'3' //credit for matrix direct commission
        ));
}
/*
@author : Aditya
@param  : none
@desc   : It's used to register the user via ewallet user registration method
@return none
*/

/*
@Desc: It's used to register new member from user back office
*/


function sendWelcomeEmailToUser($user_id,$username,$password,$transaction_pwd,$email,$sponsor_user_name)
{

	$email_data['from']='info@globalsoftwebtechnologies.com';
	$email_data['to']=$email;
	$email_data['subject']='Registration Successful on JKS Shoppers';
	$email_data['user_id']=$user_id;
	$email_data['username']=$username;
	$email_data['password']=$password;
	$email_data['transaction_pwd']=$transaction_pwd;
	$email_data['email']=$email;
	$email_data['sponsor_user_name']=$sponsor_user_name;
	$email_data['email-template']='happy-days-welcome-mail';
	_sendEmail($email_data);
}//end function 
function sendNewRegistrationEmailToAdmin($user_id,$username,$password,$sponsor_username,$upliner,$email)
{

    $email_data['from']='info@globalsoftwebtechnologies.com';
    $email_data['to']='info@globalsoftwebtechnologies.com';
    $email_data['subject']='New member registration on JKS Shoppers';
    
    $email_data['template_header_msg']='New Member is Registered on your site <a target="_blank" href="'.ci_site_url().'">'.ci_site_url().'</a>';
    $email_data['user_id']=$user_id;
    $email_data['username']=$username;
    $email_data['password']=$password;
    $email_data['sponsor_username']=$sponsor_username;
    $email_data['upliner']=$upliner;
    $email_data['email']=$email;
    $email_data['email-template']='email-to-admin';
    _sendEmail($email_data);
}//end function
?>