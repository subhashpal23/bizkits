<?php 
/*
@author : Aditya
@param  : int(referral userid/sponsor user id), string(leg position)
@desc   : It's used to identify the nom id
@return int(nom_id)
*/
if(!function_exists('getNom2'))
{
	function getNom2($sponserid)
	{
			//static $nom_id1,$lev;
			$obj=& get_instance();
			foreach($sponserid as $key => $val)
			{
			//$query1="select * from user_registration where nom_id='$val' order by id asc";
			//$result1=mysql_query($query1);
			$query1=$obj->db->select('*')->from('reg_stage2')->where('nom_id',$val)->order_by('id','ASC')->get();
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
				    $nom_id1=$sponserid[$key1];
					break;
					}
			    case '1':
					{
				   	$nom_id1=$sponserid[$key1];
					break;
					}
				case '2':
					if(!empty($nom_id1))
					{
					 break;
					}
			    getNom2($rclid1);
			}//end switch
			$total_nom=$obj->db->select('*')->from('reg_stage2')->where('nom_id',$nom_id1)->get()->num_rows();
			if($total_nom==2)
			{
				getNom2($rclid1);
			}
			if(!empty($nom_id1) && empty($_SESSION['nom_id2']))
			{
				$_SESSION['nom_id2']=$nom_id1;
				$is_exists=$obj->db->select('id')->from('reg_stage2')->where('user_id',$nom_id1)->get()->num_rows();
				if($is_exists<=0)
				{
					echo "\n wrong code in get nom2\n";
					echo "\n nom_id=".$nom_id1;
				}
			}
			return $nom_id1;
	}//end function
}//end function exists
if(!function_exists('getFollowMeMatrixNom2'))
{
	function getFollowMeMatrixNom2($user_id,$sponserid=null)
	{
		$obj=& get_instance();
		///if sponser available
		$sponsor_count=$obj->db->select('*')->from('reg_stage2')->where('user_id',$sponserid)->get()->num_rows();
		if($sponsor_count==0)
		{
			$all_upliner=$obj->db->select('*')->from('matrix_downline')->where('down_id',$user_id)->get()->result();
			
			foreach($all_upliner as $upliner)
			{
				$upliner_count=$obj->db->select('*')->from('reg_stage2')->where('user_id',$upliner->income_id)->get()->num_rows();
				if($upliner_count>0)
				{
				   	$nom_id=$upliner->income_id;
					break;
				}
			}
			$ref_id[]=$nom_id;	
			
		}
		else 
		{
			$ref_id[]=$sponserid;			
		}
		getNom2($ref_id);
	}//end function
}//end function exists
?>