<?php
session_start();
session_destroy();
?>
<!DOCTYPE html>
<html lang="ms">
<head>
  <meta charset="UTF-8">
  <title>Log Keluar - Sistem Aduan MDJ</title>
  <style>
    body {
      margin: 0;
      padding: 0;
      background: #f9f9e8;
      font-family: 'Segoe UI', Tahoma, sans-serif;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .card {
      background: #ffffff;
      padding: 40px 30px;
      border-radius: 12px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
      text-align: center;
      max-width: 400px;
    }

    .card h1 {
      font-size: 24px;
      color: #2e7d32;
      margin-bottom: 10px;
    }

    .card p {
      font-size: 16px;
      color: #555;
    }

    .footer {
      margin-top: 20px;
      font-size: 12px;
      color: #999;
    }
  </style>
</head>
<body>
  <div class="card">
    <h1>Anda telah log keluar</h1>
    <p>Terima kasih kerana menggunakan Sistem Aduan Majlis Daerah Jerantut.</p>
    <div class="footer">Mengalihkan anda ke halaman log masuk...</div>
  </div>

  <script>
    setTimeout(function() {
      window.location.href = "AdminLogin.html";
    }, 1000); // 1 saat
  </script>
</body>
</html>
