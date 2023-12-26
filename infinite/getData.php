<?php

include('../koneksi.php');

// Initialize the response array
$response = array();

$sql = "SELECT * FROM infinite_chap1";
$query = mysqli_query($conn, $sql);

if (!$query) {
    // Check for query execution errors
    $response['status'] = '500';
    $response['message'] = 'Database Error: ' . mysqli_error($conn);
} else {
    if (mysqli_num_rows($query) > 0) {
        $data = array();

        while ($row = mysqli_fetch_assoc($query)) {
            $data[] = $row;
        }

        $response['status'] = '200';
        $response['data'] = $data;
    } else {
        $response['status'] = '404';
        $response['message'] = 'Data Not Found';
    }
}

// Return the response as JSON
header('Content-Type: application/json');
echo json_encode($response);