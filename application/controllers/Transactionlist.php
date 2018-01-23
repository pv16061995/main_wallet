<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'third_party/jsonRPCClient.php';
include_once APPPATH.'third_party/Client.php';

class Transactionlist extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Rpc');
		$this->load->helper('utility_helper');
		$this->load->model('Auth_model');

        if($this->session->userdata('user_id')==false)
        {
            redirect(base_url().'/logout');
        }
	}
	
	public function index()
	{

        $this->transactionlist();
    }


	public function transactionlist()
    {
    	if($this->input->get('curr')!='')
    	{
    		$curr=base64_decode($this->input->get('curr'));

    		//  currency is available and status chk is active or not
    		$chkcurr=$this->Auth_model->chkgetcurrencylist($curr);
    		if(count($chkcurr)!=0)
    		{
    		
        $this->session->unset_userdata('currency');
        $this->session->unset_userdata('currencyname');
 				$this->session->unset_userdata('rpc_host');
 				$this->session->unset_userdata('rpc_user');
 				$this->session->unset_userdata('rpc_pass');
 				$this->session->unset_userdata('rpc_port');
				$this->session->set_userdata('currency',$chkcurr[0]->id);
        $this->session->set_userdata('currencyname',$chkcurr[0]->short_name);
				$this->session->set_userdata('rpc_host',$chkcurr[0]->host);
				$this->session->set_userdata('rpc_user',$chkcurr[0]->user);
				$this->session->set_userdata('rpc_pass',$chkcurr[0]->pass);
				$this->session->set_userdata('rpc_port',$chkcurr[0]->port);
    		}else{
    			$currnecy_detail=$this->Auth_model->currencylist();
 				$this->session->unset_userdata('currency');
        $this->session->unset_userdata('currencyname');
 				$this->session->unset_userdata('rpc_host');
 				$this->session->unset_userdata('rpc_user');
 				$this->session->unset_userdata('rpc_pass');
 				$this->session->unset_userdata('rpc_port');
				$this->session->set_userdata('currency',$currnecy_detail[0]->id);
        $this->session->set_userdata('currencyname',$currnecy_detail[0]->short_name);
				$this->session->set_userdata('rpc_host',$currnecy_detail[0]->host);
				$this->session->set_userdata('rpc_user',$currnecy_detail[0]->user);
				$this->session->set_userdata('rpc_pass',$currnecy_detail[0]->pass);
				$this->session->set_userdata('rpc_port',$currnecy_detail[0]->port);
    		}
    		
			
    	}else{
    		$currnecy_detail=$this->Auth_model->currencylist();
 			$this->session->unset_userdata('currency');
      $this->session->unset_userdata('currencyname');
			$this->session->unset_userdata('rpc_host');
			$this->session->unset_userdata('rpc_user');
			$this->session->unset_userdata('rpc_pass');
			$this->session->unset_userdata('rpc_port');
			$this->session->set_userdata('currency',$currnecy_detail[0]->id);
      $this->session->set_userdata('currencyname',$currnecy_detail[0]->short_name);
			$this->session->set_userdata('rpc_host',$currnecy_detail[0]->host);
			$this->session->set_userdata('rpc_user',$currnecy_detail[0]->user);
			$this->session->set_userdata('rpc_pass',$currnecy_detail[0]->pass);
			$this->session->set_userdata('rpc_port',$currnecy_detail[0]->port);
			
    		
    	}

    	$rpc_host=$this->session->userdata('rpc_host');
      $rpc_user=$this->session->userdata('rpc_user');
      $rpc_pass=$this->session->userdata('rpc_pass');
      $rpc_port=$this->session->userdata('rpc_port');

      $client= new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
      $data['user_bal']=$client->getBalance($this->session->userdata['email']);
		$this->load->view('transactionlist',$data); 
       
    }


    public function gettransactionlistdetail()
    {
      
    	$status=$this->input->post('status');
    	$email=$this->session->userdata('email');
    	$rpc_host=$this->session->userdata('rpc_host');
      $rpc_user=$this->session->userdata('rpc_user');
      $rpc_pass=$this->session->userdata('rpc_pass');
      $rpc_port=$this->session->userdata('rpc_port');

        $client= new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
       
        $trans_list=$client->getTransactionList($email);
          $a=array_reverse($trans_list);

    	$data='';

    	$data .='<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                          <thead>
                            <tr>
                              <th>Sr</th>
                              <th>Date</th>
                              <th>Address</th>
                              <th>Type</th>
                              <th>Amount</th>
                              <th>Confirmations</th>
                              <th>TX Id</th>
                            </tr>
                          </thead>
                          <tbody>';
                          $i=1;
          foreach($a as $transaction)
            {

            	if($status=='all')
            	{
                if($transaction['category']=='send')
                {
                  $tx_type='Sent';
                }elseif($transaction['category']=='receive'){
                  $tx_type='Received';
                }
            		
            		$data .='<tr>';
			        $data .='<td>'.$i.'</td>
                 <td>'.date('d-M-Y h:i a',$transaction['time']).'</td>
						     <td>'.$transaction['address'].'</td>
						     <td>'.$tx_type.'</td>
						     <td>'.abs($transaction['amount']).'</td>
						     <td>'.$transaction['confirmations'].'</td>
						     <td>'.$transaction['txid'].'</td>';
			        $data .='</tr>';

            	$i++;}elseif($transaction['category']==$status)
            	{
            		if($transaction['category']=='send')
                {
                  $tx_type='Sent';
                }elseif($transaction['category']=='receive'){
                  $tx_type='Received';
                }
			        $data .='<tr>';
			        $data .='<td>'.$i.'</td>
                             <td>'.date('d-M-Y h:i a',$transaction['time']).'</td>
						     <td>'.$transaction['address'].'</td>
						     <td>'.$tx_type.'</td>
						     <td>'.abs($transaction['amount']).'</td>
						     <td>'.$transaction['confirmations'].'</td>
						     <td>'.$transaction['txid'].'</td>';
			        $data .='</tr>';
    			$i++;}
    		}
        $data .='</tbody>';
        $data .='</table>';

        print_r($data);

    }

    

}


?>