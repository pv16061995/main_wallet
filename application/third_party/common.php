<?php
/*
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
*/
error_reporting(E_ERROR | E_WARNING | E_PARSE);
ini_set('error_reporting', E_NONE);
ini_set('display_errors','0');
define("_BASE_URL_PATH_","wallet");
define("IN_WALLET", true);
define("ADMIN_EMAIL", "btgwalletsuport@gmail.com");



session_start();
//header('Cache-control: private'); // IE 6
$testing = 1;
$dbserverflag =0; // Turn this to 1 when live
 if($dbserverflag == 1)
{
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "password";
	$db_name = "wallet";
	define("_LIVE_",true); // for testing in local system no coin function will call

}
else
{
	$db_host = "localhost";
	$db_user = "root";
	$db_pass = "password";
	$db_name = "wallet";
	define("_LIVE_",true); // for testing in local system no coin function will call
}



define("WITHDRAWALS_ENABLED", true); //Disable withdrawals during maintenance

$mysqli = new Mysqli($db_host, $db_user, $db_pass, $db_name);


include('jsonRPCClient.php');
if($testing == 1)
{
	include('classes/Client.php');
}
else
{
	include('classes/Client.php');
}
include('classes/User.php');

// function by zelles to modify the number to coin format ex. 0.00120000
function satoshitize($satoshitize2) {
   return sprintf("%.8f", $satoshitize2);
}

function isEmail($email)
{
	return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
}



function getRandomString($length = 8) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $string = '';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}


function getRandomOTPString($length = 8) {
    $string = '';
    $characters = '0123456789';

    for ($i = 0; $i < $length; $i++) {
        $string .= $characters[mt_rand(0, strlen($characters) - 1)];
    }

    return $string;
}




// function by zelles to trim trailing zeroes and decimal if need
function satoshitrim($satoshitrim) {
   return rtrim(rtrim($satoshitrim, "0"), ".");
}

$dir_path = "mywallet";

$server_ip = "162.213.252.66";
$server_url = "http://".$server_ip."/".$dir_path."/";  // website url

//-------------RPC CREDS of BTC-------
$rpc_host_BTC = "162.213.252.66";
$rpc_port_BTC = "18332";
$rpc_user_BTC = "test";
$rpc_pass_BTC = "test123";

//--------------RPC CREDS of coin-----
$rpc_host = "162.213.252.66";
$rpc_user="test";
$rpc_pass="test123";
$rpc_port="18336";

$coin_fullname = "Bitcoin Gold"; //Website Title (Do Not include 'wallet')
$coin_short = "BTG"; //Coin Short 
$server_name = "http://btgwallet.io";

$blockchain_url = $server_name.":3001/tx/"; //Blockchain Url
$support = "btgwalletsuport@gmail.com"; //Your support eMail
$hide_ids = array(1); //Hide account from admin dashboard
$donation_address = "NUQ5EQVo2BVV7ENwPbYD854dCp85cVFrCB"; //Donation Address

$fee = "0.001"; //Set a fee to prevent negitive balances.  	

function sendpmail($smto, $smsub, $smbody)
{
	
	$email_from ="btgwalletsuport@gmail.com";
	$headers = 'From: '.$email_from."\r\n".
						        'Reply-To: '.$email_from."\r\n" .
						        'X-Mailer: PHP/' . phpversion();
						        @mail($smto, $smsub, $smbody, $headers);  
	
	
	/*
	require_once 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.bccwallet.io/bcc';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'support@bccwallet.io/bcc';                 // SMTP username
	$mail->Password = '4IE{aHCqD_K$';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('support@bccwallet.io/bcc', 'operaCoin');
	$mail->addAddress($smto);               // Name is optional
	$mail->addReplyTo('support@bccwallet.io/bcc', 'Support');
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $smsub;
	$mail->Body    = $smbody;
	if(!$mail->send())
	{
		return 'Mailer Error: ' . $mail->ErrorInfo;
	}
	else
	{
		return 'Message has been sent';
	}
	*/
}

function sendMailToAdmin($smto, $smfrom, $smsub, $smbody)
{
	
		$headers = 'From: '.$smfrom."\r\n".
						        'Reply-To: '.$smfrom."\r\n" .
						        'X-Mailer: PHP/' . phpversion();
	   @mail($smto, $smsub, $smbody, $headers);  
	
/*	
	require_once 'PHPMailer/PHPMailerAutoload.php';

	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'mail.bccwallet.io/bcc';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                               // Enable SMTP authentication
	$mail->Username = 'donotreply@bccwallet.io/bcc';                 // SMTP username
	$mail->Password = '4IE{aHCqD_K$';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom($smfrom);
	$mail->addAddress($smto);               // Name is optional
	$mail->addReplyTo($smfrom, 'Reply');
	$mail->isHTML(true);                                  // Set email format to HTML

	$mail->Subject = $smsub;
	$mail->Body    = $smbody;
	if(!$mail->send())
	{
		return 'Mailer Error: ' . $mail->ErrorInfo;
	}
	else
	{
		return 'Message has been sent';
	}
	*/
}


function page_protect()
{
	if(!isset($_SESSION))
	{
		session_start();
	}
    if (isset($_SESSION['HTTP_USER_AGENT']))
    {
        if ($_SESSION['HTTP_USER_AGENT'] != md5($_SERVER['HTTP_USER_AGENT']))
        {
            logout();
            exit;
        }
    }
    
}
function filter($data)
{
    $data = trim(htmlentities(strip_tags($data)));
    if (get_magic_quotes_gpc())
    {
        $data = stripslashes($data);
    }
  //  $data = mysql_real_escape_string($data);
    return $data;
}
function logout()
{
    global $db;
    global $pathString;
    session_start();
    unset($_SESSION['user_id']);
	unset($_SESSION['user_email_id']);
    unset($_SESSION['user_session']);
	unset($_SESSION['user_admin']);
    unset($_SESSION['user_supportpin']);
    unset($_SESSION['HTTP_USER_AGENT']);
	session_unset();
    session_destroy();
    header("Location:landingpage.php");
}
?>
