<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   if(isset($_GET['ders_id'])&&isset($_GET['barkod'])){
        $barkod = $_GET['barkod'];
        $ders_id = $_GET['ders_id'];
        $db = mysqli_connect($host,$username,$password,$db_name);

        $result = mysqli_query($db, "UPDATE dersler SET barkod =  '$barkod', yoklama_aktif='1' WHERE id = '$ders_id'");
    



        print(json_encode(array(
            'success' => true,
            'message' => 'barkod olusturuldu'
        )));
        mysqli_close($db);
    }
    else{
        print(json_encode(array(
            'success' => false,
            'message' => 'bir hata gerceklesti'
        )));
    }
    
?>