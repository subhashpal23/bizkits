<?php 
function matrix_commission_direct($down_id,$table_name,$pkg_id,$pkg_amount)
{
	$obj=& get_instance();
	if($table_name=='direct_matrix_downline')
	{
		$unique_identity='feeder_stage';
		$level=6;
		$stage_name='Matrix Level';
	}
	else if($table_name=='matrix_stage1')
	{
		$unique_identity='stage_1';
		$level=3;
		$stage_name=' Stage 2';
	}
	else if($table_name=='matrix_stage2')
	{
		$unique_identity='stage_2';
		$level=3;
		$stage_name=' Stage 3';
	}
	else if($table_name=='matrix_stage3')
	{
		$unique_identity='stage_3';
		$level=3;
		$stage_name=' Stage 4';
	}
	else if($table_name=='matrix_stage4')
	{
		$unique_identity='stage_4';
		$level=3;
		$stage_name='Stage 5';
	}
	else if($table_name=='matrix_stage5')
	{
		$unique_identity='stage_5';
		$level=3;
		$stage_name=' Stage 6';
	}
	else if($table_name=='matrix_stage6')
	{
		$unique_identity='stage_6';
		$level=3;
		$stage_name=' Stage 7';
	}
	else if($table_name=='matrix_stage7')
	{
		$unique_identity='stage_7';
		$level=3;
		$stage_name=' Stage 8';
	}

	$query=$obj->db->select('*')->from($table_name)->where(array('down_id'=>$down_id,'level <='=>$level, 'level_pay_status'=>'Unpaid'))->get();
	$all_upliner=$query->result_array();
	if($query->num_rows()>0)
	{
	    $admin_info=$obj->db->select('*')->from('admin_charge')->get()->row();
	    $charge_type=$admin_info->charge_type;
	    $charges=$admin_info->charges;
	    
	    $pkgpv_info=$obj->db->select('*')->from('package')->where('id',$pkg_id)->get()->row();
	    $pv=$pkgpv_info->pv;

	    
		foreach($all_upliner as $all)
		{
			           if($all['level']<=$level)
					   {
						//,'pkg_id'=>$pkg_id
						$meta_info=$obj->db->select('*')->from('direct_commission_meta')->where(array('level'=>$all['level']))->get()->row();
						//pr($meta_info);
						$member_exist=$obj->db->select('*')->from('user_registration')->where(array('user_id'=>$all['income_id']))->get()->num_rows();
						
						$main_com_amount=($pv*$meta_info->commission)/100;
						//echo $main_com_amount;
						
    					$pkg_obj=$obj->db->select('pkg_id')->from('user_registration')->where('user_id',$all['income_id'])->get()->row();
    				    $pkgid=$pkg_obj->pkg_id;
    				    if($pkgid>1)
    				    {
    						if(!empty($main_com_amount) && $member_exist>0)
    						{
    						    if($charge_type>0)
    						    {
    						        $admin_charge=$charges;
    						    }
    						    else
    						    {
    						        $admin_charge=($main_com_amount*$charges)/100;
    						    }
    						    
    						    $main_com_amount=$main_com_amount-$admin_charge;
    						    $main_com_amount=$main_com_amount*500;
    							$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$all['income_id'])->get()->row();
    							$balance=$query_obj->amount+$main_com_amount;
    							$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$all['income_id']));
    							$obj->db->insert('credit_debit',array(
    							'transaction_no'=>generateUniqueTranNo(),
    							'user_id'=>$all['income_id'],
    							'credit_amt'=>$main_com_amount,
    							'debit_amt'=>'0',
    							'balance'=>$balance,
    							'admin_charge'=>$admin_charge,
    							'receiver_id'=>$all['income_id'],
    							'sender_id'=>$down_id,
    							'receive_date'=>date('Y-m-d'),
    							'ttype'=>'Referral Bonus',
    							'TranDescription'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
    							'Cause'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
    							'Remark'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
    							'invoice_no'=>'',
    							'product_name'=>'main',
    							'deposit_id'=>'1',
    							'status'=>'1',
    							'pkg_id'=>$pkg_id,
    							'pkg_amount'=>$pv,
    							'ewallet_used_by'=>'Withdrawal Wallet',
    							'current_url'=>site_url(),
    							'reason'=>'5', //credit for matrix commission
    							'level'=>$all['level'],
    							'unique_identity'=>$unique_identity
    							));
    						}
    						$obj->db->query("update $table_name set level_pay_status='Paid' where id='".$all['id']."'");
    					}
					    else
    					{
    					    if($all['level']==1)
    					    {
    					        if(!empty($main_com_amount) && $member_exist>0)
        						{
        						    if($charge_type>0)
        						    {
        						        $admin_charge=$charges;
        						    }
        						    else
        						    {
        						        $admin_charge=($main_com_amount*$charges)/100;
        						    }
        						    
        						    $main_com_amount=$main_com_amount-$admin_charge;
        						    $main_com_amount=$main_com_amount*500;
        							$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$all['income_id'])->get()->row();
        							$balance=$query_obj->amount+$main_com_amount;
        							$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$all['income_id']));
        							$obj->db->insert('credit_debit',array(
        							'transaction_no'=>generateUniqueTranNo(),
        							'user_id'=>$all['income_id'],
        							'credit_amt'=>$main_com_amount,
        							'debit_amt'=>'0',
        							'balance'=>$balance,
        							'admin_charge'=>$admin_charge,
        							'receiver_id'=>$all['income_id'],
        							'sender_id'=>$down_id,
        							'receive_date'=>date('Y-m-d'),
        							'ttype'=>'Referral Bonus',
        							'TranDescription'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
        							'Cause'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
        							'Remark'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
        							'invoice_no'=>'',
        							'product_name'=>'main',
        							'deposit_id'=>'1',
        							'status'=>'1',
        							'pkg_id'=>$pkg_id,
        							'pkg_amount'=>$pv,
        							'ewallet_used_by'=>'Withdrawal Wallet',
        							'current_url'=>site_url(),
        							'reason'=>'5', //credit for matrix commission
        							'level'=>$all['level'],
        							'unique_identity'=>$unique_identity
        							));
        						}
        						$obj->db->query("update $table_name set level_pay_status='Paid' where id='".$all['id']."'");
    					    }
    					}
					}//end level limit if
					
		}//end foreach
	}//end num_rows >0 if
}//end function

