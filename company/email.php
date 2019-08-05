
<?php
require_once('phpmailer/class.phpmailer.php');
//include("class.smtp.php"); // optional, gets called from within class.phpmailer.php if not already loaded
 
define('GUSER', 'payalarora1827@gmail.com'); // Gmail username
define('GPWD', 'jobportal14'); // Gmail password

function smtpmailer($to, $from, $from_name, $subject, $body,$attachment) 
{
	global $error;
	$mail = new PHPMailer();  // create a new object
	$mail->IsSMTP(); // enable SMTP
	$mail->SMTPDebug = 0;  // debugging: 1 = errors and messages, 2 = messages only
	$mail->SMTPAuth = true;  // authentication enabled
	$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
	$mail->Host = 'smtp.gmail.com';
	$mail->Port = 465;
	$mail->Username = GUSER;
	$mail->Password = GPWD;
	$mail->SetFrom($from, $from_name);
	$mail->Subject = $subject;
	$mail->Body = $body;
	$mail->AddAddress($to);
        $mail->addAttachment('offerletter/'.$attachment);
	if(!$mail->Send()) 
        {
		$error = 'Mail error: '.$mail->ErrorInfo;
		return false;
	} 
        else 
        {
		$error = 'Message sent!';
		return true;
	}
}

?>
