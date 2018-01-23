<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Home extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('utility_helper');
		$this->load->model('Auth_model');
	}
	
	public function index()
	{
        $this->sign_in();
    }


	public function sign_in()
    {
       $this->load->view('login');   
    }

    

     public function login()
        {
            
            $name = $this->input->post('username');
            $password = $this->input->post('password');
            $ip=$_SERVER['REMOTE_ADDR']; 
            
            if($this->Auth_model->auth($name, $password, $ip))
            {
                if($this->session->userdata('tfa_status')==1)
                {
                    redirect('tfaotpverify');
                }else if($this->session->userdata()==true){
                    redirect('dashboard');
                }
                else{
                    redirect(base_url());
                }
                
            }
            else
            {
                $this->session->set_flashdata('error', 'Please enter correct email and password');
                redirect(base_url());

            }
            
        }

}


?>