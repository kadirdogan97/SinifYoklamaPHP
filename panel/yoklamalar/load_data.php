<?php
//load_data.php
include('../vt.php');
$output = '';

if(isset($_POST["selected"])&&isset($_POST["ders_id"]))
{
    $tarih = $_POST["selected"];
    $ders_id = $_POST["ders_id"];
//    $ders_id=$_POST["ders_id"];
    $query = "SELECT yoklama_log.id, ogrenciler.ogr_no, ogrenciler.ad_soyad as ogr_ad_soyad, yoklama_log.devamsizlik FROM yoklama_log INNER JOIN ogrenciler ON yoklama_log.ogr_id = ogrenciler.id WHERE yoklama_log.ders_id = '$ders_id' AND yoklama_log.tarih='$tarih'";
    $result = $baglanti->query($query);
    $output .= '
        <table class="table">
        <tr>
            <th>ID</th>
            <th>Ogr No</th>
            <th>Ad Soyad</th>
            <th>Devamsızlık</th>
            <th></th>
        </tr>
    ';
    while($row = mysqli_fetch_array($result))
    {
        $devamsizlik="";
        if($row['devamsizlik']=="1") {
            $devamsizlik="GELDİ";
        }
        else if($row['devamsizlik']=="0") {
            $devamsizlik="GELMEDİ";
        }
        $output .= '
        <tr>
            <td>'.$row['id'].'</td>
            <td>'.$row['ogr_no'].'</td>
            <td>'.$row['ogr_ad_soyad'].'</td>
            <td>'.$devamsizlik.'</td>
            <td><a href="duzenle.php?id='.$row['id'].'" class="btn btn-primary">Düzenle</a></td>
        </tr>
        ';

    }
    $output.="</table>";
    echo $output;
}
?>