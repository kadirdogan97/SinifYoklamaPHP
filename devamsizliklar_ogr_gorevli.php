<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   if(isset($_GET['ders_id'])){

        $ders_id = $_GET['ders_id'];

        $db = mysqli_connect($host,$username,$password,$db_name);

        $result = mysqli_query($db, "SELECT ogrenciler.ogr_no, ogrenciler.ad_soyad as ogr_ad_soyad, Count(*) AS devamsizlik FROM yoklama_log INNER JOIN ogrenciler ON yoklama_log.ogr_id = ogrenciler.id WHERE yoklama_log.devamsizlik = '0' AND yoklama_log.ders_id=$ders_id GROUP BY yoklama_log.ogr_id");

        $array = array();

        while($row = mysqli_fetch_assoc($result)){
            array_push($array,$row);
        }

        print(json_encode(array(
            'success' => true,
            'devamsizliklar' => $array
        )));

        mysqli_close($db);
    }
    else{
        print(json_encode(array(
            'success' => false,
            'devamsizliklar' => null)));
    }
    
    
?>