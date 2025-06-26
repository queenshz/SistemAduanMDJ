<?php
$koneksi = new mysqli("localhost", "root", "", "sistemaduanmdj"); // tukar nama_database kamu

$admin1_id = 'admin1';
$admin1_password = password_hash('adminMDJ1@', PASSWORD_DEFAULT);

$admin2_id = 'admin2';
$admin2_password = password_hash('adminMDJ2@', PASSWORD_DEFAULT);

$sql1 = "INSERT INTO admin (admin_id, password) VALUES ('$admin1_id', '$admin1_password')";
$sql2 = "INSERT INTO admin (admin_id, password) VALUES ('$admin2_id', '$admin2_password')";

if ($koneksi->query($sql1) && $koneksi->query($sql2)) {
    echo "2 Admin berjaya dimasukkan.";
} else {
    echo "Ralat: " . $koneksi->error;
}
?>
