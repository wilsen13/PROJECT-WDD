<?php
$host     = "localhost";   
$user     = "root";        
$password = "";            
$dbname   = "donation_web";   

$mysqli = new mysqli($host, $user, $password, $dbname);

// cek koneksi
if ($mysqli->connect_errno) {
    die("Koneksi gagal: " . $mysqli->connect_error);
}
?>