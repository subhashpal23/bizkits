<?php
 if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 *  File: /application/core/Common_Controller.php
 */
 require APPPATH . "third_party/MX/Controller.php";
class Common_Controller extends MX_Controller 
{
    public function __construct()
    {
        parent::__construct();
    }
}//end class