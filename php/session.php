<?php
session_start();
if (!isset($_SESSION['donation_count'])) {
$_SESSION['donation_count'] = 0;
$_SESSION['total_donation'] = 0;
}
$donasi_baru = 50000;
$_SESSION['total_donation'] += $donasi_baru;
$_SESSION['donation_count']+1; 


if ($_SESSION['donation_count'] == 1) {
echo "<h3>Terima kasih sudah berdonasi untuk pertama kalinya!</h3>";
echo "<p>Kamu mendapatkan Tiket Umroh Gratis!</p>";
} else {
echo "<h3>Terima kasih atas donasi ke-" . $_SESSION['donation_count'] . " kamu!</h3>"; 
}

?>