<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    
        require 'includes/PHPMailer.php';
        require 'includes/SMTP.php';
        require 'includes/Exception.php';

        use PHPMailer\PHPMailer\PHPMailer;
        use PHPMailer\PHPMailer\SMTP;
        use PHPMailer\PHPMailer\Exception;

        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = "smtp.gmail.com";
        $mail->SMTPDebug = 0;
        $mail->SMTPAuth = "true";
        $mail->SMTPSecure = "tls";
        $mail->SMTPAutoTLS = false;
        $mail->Port = "587";
        $mail->Username = "hudayar.venue@gmail.com";
        $mail->Password = "htexdwfndkwvwpal";
        $mail->Subject = "Test";
        $mail->setFrom("venue@support.com");
        $mail->isHTML(true);
        $mail->Body = '<h1 style="color: lightgree;">I am very happy/h1>';
        $mail->addAddress("tash.hudayar@gmail.com");
        $mail->Send()

    ?>
</body>
</html>