<?php 
if(!function_exists('getNom'))
{
	function getNom($sponserid)
	{
			//static $nom_id1,$lev;
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
			    getNom($rclid1);
			}//end switch
			$total_nom=$obj->db->select('*')->from('user_registration')->where('nom_id',$nom_id1)->get()->num_rows();
			if($total_nom==2)
			{
				getNom($rclid1);
			}
			if(!empty($nom_id1) && empty($_SESSION['nom_id']))
			{
				$_SESSION['nom_id']=$nom_id1;
				$is_exists=$obj->db->select('id')->from('user_registration')->where('user_id',$nom_id1)->get()->num_rows();
				if($is_exists<=0)
				{
					echo "\n wrong code in get nom\n";
					echo "\n nom_id=".$nom_id1;
				}
			}
			return $nom_id1;
	}//end function
}//end function exists
?>