<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'third_party/jsonRPCClient.php';
include_once APPPATH.'third_party/Client.php';


class Receiveamount extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Rpc');
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

		$rpc_host=$this->session->userdata('rpc_host');
        $rpc_user=$this->session->userdata('rpc_user');
        $rpc_pass=$this->session->userdata('rpc_pass');
        $rpc_port=$this->session->userdata('rpc_port');

        $client= new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
        $data['user_bal']=$client->getBalance($this->session->userdata['email']);
		$this->load->view('receiveamount',$data); 
    }


    public function generatenewaddress()
    {
    	$rpc_host=$this->session->userdata('rpc_host');
        $rpc_user=$this->session->userdata('rpc_user');
        $rpc_pass=$this->session->userdata('rpc_pass');
        $rpc_port=$this->session->userdata('rpc_port');

        $client= new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
        $getaddress=$client->getNewAddress($this->session->userdata['email']);

        if($this->Auth_model->savenewaddress($getaddress))
        {
        	$this->session->set_flashdata('success', 'New address has been generated successfully.');
            redirect('receiveamount');
        }
        else
        {
            $this->session->set_flashdata('error', 'Error occurred while generate new address!!!');
            redirect('receiveamount');
        }
    }

    
}
?>