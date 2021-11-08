<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'autoload.php';

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {if(isset($_POST['submit'])){
    $fname = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $msg = $_POST['msg'];

    $mail->SMTPDebug = 3;                               // Enable verbose debug output

    $mail->isSMTP();                                      // Set mailer to use SMTP
    $mail->Host = 'smtp.gmail.com';  // Specify main and backup SMTP servers
    $mail->SMTPAuth = true;                               // Enable SMTP authentication
    $mail->Username = 'youremail';                 // SMTP username
    $mail->Password = 'yourpassword';                           // SMTP password
    $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
    $mail->Port = 587;                                    // TCP port to connect to

    $mail->setFrom('youremail', 'Tucker');
    $mail->addAddress('youremail');     // Add a recipient
    $mail->addReplyto($_POST['email']);

    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->phone = 'New Mail from Tucker';
    $mail->Body    = "<h3>Name: $fname".".<br></br>Email: ".$email.".<br></br>Phone: ".$phone.".<br></br>Message: ".$msg.".</h3>";
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';
    
    header('Location: index.html');
    if($mail->send()) {
        header('Location: index.html');
        exit();
    } else {
        header('Location: index.html');
        exit();
    }
}
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>