function matrix_commission_direct_difference($down_id,$table_name,$pkg_id,$pkg_amount,$old_pkg_id,$old_pkg_amount)
{
	$obj=& get_instance();
	if($table_name=='direct_matrix_downline')
	{
		$unique_identity='feeder_stage';
		$level=1;
		$stage_name='Matrix Level';
	}

	$query=$obj->db->select('*')->from($table_name)->where(array('down_id'=>$down_id,'level <='=>$level))->get();
	$all_upliner=$query->result_array();
	//pr($all_upliner); exit;
	if($query->num_rows()>0)
	{
	    $admin_info=$obj->db->select('*')->from('admin_charge')->get()->row();
	    $charge_type=$admin_info->charge_type;
	    $charges=$admin_info->charges;
	    $pkgpv_info=$obj->db->select('*')->from('package')->where('id',$pkg_id)->get()->row();
	    $pv=$pkgpv_info->pv;
	    $to_level=$pkgpv_info->to_level;
	    
	    $old_pkgpv_info=$obj->db->select('*')->from('package')->where('id',$old_pkg_id)->get()->row();
	    $old_pv=$old_pkgpv_info->pv;
	    
	    
	    $diff_amount=abs($pv-$old_pv);
	    //echo $diff_amount; exit;
		foreach($all_upliner as $all)
		{
           if($all['level']<=$level)
		   {
				//,'pkg_id'=>$pkg_id
				$member_income_nfo=$obj->db->select('*')->from('user_registration')->where(array('user_id'=>$all['income_id']))->get()->row();
				$pkg_income_info=$obj->db->select('*')->from('package')->where('id',$member_income_nfo->pkg_id)->get()->row();
        	    $to_level_income=$pkg_income_info->to_level;
				if($to_level_income>=$all['level'])
    		    {
    				$meta_info=$obj->db->select('*')->from('direct_commission_meta')->where(array('level'=>$all['level']))->get()->row();
    				
    				$member_exist=$obj->db->select('*')->from('user_registration')->where(array('user_id'=>$all['income_id']))->get()->num_rows();
    				
    				$main_com_amount=($diff_amount*$meta_info->commission)/100;
    				
    				$pkg_obj=$obj->db->select('pkg_id')->from('user_registration')->where('user_id',$all['income_id'])->get()->row();
    				$pkgid=$pkg_obj->pkg_id;
    				if($pkgid>1)
    				{
        				if(!empty($main_com_amount) && $member_exist>0)
        				{
        				    if($charge_type>0)
        				    {
        				        $admin_charge=$charges;
        				    }
        				    else
        				    {
        				        $admin_charge=($main_com_amount*$charges)/100;
        				    }
        				    
        				    $main_com_amount=$main_com_amount-$admin_charge;
        				    $main_com_amount=$main_com_amount*500;
        					$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$all['income_id'])->get()->row();
        					$balance=$query_obj->amount+$main_com_amount;
        					$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$all['income_id']));
        					$obj->db->insert('credit_debit',array(
        					'transaction_no'=>generateUniqueTranNo(),
        					'user_id'=>$all['income_id'],
        					'credit_amt'=>$main_com_amount,
        					'debit_amt'=>'0',
        					'balance'=>$balance,
        					'admin_charge'=>$admin_charge,
        					'receiver_id'=>$all['income_id'],
        					'sender_id'=>$down_id,
        					'receive_date'=>date('Y-m-d'),
        					'ttype'=>'Upgrade Referral Bonus',
        					'TranDescription'=>'Upgrade Referral Bonus of level '.$all['level']." from ".$down_id,
        					'Cause'=>'Upgrade Referral Bonus of level '.$all['level']." from ".$down_id,
        					'Remark'=>'Upgrade Referral Bonus of level '.$all['level']." from ".$down_id,
        					'invoice_no'=>'',
        					'product_name'=>'main',
        					'deposit_id'=>'1',
        					'status'=>'1',
        					'pkg_id'=>$pkg_id,
        					'pkg_amount'=>$diff_amount,
        					'ewallet_used_by'=>'Withdrawal Wallet',
        					'current_url'=>site_url(),
        					'reason'=>'5', //credit for matrix commission
        					'level'=>$all['level'],
        					'unique_identity'=>$unique_identity
        					));
        				}
    				}
    				else
    				{
					    if($all['level']==1)
					    {
					        if(!empty($main_com_amount) && $member_exist>0)
    				        {
            				    if($charge_type>0)
            				    {
            				        $admin_charge=$charges;
            				    }
            				    else
            				    {
            				        $admin_charge=($main_com_amount*$charges)/100;
            				    }
            				    
            				    $main_com_amount=$main_com_amount-$admin_charge;
            				    $main_com_amount=$main_com_amount*500;
            					$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$all['income_id'])->get()->row();
            					$balance=$query_obj->amount+$main_com_amount;
            					$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$all['income_id']));
            					$obj->db->insert('credit_debit',array(
            					'transaction_no'=>generateUniqueTranNo(),
            					'user_id'=>$all['income_id'],
            					'credit_amt'=>$main_com_amount,
            					'debit_amt'=>'0',
            					'balance'=>$balance,
            					'admin_charge'=>$admin_charge,
            					'receiver_id'=>$all['income_id'],
            					'sender_id'=>$down_id,
            					'receive_date'=>date('Y-m-d'),
            					'ttype'=>'Upgrade Referral Bonus',
            					'TranDescription'=>'Upgrade Referral Bonus of level '.$all['level']." from ".$down_id,
            					'Cause'=>'Upgrade Referral Bonus of level '.$all['level']." from ".$down_id,
            					'Remark'=>'Upgrade Referral Bonus of level '.$all['level']." from ".$down_id,
            					'invoice_no'=>'',
            					'product_name'=>'main',
            					'deposit_id'=>'1',
            					'status'=>'1',
            					'pkg_id'=>$pkg_id,
            					'pkg_amount'=>$diff_amount,
            					'ewallet_used_by'=>'Withdrawal Wallet',
            					'current_url'=>site_url(),
            					'reason'=>'5', //credit for matrix commission
            					'level'=>$all['level'],
            					'unique_identity'=>$unique_identity
            					));
    				}
					    }
    				}
    		    }
				
			}//end level limit if
		}//end foreach
	}//end num_rows >0 if
}//end function
function matrix_commission_level($down_id,$table_name,$pkg_id)
{
	$obj=& get_instance();
	if($table_name=='matrix_downline')
	{
		$unique_identity='feeder_stage';
		$level=5;
		$stage_name='Matrix Level';
	}
	else if($table_name=='matrix_stage1')
	{
		$unique_identity='stage_1';
		$level=3;
		$stage_name=' Stage 2';
	}
	else if($table_name=='matrix_stage2')
	{
		$unique_identity='stage_2';
		$level=3;
		$stage_name=' Stage 3';
	}
	else if($table_name=='matrix_stage3')
	{
		$unique_identity='stage_3';
		$level=3;
		$stage_name=' Stage 4';
	}
	else if($table_name=='matrix_stage4')
	{
		$unique_identity='stage_4';
		$level=3;
		$stage_name='Stage 5';
	}
	else if($table_name=='matrix_stage5')
	{
		$unique_identity='stage_5';
		$level=3;
		$stage_name=' Stage 6';
	}
	else if($table_name=='matrix_stage6')
	{
		$unique_identity='stage_6';
		$level=3;
		$stage_name=' Stage 7';
	}
	else if($table_name=='matrix_stage7')
	{
		$unique_identity='stage_7';
		$level=3;
		$stage_name=' Stage 8';
	}

	$query=$obj->db->select('*')->from($table_name)->where(array('down_id'=>$down_id,'level <='=>$level, 'level_pay_status'=>'Unpaid'))->get();
	$all_upliner=$query->result_array();
	if($query->num_rows()>0)
	{
	    $admin_info=$obj->db->select('*')->from('admin_charge')->get()->row();
	    $charge_type=$admin_info->charge_type;
	    $charges=$admin_info->charges;
		foreach($all_upliner as $all)
		{
			           if($all['level']<=$level)
					   {
						//,'pkg_id'=>$pkg_id
						$meta_info=$obj->db->select('*')->from('unilevel_stage_level_commission_meta')->where(array('stage_key'=>$unique_identity,'level'=>$all['level']))->get()->row();
						
						$member_exist=$obj->db->select('*')->from('user_registration')->where(array('user_id'=>$all['income_id']))->get()->num_rows();
						
						$main_com_amount=$meta_info->commission_amount;
						if(!empty($main_com_amount) && $member_exist>0)
						{
						    if($charge_type>0)
						    {
						        $admin_charge=$charges;
						    }
						    else
						    {
						        $admin_charge=($main_com_amount*$charges)/100;
						    }
						    
						    $main_com_amount=$main_com_amount-$admin_charge;
						    
							$query_obj=$obj->db->select('amount')->from('final_cash_wallet')->where('user_id',$all['income_id'])->get()->row();
							$balance=$query_obj->amount+$main_com_amount;
							$obj->db->update('final_cash_wallet',array('amount'=>$balance),array('user_id'=>$all['income_id']));
							$obj->db->insert('credit_debit',array(
							'transaction_no'=>generateUniqueTranNo(),
							'user_id'=>$all['income_id'],
							'credit_amt'=>$main_com_amount,
							'debit_amt'=>'0',
							'balance'=>$balance,
							'admin_charge'=>$admin_charge,
							'receiver_id'=>$all['income_id'],
							'sender_id'=>$down_id,
							'receive_date'=>date('Y-m-d'),
							'ttype'=>'Referral Bonus',
							'TranDescription'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
							'Cause'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
							'Remark'=>'Referral Bonus of level '.$all['level']." from ".$down_id,
							'invoice_no'=>'',
							'product_name'=>'main',
							'deposit_id'=>'1',
							'status'=>'1',
							'pkg_id'=>$pkg_id,
							'ewallet_used_by'=>'Withdrawal Wallet',
							'current_url'=>site_url(),
							'reason'=>'9', //credit for matrix commission
							'level'=>$all['level'],
							'unique_identity'=>$unique_identity
							));
						}
						$obj->db->query("update $table_name set level_pay_status='Paid' where id='".$all['id']."'");
					   }//end level limit if
		}//end foreach
	}//end num_rows >0 if
}//end function

