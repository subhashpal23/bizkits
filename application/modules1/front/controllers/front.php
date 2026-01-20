<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package Front/Front
*/
class Front extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
	}
	
	public function index()
	{
		echo "show home page";
	}
}//end class
