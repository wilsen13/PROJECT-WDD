<?php 
    try {
        $conn = new PDO ("mysql:host=localhost;dbname=donation_web", "root", "");
        if(isset($_POST['submit'])) {
            $full_name = $_POST ['full_name'];
            $email= $_POST ['email'];
            $no_telp= $_POST ['no_telp'];
            $password = md5($_POST['password']);
            $registration_date = date("Y-m-d");

            $query = "INSERT INTO users (full_name, email, no_telp, password, registration_date) VALUES (?,?,?,?,?)";

            $result = $conn->prepare($query);
            $result-> execute([$full_name, $email, $no_telp, $password, $registration_date]);

            header('Location:../login.html?register=success');
            exit();
        }
    }

    catch(Exception $e) {
        if($e->getCode() ==23000) {
        echo "<script>alert('The email of  \"{$email}\" already exist. Please use a different email addres.'); </script> ";
        } else {
        $errorstring ="<p class ='text-center cols sm-8' style='color:red'>";
        $errorstring ="System error <br />  You Could not be registered due";
        $errorstring ="to a system error. We apologize  for any incovenience. </p>"; 
        $errorstring ="<p class ='text-center cols sm-8' style='color:red'>";
        //echo "<p class ='text-center col-sm-2' style='color:red'> $errorstring</p>";
        header('refresh:2, url=../login.html');
        exit();
        }
    }

?>