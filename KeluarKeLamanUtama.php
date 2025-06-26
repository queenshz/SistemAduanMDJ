<?php
session_start();
session_destroy(); // log out user
echo "<script>
  alert('Anda telah kembali ke laman utama.');
  window.location.href = 'index.html'; // redirect ke laman utama
</script>";
exit;
?>
