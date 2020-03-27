<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
 
// Load Composer's autoloader
require 'phpMailer/Exception.php';
require 'phpMailer/PHPMailer.php';
require 'phpMailer/SMTP.php';
 
// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer\PHPMailer\PHPMailer();
 
try {
    //Server settings
    $mail->SMTPDebug = 0;                      // Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host = 'smtp.mail.ru';                    // Set the SMTP server to send through
    $mail->SMTPAuth = true;                                   // Enable SMTP authentication
    $mail->Username = 'repair-design@list.ru';                     // SMTP username
    $mail->Password = 'cerfce123';                               // SMTP password
    $mail->SMTPSecure = 'ssl';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port = 465;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
 
    //Recipients
    $mail->setFrom('repair-design@list.ru', 'Шамиль');
    $mail->addAddress('honda643@yandex.ru');     // Add a recipient
 
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Это новая заявка с сайта';
 
    $message = '';
    if (isset($_POST['userName'])) {
        $message .= "Имя пользователя: " . $_POST['userName'];
    }
    if (isset($_POST['userEmail'])) {
        $message .= ", телефон: " . $_POST['userEmail'];
    }
    if (isset($_POST['userPhone'])) {
        $message .= ", email: " . $_POST['userPhone'];
    }
    if (isset($_POST['userQuestion'])) {
        $message .= ", вопрос: " . $_POST['userQuestion'];
    }
    $mail->Body = $message;
    if ($mail->send()) {
        echo "ok";
    } else {
        echo "Письмо не отправлено, есть ошибка. Код ошибки: {$mail->ErrorInfo}";
    }
    
} catch (Exception $e) {
    echo "Письмо не отправлено, есть ошибка. Код ошибки: {$mail->ErrorInfo}";
}