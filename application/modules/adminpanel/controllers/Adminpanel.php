<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Adminpanel extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('utility_helper');
		//$this->load->model('Admin_model');
        $this->load->helper('form');

        // if($this->session->userdata('user_id')==false)
        // {
        //     redirect(base_url().'/logout');
        // }
	}
	
	public function index()
	{
		echo "test";
		$this->load->view('help'); 
		//modules::run('adminpanel/help');
    }

    

}


?>