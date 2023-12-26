

<?php

include('../koneksi.php');

$email = $_POST['email'];
$password = $_POST['password'];

// Gunakan parameterized query untuk menghindari SQL injection
$sql = "SELECT id, username, email, password FROM user WHERE email = ? AND password = ?";

// Persiapkan statement SQL
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $email, $password);

// Eksekusi statement
$stmt->execute();

// Bind result variables
$stmt->bind_result($id, $username, $emailResult, $hashedPassword);

// Fetch value
$stmt->fetch();

if ($id) {
    // Login berhasil
    http_response_code(200);
    echo json_encode([
        'statusCode' => 200,
        'message' => 'Login Berhasil',
        'data' => [
            'id' => $id,
            'email' => $emailResult,
            'username' => $username,
            'password' => $hashedPassword,  // Harap dicatat bahwa ini seharusnya tidak mengembalikan password sebenarnya ke klien, ini hanya untuk keperluan demonstrasi.
        ],
    ]);
} else {
    // Login gagal
    http_response_code(401);
    echo json_encode([
        'statusCode' => 401,
        'message' => 'Login Gagal',
    ]);
}

// Tutup statement
$stmt->close();
// Tutup koneksi
$conn->close();

