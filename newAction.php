<?php
    require 'PHPMailerAutoload.php';
    require 'credential.php';
    $conn=mysqli_connect("localhost", "root", "", "email_verification");
    if(!$conn){

        die("Greska! Neuspesno povezivanje! ".mysqli_connect_error());
    }
    else{
        $oldEmail=$_POST['email'];
        $newEmail=$_POST['newemail'];
        $password=md5($_POST['pass']);
       

        $sql1 = "SELECT v_name, v_email, v_pass FROM verified_users WHERE v_email='$oldEmail' AND v_pass='$password'";
        $result = $conn->query($sql1);

        if ($result->num_rows > 0) {
            
            while($row = $result->fetch_assoc()) {
                $confirmedName=$row["v_name"];
                $confirmedEmail=$row["v_email"];
        }
        } else {
            echo "Нема таквог е-маил-а<br>Покушајте поново.";
            return;
        }


        $sql2="UPDATE verified_users SET v_email='$newEmail' WHERE v_email='$confirmedEmail' AND v_pass='$password'";
        if(mysqli_query($conn,$sql2)){
            $mail=new PHPMailer;
            $mail->isSMTP();
            $mail->Host='smtp.gmail.com';
            $mail->SMTPAuth=true;
            $mail->Username=EMAIL;
            $mail->Password=PASS;
            $mail->SMTPSecure='tls';
            $mail->Port=587;
            $mail->setFrom(EMAIL,'ITEH Nemanja');
            $to=$newEmail;
            $mail->addAddress($newEmail);
            $mail->addReplyTo(EMAIL);
            $mail->isHTML(true);
            $mail->Subject='Uspesna izmena!';
            $body="Обавештавамо Вас да је ваш е-маил успешно промењен:<br>Име: ".$confirmedName."<br>Стари е-маил: ".$confirmedEmail."<br>Нови е-маил: ".$newEmail."";
            $mail->Body=$body;


            if(!$mail->send()){
                echo 'Е-маил не може бити послат!';
                echo 'Грешка:'.$mail->ErrorInfo;

            }else{
                echo 'Е-маил успешно ажуриран! Нови подаци су послати на нови е-маил!';
            }
        }else{
            echo 'Упит се није изршио!';
        }
    }
?>