<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   $db = mysqli_connect($host,$username,$password,$db_name);
   if(isset($_GET['username'])&&isset($_GET['password'])){
   $uName = $_GET['username'];
   $pWord =  $_GET['password'];
    $result = mysqli_query($db, "SELECT * FROM ogrenciler WHERE ogr_no='$uName' && parola='$pWord'");
    if($row = mysqli_fetch_assoc($result)){
        print(json_encode(array(
            'success' => true,
            'message' => "Login Success",
            'user' => $row
        )));
        }
        else{
            print(json_encode(array(
                'success' => false,
                'message' => "Login Error")));
        }
    }
    else{
        print(json_encode(array(
            'success' => false,
            'message' => "Login Error")));
    }
   mysqli_close($db);
?>
