<?php
// Tunjukkan semua error semasa debug
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Sambung ke database
$conn = mysqli_connect("localhost", "root", "", "sistemaduanmdj");

// Elak crash kalau sambungan gagal
if (!$conn) {
  die("Gagal sambung ke pangkalan data: " . mysqli_connect_error());
}

// Query statistik
$result1 = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM db_aduan");
$total = mysqli_fetch_assoc($result1)['jumlah'];

$result2 = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM db_aduan WHERE statusAduan='Baru'");
$baru = mysqli_fetch_assoc($result2)['jumlah'];

$result3 = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM db_aduan WHERE statusAduan='Dalam Proses'");
$proses = mysqli_fetch_assoc($result3)['jumlah'];

$result4 = mysqli_query($conn, "SELECT COUNT(*) AS jumlah FROM db_aduan WHERE statusAduan='Selesai'");
$selesai = mysqli_fetch_assoc($result4)['jumlah'];
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Dashboard - Sistem Aduan</title>
  <style>
    * {
      box-sizing: border-box;
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      display: flex;
      height: 100vh;
      background: linear-gradient(to right, #a3dfa3, #033103);
    }

    .sidebar {
      width: 220px;
      background: linear-gradient(to right, #a3dfa3, #033103);
      color: white;
      display: flex;
      flex-direction: column;
      padding: 20px 15px;
    }

    .sidebar .logo {
      display: flex;
      align-items: center;
      margin-bottom: 40px;
      padding-bottom: 15px;
      border-bottom: 2px solid #ffffff88;
    }

    .sidebar .logo span {
      font-size: 16px;
      font-weight: bold;
    }

    .sidebar a {
      text-decoration: none;
      color: white;
      padding: 10px 5px;
      margin: 5px 0;
      border-radius: 5px;
      transition: background-color 0.3s;
    }

    .sidebar a:hover {
      background-color: #bce3aa;
      color: #033103;
    }

    .logout-button {
      margin-top: auto;
      background-color: #b22222;
      color: white;
      border: none;
      padding: 10px;
      border-radius: 8px;
      cursor: pointer;
      font-weight: bold;
    }

    .logout-button:hover {
      background-color: #e53935;
    }

    .main-content {
      flex: 1;
      background-color: #f4f7dc;
      overflow-y: auto;
      display: flex;
      justify-content: center;
      align-items: center;
      padding: 40px;
    }

    .main-wrapper {
      text-align: center;
      max-width: 900px;
      width: 100%;
    }

    .welcome-section h2 {
      font-size: 40px;
      color: #033103;
      margin-top: -10px;
      margin-bottom: 25px;
    }

    .logo-wrapper {
      background-color: #ffffff; /* Tukar sini untuk warna background logo */
      padding: 5px;
      border-radius: 10px;
      display: inline-block;
      box-shadow: 0 4px 10px rgba(0,0,0,0.1);
      margin-bottom: 5px;
    }

    .welcome-section img {
      width: 120px;
      height: auto;
      display: block;
    }

    .welcome-section p {
      font-style: italic;
      color: #33691e;
      margin-top: 10px;
    }

    .stat-title {
      margin-top: 30px;
      font-size: 15px;
      color: #333;
    }

    .grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
      gap: 20px;
      margin-top: 20px;
    }

    .card {
      background: linear-gradient(to bottom right,  #dff0bf, #b7d88c);
      padding: 6px;
      border-radius: 12px;
      box-shadow: 0 6px 14px rgba(0,0,0,0.1);
      border: 1px solid #f4f7dc
      transition: 0.3s ease;
      text-align: center;
    }

    .card:hover {
      transform: translateY(-4px);
      box-shadow: 0 12px 18px rgba(0,0,0,0.12);
    }

    .card h3 {
      font-size: 16px;
      margin: 0 0 8px;
      color: rgb(8, 12, 6);
    }

    .card .number {
      font-size: 36px;
      font-weight: bold;
      color: rgb(8, 12, 6);
    }

    .tajuk-dashboard{
      font-family: 'Times New Roman', Times, serif;
    }
  </style>
</head>
<body>

  <div class="sidebar">
    <div class="logo">
      <span>MD Jerantut</span>
    </div>
    <a href="dd.php">Dashboard</a>
    <a href="SenaraiAduan.php">Senarai Aduan</a>
    <a href="KemaskiniStatus.php">Kemaskini Status</a>
    <button class="logout-button" onclick="window.location.href='logOut.php'">Log Keluar</button>
  </div>

  <div class="main-content">
    <div class="main-wrapper">
      <div class="welcome-section">
        <h2 class="tajuk-dashboard">Portal Pengurusan Aduan MDJ</h2>

        <div class="logo-wrapper">
          <img src="logoMDJ1.png" alt="Gambar MDJ">
        </div>

        <p>"Cepat, Mesra, Telus"</p>
      </div>

      <p class="stat-title">Statistik Aduan Semasa:</p>

      <div class="grid">
        <div class="card">
          <h3>Jumlah Aduan</h3>
          <div class="number"><?= $total ?></div>
        </div>
        <div class="card">
          <h3>Aduan Baru</h3>
          <div class="number"><?= $baru ?></div>
        </div>
        <div class="card">
          <h3>Dalam Proses</h3>
          <div class="number"><?= $proses ?></div>
        </div>
        <div class="card">
          <h3>Selesai</h3>
          <div class="number"><?= $selesai ?></div>
        </div>
      </div>
    </div>
  </div>

</body>
</html>
