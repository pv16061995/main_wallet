<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Login extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('utility_helper');
		$this->load->model('Home_model');
        $this->load->helper('form');

        
	}
	
	public function index()
	{
        $this->load->view('adminpanel/login'); 
    }

         public function login()
        {
            print_r($this->input->post());

            $name = $this->input->post('username');
            $password = $this->input->post('password');
            $ip=$_SERVER['REMOTE_ADDR']; 
            
            if($this->Home_model->auth($name, $password, $ip))
            {
                redirect('admin/dashboard');
               
                
            }
            else
            {
                $this->session->set_flashdata('error', 'Please enter correct username and password!!!');
                redirect(base_url().'admin');

            }
            
        }

}