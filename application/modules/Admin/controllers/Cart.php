<?php
ob_start();
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package user/user
*/
class Cart extends Common_Controller 
{
	public function __construct()
	{
		parent::__construct();
		admin_auth();
	} 
	public function addToCart($product_id=null,$pkg_amount=null,$qty=null)
	{
	    //echo $product_id;
	    //echo $controller; exit;
		if(!empty($this->session->userdata('cart')))
		{
			$cart=$this->session->userdata('cart');
		}
		else 
		{
			$cart=array();
		}
		
		if(!array_key_exists($product_id,$cart))
		{
			$product_data=$this->db->query("select * from eshop_products where id='".$product_id."'")->row_array();
			$cart[$product_id]=array
			(
			'product_id'=>$product_id,
			'qty'=>$qty,
			'product_name'=>$product_data['title'],
			'tax'=>$product_data['tax'],
			'shipment_charge'=>$product_data['shipment_charge'],
			'product_price'=>$product_data['new_price'],
			'product_image'=>$product_data['product_image']
			);
		}
		else 
		{
			$cart_product_result=$cart[$product_id];
			$qty=$cart_product_result['qty']+1;
			$cart[$product_id]['qty']=$qty;
			//$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
			//$cart[$product_id]['shipment_charge']=$qty*$cart_product_result['shipment_charge'];
		}
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_items',$cart);
        $cart_item=$this->session->userdata('cart');
        //pr($cart_item);
		$cart_total=0;
		foreach($cart_item as $item)
		{
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 $cart_total=$cart_total+($item['qty']*$product_details['new_price']);
		 if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		 //+($item['qty']*$product_details['tax'])+($item['qty']*$product_details['shipment_charge']);
		}
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('total_products',count($cart_item));
		$this->session->set_userdata('cart_total_discount',$cart_total_discount);
		//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
		
		//redirect(base_url().'Admin/Eshop/ourCart');
		
		if($pkg_amount>=$cart_total)
		{
		    $this->session->set_userdata('cart_final_price',$cart_total);
		    $this->session->set_userdata('total_products',count($cart_item));
		    echo json_encode(array('total'=>count($cart_item),'total_cost'=>$cart_total,'packageamount'=>$pkg_amount,'type'=>'Added','reason'=>'','msg'=>'Product Added Successfully'));
		}
		else
		{
		    echo $this->removeItemFromCart($product_id,$pkg_amount,'Amount more than package amount');
		    //echo json_encode(array('total'=>count($cart_item),'total_cost'=>$cart_total,'packageamount'=>$pkg_amount));
		}
	}
	public function removeItemFromCart($product_id=null,$pkg_amount=null,$reason=null)
	{
	    
			$cart=$this->session->userdata('cart');
			unset($cart[$product_id]);
			$cart_total=0;
			//pr($product_id);
			foreach($cart as $item)
			{
				$product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
				$cart_total=$cart_total+($item['qty']*$product_details['new_price']);
				if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
			}
			$this->session->set_userdata('cart',$cart);
			$this->session->set_userdata('cart_final_price',$cart_total);
			$this->session->set_userdata('total_products',count($cart));
			$this->session->set_userdata('cart_total_discount',$cart_total_discount);
			//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Item removed successfully '.$product_id.'</span>');
			//redirect(site_url()."estore/".$controller);
			echo json_encode(array('total'=>count($cart),'total_cost'=>$cart_total,'packageamount'=>$pkg_amount,'reason'=>$reason,'type'=>'Removed','msg'=>'Product Removed'));
		    exit();
	}
	
	public function addToCartRepurchase($product_id=null,$controller=null,$qty=null)
	{
	    //echo $product_id;
	    //echo $controller; exit;
		if(!empty($this->session->userdata('cart')))
		{
			$cart=$this->session->userdata('cart');
		}
		else 
		{
			$cart=array();
		}
		
		if(!array_key_exists($product_id,$cart))
		{
			$product_data=$this->db->query("select * from eshop_products where id='".$product_id."'")->row_array();
			$cart[$product_id]=array
			(
			'product_id'=>$product_id,
			'qty'=>$qty,
			'product_name'=>$product_data['title'],
			'tax'=>$product_data['tax'],
			'shipment_charge'=>$product_data['shipment_charge'],
			'product_price'=>$product_data['new_price'],
			'product_image'=>$product_data['product_image']
			);
		}
		else 
		{
			$cart_product_result=$cart[$product_id];
			$qty=$cart_product_result['qty']+$qty;
			$cart[$product_id]['qty']=$qty;
			//$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
			//$cart[$product_id]['shipment_charge']=$qty*$cart_product_result['shipment_charge'];
		}
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_items',$cart);
        $cart_item=$this->session->userdata('cart');
        //pr($cart_item);
		$cart_total=0;
		foreach($cart_item as $item)
		{
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 $cart_total=$cart_total+($item['qty']*$product_details['new_price']);
		 if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		 //+($item['qty']*$product_details['tax'])+($item['qty']*$product_details['shipment_charge']);
		}
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('total_products',count($cart_item));
		$this->session->set_userdata('cart_total_discount',$cart_total_discount);
		//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
		
		redirect(base_url().'Admin/Eshop/ourCart');
		
	
	}
	
