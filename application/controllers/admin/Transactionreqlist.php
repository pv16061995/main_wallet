<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');



include_once APPPATH.'third_party/jsonRPCClient.php';
include_once APPPATH.'third_party/Client.php';


class Transactionreqlist extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Rpc');
		$this->load->helper('utility_helper');
		$this->load->model('Home_model');
        $this->load->helper('form');
        if($this->session->userdata('email')==false)
        {
            redirect(base_url().'logout');
        }
	}
	
	public function index()
	{
	     $this->load->view('adminpanel/transactionreqlist'); 
    }

    function transactionreqlist()
    {
        $a=$this->Home_model->transactionreqlist();
       
        $data='';

        $data .='<table id="datatable-checkbox" class="table table-striped table-bordered bulk_action">
                          <thead>
                            <tr>
                              <th>Sr</th>
                              <th>Date</th>
                              <th>Txn-id</th>
                              <th>Address</th>
                              <th>Amount in BTC</th>
                              <th>Name</th>
                              <th>Email</th>
                              <th>Action</th>
                            </tr>
                          </thead>
                          <tbody>';
                          $i=1;
          foreach($a as $transaction)
            {

           // print_r($transaction);
                    
                    $data .='<tr>';
                    $data .='<td>'.$i.'</td>
                             <td>'.date('d-M-Y h:i a',strtotime($transaction->created_date)).'</td>
                             <td>'.$transaction->txnid.'</td>
                             <td>'.$transaction->trans_address.'</td>
                             <td>'.abs($transaction->amount).'</td>
                             <td>'.$transaction->name.'</td>
                             <td>'.$transaction->email.'</td><td>';

                      if($transaction->status=='0')
                 {
              $data .='<a class="btn btn-sm btn-success" href="#" data-toggle="Approved" onclick="txnreqenabledisable(\''.$transaction->id.'\',1);"><i class="fa fa-check"></i></a>';
                  }else{
              $data .='<a class="btn btn-sm btn-danger" href="#" data-toggle="Disapproved" onclick="txnreqenabledisable(\''.$transaction->id.'\',0);"><i class="fa fa-close"></i></a>';
                  }
                    $data .='</td></tr>';

                $i++;
            }
        $data .='</tbody>';
        $data .='</table>';

        print_r($data);

    }

    function txnreqenabledisable()
    {
        $id=$this->input->post('id');
        $status=$this->input->post('status');
         if($status==0)
          {
            $sta='disapproved';
          }else{
            $sta='approved';
          }

          if($this->Home_model->txnreqenabledisable($id,$status))
          {
            $this->session->set_flashdata('success', 'Transaction request has been '.$sta.' successfully.');
           // redirect('admin/userdetail');
          }else{
            $this->session->set_flashdata('error', 'Error occured while '.$sta.' transaction request!!!');
           // redirect('admin/userdetail');
          }
    }

    
    
   
}
?>