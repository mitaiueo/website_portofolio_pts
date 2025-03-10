<?php
// Periksa apakah form telah di-submit
if (isset($_POST['submit'])) {
    // Tangkap data dari form
    $name    = $_POST['Name'];
    $email   = $_POST['Email'];
    $message = $_POST['Message'];

    // Konfigurasi koneksi database
    $servername = "localhost";
    $username   = "root";
    $password   = "";
    $dbname     = "database_webporto"; 

    $conn = new mysqli("localhost", "root", "", "database_webporto");



    // Cek koneksi
    if ($conn->connect_error) {
        die("Koneksi gagal: " . $conn->connect_error);
    }

    // Siapkan query INSERT menggunakan prepared statement agar aman dari SQL Injection
    $sql = "INSERT INTO contact (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $name, $email, $message);

    // Eksekusi query dan cek apakah berhasil
    if ($stmt->execute()) {
        echo "Data berhasil disimpan ke database. Terima kasih!";
    } else {
        echo "Terjadi kesalahan: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
} else {
    echo "Akses tidak valid.";
}
?>