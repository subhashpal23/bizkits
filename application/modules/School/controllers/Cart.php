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
		student_auth();
	} 
	public function addToCart($product_id=null,$controller=null)
	{
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
			'qty'=>'1',
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
			$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
			$cart[$product_id]['shipment_charge']=$qty*$cart_product_result['shipment_charge'];
		}
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_items',$cart);
        $cart_item=$this->session->userdata('cart');
        //pr($cart_item);
		$cart_total=0;
		foreach($cart_item as $item)
		{
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 $cart_total=$cart_total+($item['qty']*$product_details['new_price'])+($item['qty']*$product_details['tax'])+($item['qty']*$product_details['shipment_charge']);
		}
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('total_products',count($cart_item));
		//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
		
		redirect(base_url().'user/eshop/ourCart');
	}
	public function removeItemFromCart($product_id=null,$controller=null)
	{
			$cart=$this->session->userdata('cart');
			unset($cart[$product_id]);
			$cart_total=0;
			foreach($cart as $item)
			{
				$product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
				$cart_total=$cart_total+($item['qty']*$product_details['new_price']);
			}
			$this->session->set_userdata('cart',$cart);
			$this->session->set_userdata('cart_final_price',$cart_total);
			$this->session->set_userdata('total_products',count($cart));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Item removed successfully</span>');
			redirect(site_url()."estore/".$controller);
		    exit();
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
		}
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('total_products',count($cart));
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Item removed successfully</span>');
		echo site_url()."user/eshop/ourCart";
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
			$cart_total=$cart_total+($item['qty']*$product_details['new_price'])+($item['qty']*$product_details['tax'])+($product_details['shipment_charge']);
		}
		$cart_product_result=$cart[$product_id];
		$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_final_price',$cart_total);
		
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Cart updated successfully</span>');
		redirect(site_url()."estore/".$controller);
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
			$cart_total=$cart_total+($item['qty']*$product_details['new_price'])+($item['qty']*$product_details['tax'])+($product_details['shipment_charge']);
		}
		$cart_product_result=$cart[$product_id];
		$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
		//pr($cart);
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_final_price',$cart_total);
		
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Cart updated successfully</span>');
		//redirect(site_url()."estore/".$controller);
		//exit();
		echo site_url()."user/eshop/ourCart";
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
		}
		$this->session->set_userdata('cart_final_price',$cart_total);
		$this->session->set_userdata('total_products',count($cart_item));
		$this->session->set_userdata('cart_final_price',$cart_total);
		
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Cart updated successfully</span>');
		redirect(site_url()."estore/viewCart");
		exit();
		
	}
}
