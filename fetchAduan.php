<?php
include 'config.php';

$dari = isset($_GET['dari']) ? $_GET['dari'] : '';
$hingga = isset($_GET['hingga']) ? $_GET['hingga'] : '';

$aduan = [];

if ($dari && $hingga) {
    // tapis ikut julat tarikh
    $sql = "SELECT * FROM db_aduan WHERE tarikhAduan BETWEEN ? AND ? ORDER BY id_aduan DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $dari, $hingga);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    // kalau tak ada tapis tarikh
    $sql = "SELECT * FROM db_aduan ORDER BY id_aduan DESC";
    $result = $conn->query($sql);
}

if ($result && $result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $aduan[] = $row;
    }
}

$conn->close();

return $aduan;
