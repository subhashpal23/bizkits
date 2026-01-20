<?php 
function get_all_category()
	{
		$obj=& get_instance();
		$result=$obj->db->query("select * from eshop_category where active_status='1' order by position")->result_array();
		return (!empty($result))?$result:array();
	}

function call_subcategory($cat_id=null)
	{
		$obj=& get_instance();
		$result=$obj->db->query("select * from eshop_subcategory where parent_id='".$cat_id."' and active_status='1' order by position")->result_array();
		return (!empty($result))?$result:array();
	}
	
function getProductDetail($pid=null)
{
	    $obj=& get_instance();
		$result=$obj->db->query("select * from eshop_products where id='".$pid."'")->row_array();
		return (!empty($result))?$result:array();
}
function get_all_sub_category_product($sub_cat_id)
{
	    $obj=& get_instance();
		return $obj->db->select('*')->from('eshop_products')->where(array('category_id'=>$sub_cat_id,'status'=>'1'))->get()->result();
}
function get_product_level_commission($pid){
	$obj=& get_instance();
	return $obj->db->select('*')->from('eshop_product_level_commission')->where('product_id',$pid)->get()->result();
}//end function	
if(!function_exists('generatestockistid'))
{
	function generatestockistid()
	{
		$obj=& get_instance();
		$encypt1=uniqid(rand(100000,999999), true);
		$usid1=str_replace(".", "", $encypt1);
		$user_id_prefix=$obj->db->select('*')->from('user_id_setting')->where('id',1)->get()->row();
		$prefix='';
		if($user_id_prefix->type=='1')
		{
			$prefix=$user_id_prefix->prefix;
		}
		$pre_userid = $prefix.substr($usid1, 0, 7);
		$query=$obj->db->select('user_id')->from('admin_sub')->where(array('user_id'=>$pre_userid))->get();
		if($query->num_rows()>0)
		{
		 generatestockistid();
		}
		else
		{
		 return $pre_userid;
	    }
	}//end function    
}//end function exists
?>