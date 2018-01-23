<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Changepin extends CI_Controller
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
        $this->load->view('changepin'); 
    }

    public function updatepin()
    {
    	$old_pin=$this->input->post('old_pin');
    	$new_pin=$this->input->post('new_pin');
    	$confirm_pin=$this->input->post('confirm_pin');

    	if($new_pin==$confirm_pin)
    	{
            if($this->Auth_model->chkpasswordbyemail($old_pin)==1)
            {
            	if($this->Auth_model->updatepinpassword($old_pin,$new_pin))
                    {
                    	$this->session->set_flashdata('success', 'Your pin has been successfully update.');
                        redirect('dashboard');
                    }
                    else
                    {
                        $this->session->set_flashdata('error', 'Error occurred while update pin !!!');
                        redirect('changepin');
                    }
            }else{

            $this->session->set_flashdata('error', 'Old Pin not matched !!!');
            redirect('changepin');
            }
        }else{

        	$this->session->set_flashdata('error', 'Pin not matched !!!');
            redirect('changepin');
        }
    }
    

}


?>