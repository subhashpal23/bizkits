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
		//affiliate_auth();
	} 
	public function addToCart($product_id=null,$pkg_amount=null,$qty=null)
	{
	    //echo $product_id;
	    //echo $controller; exit;
		if(!empty($this->session->userdata('cart_reg')))
		{
			$cart=$this->session->userdata('cart_reg');
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
		$this->session->set_userdata('cart_reg',$cart);
		$this->session->set_userdata('cart_reg_items',$cart);
        $cart_item=$this->session->userdata('cart_reg');
        //pr($cart_item);
		$cart_total=0;
		foreach($cart_item as $item)
		{
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 $cart_total=$cart_total+($item['qty']*$product_details['new_price']);
		 //+($item['qty']*$product_details['tax'])+($item['qty']*$product_details['shipment_charge']);
		}
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
		//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
		
		//redirect(base_url().'Affiliate/Eshop/ourCart');
	}
	public function addToCartProducts($product_id=null,$qty=null,$price=null)
	{
	    //echo $product_id;
	    //echo $controller; exit;
		if(!empty($this->session->userdata('cart_reg')))
		{
			$cart=$this->session->userdata('cart_reg');
		}
		else 
		{
			$cart=array();
		}
		
		if(!array_key_exists($product_id,$cart))
		{
			$product_data=$this->db->query("select * from eshop_products where id='".$product_id."'")->row_array();
			if($price=='Basic')
			{
			    $price_new=$product_data['price1'];
			}
			else if($price=='Economy')
			{
			    $price_new=$product_data['price2'];
			}
			else if($price=='Enterprise')
			{
			    $price_new=$product_data['price3'];
			}
			$cart[$product_id]=array
			(
			'product_id'=>$product_id,
			'qty'=>$qty,
			'product_name'=>$product_data['title'],
			'tax'=>$product_data['tax'],
			'shipment_charge'=>$product_data['shipment_charge'],
			'product_price'=>$price_new,
			'package'=>$price,
			'product_image'=>$product_data['product_image']
			);
		}
		else 
		{
		    $package=$cart['package'];
		    if($price==$package)
			{
			    $cart_product_result=$cart[$product_id];
    			$qty=$cart_product_result['qty']+$qty;
    			$cart[$product_id]['qty']=$qty;
			}
			else if($price!=$package)
			{
			    $cart_product_result=$cart[$product_id];
    			$qty=$cart_product_result['qty'];
    			$cart[$product_id]['qty']=$qty;
    			$cart[$product_id]['package']=$price;
			}
			
			
			//$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
			//$cart[$product_id]['shipment_charge']=$qty*$cart_product_result['shipment_charge'];
		}
		$this->session->set_userdata('cart_reg',$cart);
		$this->session->set_userdata('cart_reg_items',$cart);
        $cart_item=$this->session->userdata('cart_reg');
        //pr($cart_item);
		$cart_total=0;
		foreach($cart_item as $item)
		{
		    $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		    if($price=='Basic')
			{
			    $price_new=$product_data['price1'];
			}
			else if($price=='Economy')
			{
			    $price_new=$product_data['price2'];
			}
			else if($price=='Enterprise')
			{
			    $price_new=$product_data['price3'];
			}
		    $cart_total=$cart_total+($item['qty']*$price_new);
		    if($product_details['discount_type']=='per')
    		{
    		   $discount=((int)$price_new*(int)$product_details['discount'])/100;
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
		    $this->session->set_userdata('cart_total_discount',$cart_total_discount);
		    $this->session->set_userdata('total_products',count($cart_item));
		    $grand_total_cost=$cart_total-$cart_total_discount;
		    echo json_encode(array('total'=>count($cart_item),'total_cost'=>currency().$cart_total,'total_discount'=>currency().$cart_total_discount,'grand_total_cost'=>currency().$grand_total_cost,'type'=>'Added','reason'=>'','msg'=>'Product Added Successfully'));
		
		//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
		
		//redirect(base_url().'Affiliate/Eshop/ourCart');
	}
	public function updateQtyProducts($product_id=null,$qty=null)
	{
	    //echo $product_id;
	    //echo $controller; exit;
		if(!empty($this->session->userdata('cart_reg')))
		{
			$cart=$this->session->userdata('cart_reg');
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
			//$qty=$cart_product_result['qty']+$qty;
			$cart[$product_id]['qty']=$qty;
			//$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
			//$cart[$product_id]['shipment_charge']=$qty*$cart_product_result['shipment_charge'];
		}
		$this->session->set_userdata('cart_reg',$cart);
		$this->session->set_userdata('cart_reg_items',$cart);
        $cart_item=$this->session->userdata('cart_reg');
        //pr($cart_item);
		$cart_total=0;
		foreach($cart_item as $item)
		{
		    $price=$item['package'];
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 if($price=='Basic')
			{
			    $price_new=$product_details['price1'];
			}
			else if($price=='Economy')
			{
			    $price_new=$product_details['price2'];
			}
			else if($price=='Enterprise')
			{
			    $price_new=$product_details['price3'];
			}
		 $cart_total=$cart_total+($item['qty']*$price_new);
		 //+($item['qty']*$product_details['tax'])+($item['qty']*$product_details['shipment_charge']);
		 if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=($price_new*$product_details['discount'])/100;
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
		    $grand_total_cost=$cart_total-$cart_total_discount;
		    echo json_encode(array('total'=>count($cart_item),'total_cost'=>currency().$cart_total,'total_discount'=>currency().$cart_total_discount,'grand_total_cost'=>currency().$grand_total_cost,'type'=>'Added','reason'=>'','msg'=>'Product Added Successfully'));
		
		//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
		
		//redirect(base_url().'Affiliate/Eshop/ourCart');
	}
	public function updateQtyProductsPackage($product_id=null,$package=null)
	{
	    //echo $product_id;
	    //echo $controller; exit;
		if(!empty($this->session->userdata('cart_reg')))
		{
			$cart=$this->session->userdata('cart_reg');
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
			$cart[$product_id]['package']=$package;
			//$qty=$cart_product_result['qty']+$qty;
			//$cart[$product_id]['qty']=$qty;
			//$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
			//$cart[$product_id]['shipment_charge']=$qty*$cart_product_result['shipment_charge'];
		}
		$this->session->set_userdata('cart_reg',$cart);
		$this->session->set_userdata('cart_reg_items',$cart);
        $cart_item=$this->session->userdata('cart_reg');
        //pr($cart_item);
		$cart_total=0;
		foreach($cart_item as $item)
		{
		    $price=$item['package'];
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 if($price=='Basic')
			{
			    $price_new=$product_details['price1'];
			}
			else if($price=='Economy')
			{
			    $price_new=$product_details['price2'];
			}
			else if($price=='Enterprise')
			{
			    $price_new=$product_details['price3'];
			}
		 $cart_total=$cart_total+($item['qty']*$price_new);
		 //+($item['qty']*$product_details['tax'])+($item['qty']*$product_details['shipment_charge']);
		 if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=($price_new*$product_details['discount'])/100;
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
		    $grand_total_cost=$cart_total-$cart_total_discount;
		    echo json_encode(array('total'=>count($cart_item),'total_cost'=>currency().$cart_total,'total_discount'=>currency().$cart_total_discount,'grand_total_cost'=>currency().$grand_total_cost,'type'=>'Added','reason'=>'','msg'=>'Product Added Successfully'));
		
		//$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Product Added Successfully</span>');
		
		//redirect(base_url().'Affiliate/Eshop/ourCart');
	}
	public function loadCartItems()
	{
	    $cart_item=$this->session->userdata('cart_reg');
	    // $str="<ul>";
	    $currency=currency();
	    foreach($cart_item as $item)
		{
		    $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		    $price=$item['package'];
		    if($price=='Basic')
			{
			    $price_new=$product_details['price1'];
			}
			else if($price=='Economy')
			{
			    $price_new=$product_details['price2'];
			}
			else if($price=='Enterprise')
			{
			    $price_new=$product_details['price3'];
			}
		    $cart_total=$cart_total+($item['qty']*$price_new);
		    if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=((int)$price_new*(int)$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
    		 /*$str.='<li>
                <div class="shopping-cart-img">
                    <a href="javascript:void(0);"><img alt="Nest" style="max-width:40% !important;" src="'.base_url().'product_images/'.$product_details["product_image"].'" /></a>
                </div>
                <div class="shopping-cart-title">
                    <h4><a href="javascript:void(0);"><?php echo $product_details["title"];?></a></h4>
                    <h4><span>'.$item["qty"].' × '.$currency.$price_new.'</span></h4>
                </div>
                <div class="shopping-cart-delete">
                    <a href="javscript:void(0);" onclick="removefromcartproducts('.$item['product_id'].')"><i class="fi-rs-cross-small"></i></a>
                </div>
             </li>';*/
             $str.='<div class="single-cart">
                                                <div class="cart-img">
                                                    <a href="javascript:void(0);"><img alt="Nest" style="max-width:40% !important;" src="'.base_url().'product_images/'.$product_details["product_image"].'" /></a>
                                                </div>
                                                <div class="cart-info">
                                                    <h5><a href="javascript:void(0);">'.$product_details["title"].'</a></h5>
                                                    <p>'.$item["qty"].' × '.$currency.$price_new.'</p>
                                                </div>
                                                <div class="cart-icon">
                                                    <a href="javscript:void(0);" onclick="removefromcartproducts('.$item['product_id'].')"><i class="fa fa-remove"></i></a>
                                                </div>
                                             </div>';
		}
		//$str.='</ul>';
		echo $str;
	}
	public function loadCartPage()
	{
	    $cart_item=$this->session->userdata('cart_reg');
	    // $str="<ul>";
	    $currency=currency();
	    $new_price=0;
	    foreach($cart_item as $item)
		{
		 $product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
		 $new_price=($item['qty']*$product_details['new_price']);
		 $cart_total=$cart_total+$new_price;
		 if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=($product_details['new_price']*$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		 $str.='<tr class="pt-30">
                                    <td class="custome-checkbox pl-30">
                                        
                                    </td>
                                    <td class="image product-thumbnail pt-40"><img src="'.base_url().'product_images/'.$product_details["product_image"].'" alt="#"></td>
                                    <td class="product-des product-name">
                                        <h6 class="mb-5"><a class="product-name mb-10 text-heading" href="'.base_url().'product/'.$product_details['id'].'">'.$product_details['title'].'</a></h6>
                                    
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-body">'.$currency.$product_details["new_price"].'</h4>
                                    </td>
                                    <td class="text-center detail-info" data-title="Stock">
                                        <div class="detail-extralink mr-15">
                                            <div class="detail-qty border radius">
                                                <a href="#" class="qty-down"><i class="fi-rs-angle-small-down"></i></a>
                                                <input type="text" name="quantity" id="quantity_'.$item['product_id'].'"  class="qty-val" value="'.$item['qty'].'" min="1">
                                                <a href="#" class="qty-up"><i class="fi-rs-angle-small-up"></i></a>
                                            </div>
                                            <a href="#" onclick="updatecart('.$item['product_id'].');" class="btn"><i class="fi-rs-refresh"></i></a>
                                        </div>
                                    </td>
                                    
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand">'.$currency.$discount.'</h4>
                                    </td>
                                    <td class="price" data-title="Price">
                                        <h4 class="text-brand">'.$currency.($new_price-($item['qty']*$discount)).'</h4>
                                    </td>
                                    <td class="action text-center" data-title="Remove"><a href="#" onclick="removefromcartproduct('.$item['product_id'].')" class="text-body"><i class="fi-rs-trash"></i></a></td>
                                </tr>';
		 
		}
		//$str.='</ul>';
		echo $str;
	}
	public function removeItemFromCartProducts($product_id=null,$reason=null)
	{
	    
			$cart=$this->session->userdata('cart_reg');
			unset($cart[$product_id]);
			$cart_total=0;
			//pr($product_id);
			foreach($cart as $item)
			{
				$product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
				$cart_total=$cart_total+($item['qty']*$product_details['new_price']);
			if($product_details['discount_type']=='per')
                                    		 {
                                    		     $discount=($product_details['new_price']*$product_details['discount'])/100;
                                    		     $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
                                    		 else
                                    		 {
                                    		     $discount=$product_details['discount'];
                                    		    $cart_total_discount=$cart_total_discount+($item['qty']*$discount);
                                    		 }
		}
		
		   /* $this->session->set_userdata('cart_final_price',$cart_total);
		    $this->session->set_userdata('cart_total_discount',$cart_total_discount);
		    $this->session->set_userdata('total_products',count($cart_item));
		    $grand_total_cost=$cart_total-$cart_total_discount;
		    echo json_encode(array('total'=>count($cart_item),'total_cost'=>currency().$cart_total,'total_discount'=>currency().$cart_total_discount,'grand_total_cost'=>currency().$grand_total_cost,'type'=>'Added','reason'=>'','msg'=>'Product Added Successfully'));
		*/
			$this->session->set_userdata('cart_reg',$cart);
			$this->session->set_userdata('cart_final_price',$cart_total);
			$this->session->set_userdata('cart_total_discount',$cart_total_discount);
			$this->session->set_userdata('total_products',count($cart));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Item removed successfully '.$product_id.'</span>');
			//redirect(site_url()."estore/".$controller);
			echo json_encode(array('total'=>count($cart),'total_cost'=>currency().$cart_total,'total_discount'=>currency().$cart_total_discount,'grand_total_cost'=>currency().$grand_total_cost,'reason'=>$reason,'type'=>'Removed','msg'=>'Product Removed'));
		    //exit();
	}
	public function removeItemFromCart($product_id=null,$pkg_amount=null,$reason=null)
	{
	    
			$cart=$this->session->userdata('cart_reg');
			unset($cart[$product_id]);
			$cart_total=0;
			//pr($product_id);
			foreach($cart as $item)
			{
				$product_details=$this->db->query("select * from eshop_products where id='".$item['product_id']."'")->row_array();
				$cart_total=$cart_total+($item['qty']*$product_details['new_price']);
			}
			$this->session->set_userdata('cart_reg',$cart);
			$this->session->set_userdata('cart_reg_final_price',$cart_total);
			$this->session->set_userdata('total_products',count($cart));
			$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Item removed successfully '.$product_id.'</span>');
			//redirect(site_url()."estore/".$controller);
			echo json_encode(array('total'=>count($cart),'total_cost'=>$cart_total,'packageamount'=>$pkg_amount,'reason'=>$reason,'type'=>'Removed','msg'=>'Product Removed'));
		    //exit();
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
		echo site_url()."Affiliate/Eshop/ourCart";
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
		}
		$cart_product_result=$cart[$product_id];
		$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_final_price',$cart_total);
		
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
		}
		$cart_product_result=$cart[$product_id];
		//$cart[$product_id]['tax']=$qty*$cart_product_result['tax'];
		//pr($cart);
		$this->session->set_userdata('cart',$cart);
		$this->session->set_userdata('cart_final_price',$cart_total);
		
		$this->session->set_flashdata("flash_msg", '<span class="text-semibold">Cart updated successfully</span>');
		//redirect(site_url()."estore/".$controller);
		//exit();
		echo site_url()."Affiliate/Eshop/ourCart";
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
	public function clearCart()
    {
        $this->session->unset_userdata('cart_reg');
        $this->session->unset_userdata('cart_reg_items');
        $this->session->unset_userdata('cart_final_price');
        $this->session->unset_userdata('cart_total_discount');
        $this->session->unset_userdata('total_products');
        echo json_encode(array('type'=>'Removed','msg'=>'Cart Removed'));
    
    }

}
