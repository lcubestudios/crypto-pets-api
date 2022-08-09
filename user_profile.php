<?php

require('config.php');
$user_table = "crypto_pets_user";
$output = array();

switch ($method) {
    case 'POST': // Register User

        $raw=file_get_contents('php://input');
        $data=json_decode($raw,true);
        $public_address = $_GET['public_address'];
        // Load values
        $crypto_dns = $data['crypto_dns'];
        $privacy_mode = $data['privacy_mode'];
        $user_email = $data['email'];
        $user_phone_number = $data['phone_number'];
        $user_country_of_residence = $data['country_of_residence'];
        $user_full_name = $data['full_name'];
        // Check if User Exist
        $check_query = "SELECT id FROM {$user_table} WHERE public_address = '{$public_address}'";
        $result = pg_query($conn,$check_query);
        $row = pg_fetch_row($result);
       
        if($row == 0){
            // Register User
            $register_query = "INSERT INTO {$user_table} (public_address, crypto_dns, privacy_mode, email, phone_number, country_of_residence, full_name) VALUES ('{$public_address}','{$crypto_dns}','{$privacy_mode}','{$user_email}','{$user_phone_number}','{$user_country_of_residence}', '{$user_full_name}')";
            pg_query($conn,$register_query);
            $output = array(
                'status_code' => 200,
                'message' => 'Success, user has been created.',
            );
            
        }else{
            $output = array(
                'status_code' => 300,
                'message' => 'User already exist. Please log in.'
            );
        }
    break;
    case 'PUT': // update user profile
        $raw=file_get_contents('php://input');
        $data=json_decode($raw,true);
        // Load values
        $public_address = $_GET['public_address'];
        
        if($public_address){           

            $crypto_dns = $data['crypto_dns'];
            $privacy_mode = $data['privacy_mode'];
            $user_email = $data['email'];
            $user_phone_number = $data['phone_number'];
            $user_country_of_residence = $data['country_of_residence'];
            $user_full_name = $data['full_name'];
            $pet_ens = $data['pet_ens'];
            
            // Check Pet ENS 
            // $check_query = "SELECT pet_ens FROM {$user_table} WHERE public_address = '{$public_address}'";
            // $result = pg_query($conn,$check_query);
            // $row = pg_fetch_row($result);
           
            // Update Profile
           $update_query = "UPDATE {$user_table} SET crypto_dns = '{$crypto_dns}', privacy_mode = '{$privacy_mode}', email = '${user_email}', phone_number = '{$user_phone_number}', country_of_residence = '{$user_country_of_residence}', full_name = '{$user_full_name}', pet_ens = '{$pet_ens}' ";
           pg_query($conn,$update_query);
           
           $output = array(
               'status_code' => 200,
               'message' => 'Success, Profile has been updated.'
           );
        }
        
        break;
    default:
        $output = array(
            'status_code' => 500,
            'message' => 'Invalid Request or Missing Information.'
        );
        break;
}
echo json_encode($output);
pg_close($conn);