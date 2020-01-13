<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   if(isset($_GET['ders_id'])){
        $ders_id = $_GET['ders_id'];
        $db = mysqli_connect($host,$username,$password,$db_name);

        $result = mysqli_query($db, "UPDATE dersler SET yoklama_aktif='0' WHERE id = '$ders_id'");
    



        print(json_encode(array(
            'success' => true,
            'message' => 'yoklama kapatildi'
        )));
        mysqli_close($db);
    }
    else{
        print(json_encode(array(
            'success' => false,
            'message' => 'yoklama kapatilamadi'
        )));
    }
    
?>