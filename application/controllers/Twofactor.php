<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'third_party/GoogleAuthenticator.php';

class Twofactor extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Twoauth');
		$this->load->helper('utility_helper');
		$this->load->model('Auth_model');

		if($this->session->userdata('user_id')==false)
        {
            redirect(base_url().'/logout');
        }
	}
	
	public function index()
	{
		$ga = new GoogleAuthenticator();
		$secret = $this->session->userdata('tfa_key');
		$email=$this->session->userdata('email');
        

        //$data['qrCodeUrl'] = 'http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl='. $secret;
		$data['qrCodeUrl'] = $ga->getQRCodeGoogleUrl($email, $secret);

       $this->load->view('two-factor',$data); 
       
    }

    public function verifytotp()
    {
    	$ga = new GoogleAuthenticator();
    	$totp=$this->input->post('totp');
    	$secret = $this->session->userdata('tfa_key');

    	
    	$checkResult = $ga->verifyCode($secret, $totp, 2);
    	
    	if($checkResult)
    	{
    		if($this->Auth_model->updateauthstatus('1'))
    		{
    			$this->session->set_flashdata('success', 'Two-factor enable successfully.');
    			redirect(base_url());
    		}else{
    			$this->session->set_flashdata('error', 'Error occurred while enable two-factor!!!');
    			redirect('twofactor');
    		}
    	}else{
    		$this->session->set_flashdata('error', 'Please enter correct totp!!!');
            redirect('twofactor');
    	}
    }

    public function disable()
    {
        if($this->Auth_model->updateauthstatus('0'))
        {
            $this->session->set_flashdata('success', 'Two-factor disable successfully.');
            redirect(base_url());
        }else{
            $this->session->set_flashdata('error', 'Error occurred while disable two-factor!!!');
            redirect('twofactor');
        }
       
    }

    

}


?>