function getBinaryPairingCommission($user_id=null,$pkg_id=null)
{
   $obj=& get_instance();
     $date=date('Y-m-d');
	 $total_left_amount_query=$obj->db->query("select sum(pv) as total_left_amount from matrix_downline_pv where status='0'  and income_id='$user_id' and leg='Left' and date(l_date)<='$date'");
	 //echo $obj->db->last_query();
	 //$total_left_pair=$obj->db->select('id')->from('manage_bv_history')->where(array('status'=>'0','income_id'=>$user_id,'position'=>'left','date <='=>$date))->get->num_rows();
	 $total_left_amount_query_res=$total_left_amount_query->result();
     $leftamt=$total_left_amount_query_res[0]->total_left_amount;
    
	/////////////
	 $total_right_amount_query=$obj->db->query("select sum(pv) as total_right_amount from matrix_downline_pv where status='0'  and income_id='$user_id' and leg='Right' and date(l_date)<='$date'");
	 //$total_right_pair=$obj->db->select('id')->from('manage_bv_history')->where(array('status'=>'0','income_id'=>$user_id,'position'=>'right','date <='=>$date))->get->num_rows();
     $total_right_amount_query_res=$total_right_amount_query->result();
     $rightamt=$total_right_amount_query_res[0]->total_right_amount;
     //echo $obj->db->last_query();
	 
	 //echo $rightamt."-".$leftamt; exit;
	 ///////////////////////////////
	 $carry_amount=null;
	 $carry_pos=null;
     ////////code for lesser bv///////
     $pvinfo=$obj->db->select('*')->from('package')->where('id',$pkg_id)->get()->row();
     //echo $pvinfo->title;
     $pairpv=$pvinfo->binary_pair_pv;
     $daily_binary_cycle=$pvinfo->daily_binary_cycle;
     $capping_times=$pvinfo->capping_times;
     
	 if((!empty($leftamt) && !empty($rightamt)) && (($leftamt>=$pairpv) && ($rightamt>=$pairpv)))
	 {
			if($leftamt<$rightamt)
			{
				$lesser_bv=$leftamt;
				$matchingpv=$lesser_bv%$pairpv;
				$matchingpv=$lesser_bv-$matchingpv;
				$carry_amount=$rightamt-$leftamt;
				$carry_amount_left=$leftamt-$matchingpv;
				$carry_amount_right=$rightamt-$matchingpv;
				$carry_pos_left='Left';
				$carry_pos_right='Right';
				$total_pair=$matchingpv/$pairpv;
			}
			else if($rightamt<$leftamt)
			{
				$lesser_bv=$rightamt;
				$matchingpv=$lesser_bv%$pairpv;
				$matchingpv=$lesser_bv-$matchingpv;
				$carry_amount=$leftamt-$rightamt;				
				$carry_pos='left';
				$carry_amount_left=$leftamt-$matchingpv;
				$carry_amount_right=$rightamt-$matchingpv;
				$carry_pos_left='Left';
				$carry_pos_right='Right';
				$total_pair=$matchingpv/$pairpv;
			}
			else if($leftamt==$rightamt)
			{
				$lesser_bv=$rightamt;	
				$matchingpv=$lesser_bv%$pairpv;
				$matchingpv=$lesser_bv-$matchingpv;
				$carry_amount=0;
				$carry_pos=null;
				$carry_amount_left=$leftamt-$matchingpv;
				$carry_amount_right=$rightamt-$matchingpv;
				$carry_pos_left='Left';
				$carry_pos_right='Right';
				$total_pair=$matchingpv/$pairpv;
			}
			
			//echo $lesser_bv.'=='.$carry_amount.'=='.$carry_pos.'=='.$total_pair; echo "<br>";
			$user_info=get_user_details($user_id);
			//echo $user_info->pkg_id;
			//$arraypackage=array('','6','18','42','90');
			//$arraypackageamount=$arraypackage[$user_info->pkg_id];
			
			//$capping_amount=$arraypackageamount*25;
			//echo $arraypackageamount.'=='.$capping_amount;
			//$capping_amount=5000;
			$capping_amount=(($pairpv*$daily_binary_cycle)/100)*$capping_times;
			
			$info=$obj->db->select_sum('bonus')->from('matching_bonus')->where(array('user_id'=>$user_id,'bonus_date'=>$date))->get()->row();
			$totaldailybonus=$info->bonus;
			//echo $matchingpv.'==Daily Capping:'.$capping_amount;
			//$matchamount=100;
			if($totaldailybonus<$capping_amount)
			{
    			if(($lesser_bv)>$capping_amount)
    			{
    			    $commission_amount=$capping_amount;
    			    if($carry_pos=='left')
    			    {
    			        $carry_amount_left=0;
    			        $carry_amount_right=$rightamt-$capping_amount;
    			    }
    			    else if($carry_pos=='right')
    			    {
    			        $carry_amount_right=0;
    			        $carry_amount_left=$leftamt-$capping_amount;
    			    }
    			    else
    			    {
    			        $carry_amount_left=0;
    			        $carry_amount_right=0;
    			    }
    			}
    			else
    			{
    			    $commission_amount=$matchingpv;
    			}
    			$total_pair=$commission_amount/$pairpv;
    			//echo "((".$commission_amount."*".$daily_binary_cycle.")/100)*500";
    			$paid_commission_amount=(($commission_amount*$daily_binary_cycle)/100)*500;
			}
			else
			{
			    $commision_amount=null;
			}
	 }
	 else 
	 {
	  $commision_amount=null;
	 }
	 
	 
	 $commission_details=(object)array(
	 'commission_amount'=>$commission_amount,
	 'carry_amount'=>$carry_amount,
	 'total_pair'=>$total_pair,
	 'lessar_pv'=>$lesser_bv,
	 'carry_pos'=>$carry_pos,
	 'pairpv'=>$pairpv,
	 'daily_capping'=>$capping_amount,
     'carry_amount_left'=>$carry_amount_left,
	 'carry_amount_right'=>$carry_amount_right,
	 'carry_pos_left'=>$carry_pos_left,
	 'carry_pos_right'=>$carry_pos_right,
	 'paid_commission_amount'=>$paid_commission_amount,
	 'user_id'=>$user_id
	 );
	 return $commission_details;
	 //return $commision_amount;
	
}//end function
/*
@author : Aditya
@param  : None
@desc   : It's used to credit the binary pairing commission
@return : int(creditStatus)
*/

