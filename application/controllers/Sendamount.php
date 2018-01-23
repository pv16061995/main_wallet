<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');



include_once APPPATH.'third_party/jsonRPCClient.php';
include_once APPPATH.'third_party/Client.php';


class Sendamount extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Rpc');
		$this->load->helper('utility_helper');
		$this->load->model('Auth_model');
        $this->load->helper('form');
        if($this->session->userdata('email')==false)
        {
            redirect(base_url().'logout');
        }
	}
	
	public function index()
	{

		$rpc_host=$this->session->userdata('rpc_host');
        $rpc_user=$this->session->userdata('rpc_user');
        $rpc_pass=$this->session->userdata('rpc_pass');
        $rpc_port=$this->session->userdata('rpc_port');

        $client= new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
        print_r($client->getadminbal());

        die();

        $data['user_bal']=$client->getBalance($this->session->userdata['email']);
		$this->load->view('sendamount',$data); 
    }

    public function transferamount()
    {
        if($this->input->post('amount')>0)
        {
    	$rpc_host=$this->session->userdata('rpc_host');
        $rpc_user=$this->session->userdata('rpc_user');
        $rpc_pass=$this->session->userdata('rpc_pass');
        $rpc_port=$this->session->userdata('rpc_port');

        $client= new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);


    	$pin=$this->input->post('pin');
    	$email=$this->session->userdata['email'];

        ///  check pin 
    	if($this->Auth_model->chkpinpass($pin))
    	{
    		$user_bal=$client->getBalance($email);
	    	$amount=$this->input->post('amount');

            /////   check balance 
	    	if($user_bal>$amount)
	    	{
                /////   get fee
                $fee=$this->Auth_model->chksendfee($amount);

                $current_bal=$user_bal-$fee[0]->charge;
                //  chk balance after deduct fee
                if($current_bal>=$amount)
                {

    	    		$receive_address=$this->input->post('receive_address');

    	    		if($client->withdraw($email, $receive_address, $amount))
    	    		{
                        $this->session->set_flashdata('success',"Your amount has been successfully sent.");
                        redirect('sendamount');
    	    		}else{
    	    			$this->session->set_flashdata('error', "Error occured while sending amount!!!");
                        redirect('sendamount');
    	    		}
                }else{
                    $this->session->set_flashdata('error', "you don't have sufficient balance!!!");
                    redirect('sendamount');
                }

	    	}else{
	    		$this->session->set_flashdata('error', "you don't have sufficient balance!!!");
            	redirect('sendamount');
	    	}

    	}else{
    		$this->session->set_flashdata('error', 'Please enter correct pin!!!');
            redirect('sendamount');
    	}

    }else{
        $this->session->set_flashdata('error', 'Please enter valid amount!!!');
            redirect('sendamount');
    }

    	

    }
}
?>