
<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stockist_Model extends Common_Model
{
 
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
	
	public function getOneProduct($pid)
    {
        
        $query = $this->db->query("select * from eshop_products where id='".$pid."'");
		
        if ($query->num_rows() > 0) 
		{
            return $query->row_array();
        }
		else 
		{
            return false;
        }
    }
 
}