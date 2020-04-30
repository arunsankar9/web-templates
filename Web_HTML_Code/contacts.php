<?php 
error_reporting(E_ALL ^ E_NOTICE); 


if(isset($_POST['submitted'])) {
	

	if(trim($_POST['name']) === '') {
		$nameError =  'This field is required.'; 
		$hasError = true;
	} else {
		$name = trim($_POST['name']);
	}
	
    $website = trim($_POST['website']);
	$phone = trim($_POST['phonenumber']);
	$subject = trim($_POST["subject"]);
	
	// E-Mail Validation
	if(trim($_POST['email']) === '')  {
		$emailError = 'This field is required.';
		$hasError = true;
	} else if (!preg_match("/^[[:alnum:]][a-z0-9_.-]*@[a-z0-9.-]+\.[a-z]{2,4}$/i", trim($_POST['email']))) {
		$emailError = 'Please enter a valid email address';
		$hasError = true;
	} else {
		$email = trim($_POST['email']);
	}
		

	if(trim($_POST['message']) === '') {
		$commentError = 'This field is required!';
		$hasError = true;
	} else {
		if(function_exists('stripslashes')) {
			$comments = stripslashes(trim($_POST['message']));
		} else {
			$comments = trim($_POST['message']);
		}
	}
		

	if(!isset($hasError)) {
		
		$emailTo = 'mailto:can@themeflex.com';
		$subject = 'Test\'dan mail var. '.$name;
		$sendCopy = trim($_POST['sendCopy']);
		$body = "Name: $name \n\n Email: $email \n\n Subject:$subject \n\nPhone: $phone \n\n Website: $website \n\n Message: $comments";
		$headers = 'From: ' .' <'.$emailTo.'>' . "\r\n" . 'Reply-To: ' . $email;

		mail($emailTo, $subject, $body, $headers);
        
        
		$emailSent = true;
		
	}

}

?>