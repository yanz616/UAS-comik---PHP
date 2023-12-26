<?php
include('../koneksi.php');


$username = $_POST['username'];
$email = $_POST['email'];
$password = $_POST['password'];

if (!empty($username) && !empty($email) && !empty($password)) {
    $sqlCheck = "SELECT count(*) FROM user WHERE username = '$username'";
    $queryCheck = mysqli_query($conn, $sqlCheck);
    $resultCheck = mysqli_fetch_array($queryCheck);
    if ($resultCheck[0] == 0) {
        $sql = "INSERT INTO user ( username, email, password) VALUES ('$username', '$email', '$password')";
        $query = mysqli_query($conn, $sql);
        $data['status'] = 200;
        $data['result'][] = "Data berhasil ditambah";
        
    } else {
        $data['status'] = 400;
        $data['result'][] = "Data sudah ada";
    }
} else {
    $data['status'] = '400';
    $data['result'][] = "Data tidak boleh kosong";
}


print_r(json_encode($data));