function creditBinaryLevelCommission($down_id)
{
	//insert commission in user ewallet by fetching from level income table code start here
	$obj=& get_instance();
	$arraycom=array('',30,15,15,10,5);
	
	$all_user_level=$obj->db->select('*')->from('level_income_binary')->where(array('down_id' => $down_id))->get();
	if($all_user_level->num_rows()>0)
	{
	    foreach($all_user_level->result() as $userLevelObj)
    	{
    	    $userLevelObj->income_id;
        	$all_user_query=$obj->db->select('*')->from('user_registration')->where(array('user_id' => $userLevelObj->income_id,'nom_id !=' => '','active_status'=>'1'))->get();
        	
        	$date=date('Y-m-d');
        	$current_timestamp=date("Y-m-d H:i:s");
        	$creditStatus=0;
        	$manage_bv_history=array();
        	if($all_user_query->num_rows()>0)
        	{
        	    //echo $this->db->last_query();
        	    //echo "syubhahsj";
        			foreach($all_user_query->result() as $userObj)
        			{
        					$user_id=$userObj->user_id;
        					$pkg_id=$userObj->pkg_id;
        					if($pkg_id>1)
        					{
        					    $matchingcondleft=$obj->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='left') and ref_id='".$user_id."'")->num_rows();
            					$matchingcondright=$obj->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='right') and ref_id='".$user_id."'")->num_rows();
            					
            					$commission_details=getBinaryPairingCommission($user_id,$pkg_id);
            					//pr($commission_details);
            					
            					//exit;
            					if(!empty($commission_details->commission_amount) && $matchingcondleft>=1 && $matchingcondright>=1)
            					{
            					    $obj->db->insert('matching_bonus',array(
            								'user_id'=>$user_id,
            								'bonus'=>$commission_details->lessar_pv,
            								'bonus_date'=>date('Y-m-d'),
            								'status'=>'0'
            								));
            								
            						//$commission_amount=$commission_details->commission_amount;
            						$commission_amount=$commission_details->paid_commission_amount;
            						//$commission_amount=$commission_details->total_pair*100;
            						
            						$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$user_id,'wallet_type'=>'main','wallet_type_id'=>1))->get()->row();
            						//echo "<br>"; echo $obj->db->last_query();
            						$balance=$query_obj->amount+$commission_amount;
            						$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id,'wallet_type'=>'main','wallet_type_id'=>1));
            					    //echo "<br>";	echo $obj->db->last_query();
            						//reason enum filed '1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
            						/*
            						Note: status field '0'=>debit,'1'=>credit
            						*/
            						$obj->db->insert('credit_debit',array(
            								'transaction_no'=>generateUniqueTranNo(),
            								'user_id'=>$user_id,
            								'credit_amt'=>$commission_amount,
            								'debit_amt'=>'0',
            								'balance'=>$balance,
            								'receiver_id'=>$user_id,
            								'sender_id'=>COMP_USER_ID,
            								'receive_date'=>date('Y-m-d'),
            								'ttype'=>'Binary Income',
            								'TranDescription'=>'Earn Binary Pairing Income of '.$commission_details->total_pair." pair",
            								'Cause'=>'Commission of Binary Pairing Income',
            								'Remark'=>'Binary Pairing Income',
            								'deposit_id'=>'1',
            								'product_name'=>'main',
            								'status'=>'1',
            								'matching_commission_status	'=>'0',
            								'current_url'=>ci_site_url(),
            								'carry_pv_left'=>$commission_details->carry_amount_left,
            								'carry_pv_right'=>$commission_details->carry_amount_right,
            								'daily_capping'=>$commission_details->daily_capping,
            								'total_pair'=>$commission_details->total_pair,
            								'pair_pv'=>$commission_details->pairpv,
            								'reason'=>'6'
            								));
                					//echo "<br>";	echo $obj->db->last_query();		
                					$manage_bv_history=array();
                					if(!empty($commission_details->carry_amount_left))
                					{
                						$carry_amount_left=$commission_details->carry_amount_left;
                						$carry_pos_left=$commission_details->carry_pos_left;
                						
                						$manage_bv_history[]=array(
                						'income_id'=>$user_id,
                						'down_id'=>$user_id,
                						'level'=>'1',
                						'pv'=>$carry_amount_left,
                						'leg'=>$carry_pos_left,
                						'type'=>'Carry Forward PV',
                						'l_date'=>date('Y-m-d H:i:s'),
                						'status'=>'0'
                						);
                						
                						
                					}
                					
                					if(!empty($commission_details->carry_amount_right))
                					{
                						$carry_amount_right=$commission_details->carry_amount_right;
                						$carry_pos_right=$commission_details->carry_pos_right;
                						
                						$manage_bv_history[]=array(
                						'income_id'=>$user_id,
                						'down_id'=>$user_id,
                						'level'=>'1',
                						'pv'=>$carry_amount_right,
                						'leg'=>$carry_pos_right,
                						'type'=>'Carry Forward PV',
                						'l_date'=>date('Y-m-d H:i:s'),
                						'status'=>'0'
                						);
                						
                						
                					}
            					
                					// update matching commission
                					
                				
                					
                					$receive_date=date('Y-m-d');
                                	$obj->db->update("matrix_downline_pv",array("status"=>'1'),array("date(l_date) <="=>$receive_date,"status"=>'0','income_id'=>$user_id));
                                	
                                	$userinfo=$obj->db->select('*')->from('user_registration')->where(array('user_id' =>$user_id))->get()->row();
                                	$ref_id=$userinfo->ref_id;
                                	$pkg_obj=$obj->db->select('pkg_id')->from('user_registration')->where('user_id',$ref_id)->get()->row();
                    				$pkgid=$pkg_obj->pkg_id;
                    				if($pkgid>1)
                    				{
                                    	$main_com_amount=($commission_amount*5)/100;
                                    	$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$ref_id)->get()->row();
            							$balance=$query_obj->amount+$main_com_amount;
            							$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$ref_id));
            							$obj->db->insert('credit_debit',array(
            							'transaction_no'=>generateUniqueTranNo(),
            							'user_id'=>$ref_id,
            							'credit_amt'=>$main_com_amount,
            							'debit_amt'=>'0',
            							'balance'=>$balance,
            							'admin_charge'=>0,
            							'receiver_id'=>$ref_id,
            							'sender_id'=>$user_id,
            							'receive_date'=>date('Y-m-d'),
            							'ttype'=>'Direct Matching Bonus',
            							'TranDescription'=>'Direct Matching Bonus  from '.$user_id,
            							'Cause'=>'Direct Matching Bonus  from '.$user_id,
            							'Remark'=>'Direct Matching Bonus from'.$user_id,
            							'invoice_no'=>'',
            							'product_name'=>'main',
            							'deposit_id'=>'1',
            							'status'=>'1',
            							'ewallet_used_by'=>'Withdrawal Wallet',
            							'current_url'=>site_url(),
            							'reason'=>'9', //credit for matrix commission
            							'unique_identity'=>$unique_identity
            							));
                    				}
                                	if(count($manage_bv_history)>0)
                                	{
                                	    $obj->db->insert_batch('matrix_downline_pv',$manage_bv_history);
                                	    //echo "<br>";echo $obj->db->last_query();
                                	}
                					$creditStatus++;
            					}//end if
        					}
        			}//end foreach loop here		
        	}//end if
    	}
	}
	
	return $creditStatus;
}//end function

