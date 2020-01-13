<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   if(isset($_GET['ogr_id'])&&isset($_GET['ag_adres'])){
        $ag_adres = $_GET['ag_adres'];
        $ogr_id = $_GET['ogr_id'];
        $db = mysqli_connect($host,$username,$password,$db_name);

        $result = mysqli_query($db, "UPDATE ogrenciler SET ag_adresi =  '$ag_adres' WHERE id = '$ogr_id'");


        print(json_encode(array(
            'success' => true,
            'message' => 'cihaz tanimlandi'
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