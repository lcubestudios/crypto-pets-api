<?php

require('config.php');
$user_table = "crypto_pets_user";
$output = array();

switch ($method) {
    case 'GET':
        $query = "SELECT * FROM {$user_table}";
        $result = pg_query($conn, $query);
        $row = pg_fetch_assoc($result);
        $output = $row;
        break;
    case 'POST':
        $raw=file_get_contents('php://input');
        $data=json_decode($raw,true);
        $public_address = $data['public_address'];
        $crypto_dns = $data['crypto_dns'];
        $privacy_mode = $data['privacy_mode'];
        $user_email = $data['email'];
        $user_phone_number = $data['phone_number'];
        $user_country_of_residence = $data['country_of_residence'];
        $user_full_name = $data['full_name'];
        
        $query = "INSERT INTO (public_address,crypto_dns,privacy_mode,user_email,user_phone_number,user_country_of_residence,user_full_name)  VALUES ({$public_address},{$crypto_dns},{$privacy_mode},{$user_email},{$user_phone_number},{$user_full_name})";
        echo $query;
        // $output = array(
        //     'status_code' => 200,
        //     'message' => 'User has been created.',
        // );
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