function creditBinaryCommission()
{
	//insert commission in user ewallet by fetching from level income table code start here
	$obj=& get_instance();
	$arraycom=array('',30,15,15,10,5);
	$all_user_query=$obj->db->select('*')->from('user_registration')->where(array('nom_id !=' => '','active_status'=>'1'))->get();
	
	$date=date('Y-m-d');
	$current_timestamp=date("Y-m-d H:i:s");
	$creditStatus=0;
	$manage_bv_history=array();
	if($all_user_query->num_rows()>0)
	{
	    //echo $this->db->last_query();
	    //echo "syubhahsj";
			foreach($all_user_query->result() as $userObj)
			{
					$user_id=$userObj->user_id;
					$pkg_id=$userObj->pkg_id;
					if($pkg_id>1)
					{
					    $matchingcondleft=$obj->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='left') and ref_id='".$user_id."'")->num_rows();
    					$matchingcondright=$obj->db->query("select user_id,(SELECT leg FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as leg,(SELECT level FROM `level_income_binary` where income_id='".$user_id."' and down_id=user_registration.user_id) as level from user_registration where user_id in (SELECT down_id FROM `level_income_binary` where income_id='".$user_id."' and leg='right') and ref_id='".$user_id."'")->num_rows();
    					
    					$commission_details=getBinaryPairingCommission($user_id,$pkg_id);
    					pr($commission_details);
    					
    					//exit;
    					if(!empty($commission_details->commission_amount) && $matchingcondleft>=1 && $matchingcondright>=1)
    					{
    						//$commission_amount=$commission_details->commission_amount;
    						$commission_amount=$commission_details->paid_commission_amount;
    						//$commission_amount=$commission_details->total_pair*100;
    						
    						$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$user_id,'wallet_type'=>'main','wallet_type_id'=>1))->get()->row();
    						echo "<br>"; echo $obj->db->last_query();
    						$balance=$query_obj->amount+$commission_amount;
    						$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$user_id,'wallet_type'=>'main','wallet_type_id'=>1));
    					    echo "<br>";	echo $obj->db->last_query();
    						//reason enum filed '1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
    						/*
    						Note: status field '0'=>debit,'1'=>credit
    						*/
    						$obj->db->insert('credit_debit',array(
    								'transaction_no'=>generateUniqueTranNo(),
    								'user_id'=>$user_id,
    								'credit_amt'=>$commission_amount,
    								'debit_amt'=>'0',
    								'balance'=>$balance,
    								'receiver_id'=>$user_id,
    								'sender_id'=>COMP_USER_ID,
    								'receive_date'=>date('Y-m-d'),
    								'ttype'=>'Binary Income',
    								'TranDescription'=>'Earn Binary Pairing Income of '.$commission_details->total_pair." pair",
    								'Cause'=>'Commission of Binary Pairing Income',
    								'Remark'=>'Binary Pairing Income',
    								'deposit_id'=>'1',
    								'product_name'=>'main',
    								'status'=>'1',
    								'matching_commission_status	'=>'0',
    								'current_url'=>ci_site_url(),
    								'carry_pv_left'=>$commission_details->carry_amount_left,
    								'carry_pv_right'=>$commission_details->carry_amount_right,
    								'daily_capping'=>$commission_details->daily_capping,
    								'total_pair'=>$commission_details->total_pair,
    								'pair_pv'=>$commission_details->pairpv,
    								'reason'=>'6'
    								));
        					echo "<br>";	echo $obj->db->last_query();		
        					$manage_bv_history=array();
        					if(!empty($commission_details->carry_amount_left))
        					{
        						$carry_amount_left=$commission_details->carry_amount_left;
        						$carry_pos_left=$commission_details->carry_pos_left;
        						
        						$manage_bv_history[]=array(
        						'income_id'=>$user_id,
        						'down_id'=>$user_id,
        						'level'=>'1',
        						'pv'=>$carry_amount_left,
        						'leg'=>$carry_pos_left,
        						'type'=>'Carry Forward PV',
        						'l_date'=>date('Y-m-d H:i:s'),
        						'status'=>'0'
        						);
        						
        						
        					}
        					
        					if(!empty($commission_details->carry_amount_right))
        					{
        						$carry_amount_right=$commission_details->carry_amount_right;
        						$carry_pos_right=$commission_details->carry_pos_right;
        						
        						$manage_bv_history[]=array(
        						'income_id'=>$user_id,
        						'down_id'=>$user_id,
        						'level'=>'1',
        						'pv'=>$carry_amount_right,
        						'leg'=>$carry_pos_right,
        						'type'=>'Carry Forward PV',
        						'l_date'=>date('Y-m-d H:i:s'),
        						'status'=>'0'
        						);
        						
        						
        					}
    					
        					// update matching commission
        					
        					/*$uplineinfo=$obj->db->select('*')->from('direct_matrix_downline')->where(array('down_id'=>$user_id))->order_by('level','desc')->get()->result();
        					foreach($uplineinfo as $key=>$val)
        					{
        					    $income_id=$val->income_id;
        					    $level=$val->level;
        					    $comm_amount=($commission_amount*$arraycom[$level])/100;
        					    if($comm_amount>0)
        							{
        								$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where(array('user_id'=>$income_id,'wallet_type'=>'main','wallet_type_id'=>1))->get()->row();
        								$balance=$query_obj->amount+$comm_amount;
        								$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$income_id,'wallet_type'=>'main','wallet_type_id'=>1));
        								//reason enum filed '1'=>debit for pkg purchased, '2'=> debit for ewallet withdrawl, '3'=>debit for balance transfer, '4'=>'credit for balance transfer received', '5'=>credit for direct commission, '6'=>credit for binary commission, '7'=>credit for matching commission, '9'=>credit for unilevel commission, '10'=>credit for rank bonus update
        								
        								$obj->db->insert('credit_debit',array(
        											'transaction_no'=>generateUniqueTranNo(),
        											'user_id'=>$income_id,
        											'credit_amt'=>$comm_amount,
        											'debit_amt'=>'0',
        											'balance'=>$balance,
        											'receiver_id'=>$income_id,
        											'sender_id'=>$user_id,
        											'receive_date'=>date('Y-m-d'),
        											'ttype'=>'Matching Income',
        											'TranDescription'=>'Earn Matching Income',
        											'Cause'=>'Commission of Matching Income',
        											'Remark'=>'Matching Income',
        											'level'=>$level,
        											'deposit_id'=>'1',
        											'product_name'=>'main',
        											'status'=>'1',
        											'ewallet_used_by'=>'',
        											'current_url'=>ci_site_url(),
        											'reason'=>'7'
        											));		
        							
        							}//end commision_amount>0 if here
        					    if($level==5)
        					    {
        					        break;
        					    }
        					}*/
        					
        					$receive_date=date('Y-m-d');
                        	$obj->db->update("matrix_downline_pv",array("status"=>'1'),array("date(l_date) <="=>$receive_date,"status"=>'0','income_id'=>$user_id));
                        	
                        	$userinfo=$obj->db->select('*')->from('user_registration')->where(array('user_id' =>$user_id))->get()->row();
                        	$ref_id=$userinfo->ref_id;
                        	$pkg_obj=$obj->db->select('pkg_id')->from('user_registration')->where('user_id',$ref_id)->get()->row();
            				$pkgid=$pkg_obj->pkg_id;
            				if($pkgid>1)
            				{
                            	$main_com_amount=($commission_amount*5)/100;
                            	$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$ref_id)->get()->row();
    							$balance=$query_obj->amount+$main_com_amount;
    							$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$ref_id));
    							$obj->db->insert('credit_debit',array(
    							'transaction_no'=>generateUniqueTranNo(),
    							'user_id'=>$ref_id,
    							'credit_amt'=>$main_com_amount,
    							'debit_amt'=>'0',
    							'balance'=>$balance,
    							'admin_charge'=>0,
    							'receiver_id'=>$ref_id,
    							'sender_id'=>$user_id,
    							'receive_date'=>date('Y-m-d'),
    							'ttype'=>'Direct Matching Bonus',
    							'TranDescription'=>'Direct Matching Bonus  from '.$user_id,
    							'Cause'=>'Direct Matching Bonus  from '.$user_id,
    							'Remark'=>'Direct Matching Bonus from'.$user_id,
    							'invoice_no'=>'',
    							'product_name'=>'main',
    							'deposit_id'=>'1',
    							'status'=>'1',
    							'ewallet_used_by'=>'Withdrawal Wallet',
    							'current_url'=>site_url(),
    							'reason'=>'9', //credit for matrix commission
    							'unique_identity'=>$unique_identity
    							));
            				}
                        	if(count($manage_bv_history)>0)
                        	{
                        	    $obj->db->insert_batch('matrix_downline_pv',$manage_bv_history);
                        	    echo "<br>";echo $obj->db->last_query();
                        	}
        					$creditStatus++;
    					}//end if
					}
			}//end foreach loop here		
	}//end if
	
	return $creditStatus;
}//end function