	public function addToCartRepurchaseDiscount($product_id=null,$controller=null,$qty=null)
	{
	    //echo $product_id;
	    //echo $controller; exit;
		if(!empty($this->session->userdata('cart')))
		{
			$cart=$this->session->userdata('cart');
		}
		else 
		{
			$cart=array();
		}
		
		if(!array_key_exists($product_id,$cart))
		{
			$product_data=$this->db->query("select * from eshop_products where id='".$product_id."'")->row_array();
			$cart[$product_id]=array
			(
			'product_id'=>$product_id,
			'qty'=>$qty,
			'product_name'=>$product_data['title'],
			'tax'=>$product_data['tax'],
			'shipment_charge'=>$product_data['shipment_charge'],
			'product_price'=>$product_data['new_price'],
			'product_image'=>$product_data['product_image']
			);
		}
		else 
		{
			$cart_product_result=$cart[$product_id];
			$qty=(int)$cart_product_result['qty']+(int)$qty;
			$cart[$product_id]['qty']=$qty;
			//$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
			//$cart[$product_id]['shipment_charge']=$qty*$cart_product_result['shipment_charge'];
		}
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_items',$cart);
        $cart_item=$this->session->userdata('cart');
        //pr($cart_item);
		$cart_total=0;
		foreach($cart_item as $item)
		{
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 $cart_total=$cart_total+($item['qty']*$product_details['new_price']);
		 //+($item['qty']*$product_details['tax'])+($item['qty']*$product_details['shipment_charge']);
		 if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		}
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('cart_total_discount',$cart_total_discount);
		$this->session->set_userdata('total_products',count($cart_item));
		$this->session->set_userdata('cart_total_discount',$cart_total_discount);
		$grand_total_cost=$cart_total-$cart_total_discount;
		//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
		echo json_encode(array('total'=>count($cart_item),'total_cost'=>currency().$cart_total,'total_discount'=>currency().$cart_total_discount,'grand_total_cost'=>currency().$grand_total_cost,'type'=>'Added','reason'=>'','msg'=>'Product Added Successfully'));
		
		//redirect(base_url().'Admin/Eshop/ourCart');
		
	
	}
	public function removeItemOfCart($product_id=null,$controller=null)
	{
        $product_id=$this->input->post('query');
		$cart=$this->session->userdata('cart');
		unset($cart[$product_id]);
		$cart_total=0;
		foreach($cart as $item)
		{
			$product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
			$cart_total=$cart_total+($item['qty']*$product_details['new_price']);
			if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		}
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('total_products',count($cart));
		$this->session->set_userdata('cart_total_discount',$cart_total_discount);
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Item removed successfully</span>');
		echo site_url()."Admin/Eshop/ourCart";
	    exit();
	}
	public function updateItemInCart($product_id=null,$qty=null,$controller=null)
	{
	    //echo $product_id.'=='.$qty.'=='.$controller; exit;
		$cart=$this->session->userdata('cart');
		$cart[$product_id]['qty']=$qty;
		$cart_total=0;
		foreach($cart as $item)
		{
			$product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
			$cart_total=$cart_total+($item['qty']*$product_details['new_price']);//+($item['qty']*$product_details['tax'])+($product_details['shipment_charge']);
			if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		}
		$cart_product_result=$cart[$product_id];
		$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('cart_total_discount',$cart_total_discount);
		
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Cart updated successfully</span>');
		//redirect(site_url()."estore/".$controller);
		//exit();
		//echo site_url()."user/eshop/ourCart";
	}
	
	public function updateItemOfCart($product_id=null,$qty=null,$controller=null)
	{
	    //echo $product_id.'=='.$qty.'=='.$controller; exit;
	    $product_id=$this->input->post('query');
	    $qty=$this->input->post('qty');
		$cart=$this->session->userdata('cart');
		$cart[$product_id]['qty']=$qty;
		$cart_total=0;
		foreach($cart as $item)
		{
			$product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
			$cart_total=$cart_total+($item['qty']*$product_details['new_price']);//+($item['qty']*$product_details['tax'])+($product_details['shipment_charge']);
			if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		}
		$cart_product_result=$cart[$product_id];
		//$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
		//pr($cart);
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('cart_total_discount',$cart_total_discount);
		
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Cart updated successfully</span>');
		//redirect(site_url()."estore/".$controller);
		//exit();
		echo site_url()."Admin/Eshop/ourCart";
	}
	
	public function updateToCart()
	{
	    //pr($_POST); exit;
	    $qtyarr=$this->input->post('qty');
	    
		if(!empty($this->session->userdata('cart')))
		{
			$cart=$this->session->userdata('cart');
		}
		else 
		{
			$cart=array();
		}
		foreach($qtyarr as $product_id=>$qty)
		{
    		if(!array_key_exists($product_id,$cart))
    		{
    			$product_data=$this->db->query("select * from eshop_products where id='".$product_id."'")->row_array();
    			$cart[$product_id]=array
    			(
    			'product_id'=>$product_id,
    			'qty'=>$qty,
    			'product_name'=>$product_data['title'],
    			'tax'=>$product_data['tax'],
    			'shipment_charge'=>$product_data['shipment_charge'],
    			'product_price'=>$product_data['new_price'],
    			'product_image'=>$product_data['product_image']
    			);
    		}
    		else 
    		{
    			$cart_product_result=$cart[$product_id];
    			$cart[$product_id]['qty']=$qty;
    			$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
    			$cart[$product_id]['shipment_charge']=$qty*$cart_product_result['shipment_charge'];
    		}
    		$this->session->set_userdata('cart',$cart);
	    }
        $cart_item=$this->session->userdata('cart');
		$cart_total=0;
		foreach($cart_item as $item)
		{
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 $cart_total=$cart_total+($item['qty']*$product_details['new_price'])+($item['qty']*$product_details['tax'])+($item['qty']*$product_details['shipment_charge']);
		 if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$product_details['new_price']*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		}
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('total_products',count($cart_item));
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('cart_total_discount',$cart_total_discount);
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Cart updated successfully</span>');
		redirect(site_url()."estore/viewCart");
		exit();
		
	}
}
