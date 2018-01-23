<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'third_party/jsonRPCClient.php';
include_once APPPATH.'third_party/Client.php';

class Userdetail extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Rpc');
		$this->load->helper('utility_helper');
		$this->load->model('Home_model');
    $this->load->model('Auth_model');

		
        if($this->session->userdata('user_id')==false || $this->session->userdata('is_Admin_in')==false )
        {
            redirect(base_url().'/logout');
        }
	}
	
	public function index()
	{
		
        $this->load->view('adminpanel/userdetail'); 
       
    }


    public function userdata()
    {
    	$data='';

      $data .='<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                          <thead>
                            <tr>
                              <th>Sr</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>';
                          $i=1;
                         $detail= $this->Home_model->userdata();

                    
          foreach($detail as $transaction)
            {
            
            	$data .='<tr>';
			        $data .='<td>'.$i.'</td>
                			 <td>'.$transaction->name.'</td>
						     <td>'.$transaction->email.'</td><td>';

                 if($transaction->status=='0')
                 {
						  $data .='<a class="btn btn-sm btn-success" href="#"  onclick="userenabledisable(\''.$transaction->id.'\',0);"><i class="fa fa-eye"></i></a>';
                  }else{
              $data .='<a class="btn btn-sm btn-danger" href="#" onclick="userenabledisable(\''.$transaction->id.'\',0);"><i class="fa fa-eye-slash"></i></a>';
                  }


                 if($transaction->tfa_status=='0')
                 {
              $data .='<a class="btn btn-sm btn-success" href="#" onclick="usertfaenabledisable(\''.$transaction->id.'\',1);"><i class="fa fa-lock"></i></a>';
                  }else{
              $data .='<a class="btn btn-sm btn-danger" href="#" onclick="usertfaenabledisable(\''.$transaction->id.'\',0);"><i class="fa fa-unlock"></i></a>';
                  }


              $data .='<a class="btn btn-sm btn-warning" href="#" onclick="usertransactionlist(\''.$transaction->email.'\');" data-toggle="modal" data-target="#myModal"><i class="fa fa-file-text"></i></a>';

			        $data .='</td></tr>';

            	$i++;
            }
    		
        $data .='</tbody>';
        $data .='</table>';

        print_r($data);

    }

    public function userenabledisable()
    {
      $id=$this->input->post('id');
      $status=$this->input->post('status');

      if($status==0)
      {
        $sta='disabled';
      }else{
        $sta='enabled';
      }

      if($this->Home_model->userenabledisable($id,$status))
      {
        $this->session->set_flashdata('success', 'Account has been '.$sta.' successfully.');
       // redirect('admin/userdetail');
      }else{
        $this->session->set_flashdata('error', 'Error occured while '.$sta.' account!!!');
       // redirect('admin/userdetail');
      }
     
    }

    public function usertfaenabledisable()
    {
      $id=$this->input->post('id');
      $status=$this->input->post('status');

      if($status==0)
      {
        $sta='disabled';
      }else{
        $sta='enabled';
      }

      if($this->Home_model->usertfaenabledisable($id,$status))
      {
        $this->session->set_flashdata('success', 'Two factor authentication has been '.$sta.' successfully.');
       // redirect('admin/userdetail');
      }else{
        $this->session->set_flashdata('error', 'Error occured while '.$sta.' two factor authentication!!!');
       // redirect('admin/userdetail');
      }
     
    }

    function usertransactionlist()
    {
      $status=$this->input->post('status');
      $email=$this->input->post('email');
      if($this->input->post('currency')!='')
      {
        $currency=base64_decode($this->input->post('currency'));
      }
      

      $currency_detail=$this->Auth_model->chkgetcurrencylist($currency);
    // print_r($currency_detail);


      $rpc_host=$currency_detail[0]->host;
      $rpc_user=$currency_detail[0]->user;
      $rpc_pass=$currency_detail[0]->pass;
      $rpc_port=$currency_detail[0]->port;

      //print_r($rpc_host.$rpc_user.$rpc_pass.$rpc_port);

        $client= new Client($rpc_host, $rpc_port, $rpc_user, $rpc_pass);
        
        $balance='<a href="javascript:;" class="btn btn-success" style="cursor:default;float: right;">Balance : '.$client->getBalance($email).' '. $currency_detail[0]->short_name.'</a>';
        $trans_list=$client->getTransactionList($email);
        $a=array_reverse($trans_list);
        $data='';

        $data .='<table id="datatable-checkbox-txnlist" class="table table-striped table-bordered bulk_action">
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

          echo 'detail^'.$data.'^'.$balance.'^detail';
    }
    

    

}


?>