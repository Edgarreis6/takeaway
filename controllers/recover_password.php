<?php
require("models/users.php");

$userModel = new Users();


	
	function forgot_password(){
		if(isset($_POST['forgot']))
        {
	    $email=$this->input->post('email');
        $row = $userModel->getDetails($email);
		$user_email=$row->email;
				if((!strcmp($email, $user_email))){
						$pass=$row->pass;
						$to = $user_email;
						$subject = "Password";
						$txt = "Your password is $pass .";
						$headers = "From: password@example.com" . "\r\n" .
						"CC: ifany@example.com";
						mail($to,$subject,$txt,$headers);
				}
		}
        
    }
	
    require("views/forgot_pass.php");



?>