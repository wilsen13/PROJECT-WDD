<?php 
session_start();
session_unset();
session_destroy();

// buat hapus cookie
//setcookie("user_display_name", "", time() - 3600, "/");

// kembali ke index
//header("Location: ../index.php");
//exit;
?>


?>