<?php
include('connect.php');

// Pastikan bahwa semua parameter diterima dengan benar
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    
    // Mengambil waktu saat ini sebagai timestamp
    $time = date('Y-m-d H:i:s');

    // Query INSERT data ke tabel 'data' dengan menggunakan prepared statement
    $query = "INSERT INTO `data` (`time`, `qty`) VALUES (?, 1)";
    
    $stmt = $connect->prepare($query);
    $stmt->bind_param("s", $time);

    if ($stmt->execute()) {
        echo json_encode(array('status' => 'success', 'message' => 'Data berhasil ditambahkan'));
    } else {
        echo json_encode(array('status' => 'error', 'message' => 'Gagal menambahkan data: ' . $stmt->error));
    }

    // Tutup statement
    $stmt->close();
} else {
    echo json_encode(array('status' => 'error', 'message' => 'Parameter tidak lengkap atau metode HTTP tidak valid'));
}

// Menutup koneksi
$connect->close();
?>
