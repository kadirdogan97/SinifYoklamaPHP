<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   if(isset($_GET['ogr_id'])&&isset($_GET['ders_id'])){
        $ogr_id = $_GET['ogr_id'];
        $ders_id = $_GET['ders_id'];
        $tarih = date("d/m/Y");
        $giris_saati = gmdate("h:i", time()+("3" * 3600));
        $db = mysqli_connect($host,$username,$password,$db_name);

        $result = mysqli_query($db, "SELECT distinct count(id) as devamsizlik FROM yoklama_log WHERE ders_id='$ders_id' AND ogr_id='$ogr_id' AND devamsizlik=0");
        $devamsizlik_sayi="";
        $array = array();
        if($row = mysqli_fetch_assoc($result)){
            $devamsizlik_sayi = $row['devamsizlik'];
        }

        $result = mysqli_query($db, "SELECT barkod,yoklama_aktif FROM dersler WHERE id = '$ders_id'");
        $barkod="";
        $yoklama_aktif="";
        if($row = mysqli_fetch_assoc($result)){
            $barkod = $row['barkod'];
            $yoklama_aktif = $row['yoklama_aktif'];
        }
        $result = mysqli_query($db, "SELECT yoklama_log.id, ogrenciler.ogr_no, ogrenciler.ad_soyad as ogr_ad_soyad, dersler.ders_adi, yoklama_log.tarih as yoklama_tarih, yoklama_log.devamsizlik FROM yoklama_log INNER JOIN ogrenciler ON yoklama_log.ogr_id = ogrenciler.id INNER JOIN dersler ON yoklama_log.ders_id = dersler.id WHERE yoklama_log.ogr_id = '$ogr_id' AND yoklama_log.ders_id = '$ders_id' ORDER BY yoklama_log.tarih DESC");

        $array = array();
        while($row = mysqli_fetch_assoc($result)){
            array_push($array,$row);
        }
        print(json_encode(array(
            'success' => true,
            'barkod' => $barkod,
            'aktif' => $yoklama_aktif,
            'devamsizlik_sayi' => $devamsizlik_sayi,
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