<?php

require('config.php');
$user_table = "crypto_pets_user"
$output = array();

switch ($method) {
    case 'GET':
        $query = "SELECT * FROM {$user_table}";
        $result = pg_query($conn, $query);
        $row = pg_fetch_assoc($result);
        $output = $row;
        break;
    default:
        $output = array(
            'status_code' => 500,
            'message' => 'Invalid Request or Missing Information.',
        );
        break;
}
echo json_encode($output);
pg_close($conn);