<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "sistemaduanmdj";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Gagal sambung: " . $conn->connect_error);
}
