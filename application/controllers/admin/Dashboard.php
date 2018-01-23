<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'third_party/jsonRPCClient.php';
include_once APPPATH.'third_party/Client.php';

class Dashboard extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Rpc');
		$this->load->helper('utility_helper');
		$this->load->model('Home_model');
		$this->load->model('Auth_model');

		//print_r($this->session->userdata());

		if($this->session->userdata('user_id')==false || $this->session->userdata('is_Admin_in')==false )
        {
            redirect(base_url().'/logout');
        }
	}
	
	public function index()
	{
		
        $this->load->view('adminpanel/dashboard'); 
       
    }

    

}


?>