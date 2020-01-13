<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   $db = mysqli_connect($host,$username,$password,$db_name);
   if(isset($_GET['bolum_id'])){
    $bolumID = $_GET['bolum_id'];
     
    //$result = mysqli_query($db, "SELECT dersler.id, ogr_gorevli.ad_soyad as ogr_gorevli_ad_soyad, ogr_gorevli.mail as ogr_gorevli_mail, dersler.ders_adi, dersler.ders_gunu, dersler.baslangic_saati, dersler.yoklama_aktif, dersler.bitis_saati, dersler.barkod, dersler.devamsizlik_sinir FROM ogr_gorevli INNER JOIN dersler ON dersler.ogr_gorevli_id = ogr_gorevli.id WHERE bolum_id ='$bolumID' ORDER BY yoklama_aktif DESC");

    $querty="SELECT 
    dersler.id,
    ogr_gorevli.ad_soyad,
    ogr_gorevli.mail,
    dersler.ders_adi,
    dersler.ders_gunu,
    dersler.baslangic_saati,
    dersler.bitis_saati,
    dersler.yoklama_aktif,
    dersler.barkod,
    dersler.devamsizlik_sinir
    FROM
    ogr_ders
    INNER JOIN dersler ON ogr_ders.ders_id = dersler.id
    INNER JOIN ogr_gorevli ON dersler.ogr_gorevli_id = ogr_gorevli.id
    WHERE ogr_ders.ogr_id = $bolumID";
    $result = mysqli_query($db, $querty);


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
            'success' => false)));
    }
   mysqli_close($db);
   /*SELECT
yoklama_log.id,
ogrenciler.ad_soyad as ogr_ad_soyad,
dersler.ders_adi,
yoklama_log.tarih as yoklama_tarih
FROM
yoklama_log
INNER JOIN ogrenciler ON yoklama_log.ogr_id = ogrenciler.id
INNER JOIN dersler ON yoklama_log.ders_id = dersler.id
WHERE
yoklama_log.devamsizlik = 0 AND
yoklama_log.ogr_id = 0 AND
yoklama_log.ders_id = 0
*/
?>

