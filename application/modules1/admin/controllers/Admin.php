<?php
defined('BASEPATH') OR exit('No direct script access allowed');
/*
@package admin/admin
*/
class Admin extends Common_Controller 
{
	public function __construct()
	{
		//@call to parent CI_Controller constructor
		parent::__construct();
	} 
	/*
	@Desc:It's used to view dashboard
	*/
	public function index()
	{
		echo 'admin';
	}
}//end class
