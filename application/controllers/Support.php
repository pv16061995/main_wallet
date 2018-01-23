<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');
class Support extends CI_Controller
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
        $this->load->view('support'); 
    }

    public function supportsave()
	{
       
		$message1=$this->input->post('message');
		$subject=$this->input->post('subject');
		$toemail=$this->session->userdata('email');
        $name=$this->session->userdata('name');


        $message='<div style="width:500px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;">
 
<div style="margin-bottom:35px;background:#fafafa; text-align:center;"><img src="'.logo_url().'" style="height:70px;" /></div>
<div class="mobile-br"  style="font-size:35px; font-weight: 600; color: #2f982e; text-align:center;">&nbsp; Welcome to <b>'.project_name().'</b> <br><br> </div>
<div style="margin-bottom:20px;">Dear Admin,</div>
<div style="margin-bottom:10px;">You have a new query from your wallet. User detail has been given below 
: <br><br> </div> 
 ';

$message.='<b>Name</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp;&nbsp; '.$name.'<br>';
$message.='<b>Email Id</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b> :</b>&nbsp;&nbsp; '.$toemail.'<br>';
$message.='<b>Message</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <b> :</b>&nbsp;&nbsp;&nbsp; '.$message1.'<br>';
$message .='

<div style="background:#1a1a1a; padding:10px; width:100%; color:#fff; box-sizing: border-box; text-align:center;margin-top:50px;">
<div style="font-size:18px; font-weight:bold; margin-bottom:5px;"><b>'.project_name().'</b></div>
<div style="margin-bottom:10px;">'.base_url().'</div>

</div></div>';



		$config['protocol']    = 'smtp';
        $config['smtp_host']    = 'ssl://smtp.zoho.com';
        $config['smtp_port']    = '465';
        $config['smtp_timeout'] = '7';
        $config['smtp_user']    = sending_mail();
        $config['smtp_pass']    = sending_mail_pass();
        $config['charset']    = 'utf-8';
        $config['newline']    = "\r\n";
        $config['mailtype'] = 'text'; 
        $config['validation'] = TRUE;    

        $this->load->library('email',$config);

        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->from(sending_mail(), project_name());
        $this->email->to(sending_mail()); 

        $this->email->subject($subject);
        $this->email->message($message);
       

        if($this->email->send())
            $this->session->set_flashdata("success","Your request has been send Successfully.");
        else
            $this->session->set_flashdata("error","Error occured while sending request!!!");

        redirect('support'); 


    }

    
    

}


?>