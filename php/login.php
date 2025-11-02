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

            // redirect to homepage after successful login
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