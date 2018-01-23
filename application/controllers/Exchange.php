<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');



include_once APPPATH.'third_party/jsonRPCClient.php';
include_once APPPATH.'third_party/Client.php';


class Exchange extends CI_Controller
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
	    $json_url = "https://cex.io/api/ticker/BCH/BTC";
		$data['askdata']=$this->curlfunction($json_url);

		$rpc_host=$this->session->userdata('rpc_host');
        $rpc_user=$this->session->userdata('rpc_user');
        $rpc_pass=$this->session->userdata('rpc_pass');
        $rpc_port=$this->session->userdata('rpc_port');

        $client= new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
        $data['user_bal']=$client->getBalance($this->session->userdata['email']);
		$this->load->view('exchange',$data); 
    }

    public function changeamt()
    {
    	$json_url = "https://cex.io/api/ticker/BCH/BTC";
		$askdata=$this->curlfunction($json_url);

    	$email=$this->session->userdata['email'];
    	$amount=$this->input->post('amount');
    	$pin=$this->input->post('pin');

    	///  currennt rate////////
    	$json_url = "https://cex.io/api/ticker/BCH/BTC";
		$askdata=$this->curlfunction($json_url);
		$coin_amount = $btc_amount / $data->ask;

		 //************UNCOMMENT THIS ONE***********
        $reciever_address = "n2KAtcBreKWD3mmkZgXvWksRusprxDH7Hp";
        //************company's btc address********
        $reciever_address_btc = "mmvxvY6bpKFLBmPn2o2ty154okMLGEbVuz";



    	if($amount>0)
    	{
    		if($this->Auth_model->chkpasswordbyemail($pin)==1)
            {
            	$user_bal=$client->getBalance($email);

            	if($user_bal>$amount)
            	{
            		 /////   get fee
	                $fee=$this->Auth_model->chksendfee($amount);

	                $current_bal=$user_bal-$fee[0]->charge;
	                //  chk balance after deduct fee
	                if($current_bal>=$amount)
	                {
	                	$withdraw_message = $client->withdraw($email, $reciever_address_btc, (float)$coin_amount);
	                	if($withdraw_message)
	                	{
	                		$this->session->set_flashdata('error', "Your amount changed successfully.");
		            	     redirect('exchange');
	                	}else{
	                		$this->session->set_flashdata('error', "Error occurred while exchange amount!!!");
		            	     redirect('exchange');
	                	}
	                }else{

		            $this->session->set_flashdata('error', "you don't have sufficient balance!!!");
		            redirect('exchange');
		            }

            	}else{

		            $this->session->set_flashdata('error', "you don't have sufficient balance!!!");
		            redirect('exchange');
		            }

            }else{

            $this->session->set_flashdata('error', 'Please enter valid pin !!!');
            redirect('exchange');
            }
    	}else{
    		$this->session->set_flashdata('error', 'Please enter valid amount!!!');
            redirect('exchange');
    	}
    }


    function curlfunction($url)
    {
    	
         $response = file_get_contents($url);
          $response=json_decode($response);

          return $respons=$response->ask;
    	
    }

   
}
?>