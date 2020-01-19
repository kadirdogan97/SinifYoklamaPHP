<?php
    include ("panel/vt.php");

    $tarih = date("d/m/Y");
    if(isset($_GET['ders_id'])){
        $ders_id = $_GET['ders_id'];

        $result = $baglanti->query( "SELECT * FROM dersler WHERE id='$ders_id' AND yoklama_aktif='1'");
        $resultCount = $baglanti->query( "SELECT count(*) as cnt FROM yoklama_log WHERE yoklama_log.ders_id = '$ders_id' AND yoklama_log.tarih='$tarih' AND devamsizlik='1'");
        $resultCount2 = $baglanti->query( "SELECT count(*) as cnt FROM yoklama_log WHERE yoklama_log.ders_id = '$ders_id' AND yoklama_log.tarih='$tarih'");

        $barkod="test";
        if($row = $result->fetch_assoc()){
            $barkod = $row['barkod'];
            $image = 'https://chart.googleapis.com/chart?chs=547x547&cht=qr&chl='.$barkod;
            $imageData = base64_encode(file_get_contents($image));
            echo '<div style="text-align:center"><img src="data:image/jpeg;base64,'.$imageData.'" width="750" height="750"></div>';
            if($rowCount = $resultCount->fetch_assoc()){
                $rowCount2 = $resultCount2->fetch_assoc();
                echo '<div style="text-align: center; border:1px solid #ccc; width: 150px; height: 100px; padding:20px; margin-bottom:20px;position: absolute;top: 10px;right: 10px; font-size: 50px; font-weight: bolder">'.$rowCount["cnt"].' / '.$rowCount2['cnt'].'</div>';
            }
            $page = 'index_qr.php?ders_id='.$ders_id;
            $sec = "5";
            header("Refresh: $sec; url=$page");
        }else{
            echo '<div role="alert" class="alert  alert-danger  text-center" style="font-size:25px;text-align:center">Şuanda Açık Dersiniz Bulunmamaktadır.</div>';
        }

    }
    
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hoşgeldiniz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<body>
<div class="container">
    <!-- Veritabanına eklenmiş verileri sıralamak için önce üst kısmı hazırlayalım. -->
    <div class="row" >
        <table class="table">

            <tr>
                <th>Öğrenci No</th>
                <th>Ad Soyad</th>
                <th>Devamsızlık</th>
            </tr>

            <!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

            <?php
            $sorgu = $baglanti->query("SELECT yoklama_log.id, ogrenciler.ogr_no, ogrenciler.ad_soyad, yoklama_log.devamsizlik FROM yoklama_log INNER JOIN ogrenciler ON yoklama_log.ogr_id = ogrenciler.id WHERE yoklama_log.ders_id = '$ders_id' AND yoklama_log.tarih='$tarih' ORDER BY ogr_no ASC");
            while ($sonuc = $sorgu->fetch_assoc()) {
                $id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
                $ogr_no = $sonuc['ogr_no'];
                $ad_soyad = $sonuc['ad_soyad'];
                $devamsizlik = $sonuc['devamsizlik'];

// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz.
                ?>

                <tr>
                    <td><?php echo $ogr_no; ?></td>
                    <td><?php echo $ad_soyad; ?></td>
                    <td contenteditable="true" onBlur="veriKaydet(this,'<?php echo $id ?>')"><?php echo $devamsizlik; ?></td>
                </tr>

                <?php
            }
            // Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz.
            ?>

        </table>
    </div>
</div>
</body>

<script src="http://code.jquery.com/jquery-1.10.2.js"></script>
<script>


    function veriKaydet(deger, id) {
        $.ajax({
            url: "duzenleKaydet.php", //verileri göndereceğimiz url
            type: "POST", //post ile gönderilecek
            data: 'deger=' + deger.innerHTML.split('+').join('{0}')+ '&id=' + id,
            success: function (data) {
                if (data == true) {
                    $(deger).css("background", "#fff");
                    // eğer veriler veri tabanına yazılmış ise hücrenin
                    //arka plan rengini beyaza geri döndürüyoruz
                }

                else {
                    $(deger).css("background", "#f00");
                    $("#sonuc").text("Hata veri düzenlenmedi");

                    //Eğer hata varsa hücre rengini kırmızı ve
                    // tablo altında hata mesajı yazdırıyoruz
                }
            }
        });
    }
</script>