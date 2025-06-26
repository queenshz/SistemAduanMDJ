<?php
// Sambung ke database
$host = "localhost";
$user = "root";
$pass = "";
$db = "sistemaduanmdj";

// Simpan data dari borang
$nama = $_POST['nama'];
$telefon = $_POST['telefon'];
$lokasi = $_POST['lokasi'];
$kategori = $_POST['kategori'];
$butiran = $_POST['butiran'];
$status = "Baru";

// Sambung ke MySQL
$conn = new mysqli($host, $user, $pass, $db);

// Semak sambungan
if ($conn->connect_error) {
  die("Gagal sambung: " . $conn->connect_error);
}

// SQL insert
$sql = "INSERT INTO db_aduan (nama_penuh, noTelefon, lokasiKejadian, kategoriAduan, butiranAduan, statusAduan)
        VALUES ('$nama', '$telefon', '$lokasi', '$kategori', '$butiran', '$status')";
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Penghantaran Aduan</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      background: linear-gradient(to right, #a3dfa3, #033103);
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 15px;
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.2);
      text-align: center;
      max-width: 420px;
      animation: fadeIn 0.6s ease;
    }

    .card h1 {
      font-size: 24px;
      color: #2e7d32;
      margin-bottom: 15px;
    }

    .card p {
      font-size: 16px;
      color: #444;
      margin-bottom: 10px;
    }

    .footer {
      margin-top: 20px;
      font-size: 12px;
      color: #888;
    }

    @keyframes fadeIn {
      from { opacity: 0; transform: translateY(30px); }
      to { opacity: 1; transform: translateY(0); }
    }
  </style>
</head>
<body>
  <div class="card">
    <?php
    if ($conn->query($sql) === TRUE) {
      echo "<h1>Aduan Berjaya Dihantar</h1>";
      echo "<p>Terima kasih kerana mengemukakan aduan anda kepada pihak kami.</p>";
      echo "<div class='footer'>Anda akan dialihkan ke halaman utama sebentar lagi...</div>";
    } else {
      echo "<h1>Ralat Berlaku</h1>";
      echo "<p>" . $conn->error . "</p>";
      echo "<div class='footer'>Sila cuba semula atau hubungi pihak pentadbir sistem.</div>";
    }
    $conn->close();
    ?>
  </div>

  <script>
    setTimeout(function() {
      window.location.href = "index.html";
    }, 3000); // 3 saat
  </script>
</body>
</html>
