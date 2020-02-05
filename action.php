<?php
    require 'PHPMailerAutoload.php';
    require 'credential.php';
    $conn=mysqli_connect("localhost", "root", "", "email_verification");
    if(!$conn){
        die("Грешка у конекцији! ".mysqli_connect_error());
    }
    else{
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=md5($_POST['pass']);
        $code=substr(md5(mt_rand()), 0,15);

        $sql="INSERT INTO users(name, email, pass, code) VALUES ('$name','$email','$password','$code')";
        if(mysqli_query($conn,$sql)){
            $mail=new PHPMailer;
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username=EMAIL;
            $mail->Password=PASS;
            $mail->SMTPSecure='tls';
            $mail->Port=587;
            $mail->setFrom(EMAIL,'ITEH Nemanja Kontic');
            $to=$email;
            $mail->addAddress($email);
            $mail->addReplyTo(EMAIL);
            $mail->isHTML(true);
            $mail->Subject='Aktivacioni link. Kliknite da verifikujete!';
            $body="<h3> Ваш активациони код је: ".$code."<br>Кликните на линк испод како бисте верификовали ваш налог:<br> <a href='http://localhost/E-mail-verification/verify.php?email=".$email."&code=".$code."'>http://localhost/E-mail-verification/verify.php?email=".$email."&code=".$code."</a></h3>";
            $mail->Body=$body;


            if(!$mail->send()){
                echo 'Грешка!Е-маил не може бити послат!';
                echo 'Mailer Error:'.$mail->ErrorInfo;

            }else{
                echo 'Активациони линк је послат на Вашу е-маил адресу. Проверите инбокс!';
            }
        }
    }
?>