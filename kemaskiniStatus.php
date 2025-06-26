<?php
include 'config.php';

// Jika ada POST (kemaskini)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id_aduan'];
    $statusBaru = $_POST['status_baru'];

    $stmt = $conn->prepare("UPDATE db_aduan SET statusAduan = ? WHERE id_aduan = ?");
    $stmt->bind_param("si", $statusBaru, $id);
    if ($stmt->execute()) {
        echo "
        <!DOCTYPE html>
        <html lang='ms'>
        <head>
          <meta charset='UTF-8'>
          <title>Status Dikemaskini</title>
          <style>
            body {
              margin: 0;
              padding: 0;
              background-color: #f4f7dc;
              font-family: 'Segoe UI', Tahoma, sans-serif;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
            }
            .popup-card {
              background: white;
              padding: 40px;
              border-radius: 12px;
              box-shadow: 0 4px 20px rgba(0,0,0,0.2);
              text-align: center;
              max-width: 400px;
            }
            .popup-card h2 {
              color: #2e7d32;
              margin-bottom: 10px;
            }
            .popup-card p {
              color: #333;
              margin-bottom: 20px;
            }
            .btn-ok {
              padding: 10px 20px;
              background-color: #2e7d32;
              color: white;
              border: none;
              border-radius: 5px;
              cursor: pointer;
              font-weight: bold;
              transition: background-color 0.3s ease;
            }
            .btn-ok:hover {
              background-color: #256429;
            }
          </style>
        </head>
        <body>
          <div class='popup-card'>
            <h2>Berjaya!</h2>
            <p>Status aduan berjaya dikemaskini.</p>
            <button class='btn-ok' onclick=\"window.location.href='kemaskiniStatus.php'\">OK</button>
          </div>
        </body>
        </html>";
        exit();
    } else {
        echo "
        <!DOCTYPE html>
        <html lang='ms'>
        <head>
          <meta charset='UTF-8'>
          <title>Ralat</title>
          <style>
            body {
              margin: 0;
              padding: 0;
              background-color: #f4f7dc;
              font-family: 'Segoe UI', Tahoma, sans-serif;
              display: flex;
              justify-content: center;
              align-items: center;
              height: 100vh;
            }
            .popup-card {
              background: white;
              padding: 40px;
              border-radius: 12px;
              box-shadow: 0 4px 20px rgba(0,0,0,0.2);
              text-align: center;
              max-width: 400px;
            }
            .popup-card h2 {
              color: #c62828;
              margin-bottom: 10px;
            }
            .popup-card p {
              color: #333;
              margin-bottom: 20px;
            }
            .btn-ok {
              padding: 10px 20px;
              background-color: #c62828;
              color: white;
              border: none;
              border-radius: 5px;
              cursor: pointer;
              font-weight: bold;
              transition: background-color 0.3s ease;
            }
            .btn-ok:hover {
              background-color: #a41e1e;
            }
          </style>
        </head>
        <body>
          <div class='popup-card'>
            <h2>Ralat!</h2>
            <p>Gagal mengemaskini status. Sila cuba semula.</p>
            <button class='btn-ok' onclick=\"window.location.href='kemaskiniStatus.php'\">OK</button>
          </div>
        </body>
        </html>";
        exit();
    }
}

// Untuk paparan (GET)
$statusFilter = isset($_GET['status']) ? $_GET['status'] : '';

if ($statusFilter && in_array($statusFilter, ['Baru', 'Dalam Proses', 'Selesai'])) {
    $sql = "SELECT * FROM db_aduan WHERE statusAduan = ? ORDER BY id_aduan DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $statusFilter);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $sql = "SELECT * FROM db_aduan ORDER BY id_aduan DESC";
    $result = $conn->query($sql);
}
?>

<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Kemaskini Status Aduan</title>
  <style>
    body { font-family: Arial, sans-serif; background: #f4f7dc; }
    .container {
      width: 90%;
      margin: auto;
      margin-top: 30px;
      background: white;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.2);
    }
    table {
      width: 100%;
      border-collapse: collapse;
      margin-top: 20px;
    }
    th, td {
      padding: 10px;
      border: 1px solid #ccc;
    }
    th {
      background-color:#c9f7c9;
      color: #033103;
    }
    form {
      display: flex;
      gap: 10px;
      align-items: center;
    }
    select, button {
      padding: 5px 10px;
    }
    .filter-form {
      margin-bottom: 15px;
    }

    .btn-kemaskini {
      background-color: rgb(240, 3, 94);
      color: white;
      border: none;
      padding: 6px 12px;
      border-radius: 50px;
      cursor: pointer;
      font-weight: bold;
      transition: background-color 0.3s ease;
    }

    .btn-kemaskini:hover {
      background-color: rgb(237, 163, 211);
    }

    .back-button-container {
      width: 97%;
      padding: 20px 40px 0 0;
      text-align: right;
    }

    .btn-back {
      background-color: #b22222;
      color: white;
      padding: 8px 16px;
      border: none;
      border-radius: 10px;
      font-weight: bold;
      text-decoration: none;
      transition: background-color 0.3s ease;
    }

    .btn-back:hover {
      background-color: rgb(244, 163, 163);
    }
  </style>
</head>
<body>

  <div class="container">
    <h2>Kemaskini Status Aduan</h2>

    <form method="GET" class="filter-form">
      <label for="status">Tapis Status: </label>
      <select name="status" onchange="this.form.submit()">
        <option value="">-- Semua --</option>
        <option value="Baru" <?= $statusFilter == 'Baru' ? 'selected' : '' ?>>Baru</option>
        <option value="Dalam Proses" <?= $statusFilter == 'Dalam Proses' ? 'selected' : '' ?>>Dalam Proses</option>
        <option value="Selesai" <?= $statusFilter == 'Selesai' ? 'selected' : '' ?>>Selesai</option>
      </select>
    </form>

    <table>
      <thead>
        <tr>
          <th>ID Aduan</th>
          <th>Nama</th>
          <th>Kategori</th>
          <th>Status Semasa</th>
          <th>Kemaskini Status</th>
        </tr>
      </thead>
      <tbody>
        <?php if ($result && $result->num_rows > 0): ?>
          <?php while($row = $result->fetch_assoc()): ?>
            <tr>
              <td><?= str_pad($row['id_aduan'], 4, '0', STR_PAD_LEFT) ?></td>
              <td><?= htmlspecialchars($row['nama_penuh']) ?></td>
              <td><?= htmlspecialchars($row['kategoriAduan']) ?></td>
              <td><?= htmlspecialchars($row['statusAduan']) ?></td>
              <td>
                <form method="POST" action="kemaskiniStatus.php">
                  <input type="hidden" name="id_aduan" value="<?= $row['id_aduan'] ?>">
                  <select name="status_baru" required>
                    <option value="">--Pilih--</option>
                    <option value="Baru">Baru</option>
                    <option value="Dalam Proses">Dalam Proses</option>
                    <option value="Selesai">Selesai</option>
                  </select>
                  <button type="submit" class="btn-kemaskini">Kemaskini</button>
                </form>
              </td>
            </tr>
          <?php endwhile; ?>
        <?php else: ?>
          <tr><td colspan="5" style="text-align: center;">Tiada aduan direkodkan.</td></tr>
        <?php endif; ?>
      </tbody>
    </table>
  </div>

  <div class="back-button-container">
    <a href="dd.php" class="btn-back">Kembali</a>
  </div>

</body>
</html>
