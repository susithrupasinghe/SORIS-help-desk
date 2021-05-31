<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'helpers/Exception.php';
require 'helpers/PHPMailer.php';
require 'helpers/SMTP.php';
$smtpUsername = "soris.university@gmail.com";
$smtpPassword = "soris.university123";

$emailFrom = "soris.university@gmail.com";
$emailFromName ="SORIS University Help Desk";





function send_Verify_Email($to,$verificationLink){

$mail = new PHPMailer;
$mail->isSMTP(); 
$mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
$mail->Host = "smtp.gmail.com";
$mail->Port = 587; // TLS only
$mail->SMTPSecure = 'tls'; // ssl is depracated
$mail->SMTPAuth = true;
$mail->Username = $GLOBALS['smtpUsername'];
$mail->Password = $GLOBALS['smtpPassword'];
$mail->setFrom($GLOBALS['emailFrom'], $GLOBALS['emailFromName']);
$mail->addAddress($to, $to);
$mail->Subject = 'SORIS Verification';
$mail->msgHTML("
<html>

<head>
    
</head>

<body>
    <div class='es-wrapper-color'>
        <!--[if gte mso 9]>
			<v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
				<v:fill type='tile' color='#f8f9fd'></v:fill>
			</v:background>
		<![endif]-->
        <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
            <tbody>
                <tr>
                    <td class='esd-email-paddings' valign='top'>
                        <table cellpadding='0' cellspacing='0' class='es-content esd-header-popover' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe' align='center' bgcolor='#f8f9fd' style='background-color: #f8f9fd;'>
                                        <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p10t es-p15b es-p30r es-p30l' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='540' class='esd-container-frame' align='center' valign='top'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align='left' class='esd-block-text'>
                                                                                        <p style='color: #08a73a; font-size: 36px; text-align: center;'><strong>SO<span style='color:#000000;'>RIS University Help Desk</span></strong></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                        <table cellpadding='0' cellspacing='0' class='es-content' align='center'>
                            <tbody>
                                <tr>
                                    <td class='esd-stripe' align='center' bgcolor='#f8f9fd' style='background-color: #f8f9fd;'>
                                        <table bgcolor='transparent' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600' style='background-color: transparent;'>
                                            <tbody>
                                                <tr>
                                                    <td class='esd-structure es-p20t es-p10b es-p20r es-p20l' align='left'>
                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                            <tbody>
                                                                <tr>
                                                                    <td width='560' class='esd-container-frame' align='center' valign='top'>
                                                                        <table cellpadding='0' cellspacing='0' width='100%'>
                                                                            <tbody>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-p10b'>
                                                                                        <h1>Your Verification Link&nbsp;</h1>
                                                                                    </td>
                                                                                </tr>
                                                                                <tr>
                                                                                    <td align='center' class='esd-block-text es-p10t es-p10b'>
                                                                                        <p><a href='$verificationLink'target='_blank'>Click Here</a></p>
                                                                                    </td>
                                                                                </tr>
                                                                            </tbody>
                                                                        </table>
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </td>
                                                </tr>
                                                
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                   
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>"); 


if(!$mail->send()){
    // echo "Mailer Error: " . $mail->ErrorInfo;

    return false;
}else{
    // echo "Message sent!";
    return true;
}



}




function send_Forgot_password($to,$Link){

    $mail = new PHPMailer;
    $mail->isSMTP(); 
    $mail->SMTPDebug = 0; // 0 = off (for production use) - 1 = client messages - 2 = client and server messages
    $mail->Host = "smtp.gmail.com";
    $mail->Port = 587; // TLS only
    $mail->SMTPSecure = 'tls'; // ssl is depracated
    $mail->SMTPAuth = true;
    $mail->Username = $GLOBALS['smtpUsername'];
    $mail->Password = $GLOBALS['smtpPassword'];
    $mail->setFrom($GLOBALS['emailFrom'], $GLOBALS['emailFromName']);
    $mail->addAddress($to, $to);
    $mail->Subject = 'SORIS Help Desk Password Reset';
    $mail->msgHTML("
    <html>
    
    <head>
        
    </head>
    
    <body>
        <div class='es-wrapper-color'>
            <!--[if gte mso 9]>
                <v:background xmlns:v='urn:schemas-microsoft-com:vml' fill='t'>
                    <v:fill type='tile' color='#f8f9fd'></v:fill>
                </v:background>
            <![endif]-->
            <table class='es-wrapper' width='100%' cellspacing='0' cellpadding='0'>
                <tbody>
                    <tr>
                        <td class='esd-email-paddings' valign='top'>
                            <table cellpadding='0' cellspacing='0' class='es-content esd-header-popover' align='center'>
                                <tbody>
                                    <tr>
                                        <td class='esd-stripe' align='center' bgcolor='#f8f9fd' style='background-color: #f8f9fd;'>
                                            <table bgcolor='#ffffff' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600'>
                                                <tbody>
                                                    <tr>
                                                        <td class='esd-structure es-p10t es-p15b es-p30r es-p30l' align='left'>
                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width='540' class='esd-container-frame' align='center' valign='top'>
                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align='left' class='esd-block-text'>
                                                                                            <p style='color: #08a73a; font-size: 36px; text-align: center;'><strong>SO<span style='color:#000000;'>RIS University Help Desk</span></strong></p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                            <table cellpadding='0' cellspacing='0' class='es-content' align='center'>
                                <tbody>
                                    <tr>
                                        <td class='esd-stripe' align='center' bgcolor='#f8f9fd' style='background-color: #f8f9fd;'>
                                            <table bgcolor='transparent' class='es-content-body' align='center' cellpadding='0' cellspacing='0' width='600' style='background-color: transparent;'>
                                                <tbody>
                                                    <tr>
                                                        <td class='esd-structure es-p20t es-p10b es-p20r es-p20l' align='left'>
                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                <tbody>
                                                                    <tr>
                                                                        <td width='560' class='esd-container-frame' align='center' valign='top'>
                                                                            <table cellpadding='0' cellspacing='0' width='100%'>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td align='center' class='esd-block-text es-p10b'>
                                                                                            <h1>Your password Reset Link &nbsp;</h1>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td align='center' class='esd-block-text es-p10t es-p10b'>
                                                                                            <p><a href='$Link'target='_blank'>Click Here</a></p>
                                                                                        </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                       
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    
    </html>"); 
    
    
    if(!$mail->send()){
        // echo "Mailer Error: " . $mail->ErrorInfo;
    
        return false;
    }else{
        // echo "Message sent!";
        return true;
    }
    
    
    
    }


?>