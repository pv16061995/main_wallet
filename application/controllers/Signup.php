<?php
if(!defined('BASEPATH')) exit('No direct script access allowed');

include_once APPPATH.'third_party/GoogleAuthenticator.php';

class Signup extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		$this->load->library('session','Twoauth');
		$this->load->helper('utility_helper');
        $this->load->model('Auth_model');

        
	}
	
	public function index()
	{
        $this->sign_up();
    }



    public function sign_up()
    {
        $this->load->view('signup'); 

    }



     public function registeration()
        {
            $ga = new GoogleAuthenticator();
            
            
            $name = $this->input->post('name');
            $email = $this->input->post('username');
            $password = $this->input->post('password');
            $pin=$this->input->post('pin');
            $secret = $ga->createSecret();

            $chkmail=$this->Auth_model->chkmailvalid($email);

            if(count($chkmail)==0)
            {
                $userid=$this->Auth_model->signup($name,$email,$password,$pin,$secret);
                if($userid)
                {
                    $this->verifymail($name,$email,$userid);
                    $this->session->set_flashdata('success', 'Thank you for registration. Please verify email then login.');
                    redirect(base_url());
                }
                else
                {
                    $this->session->set_flashdata('error', 'Please enter correct username and password');
                    redirect('signup');
                } 
            }else{
                $this->session->set_flashdata('error', 'This e-mail already exists!!!');
                redirect('signup');
            }
            
            
        }

    public function verifymail($name,$toemail,$userid)
    {

        $subject='Registration and Verification mail';

       $message='<div style="width:500px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;">
 
<div style="margin-bottom:35px;background:#fafafa; text-align:center;"><img src="'.logo_url().'" style="height:70px;" /></div>
<div class="mobile-br"  style="font-size:35px; font-weight: 600; color: #2f982e; text-align:center;">&nbsp; Welcome to <b>'.project_name().'</b> <br><br> </div>
 <div style="font-size:24px; text-align:center;"> <br>Congratulations!!!<br><br> </div>
<div style="margin-bottom:20px;">Dear '.ucfirst(strtolower($name)).',</div>
<div style="margin-bottom:10px;">Thank you for registering at <b>'.project_name().'</b> !  <br><br> 
You have successfully gone through the process of registration at <b>'.project_name().'</b>. Now You can start to receive and send from your wallet account in seconds. <br><br></div> 
 <div>
 <a href="'.base_url().'signup/activateaccount?em='.base64_encode($toemail).'&uid='.base64_encode($userid).'" style="background-color:#f5774e;color:#ffffff;display:inline-block;font-size:18px;font-weight:400;line-height:45px;text-align:center;text-decoration:none;width:180px;-webkit-text-size-adjust:none; text-align="center" target="_blank">Activate Account</a><br><br>
                     </div>';

$message .='
 <div style="text-align:left; font-size:13px;" class="mobile-center body-padding w320"><br>If you have any questions regarding <b>'.project_name().'</b> please read our FAQ or use our support form wallet email address. Our support staff will be more than happy to assist you.<br><br><br></div>
<div style="margin-bottom:20px;">
<br>
<b>With Best of Regards</b>,<br>
<b>Team '.project_name().'</b> <br>
</div>
<div style="background:#1a1a1a; padding:10px; width:100%; color:#fff; box-sizing: border-box; text-align:center;">
<div style="font-size:18px; font-weight:bold; margin-bottom:5px;"><b>'.project_name().'</b></div>
<div style="margin-bottom:10px;"><b>'.base_url().'</b></div>

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

        $this->email->from(sending_mail(), project_name());
        $this->email->to($toemail); 

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->send();
    }


    public function activateaccount()
    {
        if($this->input->get('em')!=false && $this->input->get('uid')!=false)
        {
            $email=base64_decode($this->input->get('em'));
            $uid=base64_decode($this->input->get('uid'));

            if($this->Auth_model->activateaccount($email,$uid))
            {
                $this->activationmail();
                $this->session->set_flashdata('success', 'Your account activate successfully');
                redirect(base_url());

            }else{
                $this->session->set_flashdata('error', 'Error occurred while activate your account!!!');
                redirect(base_url());
            }
        }
    }

    public function activationmail()
    {
        $subject='Account activation mail';
        $message='<div style="width:500px; margin:auto; font-family:Helvetica,Arial; font-size:13px; color:#333; line-height:18px; background:#fafafa; border:#F1F0F0 solid 1px; padding:10px 10px 0 10px;">
 
<div style="margin-bottom:35px;background:#fafafa; text-align:center;"><img src="'.logo_url().'" style="height:70px;" /></div>
<div class="mobile-br"  style="font-size:35px; font-weight: 600; color: #2f982e; text-align:center;">&nbsp; Welcome to <b>'.project_name().'</b> <br><br> </div>
 <div style="font-size:24px; text-align:center;"> <br>Congratulations!!!!!!!!!<br><br> </div>
<div style="margin-bottom:20px;">Dear,</div>
<div style="margin-bottom:10px;">Congratulations your wallet Account has been verified successfully.<br><br> <div><b>Note: </b>In case you have not made this request of OTP, please email our Customer Care. <br><br></div> 
 ';

$message .='
 
 <div style="text-align:left; font-size:13px;" class="mobile-center body-padding w320"><br><b>Please Note : </b><br>
                    1. Do not share your credentials or otp with anyone on email.<br>
                    2. Wallet never asks you for your credentials or otp.<br>
                    3. Always create a strong password and keep different passwords for different websites.<br>
                    4. Ensure you maintain only one account on wallet to enjoy our awesome services.<br><br></div>
 <div style="text-align:left; font-size:13px;" class="mobile-center body-padding w320"><br>If you have any questions regarding <b>'.project_name().'</b> please read our FAQ or use our support form wallet eamil address). Our support staff will be more than happy to assist you.</div>
<div style="margin-bottom:10px;">
<br>
<b>With Best of Regards</b>,<br>
<b>Wallet Team<br>
</div>
<div style="background:#1a1a1a; padding:10px; width:100%; color:#fff; box-sizing: border-box; text-align:center;">
<div style="font-size:18px; font-weight:bold; margin-bottom:5px;"><b>'.project_name().'</b></div>
<div style="margin-bottom:10px;"><b>'.base_url().'</b></div>

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

        $this->email->from(sending_mail(), project_name());
        $this->email->to($toemail); 

        $this->email->subject($subject);
        $this->email->message($message);
        $this->email->set_header('MIME-Version', '1.0; charset=utf-8');
        $this->email->set_header('Content-type', 'text/html');
        $this->email->send();
    }

}


?>