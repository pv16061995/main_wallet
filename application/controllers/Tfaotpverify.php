<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'third_party/GoogleAuthenticator.php';

class Tfaotpverify extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Twoauth');
		$this->load->helper('utility_helper');
        $this->load->model('Auth_model');

        
	}
	
	public function index()
	{
        $this->load->view('tfaotpverify'); 

    }

    public function verify()
    {
        $ga = new GoogleAuthenticator();
        $totp=$this->input->post('totp');
        $secret = $this->session->userdata('tfa_key');
        
        $checkResult = $ga->verifyCode($secret, $totp, 2);
        
        if($checkResult)
        {
           
                $this->session->set_flashdata('error', 'Error occurred while enable two-factor!!!');
                redirect('dashboard');
            
        }else{
            $this->session->set_flashdata('error', 'Please enter correct totp!!!');
            redirect('tfaotpverify');
        }
    }

    


     

}


?>