<?php if (!defined("IN_WALLET")) { die("Auth Error2!"); } ?>
<?php
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 'On');
class User 
{
	private $mysqli;
	function __construct($mysqli)
	{
		$this->mysqli = $mysqli;
	}
	
	function isEmail($email)
	{
		return preg_match('/^\S+@[\w\d.-]{2,}\.[\w]{2,6}$/iU', $email) ? TRUE : FALSE;
	}
	
	function logIn($username, $password)
	{
		if (empty($username) || empty($password))
		{
			return "Please, fill all the fields";
		} 
		else
		{
			$auth=$_POST['auth'];
			$username = $this->mysqli->real_escape_string(strip_tags($username));
			$password = hash('sha256',addslashes(strip_tags($password)));
 			$auth = $this->mysqli->real_escape_string(	strip_tags(	$auth));
			$qstring = "SELECT * FROM users WHERE username='" . $username . "'";
			$result	= $this->mysqli->query($qstring);
           	$user = $result->fetch_assoc();

			$secret = $user['secret'];
			$oneCode = $this->getCode($secret);

        	if (($user) && ($user['password'] == $password) && ($user['locked'] == 0) && ($user['authused'] == 0))
        	{
        		return $user;
        	} 
			elseif (($user) && ($user['password'] == $password) && ($user['locked'] == 1))
			{
				$pin = $user['supportpin'];
				return "Account is locked. Contact support for more information. $pin";
			}
			elseif (($user) && ($user['password'] == $password) && ($user['locked'] == 0) && ($user['authused'] == 1 && ($oneCode == $_POST['auth']))) 
			{
				return $user;
			}
			else
			{
					return "Username, password or 2 factor is incorrect";
			}
		}
	}

	function add($username, $password, $confirmPassword,$email_id)
	{
		if (empty($username) || empty($password) || empty($confirmPassword)|| empty($email_id))
		{
			return "Please, fill all the fields";
		}
		elseif ($password != $confirmPassword)
		{
			return "Passwords did not match";
		}
		elseif ((strlen($username) < 3) || (strlen($username) > 30))
		{
			return "Username must be between 3 and 30 characters";
		}
		elseif (strlen($password) < 3)
		{
			return "Password must be longer than 3 characters";
		}
		elseif (!$this->isEmail($email_id))
		{
			return "Please, fill all the fields";
		}
		else 
		{
			
			$email = $this->mysqli->query("SELECT * FROM users WHERE email='" . $email_id . "'");
			if ($email->num_rows > 0)
			{
				return "Email already taken";
			}	
			else
			{
				//Let's do a database check
				$username = $this->mysqli->real_escape_string(strip_tags($username));
				$password = hash('sha256',addslashes(strip_tags($password)));
				$user = $this->mysqli->query("SELECT * FROM users WHERE username='" . $username . "'");
				if ($user->num_rows > 0)
				{
					return "Username already taken";
				}
				else
				{
					$temp = "INSERT INTO users (`date`, `ip`, `username`, `password`, `supportpin`,`email`, 	encrypt_username) VALUES (";
					$temp .= " now(),'" . $_SERVER['REMOTE_ADDR'] . "', '" . $username ."', '" . $password . "', '". rand(10000,99999) . "','".$email_id."','".hash('sha256',addslashes(strip_tags($username)))."')";
					
					$query = $this->mysqli->query($temp);				
					if ($query)
					{
						return true;
					}
					else
					{
						return "System error";
					}
				}
			}
		}
	}


	function updatePassword($user_session, $oldPassword, $newPassword, $confirmPassword)

	{
		global $hide_ids;
		if ($newPassword != $confirmPassword)
		{
			return "Passwords did not match.";
		}
		else
		{
			//Get old password
			$result = $this->mysqli->query("SELECT * FROM users WHERE username='" . $user_session . "'");
			if ($result->num_rows > 0)
			{
				$user = $result->fetch_assoc();
				$oldPassword = hash('sha256',addslashes(strip_tags($oldPassword)));
				$newPassword = hash('sha256',addslashes(strip_tags($newPassword)));
				if ($user['password'] != $oldPassword)

				{

					return "Password is incorrect.";

				} else {

					$result = $this->mysqli->query("UPDATE users SET password='" . $newPassword . "', supportpin='" . rand(10000,99999) . "' WHERE id=" . $user['id']);

					if ($result)

					{

						return true;

					} else {

						return "Some sort of error occured.";

					}

				}

			} else {

				return "Some sort of error occured.";

			}

		}

	}
                     

