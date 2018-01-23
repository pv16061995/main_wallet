<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Changepassword extends CI_Controller
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
        $this->load->view('changepassword'); 
    }

    public function updatepass()
    {
    	$old_password=$this->input->post('old_password');
    	$new_password=$this->input->post('new_password');
    	$confirm_password=$this->input->post('confirm_password');

    	if($new_password==$confirm_password)
    	{
            if($this->Auth_model->chkpasswordbyemail($old_password)==1)
            {
            	if($this->Auth_model->updatepassword($old_password,$new_password))
                    {
                    	$this->session->set_flashdata('success', 'Your password has been updated successfully.');
                        redirect('dashboard');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Error occurred while update password !!!');
                        redirect('changepassword');
                    }
            }else{

            $this->session->set_flashdata('error', 'Please enter valid old password !!!');
            redirect('changepassword');
            }
        }else{

        	$this->session->set_flashdata('error', 'New Password and Confirm Password must be same !!!');
            redirect('changepassword');
        }
    }
    

}


?>