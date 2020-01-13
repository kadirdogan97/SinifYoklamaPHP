<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   $db = mysqli_connect($host,$username,$password,$db_name);
   if(isset($_GET['ogr_gorevli_id'])){
    $ogr_gorevli_id = $_GET['ogr_gorevli_id'];
     
    $result = mysqli_query($db, "SELECT dersler.id, ogr_gorevli.ad_soyad as ogr_gorevli_ad_soyad, ogr_gorevli.mail as ogr_gorevli_mail, dersler.ders_adi, dersler.ders_gunu, dersler.baslangic_saati, dersler.yoklama_aktif, dersler.bitis_saati, dersler.barkod FROM ogr_gorevli INNER JOIN dersler ON dersler.ogr_gorevli_id = ogr_gorevli.id WHERE ogr_gorevli_id ='$ogr_gorevli_id'");
        $array = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($array,$row);
        }
        print(json_encode(array(
            'success' => true,
            'dersler' => $array
        )));
    }
    else{
        print(json_encode(array(
            'success' => false
        )));
    }
   mysqli_close($db);
?>

