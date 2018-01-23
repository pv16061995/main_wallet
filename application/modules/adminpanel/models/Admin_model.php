<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

class Auth_model extends CI_Model
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
        $this->db->where('email',$name);
        $this->db->where('password',$password1);
        $this->db->where('status',1);
        $this->db->where('email_verify_status',1);
        $query = $this->db->get('users');
        if($query->num_rows()==1)
        {
            $currnecy_detail=$this->currencylist();
            
            foreach ($query->result() as $row)
            {
                $data = array(
                    'email'                 =>   $row->email,
                    'name'                  =>   $row->name,
                    'tfa_status'            =>   $row->tfa_status,
                    'tfa_key'               =>   $row->tfa_key,
                    'kyc_status'            =>   $row->kyc_status,
                    'user_id'               =>   $row->id,
                    'tfa_key'               =>   $row->tfa_key,
                    'ip_address'            =>   $ip,
                    'currency'              =>   $currnecy_detail[0]->id,
                    'currencyname'          =>   $currnecy_detail[0]->short_name,
                    'rpc_host'              =>   $currnecy_detail[0]->host,
                    'rpc_user'              =>   $currnecy_detail[1]->user,
                    'rpc_pass'              =>   $currnecy_detail[0]->pass,
                    'rpc_port'              =>   $currnecy_detail[1]->port,
                    'is_Admin_in'           =>   True
                );
            }

            $this->insertlogindetail($data['user_id'],$ip);
            $this->updatelogindetail($data['user_id']);


            if(($name==$data['email'])) {
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


    function signup($name,$email,$password,$pin,$secret)
    {
    	$data = array( 
				'name'	      =>  $name, 
				'email'       =>  $email,
				'password'    =>  sha1($password),
				'ip_address'  =>  $_SERVER['REMOTE_ADDR'],
				'pin'         =>  sha1($pin),
                'tfa_key'      =>  $secret
			);
    	$this->db->insert('users', $data);
    	$userid=$this->db->insert_id();
    	return $userid;
    }

    function insertlogindetail($user_id,$ip)
    {
    	
    	$data = array( 
				'user_id'	      =>  $user_id, 
				'ip_address'      =>  $ip 
			);

		$this->db->insert('login_detail', $data);
    }

    function updatelogindetail($user_id)
    {
        $data = array( 
                'last_login' =>  date("Y-m-d H:i:s")
            );
        $this->db->where('id',$user_id);
        $query=$this->db->update('users', $data);
        return $query;

    }

    function updatepassword($old_password,$new_password)
    {
        $user_id=$this->session->userdata['user_id'];
        $data = array('password' => sha1($new_password));

        $this->db->where('id',$user_id);
        $this->db->where('password',sha1($old_password));

        $userid=$this->db->update('users', $data);
        return $userid;
    }



    function updatepinpassword($old_pin,$new_pin)
    {
        $user_id=$this->session->userdata['user_id'];
        $data = array('pin' => sha1($new_pin));

        $this->db->where('id',$user_id);
        $this->db->where('pin',sha1($old_pin));

        $userid=$this->db->update('users', $data);
        return $userid;
    }

    function currencylist()
    {
        $this->db->select("*");
        $this->db->from("currency_list");
        $this->db->where("status",'1');
        $q = $this->db->get();
        $row = $q->result();

        return $row;
    }

    function savenewaddress($address)
    {
        $user_id=$this->session->userdata['user_id'];
        $curr_id=$this->session->userdata['currency'];
        $data = array( 
                'user_id'         =>  $user_id, 
                'curr_id'         =>  $curr_id,
                'curr_address'    =>  $address 
            );

        $data=$this->db->insert('balance', $data);
        return $data;
    }

    function getalladdresslistByCurrency()
    {
        $user_id=$this->session->userdata['user_id'];
        $curr_id=$this->session->userdata['currency'];

        $this->db->select("*");
        $this->db->from("balance");
        $this->db->where("user_id",$user_id);
        $this->db->where("curr_id",$curr_id);
        $q = $this->db->get();
        $row = $q->result();

        return $row;
    }

    function chkpinpass($pin)
    {
        $user_id=$this->session->userdata['user_id'];
        $this->db->select('*');
        $this->db->from("users");
        $this->db->where("pin",sha1($pin));
        $this->db->where("id",$user_id);
        $query = $this->db->get();
        $q=$query->num_rows();
        return $q;
    }

    function fee_amount($amount)
    {
        $this->db->select("*");
        $this->db->from("fee_charges");
        $this->db->where("user_id",$user_id);
        $this->db->where("curr_id",$curr_id);
        $q = $this->db->get();
        $row = $q->result();
    }

    function chkgetcurrencylist($curr)
    {
        $this->db->select("*");
        $this->db->from("currency_list");
        $this->db->where("status",'1');
        $this->db->where("id",$curr);
        $query = $this->db->get();
        $q=$query->result();
        return $q;
    }

    function chksendfee($amt)
    {
        $this->db->select("charge");
        $this->db->from("fee_charges");
        $this->db->where("min_amt <=",$amt);
        $this->db->where("max_amt >=",$amt);
        $query = $this->db->get();

        $q=$query->result();
        return $q;
    }

    function updateauthstatus($status)
    {
        $user_id=$this->session->userdata['user_id'];
        $email=$this->session->userdata['email'];
        $data = array('tfa_status' => $status);

        $this->db->where('id',$user_id);
        $this->db->where('email',$email);

        $userid=$this->db->update('users', $data);
        return $userid;
    }

    function activateaccount($email,$uid)
    {
        $user_id=$uid;
        $email=$email;
        $data = array('email_verify_status' => '1','status' => '1');

        $this->db->where('id',$user_id);
        $this->db->where('email',$email);

        $userid=$this->db->update('users', $data);
        return $userid;
    }

    function chkmailvalid($tomail)
    {
        $this->db->select("id,name");
        $this->db->from("users");
        $this->db->where("email",$tomail);
        $query = $this->db->get();

        $q=$query->result();
        return $q;
    }

    function updateforgetpassword($password,$otp)
    {
        
        $data = array('password' => sha1($password));

        $this->db->where('otp',sha1($otp));

        $userid=$this->db->update('users', $data);
        return $userid;
    }

	function chkpasswordbyemail($password)
    {
        $name=$this->session->userdata('email');
        $password1 = sha1($password);
        $this->db->where('email',$name);
        $this->db->where('password',$password1);
        $this->db->where('status',1);
        $this->db->where('email_verify_status',1);
        $query = $this->db->get('users');
        return $query->num_rows();
    }



    function chkpinbyemail($pin)
    {
        $name=$this->session->userdata('email');
        $password1 = sha1($password);
        $this->db->where('email',$name);
        $this->db->where('pin',$password1);
        $this->db->where('status',1);
        $this->db->where('email_verify_status',1);
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    function updateotpbyuserid($otp,$userid)
    {
        
        $data = array('otp' => sha1($otp));

        $this->db->where('id',$userid);

        $userid=$this->db->update('users', $data);
        return $userid;
    }

    function chkotpisvalid($otp)
    {
        $this->db->where('otp',sha1($otp));
        $query = $this->db->get('users');
        return $query->num_rows();
    }

    function resetpassblank($otp)
    {
        $data = array('otp' => '');

        $this->db->where('otp',$otp);

        $userid=$this->db->update('users', $data);
        return $userid;
    }

}


?>