function fast_start_bonus($income_id=null)
{
    
	$obj=& get_instance();
	//$l_date = date('Y-m-d'); // Your initial date
    //$date = date('Y-m-d', strtotime($date . ' +1 month'));
    //echo $new_date; // Output: 2024-03-17 (One month subtracted)
	$countuser=$obj->db->select('*')->from('faststart_bonus')->where(array('user_id'=>$income_id,'status'=>0))->get()->num_rows(); //'user_id'=>'1478266',
	if($countuser>0)
	{
    	$pkg_obj=$obj->db->select('pkg_id,auto_registration_date')->from('user_registration')->where('user_id',$income_id)->get()->row();
        $pkgid=$pkg_obj->pkg_id;
        $l_date = date('Y-m-d',strtotime($pkg_obj->auto_registration_date)); // Your initial date
        $date = date('Y-m-d', strtotime($date . ' +1 month'));
        if($pkgid>1)
        {
            $query=$obj->db->query("SELECT down_id FROM `direct_matrix_downline` where income_id='".$income_id."' and l_date>='".$l_date." 00:00:00' and l_date<='".$date." 23:59:59' and level=1 limit 2");
        	//echo $obj->db->last_query();
        	$all_downlines=$query->result_array();
        	$count=$query->num_rows();
        	if($query->num_rows()>1)
        	{
        	    //pr($all_downlines);exit;
        	    foreach($all_downlines as $key=>$val)
        	    {
        	        //pr($val['down_id']);
        	        $array[]=$val['down_id'];
        	        $query1=$obj->db->query("SELECT down_id FROM `direct_matrix_downline` where income_id='".$val['down_id']."' and l_date>='".$l_date." 00:00:00' and l_date<='".$date." 23:59:59' and level=1 limit 2");
        	        $all_downlines1=$query1->result_array();
        	        //echo $obj->db->last_query(); echo "<br>";
        	        //pr($all_downlines1);
        	        foreach($all_downlines1 as $key1=>$val1)
        	        {
        	            $array[]=$val1['down_id'];
        	        }
        	        $count=$count+$query1->num_rows();
        	    }
        	    //echo "Total Count:".$count;
        	    //pr($array);
        	    if($count>=6)
        	    {
        	        $pv=0;
        	        foreach($array as $key2=>$val2)
        	        {
        	            $val2;
        	            //$user_obj=$obj->db->select('pkg_id')->from('user_package_log')->where('user_id',$val2)->get()->row();
        	            $user_obj=$obj->db->query("SELECT new_package_id as pkg_id FROM `user_package_log`  where user_id='".$val2."' and old_package_id is NULL order by id asc limit 1")->row();
        	
        	            
        	            $pkg_id=$user_obj->pkg_id;
        	            $pv_obj=$obj->db->select('pv')->from('package')->where('id',$pkg_id)->get()->row();
        	            $pv=$pv+$pv_obj->pv;
        	            
        	        }
        	        // get total pv of users
        	        $main_com_amount=(($pv*5)/100);
        	        
        	        $main_com_amount=$main_com_amount*500;
        							$query_obj=$obj->db->select('amount')->from('final_e_wallet')->where('user_id',$income_id)->get()->row();
        							$balance=$query_obj->amount+$main_com_amount;
        							$obj->db->update('final_e_wallet',array('amount'=>$balance),array('user_id'=>$income_id));
        							$obj->db->insert('credit_debit',array(
        							'transaction_no'=>generateUniqueTranNo(),
        							'user_id'=>$income_id,
        							'credit_amt'=>$main_com_amount,
        							'debit_amt'=>'0',
        							'balance'=>$balance,
        							'admin_charge'=>0,
        							'receiver_id'=>$income_id,
        							'sender_id'=>$income_id,
        							'receive_date'=>date('Y-m-d'),
        							'ttype'=>'Fast Start Bonus',
        							'TranDescription'=>'Fast Start Bonus',
        							'Cause'=>'Fast Start Bonus',
        							'Remark'=>'Fast Start Bonus',
        							'invoice_no'=>'',
        							'product_name'=>'main',
        							'deposit_id'=>'1',
        							'status'=>'1',
        							'pkg_id'=>$pkg_id,
        							'ewallet_used_by'=>'Withdrawal Wallet',
        							'current_url'=>site_url(),
        							'reason'=>'8', //credit for matrix commission
        							));
        							
        							$obj->db->update('faststart_bonus',
            							array(
            							    'amount'=>$main_com_amount,
            							    'update_date'=>date('Y-m-d'),
            							    'status'=>1
            							    ),array('user_id'=>$income_id));
        	    }
        	    
            }
        }
	}
}//end function
?>