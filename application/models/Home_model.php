<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Home_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->library('session');
        $this->load->helper('url');

		
	}

	function auth($name,$password,$ip)
    {
        $password1 = sha1($password);
        $this->db->where('username',$name);
        $this->db->where('password',$password1);
        $this->db->where('status',1);
        $query = $this->db->get('Admin_login');
        if($query->num_rows()==1)
        {
        	
            foreach ($query->result() as $row)
            {
                $data = array(
                    'email'                 =>   $row->email,
                    'name'                  =>   $row->name,
                    'user_id'               =>   $row->id,
                    'username'               =>   $row->username,
                    'is_Admin_in'           =>   TRUE
                );
            }
           
            
            if(($name==$data['username'])) 
            {
	            $this->session->set_userdata($data);
	            return TRUE;
            } else {
                return FALSE;
            }
        }
        else
        {
            return FALSE;
        }
        
    }


    function userdata()
    {
         $query = $this->db->get('users');
         return $query->result();
    }

    function userenabledisable($id,$status)
    {
         $data = array( 
                'status' => $status
            );

        $this->db->where('id',$id);
        $query=$this->db->update('users', $data);
        return $query;
    }

    function usertfaenabledisable($id,$status)
    {
         $data = array( 
                'tfa_status' => $status
            );

        $this->db->where('id',$id);
        $query=$this->db->update('users', $data);
        return $query;
    }

    function transactionreqlist()
    {
        $this->db->select('txn.*,usr.name,usr.email');
        $this->db->from('transaction as txn');        
        $this->db->join('users as usr', 'txn.user_id = usr.id', 'left');
        $q = $this->db->get(); 
        $row = $q->result();
        return $row;
    }


    function getuserscount()
    {
        $query = $this->db->get('users');
         return $query->num_rows();
    }


    function gettxnreqcount()
    {
        $query = $this->db->get('transaction');
         return $query->num_rows();
    }

    function txnreqenabledisable($id,$status)
    {
         $data = array( 
                'status' => $status
            );

        $this->db->where('id',$id);
        $query=$this->db->update('transaction', $data);
        return $query;
    }

    
}




?>