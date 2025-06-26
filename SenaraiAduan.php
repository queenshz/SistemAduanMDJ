<?php 
// Hantar parameter ?dari=...&hingga=... ke fetchAduan.php
$aduan = include 'fetchAduan.php';
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Senarai Aduan - Admin</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f9f9e8;
      padding: 20px;
    }

    .container {
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 2px 5px rgba(217, 25, 25, 0.1);
    }

    h2 {
      color: black;
      text-align: center;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }

    table, th, td {
      border: 1px solid #ccc;
    }

    th {
      background-color: #c9f7c9;
      padding: 10px;
      text-align: center;
    }

    td {
      padding: 10px;
      text-align: center;
    }

    tr:nth-child(even) {
      background-color: #f2f2f2;
    }

    .filter-form {
      text-align: center;
      margin-bottom: 20px;
    }

    input[type="date"], button {
      padding: 5px 10px;
      margin: 0 5px;
    }

    .btn-submit {
      background-color: rgb(240, 3, 94);
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 50px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn-submit:hover {
      background-color: rgb(237, 163, 211);
    }

    /* Butang kembali di luar container */
    .btn-back-wrapper {
      text-align: right;
      margin-top: 30px;
      padding-right: 20px;
    }

    .btn-back {
      display: inline-block;
      padding: 8px 16px;
      background-color: #b22222;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
      transition: background-color 0.3s;
    }

    .btn-back:hover {
      background-color: rgb(244, 163, 163);
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Senarai Aduan Pengguna</h2>

    <!-- Form tapis tarikh -->
    <form method="GET" class="filter-form">
      Dari: <input type="date" name="dari" value="<?= isset($_GET['dari']) ? $_GET['dari'] : '' ?>">
      Hingga: <input type="date" name="hingga" value="<?= isset($_GET['hingga']) ? $_GET['hingga'] : '' ?>">
      <button type="submit" class="btn-submit">Cari</button>
    </form>

    <table>
      <thead>
        <tr>
          <th>Id Aduan</th>
          <th>Nama Penuh</th>
          <th>No Telefon</th>
          <th>Lokasi Kejadian</th>
          <th>Kategori Aduan</th>
          <th>Butiran Aduan</th>
          <th>Tarikh Aduan</th>
          <th>Status Aduan</th>
        </tr>
      </thead>
      <tbody>
        <?php if (count($aduan) > 0): ?>
          <?php foreach ($aduan as $row): ?>
            <tr>
              <td><?= str_pad($row['id_aduan'], 4, '0', STR_PAD_LEFT) ?></td>
              <td><?= htmlspecialchars($row['nama_penuh']) ?></td>
              <td><?= htmlspecialchars($row['noTelefon']) ?></td>
              <td><?= htmlspecialchars($row['lokasiKejadian']) ?></td>
              <td><?= htmlspecialchars($row['kategoriAduan']) ?></td>
              <td><?= htmlspecialchars($row['butiranAduan']) ?></td>
              <td><?= htmlspecialchars($row['tarikhAduan']) ?></td>
              <td><?= htmlspecialchars($row['statusAduan']) ?></td>
            </tr>
          <?php endforeach; ?>
        <?php else: ?>
          <tr><td colspan="8">Tiada aduan direkodkan.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <!-- Butang kembali di luar kotak putih -->
  <div class="btn-back-wrapper">
    <a href="dd.php" class="btn-back">Kembali</a>
  </div>
</body>
</html>
