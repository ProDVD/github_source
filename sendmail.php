    <?php
     
    require_once( 'PHPMailer/PHPMailerAutoload.php');
     
    $mail = new PHPMailer;
    $mail->isSMTP();
	$mail->SMTPAuth = true;
	$mail->SMTPSecure = 'ssl';
    $mail->Host = 'smtpout.secureserver.net';
    $mail->Port = 465;
	$mail->isHTML();
    $mail->Username = 'support@medical-stream.com';
    $mail->Password = 'support1319';
	$mail->SetFrom('support@medical-stream.com');
	$mail->Subject = 'Password remind';
    $mail->Body    = 'loremru50';
    $mail->addAddress('eugene.rim911@gmail.com', 'Eugene');
	var_dump(	$mail->send());