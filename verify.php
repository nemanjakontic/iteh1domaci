<?php
    $conn=mysqli_connect("localhost", "root", "", "email_verification");
    if(!$conn){

        die("Greska! Nije moguce povezivanje na bazu! ".mysqli_connect_error());
    }
    else{
        if(isset($_GET['email']) && isset($_GET['code'])){//da bismo potvrdili da je u linku preko kog se verifikuje postavljen email i kod

            $email=$_GET['email'];
            $code=$_GET['code'];

            $sql="SELECT * FROM users WHERE email='$email' AND code='$code'";
            $result=mysqli_query($conn,$sql);
            $row=mysqli_fetch_array($result);

            $v_name=$row['name'];
            $v_email=$row['email'];
            $v_pass=$row['pass'];
            $v_code=$row['code'];

            if($code==$v_code){

                $query="INSERT INTO verified_users(v_name,v_email,v_pass)VALUES('$v_name','$v_email','$v_pass')";
                mysqli_query($conn, "DELETE FROM USERS WHERE email='$email' AND code='$code'");
                if(mysqli_query($conn,$query)){

                    header("location:profile.php");

                }else{
                    echo 'Something went wrong';
                }
            }else{
                echo 'Code does not exist in the table users';
            }
        }
    }
?>