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
        $resultOgr = mysqli_query($db, "SELECT * FROM ogrenciler");
        $ogrSayi = mysqli_num_rows($resultOgr);
        
        $result = mysqli_query($db, "SELECT tarih FROM yoklama_log WHERE ders_id='$ders_id' AND tarih='$tarih'");
        if($row = mysqli_fetch_assoc($result)){
            //varsa ogrencileri toplu ekleme islemi yaptırmıyoruz.       
        }
        else{
            for ($i = 1; $i <= $ogrSayi; $i++) {
                $result = mysqli_query($db, "INSERT INTO yoklama_log (ders_id,ogr_id,giris_saati,tarih,devamsizlik) VALUES('$ders_id','$i','-','$tarih','0')");
            }
        }
        $result = mysqli_query($db, "UPDATE yoklama_log SET devamsizlik='1',giris_saati='$giris_saati' WHERE ders_id = '$ders_id' AND ogr_id = '$ogr_id' AND tarih='$tarih'");


        
        print(json_encode(array(
            'success' => true,
            'message' => 'yoklama gerceklestirildi'
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