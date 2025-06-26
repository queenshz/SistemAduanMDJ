<?php
session_start();
$koneksi = new mysqli("localhost", "root", "", "sistemaduanmdj");

$admin_id = $_POST['admin_id'];
$password = $_POST['password'];

$query = $koneksi->prepare("SELECT * FROM admin WHERE admin_id = ?");
$query->bind_param("s", $admin_id);
$query->execute();
$result = $query->get_result();

function showMessage($tajuk, $mesej) {
  echo "
  <!DOCTYPE html>
  <html lang='ms'>
  <head>
    <meta charset='UTF-8'>
    <title>$tajuk</title>
    <style>
      body {
        margin: 0;
        padding: 0;
        background: linear-gradient(to right, #a3dfa3, #033103);
        font-family: 'Segoe UI', Tahoma, sans-serif;
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
        color: #c62828;
        margin-bottom: 15px;
      }

      .card p {
        font-size: 16px;
        color: #555;
        margin-bottom: 25px;
      }

      .btn {
        padding: 10px 20px;
        background-color: #2e7d32;
        color: white;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        cursor: pointer;
        transition: background-color 0.3s ease;
      }

      .btn:hover {
        background-color: #256429;
      }

      @keyframes fadeIn {
        from { opacity: 0; transform: translateY(30px); }
        to { opacity: 1; transform: translateY(0); }
      }
    </style>
  </head>
  <body>
    <div class='card'>
      <h1>$tajuk</h1>
      <p>$mesej</p>
      <button class='btn' onclick=\"window.location.href='AdminLogin.html'\">OK</button>
    </div>
  </body>
  </html>
  ";
}

if ($result->num_rows === 1) {
    $row = $result->fetch_assoc();

    if (password_verify($password, $row['password'])) {
        $_SESSION['admin_id'] = $row['admin_id'];
        header("Location: dd.php");
        exit;
    } else {
        showMessage("Kata Laluan Salah", "Sila pastikan kata laluan yang dimasukkan adalah betul.");
    }
} else {
    showMessage("ID Admin Tidak Dijumpai", "ID yang dimasukkan tidak wujud dalam sistem.");
}
?>
