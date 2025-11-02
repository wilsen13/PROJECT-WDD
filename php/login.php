<?php
session_start();

if(isset($_POST['submit'])){
    $email = $_POST['email'];
    $password = $_POST['password'];

    $conn = new PDO("mysql:host=localhost;dbname=donation_web", "root", "");

    $query = "SELECT * FROM users WHERE email = ?";
    $result = $conn->prepare($query);
    $result->execute([$email]);

    if($row = $result->fetch()){
        if(md5($password) == $row['password']){
            $_SESSION['email'] = $row['email'];
            $_SESSION['full_name'] = $row['full_name'];

            $user_fullname = $user['full_name'];
            $end_time = time() + (86400 * 30); //30 hari 

            setcookie("user_full_name", $user_fullname, $end_time, "/");

            // kembali ke homepage kalau login berhasil
            header('Location: ../index.html');
            exit();
        } else {
            // invalid password
            session_unset();
            session_destroy();
            header('Location: ../login.html?login=failed');
            exit();
        }
    } else {
        // user not found
        session_unset();
        session_destroy();
        header('Location: ../login.html?login=notfound');
        exit();
    }
}
?>