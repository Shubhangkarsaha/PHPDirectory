<?php
//USING PhpMailer.....
	//"phpmailer/phpmailer": "~5.2"
	include 'PHPMailer/PHPMailerAutoload.php';
	
	//$councilor_name	= $_POST['councilor_name'];
	
	$mail_to 		= $_POST['mail_to'];
    $subject 		= $_POST['subject'];
	$message 		= $_POST['message'];
	$message 		= "&nbsp;".nl2br($message);
	/*if($message != "")
	{
		$message = nl2br($message);
	}
	else
	{
		$message = "To,<br> ".$councilor_name."<br>Councilor LAD Report<br>";
	}*/
	//$filename 		= $_FILES['attachment']['name'];
	//$filetmpname 	= $_FILES['attachment']['tmp_name'];
	//$total_files =  count($_FILES['attachment']['name']);
	
	$sender_name		= "SMC Vehicle";
	$sender_email 		= "smc@classicsoftwares.com";//"councilorlad2022@gmail.com"; //"formailtesting93@gmail.com";
	$sender_password 	= "Classic@123";//"General@123"; //"formailtesting";
	
	$mail = new PHPMailer;

	//$mail->SMTPDebug = 3;                                 // Enable verbose debug output
	
	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'smtp.hostinger.com';  					 // Specify main and backup SMTP servers
	$mail->SMTPAuth = true;                             // Enable SMTP authentication
	$mail->Username = $sender_email;	               // SMTP username
	$mail->Password = $sender_password;               // SMTP password
	$mail->SMTPSecure = 'tls';                       // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                              // TCP port to connect to
	
	$mail->setFrom($sender_email, $sender_name);		  //Sender EMail
	 
	//$mail->addAddress('joe@example.net', 'Joe User');     // Add a recipient
	$mail->addAddress($mail_to);               // Name is optional
	//$mail->addReplyTo('info@example.com', 'Information');
	//$mail->addCC('cc@example.com');
	//$mail->addBCC('bcc@example.com');
	
	//$mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
	if(isset($_FILES['attachment']['name'])){
		for($i=0;$i<count($_FILES['attachment']['name']);$i++){
			$mail->addAttachment($_FILES['attachment']['tmp_name'][$i], $_FILES['attachment']['name'][$i]);    // Optional name
		}
	}
	$mail->isHTML(true);                                  // Set email format to HTML
	
	$mail->Subject = $subject;
	$mail->Body    = $message;
	//$mail->AltBody = This is the body in plain text for non-HTML mail clients';

	
	if ($mail->Send()) {
        //exit;
		echo "<script>
				alert('Mail send successfully');
				location.replace('dashboard.php');
			</script>"; // do what you want after sending the email        
    } else {
        //exit;
		echo "<script>
				alert('ERROR! Contact Your Developer! ".$mail->ErrorInfo."');
				location.replace('dashboard.php');
			</script>";
        //print_r( error_get_last() );
    }
	
?>