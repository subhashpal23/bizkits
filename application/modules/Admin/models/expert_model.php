<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
 * @package admin/member_model
*/
class Expert_Model extends Common_Model
{
  public function __construct()
    {
        //@call to parent CI_Model constructor
        parent::__construct();
    }
    
  public function getDirectCommission()
  {
      $sql=$this->db->select('*')->from('direct_commission_meta')->get()->result();
      return $sql;
  }
    public function getAllMembers($params = array(),$type=false)
    {
		$requestData = $_GET;
		//pr($params);
		/*
		 $requestData['length']=10;
		 $requestData['start']=1;
		 <th>Sr.No</th>
         <th>Member Name</th>
         <th>User Id</th>
         <th>Joining Date</th>
         <th>Sponsor Id</th>
         <th>Sponsor Name</th>
         
		 <th>View Genealogy</th>
      	 <th>Referral Tree</th>
         <th>Status</th>
         <th>Action</th>
		*/
		if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
		    
		    $sql2=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status,u.member_type,u.pkg_id,u.pkg_amount,u.idno,u.first_name,u.last_name,u.contact_no')
			->from('user_registration as u') 
			->where('u.member_type', 1);
		    if($params['user_id']!='')
		    {
		        $sql2=$sql2->where('user_id',$params['user_id']);
		    }
		    else if($params['username']!='')
		    {
		        $sql2=$sql2->where('username',$params['username']);
		    }
		    
             //$sql->order_by('u.id', 'desc'); 
			//$sql1 = clone $sql2;
            
			$totalData = $totalFiltered = $sql2->get()->num_rows();
			return $totalData; exit;
		}
		else
		{
		    
		    
		    if($params['user_id']!='')
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->num_rows();
		    }
		    else if($params['username']!='')
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->num_rows();
		    }
		    else
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->get()->num_rows();
		    }
		    
		
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    
                    
                    if($params['user_id']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
        		    else if($params['username']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->limit($params['limit'],$params['start'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
        		    else
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'],$params['start'])->get()->result(); 
                        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    
                    if($params['user_id']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->num_rows();
        		    }
        		    else if($params['username']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->limit($params['limit'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->num_rows();
        		    }
        		    else
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'])->get()->result(); 
                        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'])->get()->num_rows();
        		    }
                } 
            //$query = $sql->get()->result();
            //echo $this->db->last_query();
            
			             
        }
			$data = array();
            
			$sr_no = $params['start'];
            foreach ($query as $row) 
			{
                $active_status_class=($row->active_status=='1')?'label-success':'label-danger';
                $active_status_label=($row->active_status=='1')?'Active':'Inactive';
				
				$status=html_entity_decode('<span class="label '.$active_status_class.'">'.$active_status_label.'</span>');
				
				$edit=html_entity_decode('<a href="'.ci_site_url().'Admin/Expert/editMember/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Edit Member Profile"><i class="fa fa-edit"></i></a>');
				if($row->member_type==2)
				{ 
				    $st='<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
				    $stockist=$st; 
				    $stockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Stockist">'.$st.'Mega</a>');
				    
				    $st='<i class="fas fa-user-times"></i>';
				    $unstockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/removeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Make Stockist">'.$st.'</a>');
				}
				else if($row->member_type==3)
				{ 
				    $st='<i class="fa fa-shopping-bag" aria-hidden="true"></i>';
				    $stockist=$st; 
				    $stockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Stockist">'.$st.'Normal</a>');
				    
				    $st='<i class="fas fa-user-times"></i>';
				    $unstockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/removeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Make Stockist">'.$st.'</a>');
				}
				else
				{
				    $st='<i class="fa fa-truck" aria-hidden="true"></i>';
				    $stockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Make Mega Stockist">'.$st.'Normal</a>');
				    $unstockist="";
				    
				    $st1='<i class="fa fa-solid fa-store"></i>';
				    
				    $stockist1=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeNStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Make Noraml Stockist">'.$st1.'Mega</a>');
				    $unstockist="";
				}
				 
				 if($row->idno=='Free')
				    { 
				        $st='<i class="fas fa-user-times"></i>';
				        $freereg=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/unmarkFree/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Un Mark Free">'.$st.'</a>');
				    //$unstockist="";
				    }
				    else
				    {
				    $st='<i class="fa fa-shopping-cart"></i>';
				    $freereg=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/assignProducts/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Assign Products">'.$st.'</a>');
				    //$unstockist="";
				    }   
				    
				    $viewm=html_entity_decode('<a href="'.ci_site_url().'Admin/Eshop_orders/allReports/'.ID_encode($row->user_id).'" ><i class="fa fa-eye"></i></a>');
					// $viewmlogin=html_entity_decode('<a href="'.ci_site_url().'Admin/Expert/loginAs/'.ID_encode($row->user_id).'" target="_blank" title="Login Access"><i class="fa fa-lock"></i></a>');
				
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
                $nestedData[] = ucwords($row->first_name).' '.ucwords($row->last_name);
                $nestedData[] = ucwords($row->contact_no);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				
				$nestedData[] = $status;
				
				
				
				$nestedData[] = $edit.'&nbsp;&nbsp;'.$viewm;	
                $data[] = $nestedData;
           }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );
            return  $json_data;
    }//end method 
    public function getPromoMembers($params = array(),$type=false)
    {
		$requestData = $_GET;
	
		if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
		    
		    $sql2=$this->db->select('u.*')
			->from('user_package_log as u');
		    if($params['user_id']!='')
		    {
		        $sql2=$sql2->where('user_id',$params['user_id']);
		    }
		    else if($params['username']!='')
		    {
		        $sql2=$sql2->where('username',$params['username']);
		    }
		    $sql2=$sql2->where('purchased_date >=','2024-06-10 00:00:00');
		    $sql2=$sql2->where('new_package_id',4);
             //$sql->order_by('u.id', 'desc'); 
			//$sql1 = clone $sql2;
            
			$totalData = $totalFiltered = $sql2->get()->num_rows();
			return $totalData; exit;
		}
		else
		{
		    
		    
		    if($params['user_id']!='')
		    {
		        $query=$this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->get()->num_rows();
		    }
		    else if($params['username']!='')
		    {
		        $query=$this->db->select('*')->from('user_package_log')->where('username',$params['username'])->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->get()->num_rows();
		    }
		    else
		    {
		        $query=$this->db->select('*')->from('user_package_log')->where(array('purchased_date >='=>'2024-06-10 00:00:00','new_package_id'=>4))->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->get()->num_rows();
		    }
		    
		
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    
                    
                    if($params['user_id']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
        		    else if($params['username']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_package_log')->where('username',$params['username'])->limit($params['limit'],$params['start'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
        		    else
        		    {
        		        $query=$this->db->select('*')->from('user_package_log')->where(array('purchased_date >='=>'2024-06-10 00:00:00','new_package_id'=>4))->limit($params['limit'],$params['start'])->get()->result(); 
                        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    
                    if($params['user_id']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->limit($params['limit'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->limit($params['limit'])->get()->num_rows();
        		    }
        		    else if($params['username']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_package_log')->where('username',$params['username'])->limit($params['limit'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->where('user_id',$params['user_id'])->limit($params['limit'])->get()->num_rows();
        		    }
        		    else
        		    {
        		        $query=$this->db->select('*')->from('user_package_log')->where(array('purchased_date >='=>'2024-06-10 00:00:00','new_package_id'=>4))->limit($params['limit'])->get()->result(); 
                        $totalData = $totalFiltered = $this->db->select('*')->from('user_package_log')->limit($params['limit'])->get()->num_rows();
        		    }
                } 
            //$query = $sql->get()->result();
            //echo $this->db->last_query();
            
			             
        }
			$data = array();
            
			$sr_no = $params['start'];
            foreach ($query as $row) 
			{
                $active_status_class=($row->active_status=='1')?'label-success':'label-danger';
                $active_status_label=($row->active_status=='1')?'Active':'Inactive';
				
				$status=html_entity_decode('<span class="label '.$active_status_class.'">'.$active_status_label.'</span>');
				
				$edit=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/editMember/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Edit Member Profile"><i class="fa fa-edit"></i></a>');
				if($row->member_type==2)
				{ 
				    $st='<i class="fa fa-shopping-cart" aria-hidden="true"></i>';
				    $stockist=$st; 
				    $stockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Stockist">'.$st.'Mega</a>');
				    
				    $st='<i class="fas fa-user-times"></i>';
				    $unstockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/removeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Make Stockist">'.$st.'</a>');
				}
				else if($row->member_type==3)
				{ 
				    $st='<i class="fa fa-shopping-bag" aria-hidden="true"></i>';
				    $stockist=$st; 
				    $stockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Stockist">'.$st.'Normal</a>');
				    
				    $st='<i class="fas fa-user-times"></i>';
				    $unstockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/removeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Make Stockist">'.$st.'</a>');
				}
				else
				{
				    $st='<i class="fa fa-truck" aria-hidden="true"></i>';
				    $stockist=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Make Mega Stockist">'.$st.'Normal</a>');
				    $unstockist="";
				    
				    $st1='<i class="fa fa-solid fa-store"></i>';
				    
				    $stockist1=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeNStockist/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Make Noraml Stockist">'.$st1.'Mega</a>');
				    $unstockist="";
				}
				 
				 if($row->idno=='Free')
				    { 
				        $st='<i class="fas fa-user-times"></i>';
				        $freereg=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/unmarkFree/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Un Mark Free">'.$st.'</a>');
				    //$unstockist="";
				    }
				    else
				    {
				    $st='<i class="fa fa-user"></i>';
				    $freereg=html_entity_decode('<a href="'.ci_site_url().'Admin/Member/makeFree/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="Mark Free">'.$st.'</a>');
				    //$unstockist="";
				    }   
				
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = get_user_name($row->user_id);
                $nestedData[] = ucwords($row->user_id);
                $nestedData[] = ucwords($row->first_name);
                $nestedData[] = ucwords($row->contact_no);
				$nestedData[] = date(date_formats(),strtotime($row->purchased_date));
			
				$nestedData[] = get_package_name($row->new_package_id);
				//$nestedData[] = $edit;
                $data[] = $nestedData;
           }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );
            return  $json_data;
    }//end method 
    public function getAllMembersPassword($params = array(),$type=false)
    {
		$requestData = $_GET;
		      
            
            if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
		    $sql2=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status,u.member_type,u.pkg_id,u.pkg_amount,u.first_name,u.last_name,u.contact_no')
			->from('user_registration as u') 
			->where('u.member_type', 1); 
		    if($params['user_id']!='')
		    {
		        $sql2=$sql2->where('user_id',$params['user_id']);
		    }
		    else if($params['username']!='')
		    {
		        $sql2=$sql2->where('username',$params['username']);
		    }
             //$sql->order_by('u.id', 'desc'); 
			//$sql1 = clone $sql2;
            
			$totalData = $totalFiltered = $sql2->get()->num_rows();
			return $totalData; exit;
		}
		else
		{
		    /*$query=$this->db->select('*')->from('user_registration')->get()->result();
		    $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->get()->num_rows();
		
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $query=$this->db->select('*')->from('user_registration')->limit($params['limit'],$params['start'])->get()->result(); 
                    $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->limit($params['limit'],$params['start'])->get()->num_rows();
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    $query=$this->db->select('*')->from('user_registration')->limit($params['limit'])->get()->result(); 
                    $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->limit($params['limit'])->get()->num_rows();
                } */
                
                if($params['user_id']!='')
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->num_rows();
		    }
		    else if($params['username']!='')
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->num_rows();
		    }
		    else
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->get()->num_rows();
		    }
		    
		
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    
                    
                    if($params['user_id']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
        		    else if($params['username']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->limit($params['limit'],$params['start'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
        		    else
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'],$params['start'])->get()->result(); 
                        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    
                    if($params['user_id']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->num_rows();
        		    }
        		    else if($params['username']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->limit($params['limit'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->num_rows();
        		    }
        		    else
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'])->get()->result(); 
                        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'])->get()->num_rows();
        		    }
                } 
            //$query = $sql->get()->result();
            //echo $this->db->last_query();
            
			             
        }
        
			$data = array();
            
			$sr_no = $params['start'];
            foreach ($query as $row) 
			{
                $active_status_class=($row->active_status=='1')?'label-success':'label-danger';
                $active_status_label=($row->active_status=='1')?'Active':'Inactive';
				
				$status=html_entity_decode('<span class="label '.$active_status_class.'">'.$active_status_label.'</span>');
				
				$reset_password=html_entity_decode('<a href="'.ci_site_url().'Admin/Expert/resetPassword/'.ID_encode($row->user_id).'"><i class="fa fa-key"></i></a>');
				$reset_password1=html_entity_decode('<a href="'.ci_site_url().'Admin/Expert/resetTPassword/'.ID_encode($row->user_id).'">Reset Transaction Password</a>');
				//$viewm=html_entity_decode('<a href="'.ci_site_url().'Web/checkuserlogin/'.$row->username.'/'.$row->password.'" target="_blank"><i class="fa fa-eye"></i></a>');
				
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
                $nestedData[] = ucwords($row->first_name).' '.ucwords($row->last_name);
                $nestedData[] = ucwords($row->contact_no);
				//$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				//$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $row->password;
				$nestedData[] = $reset_password.'&nbsp;&nbsp;'.$viewm;
				//$nestedData[] = $row->t_code;
				//$nestedData[] = $reset_password1;
				//$nestedData[] = $status;
                $data[] = $nestedData;
           }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );
            return  $json_data;
    }//end method 		
  public function getAllActiveMembers()
   {
      $requestData = $_GET;
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status',false)
			->from('user_registration as u');
		if (!empty($requestData['search']['value'])) {
                $ser = strtolower($requestData['search']['value']);
                $sql->where("(LOWER(u.username) like '%$ser%'");
                $sql->or_where("LOWER(u.user_id) like '%$ser%' ");
                $sql->or_where("u.ref_id like '%$ser%' ");
                $sql->or_where("u.registration_date like '%$ser%' )");
             }
             //$sql->order_by('u.id', 'desc'); 
			$sql->where_in('u.active_status',array('1'));  
			$sql1 = clone $sql;
             if ($requestData['length'] != '-1') {  // for showing all records
                $query = $sql->limit($requestData['length'], $requestData['start']);   
             }
            $query = $sql->get()->result();
            
			$totalData = $totalFiltered = $sql1->get()->num_rows();             
            
			$data = array();
            
			$sr_no = $requestData['start'];
            foreach ($query as $row) 
			{
                $active_status_class=($row->active_status=='1')?'label-success':'label-danger';
                $active_status_label=($row->active_status=='1')?'Active':'Inactive';
				
				$status=html_entity_decode('<span class="label '.$active_status_class.'">'.$active_status_label.'</span>');
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $row->ref_id;
				$nestedData[] = $status;
                $data[] = $nestedData;
           }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );
            return  $json_data;
   }//end method
  public function getAllInActiveMembers()
   {
        $requestData = $_GET;
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status',false)
			->from('user_registration as u');
		if (!empty($requestData['search']['value'])) {
                $ser = strtolower($requestData['search']['value']);
                $sql->where("(LOWER(u.username) like '%$ser%'");
                $sql->or_where("LOWER(u.user_id) like '%$ser%' ");
                $sql->or_where("u.ref_id like '%$ser%' ");
                $sql->or_where("u.registration_date like '%$ser%' )");
             }
			$sql->where_in('u.active_status',array('0'));  
             //$sql->order_by('u.id', 'desc'); 
			$sql1 = clone $sql;
             if ($requestData['length'] != '-1') {  // for showing all records
                $query = $sql->limit($requestData['length'], $requestData['start']);   
             }
            $query = $sql->get()->result();
            
			$totalData = $totalFiltered = $sql1->get()->num_rows();             
            
			$data = array();
            
			$sr_no = $requestData['start'];
            foreach ($query as $row) 
			{
                $active_status_class=($row->active_status=='1')?'label-success':'label-danger';
                $active_status_label=($row->active_status=='1')?'Active':'Inactive';
				
				$status=html_entity_decode('<span class="label '.$active_status_class.'">'.$active_status_label.'</span>');
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $row->ref_id;
				$nestedData[] = $status;
                $data[] = $nestedData;
           }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );
            return  $json_data;
   }//end method
   public function getAllBlockUnBlockMembers($params=array())
    {
		$requestData = $_GET;
		if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){ 
		    
		    $sql2=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status,u.member_type,u.pkg_id,u.pkg_amount,u.idno,u.first_name,u.last_name,u.contact_no')
			->from('user_registration as u')->where('u.member_type', 1); 
		    if($params['user_id']!='')
		    {
		        $sql2=$sql2->where('user_id',$params['user_id']);
		    }
		    else if($params['username']!='')
		    {
		        $sql2=$sql2->where('username',$params['username']);
		    }
             //$sql->order_by('u.id', 'desc'); 
			//$sql1 = clone $sql2;
            
			$totalData = $totalFiltered = $sql2->get()->num_rows();
			return $totalData; exit;
		}
		else
		{
		    
		    
		    if($params['user_id']!='')
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->num_rows();
		    }
		    else if($params['username']!='')
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->get()->num_rows();
		    }
		    else
		    {
		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->get()->result();
		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->get()->num_rows();
		    }
		    
		
            if(array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    
                    
                    if($params['user_id']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
        		    else if($params['username']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->limit($params['limit'],$params['start'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
        		    else
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'],$params['start'])->get()->result(); 
                        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'],$params['start'])->get()->num_rows();
        		    }
                }elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){ 
                    
                    if($params['user_id']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->num_rows();
        		    }
        		    else if($params['username']!='')
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->where('username',$params['username'])->limit($params['limit'])->get()->result();
        		        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->where('user_id',$params['user_id'])->limit($params['limit'])->get()->num_rows();
        		    }
        		    else
        		    {
        		        $query=$this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'])->get()->result(); 
                        $totalData = $totalFiltered = $this->db->select('*')->from('user_registration')->where('member_type', 1)->limit($params['limit'])->get()->num_rows();
        		    }
                } 
            //$query = $sql->get()->result();
            //echo $this->db->last_query();
            
			             
        }
    
            
			$data = array();
            
			$sr_no = $requestData['start'];
            foreach ($query as $row) 
			{
                $active_status_class=($row->active_status=='1')?'label-success':'label-danger';
                $active_status_label=($row->active_status=='1')?'Active':'Inactive';
				//////////////////////
				$status_change_icon=($row->active_status=='1')?'fa fa-times':'fa fa-user';
				$status_change_tooltip=($row->active_status=='1')?'block':'Unblock';
				////////////////////
				
				$action=html_entity_decode(' <a onclick="return changeStatusConfirm('.$row->active_status.');" href="'.ci_site_url().'Admin/Expert/changeStatus/'.ID_encode($row->user_id).'" data-popup="tooltip" title="" data-original-title="'.$status_change_tooltip.'"><i class="'.$status_change_icon.'"></i></a>
                           ');
				
				$status=html_entity_decode('<span class="label '.$active_status_class.'">'.$active_status_label.'</span>');
				$nestedData = array();
                $nestedData[] = ++$sr_no;
				$nestedData[] = ucwords($row->username);
                $nestedData[] = ucwords($row->user_id);
                $nestedData[] = ucwords($row->first_name).' '.ucwords($row->last_name);
                $nestedData[] = ucwords($row->contact_no);
				$nestedData[] = date(date_formats(),strtotime($row->registration_date));
				//$nestedData[] = $row->ref_id;
				//$nestedData[] = get_user_name($row->ref_id);
				$nestedData[] = $status;
				$nestedData[] = $action;
                $data[] = $nestedData;
           }
            $json_data = array(
                "draw" => intval($requestData['draw']),
                "recordsTotal" => intval($totalData),
                "recordsFiltered" => intval($totalFiltered),
                "data" => $data
            );
            return  $json_data;
    }
  public function getAllDirectMember($user_id)
   {
    $userQuery=$this->db->select('u.id,u.username,u.user_id,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,u1.username as sponsor_name,u2.username as nom_name, w.amount')->from('user_registration as u')
    ->join('final_e_wallet as w', 'w.user_id=u.user_id')
    ->join('user_registration as u1', 'u.ref_id=u1.user_id')
    ->join('user_registration as u2', 'u.nom_id=u2.user_id')
    ->where('u.ref_id',$user_id)
    ->get();
    //echo $this->db->last_query();
    $result=(!empty($userQuery->result()))?$userQuery->result():array();
    return $result;
   }//end method
  public function getAllDownlineMembers($user_id)
   {
    $userQuery=$this->db->select('u.id,u.username,u.binary_pos,u.rank_name,u.active_status,u.registration_date,u.active_status,l.level,u1.username as sponsor_name,u2.username as nom_name, p.title as package_name,w.amount')->from('user_registration as u')
    ->join('level_income_binary as l', 'l.income_id=u.user_id')
    ->join('final_e_wallet as w', 'w.user_id=u.user_id')
    ->join('user_registration as u1', 'u.ref_id=u1.user_id')
    ->join('user_registration as u2', 'u.nom_id=u2.user_id')
    ->where('u.ref_id',$user_id)
    ->get();
    $result=(!empty($userQuery->result()))?$userQuery->result():array();
    return $result;
   }//end method
   public function getUserId($username)
   {
    $this->db->where('username',$username);
    $this->db->or_where('user_id',$username);
    $user_obj=$this->db->select('user_id')->from('user_registration')->get()->row();
    $user_id=(!empty($user_obj->user_id))?$user_obj->user_id:null;
    return $user_id;
   }//end method
   
     public function getAllWalletMembers()
    {
		$requestData = $_GET;
		
		$sql=$this->db->select('u.id,u.username,u.user_id,u.ref_id,u.registration_date,u.active_status',false)
			->from('user_registration as u');
		
		
            $query = $sql->get()->result();
            //echo $this->db->last_query();
			
            return  $query;
    }//end method 
    
}//end class
?>