<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Referal extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session');
		$this->load->helper('utility_helper');
		$this->load->model('Auth_model');
        $this->load->helper('form');

        if($this->session->userdata('user_id')==false)
        {
            redirect(base_url().'/logout');
        }
	}
	
	public function index()
	{
        $this->load->view('referal'); 
    }


    public function savedetail()
    {
    	$email=$this->input->post('email');
    	$refid = substr(hash('sha256', mt_rand() . microtime()), 0, 32);


    	 $chkmail=$this->Auth_model->chkmailvalid($email);

    	if(count($chkmail)==0)
        {
        	if($this->Auth_model->referaluser($email,$refid))
        	{
        		$this->session->set_flashdata('success', 'Your invitation has been sent successfully.');
            	redirect('referal');
        	}else{
        		$this->session->set_flashdata('error', 'Error occurred while sending invitation!!! ');
            	redirect('referal');
        	}
        	

    	}else{
            $this->session->set_flashdata('error', 'This e-mail already exists!!!');
            redirect('referal');
        }
    }
    
 }