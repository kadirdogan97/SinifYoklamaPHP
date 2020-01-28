<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   if(isset($_GET['ders_id'])){

        $ders_id = $_GET['ders_id'];

        $db = mysqli_connect($host,$username,$password,$db_name);
       $tarih = date("d/m/Y");


        $result = mysqli_query($db, "SELECT ogr_no, ad_soyad as ogr_ad_soyad, (SELECT COUNT(*) FROM yoklama_log as Y WHERE Y.ogr_id = O.id AND Y.ders_id=$ders_id AND Y.devamsizlik='0')as devamsizlik, (SELECT devamsizlik FROM yoklama_log as T WHERE T.ogr_id=O.id AND T.tarih = '$tarih') as devamsizlikSuan FROM ogrenciler as O ORDER BY devamsizlik DESC");
//        $result = mysqli_query($db, "SELECT ogrenciler.ogr_no, ogrenciler.ad_soyad as ogr_ad_soyad, Count(*) AS devamsizlik FROM yoklama_log INNER JOIN ogrenciler ON yoklama_log.ogr_id = ogrenciler.id WHERE yoklama_log.devamsizlik = '0' AND yoklama_log.ders_id=$ders_id GROUP BY yoklama_log.ogr_id");

        $array = array();

        while($row = mysqli_fetch_assoc($result)){
            array_push($array,$row);
        }

       $result = mysqli_query($db, "SELECT barkod,yoklama_aktif FROM dersler WHERE id = '$ders_id'");
       $barkod="";
       $yoklama_aktif="";
       if($row = mysqli_fetch_assoc($result)){
           $barkod = $row['barkod'];
           $yoklama_aktif = $row['yoklama_aktif'];
       }

        print(json_encode(array(
            'success' => true,
            'aktif' => $yoklama_aktif,
            'devamsizliklar' => $array
        )));

        mysqli_close($db);
    }
    else{
        print(json_encode(array(
            'success' => false,
            'aktif' => '0',
            'devamsizliklar' => null)));
    }
    
    
?>