	function adminGetUserList()

	{

		global $hide_ids;

		$users = $this->mysqli->query("SELECT * FROM users");

		$return = array();

		while ($user = $users->fetch_assoc())

		{
			if (!in_array($user['id'], $hide_ids))

			{
				$return[] = $user;
			}
		}
		return $return;
	}


	function adminGetUserInfo($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("SELECT * FROM users WHERE id=" . $id);
			if ($users->num_rows > 0)
			{
				return $users->fetch_assoc();
			} else {
				return false;
			}
		} else {
			return false;
		}
	}


	function adminUpdatePassword($id, $newPassword)
	{
		global $hide_ids;
        	$password = hash('sha256',addslashes(strip_tags($newPassword)));
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$result = $this->mysqli->query("UPDATE users SET password='" . $password . "' WHERE id=" . $id . ";");
			if ($result)
			{
				return true;
			} else {
				return "Error.";
			}
		} else {
			return "User does not exist";
		}
	}

	function enableauth()

	{

	//	global $hide_ids;
		$id=$_SESSION['user_id'];
		$secret=$this->createSecret();
		$qrcode=$this->getQRCodeGoogleUrl('Wallet', $secret);
		$oneCode = $this->getCode($secret);

		if (($id)) 
		{  
			$msg = "Secret Key: $secret *Please write this down and keep in a secure area*<br><img src='$qrcode'<br>Please scan this with the Google Authenticator app on your mobile phone. This page will clear on refresh, please be careful.";
			$this->mysqli->query("UPDATE users SET authused=1, secret='" . $secret . "' WHERE id=" . $id); return "$msg";
		}
	}

	function disauth()
	{
		$id=$_SESSION['user_id'];
		if (($id))
		{
			$msg = "Two Factor Auth has been disabled for your account and will no longer be required when you sign in.";
			$this->mysqli->query("UPDATE users SET authused=0, secret='' WHERE id=" . $id); return "$msg";
		 }
	}

   function adminDeleteAccount($id)
    {
                global $hide_ids;
                if (is_numeric($id) && !in_array($id, $hide_ids))
                {
                        $this->mysqli->query("DELETE FROM users WHERE id=" . $id);
                }
        }

	function adminLockAccount($id)

	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("UPDATE users SET locked=1 WHERE id=" . $id);
			if ($users)
			{
				return true;
			} 
			else
			{
				return "Error.";
			}
		}
	}

	function adminUnlockAccount($id)

	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("UPDATE users SET locked=0 WHERE id=" . $id);
			if ($users)
			{
				return true;
			} 
			else
			{
				return "Error.";
			}
		}
	}

	function adminPrivilegeAccount($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))
		{
			$users = $this->mysqli->query("UPDATE users SET admin=1 WHERE id=" . $id);
			if ($users)
			{
				return true;
			} 
			else
			{
				return "Error.";
			}
		}
	}

	function adminDeprivilegeAccount($id)
	{
		global $hide_ids;
		if (is_numeric($id) && !in_array($id, $hide_ids))

		{
			$users = $this->mysqli->query("UPDATE users SET admin=0 WHERE id=" . $id);
			if ($users)
			{
				return true;
			} 
			else
			{
				return "Error.";
			}
		}
	}
	
	function getUserIdFromUserName($user_name)
	{
		$users = $this->mysqli->query("select id from users  WHERE username='" . $user_name."'limit 1");
		$return = array();

		while ($user = $users->fetch_assoc())
		{
			if (!in_array($user['id'], $hide_ids))
			{
				$return[] = $user;
			}
		}
		return $return;
	}
	
	function getUserIdFromUserAddress($address)
	{
		$users = $this->mysqli->query("select id from users  WHERE address='" . $address."'limit 1");
		$return = array();

		while ($user = $users->fetch_assoc())
		{
			if (!in_array($user['id'], $hide_ids))
			{
				$return[] = $user;
			}
		}
		return $return;
	}
	
	function getUserNameFromUserAddress($address)
	{
		$users = $this->mysqli->query("select username from users  WHERE address='" . $address."'limit 1");
		$return = array();

		while ($user = $users->fetch_assoc())
		{
			$return[] = $user;
		}
		return $return;
	
	}
	
	function getBalance($id)
	{
		$users = $this->mysqli->query("select closing_amount as balance from transcation  WHERE from_user_id='" . $id."'limit 1");
		$return = array();
		while ($user = $users->fetch_assoc())
		{
			$return[] = $user;
		}
		return $return;
	
	}
	
	function getNewAddress($id,$wallet_address)
	{
		
		$temp = "update users set wallet_address = '".$wallet_address."' WHERE id='" . $id."'";
	//	echo $temp;
		$query = $this->mysqli->query($temp);
		
		if($query)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	
	function transcation($from_address,$to_address, $amount, $txid, $info)
	{
		$from_opening_amount = 0;
		$from_closing_amount = 0;
		$to_opening_amount = 0;
		$to_closing_amount = 0;
		
		
		$qstring = "select users.id as user_id from users where wallet_address ='".$from_address."' limit 1";
	//	echo $qstring;
		$result	= $this->mysqli->query($qstring);
        $userValue = $result->fetch_assoc();

		$from_user_id = isset($userValue['user_id'])?:0;
		
		$qstring3 = "select users.id as user_id from users where wallet_address ='".$to_address."' limit 1";
		$result3	= $this->mysqli->query($qstring3);
        $userValue3 = $result3->fetch_assoc();
	
		
		$to_user_id = isset($userValue3['user_id'])?:0;
		
		
		if(($from_user_id>0)&&($to_user_id>0))
		{
		
			$qstring2 = "select transcation_id, closing_amount from transcation where user_id = '".$from_user_id."' order by transcation_id desc limit 1";
			$result2 = $this->mysqli->query($qstring2);
			if($result2)
			{
				$userValue2 = $result2->fetch_assoc();
			}
			$from_opening_amount = isset($userValue2['closing_amount'])?:0;
			$from_closing_amount = floatval($from_opening_amount) - floatval($amount);
		
			$temp = "INSERT INTO transcation (`transcation_type`, `time`,from_address,to_address,`opening_amount`, ";
			$temp .= "`trans_amount`,`closing_amount`,`confirmations`,`txid`,`info`,from_user_id,to_user_id) ";
			$temp .= " VALUES ('send',now(),'";
			$temp .= $from_address . "','".$to_address ."','" .$from_opening_amount."','". $amount ."','";
			$temp .= $from_closing_amount."','6','".$txid. "','". $info."','".$from_user_id."','".$to_user_id."')";
			
		//	echo $temp."</br>";
			$query1 = $this->mysqli->query($temp);
			
			
			$qstring4 = "select transcation_id, closing_amount from transcation where user_id = '".$to_user_id."' order by transcation_id desc limit 1";
			$result4 = $this->mysqli->query($qstring4);
			if($result4)
			{
				$userValue4 = $result4->fetch_assoc();
			}
			$to_opening_amount = isset($userValue4['closing_amount'])?:0;
			$to_closing_amount = floatval($to_opening_amount) + floatval($amount);
			
			
			$temp2 = "INSERT INTO transcation (`transcation_type`, `time`,from_address,to_address,`opening_amount`, ";
			$temp2 .= "`trans_amount`,`closing_amount`,`confirmations`,`txid`,`info`,from_user_id,to_user_id) ";
			$temp2 .= " VALUES ('receive',now(),'";
			$temp2 .= $from_address . "','".$to_address ."','" .$to_opening_amount."','". $amount ."','";
			$temp2 .= $to_closing_amount."',6,'".$txid. "','". $info."','".$from_user_id."','".$to_user_id."')";
			
			$query2 = $this->mysqli->query($temp2);

			if ($query2)
			{

				return true;
			}
			else 
			{
				return "System error";
			}
		}
		else 
		{
			return "System error";
		}
	}
	
	function transcationList($address)
	{
		$qstring = "select users.id as user_id from users where wallet_address ='".$address."' limit 1";
		$result	= $this->mysqli->query($qstring);
        $userValue = $result->fetch_assoc();
		$user_id = isset($userValue['user_id'])?:0;
		
		$users = $this->mysqli->query("SELECT transcation_type as category,`time`,to_address as address, trans_amount as amount, fee, confirmations,txid,info FROM transcation where user_id =".$from_user_id);
		$return = array();
		while ($user = $users->fetch_assoc())
		{
			$return[] = $user;
		}
		return $return;
	}

	function storeAuthorizationKey($user_id,$authorization_code)
	{
		$temp2 = "INSERT INTO authorization (user_id,login_time,authorization_code) ";
		$temp2 .= " VALUES ('".$user_id."',now(),'";
		$temp2 .= $authorization_code . "')";
		
		$query2 = $this->mysqli->query($temp2);

		if ($query2)
		{

			return true;
		}
		else 
		{
			return "System error";
		}
	}

	function validateUser($user_code, $password)
	{
		$temp2 = "select id from users where encrypt_username ='";
		$temp2 .= $user_code . "' and password = '";
		$temp2 .= $password ."'";
		$query2 = $this->mysqli->query($temp2);
//		echo $temp2; die;
		if ($query2)
		{

			return true;
		}
		else 
		{
			return false;
		}
	}
	
	function validateAdmin($user_code, $password)
	{
		$temp2 = "select id from users where admin = 1 and encrypt_username ='";
		$temp2 .= $user_code . "' and password = '";
		$temp2 .= $password ."'";
		$query2 = $this->mysqli->query($temp2);
//		echo $temp2; die;
		if ($query2)
		{

			return true;
		}
		else 
		{
			return false;
		}
	}
	
    
    function forgetPassword($user_name)
	{
		$temp2 = "select id as user_id,email  from users where username ='";
		$temp2 .= $user_name."'";
		$query2 = $this->mysqli->query($temp2);
        $user_id ='';
//        echo $temp2;
     	$return = array();
		if ($query2)
		{
            while ($user = $query2->fetch_assoc())
            {
                $return[] = $user;
            }
            
            if(count($return)>0)
			{
				$user_id = $return[0]['user_id'];
				$email_id = $return[0]['email'];
	//            echo $user_id; 
				
				if(!empty($user_id))
				{
				
					$user_password =  getRandomString(8);
					
					$password = hash('sha256',addslashes(strip_tags($user_password)));
					$temp2 = "update users set `password` = '".$password."' where id = ".$user_id;
					$query3 = $this->mysqli->query($temp2);
					if($query3)
					{
						
						$email_message="";
						$email_from = "support@operacoin.com"; // required
						$subject = "Forget Password"; //  required

						$email_message = "\n\n";
						$email_message .= "Dear ".$user_name.",\n";
						$email_message .= "Your random password is  ".$user_password."\n";
						$email_message .= "Please login and change your password  \n";
						$email_message .= "Regards  \n";
						$email_message .= "Admin  \n";
						
						$headers = 'From: '.$email_from."\r\n".
						'Reply-To: '.$email_from."\r\n" .
						'X-Mailer: PHP/' . phpversion();
						@mail($email_id, $email_subject, $email_message, $headers);  
						
				//        echo $email_message; die;
						return "An Email has been sent to your email id";
					}                    
				}
			}
			else
            {
                return "Email Id is not found in our database";
            }
        }
		else 
		{
			return "Please provide valid email ID";
		}
	}

    function sendOTP($user_id,$address,$amount,$wallet_address)
	{
        $temp2 = "select wallet_address, email from users where id ='" ;
		$temp2 .= $user_id."'";
		$query2 = $this->mysqli->query($temp2);
       
//        echo $temp2;
     	$return = array();
		if ($query2)
		{
            while ($user = $query2->fetch_assoc())
            {
                $return[] = $user;
            }
            
            $email_id = $return[0]['email'];
        
            if(!empty($email_id))
            {
            
                $otp_value =  getRandomOTPString(6);
                
                
                $temp = "INSERT INTO transcation (`transcation_type`, `time`,from_address,to_address, ";
                $temp .= "`trans_amount`,from_user_id,otp_value) ";
                $temp .= " VALUES ('send',now(),'";
                $temp .= $wallet_address . "','".$address ."','" . $amount ."','";
                $temp .= $user_id."','".$otp_value."')";
                
//                echo $temp."</br>";
     // die;
                $query3 = $this->mysqli->query($temp);
                if($query3)
                {
                    $email_message="";
                    $email_from = "support@operacoin.com"; // required
                    $subject = "One time OTP"; //  required

                    $email_message = "\n\n";
                    $email_message .= "Dear User,\n";
                    $email_message .= "Your OTP password is  ".$otp_value."\n";
                    $email_message .= "Regards  \n";
                    $email_message .= "Admin  \n";
                    
                    $headers = 'From: '.$email_from."\r\n".
                    'Reply-To: '.$email_from."\r\n" .
                    'X-Mailer: PHP/' . phpversion();
                    mail($email_id, $subject, $email_message, $headers);  
                    
            //        echo $email_message; die;
            //        return "An Email has been sent to your email id";
                }                    
                
            }
            else
            {
              //  return "Email Id is not found in our database";
            }
        
		}
		else 
		{
			return "Please provide valid email ID";
		}
	}

	function checkOTP($user_id, $otp_value,$wallet_address)
	{
        
        //////////////////////////dddddddddddddddd
        
        $temp2  = " select";
        $temp2 .= " `transcation_id`, `to_address`, `trans_amount`";
        $temp2 .= " from `transcation` where";
        $temp2 .= " `transcation_type` ='send' ";
        $temp2 .= " and `otp_value` = '".trim($otp_value)."' and  `is_processed` = 0";
        $temp2 .= " and `from_address` = '".trim($wallet_address)."' and  `from_user_id` = '".$user_id."'";
        
        
		$query2 = $this->mysqli->query($temp2);
       
        //echo "chk ". $temp2." </br>"; // die;
     	$return = array();
		if ($query2)
		{
            while ($user = $query2->fetch_assoc())
            {
                $return[] = $user;
            }
            
            if(count($return) == 0)
            {
                return false;
            }
            else
            {
                
               // var_dump($return); 
            $temp2  = " update transcation set is_processed = 1 where ";
            $temp2 .= " transcation_type ='send' ";
            $temp2 .= " and `otp_value` = '".trim($otp_value)."' and  `is_processed` = 0";
            $temp2 .= " and `from_address` = '".trim($wallet_address)."' and  `from_user_id` = '".$user_id."'";
            $temp2 .= " and `transcation_id` = '".trim($return[0]['transcation_id'])."'";
   //  echo "<pre>";           
     //           echo $temp2."</br>";
       //         echo "</pre>";           
 //     die;
                $query3 = $this->mysqli->query($temp2);
                if($query3)
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
		}
		else 
		{
			return false;
		}
	}

//GoogleAuthenticator 
//Created by PHPGangsta

protected $_codeLength = 6;
    /**
     * Create new secret.
     * 16 characters, randomly chosen from the allowed base32 characters.
     *
     * @param int $secretLength
     * @return string
     */
    public function createSecret($secretLength = 16)
    {
        $validChars = $this->_getBase32LookupTable();
        unset($validChars[32]);
        $secret = '';
        for ($i = 0; $i < $secretLength; $i++) {
            $secret .= $validChars[array_rand($validChars)];
        }
        return $secret;
    }
    /**
     * Calculate the code, with given secret and point in time
     *
     * @param string $secret
     * @param int|null $timeSlice
     * @return string
     */
    public function getCode($secret, $timeSlice = null)
    {
        if ($timeSlice === null) {
            $timeSlice = floor(time() / 30);
        }
        $secretkey = $this->_base32Decode($secret);
        // Pack time into binary string
        $time = chr(0).chr(0).chr(0).chr(0).pack('N*', $timeSlice);
        // Hash it with users secret key
        $hm = hash_hmac('SHA1', $time, $secretkey, true);
        // Use last nipple of result as index/offset
        $offset = ord(substr($hm, -1)) & 0x0F;
        // grab 4 bytes of the result
        $hashpart = substr($hm, $offset, 4);
        // Unpak binary value
        $value = unpack('N', $hashpart);
        $value = $value[1];
        // Only 32 bits
        $value = $value & 0x7FFFFFFF;
        $modulo = pow(10, $this->_codeLength);
        return str_pad($value % $modulo, $this->_codeLength, '0', STR_PAD_LEFT);
    }
    /**
     * Get QR-Code URL for image, from google charts
     *
     * @param string $name
     * @param string $secret
     * @param string $title
     * @return string
     */
    public function getQRCodeGoogleUrl($name, $secret, $title = null) {
        $urlencoded = urlencode('otpauth://totp/'.$name.'?secret='.$secret.'');
	if(isset($title)) {
                $urlencoded .= urlencode('&issuer='.urlencode($title));
        }
        return 'https://chart.googleapis.com/chart?chs=200x200&chld=M|0&cht=qr&chl='.$urlencoded.'';
    }
    /**
     * Check if the code is correct. This will accept codes starting from $discrepancy*30sec ago to $discrepancy*30sec from now
     *
     * @param string $secret
     * @param string $code
     * @param int $discrepancy This is the allowed time drift in 30 second units (8 means 4 minutes before or after)
     * @param int|null $currentTimeSlice time slice if we want use other that time()
     * @return bool
     */
    public function verifyCode($secret, $code, $discrepancy = 1, $currentTimeSlice = null)
    {
        if ($currentTimeSlice === null) {
            $currentTimeSlice = floor(time() / 30);
        }
        for ($i = -$discrepancy; $i <= $discrepancy; $i++) {
            $calculatedCode = $this->getCode($secret, $currentTimeSlice + $i);
            if ($calculatedCode == $code ) {
                return true;
            }
        }
        return false;
    }
    /**
     * Set the code length, should be >=6
     *
     * @param int $length
     * @return PHPGangsta_GoogleAuthenticator
     */
    public function setCodeLength($length)
    {
        $this->_codeLength = $length;
        return $this;
    }
    /**
     * Helper class to decode base32
     *
     * @param $secret
     * @return bool|string
     */
    protected function _base32Decode($secret)
    {
        if (empty($secret)) return '';
        $base32chars = $this->_getBase32LookupTable();
        $base32charsFlipped = array_flip($base32chars);
        $paddingCharCount = substr_count($secret, $base32chars[32]);
        $allowedValues = array(6, 4, 3, 1, 0);
        if (!in_array($paddingCharCount, $allowedValues)) return false;
        for ($i = 0; $i < 4; $i++){
            if ($paddingCharCount == $allowedValues[$i] &&
                substr($secret, -($allowedValues[$i])) != str_repeat($base32chars[32], $allowedValues[$i])) return false;
        }
        $secret = str_replace('=','', $secret);
        $secret = str_split($secret);
        $binaryString = "";
        for ($i = 0; $i < count($secret); $i = $i+8) {
            $x = "";
            if (!in_array($secret[$i], $base32chars)) return false;
            for ($j = 0; $j < 8; $j++) {
                $x .= str_pad(base_convert(@$base32charsFlipped[@$secret[$i + $j]], 10, 2), 5, '0', STR_PAD_LEFT);
            }
            $eightBits = str_split($x, 8);
            for ($z = 0; $z < count($eightBits); $z++) {
                $binaryString .= ( ($y = chr(base_convert($eightBits[$z], 2, 10))) || ord($y) == 48 ) ? $y:"";
            }
        }
        return $binaryString;
    }
    /**
     * Helper class to encode base32
     *
     * @param string $secret
     * @param bool $padding
     * @return string
     */
    protected function _base32Encode($secret, $padding = true)
    {
        if (empty($secret)) return '';
        $base32chars = $this->_getBase32LookupTable();
        $secret = str_split($secret);
        $binaryString = "";
        for ($i = 0; $i < count($secret); $i++) {
            $binaryString .= str_pad(base_convert(ord($secret[$i]), 10, 2), 8, '0', STR_PAD_LEFT);
        }
        $fiveBitBinaryArray = str_split($binaryString, 5);
        $base32 = "";
        $i = 0;
        while ($i < count($fiveBitBinaryArray)) {
            $base32 .= $base32chars[base_convert(str_pad($fiveBitBinaryArray[$i], 5, '0'), 2, 10)];
            $i++;
        }
        if ($padding && ($x = strlen($binaryString) % 40) != 0) {
            if ($x == 8) $base32 .= str_repeat($base32chars[32], 6);
            elseif ($x == 16) $base32 .= str_repeat($base32chars[32], 4);
            elseif ($x == 24) $base32 .= str_repeat($base32chars[32], 3);
            elseif ($x == 32) $base32 .= $base32chars[32];
        }
        return $base32;
    }
    /**
     * Get array with all 32 characters for decoding from/encoding to base32
     *
     * @return array
     */
    protected function _getBase32LookupTable()
    {
        return array(
            'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', //  7
            'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', // 15
            'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', // 23
            'Y', 'Z', '2', '3', '4', '5', '6', '7', // 31
            '='  // padding char
        );
    }
}

?>
