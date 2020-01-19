<?php 
include("../vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.
$ogr_gorevlileri=$baglanti->query("SELECT * FROM ogr_gorevli");
$bolumler=$baglanti->query("SELECT * FROM bolumler");
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>DERSLER</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="col-md-6" style="float: left">
<form action="" method="post">
    
    <table class="table">
        
        <tr>
            <td>Ders</td>
            <td><input type="text" name="ders_adi" class="form-control" ></td>
        </tr>

        <tr>
            <td>Öğretim Görevlisi</td>
            <!--<td><input type="text" name="ogr_gorevli_id" class="form-control" ></td>-->
            <td>
                <select name="ogr_gorevli_id" class="form-control">
                    <option value="0">Seçiniz</option>
                    <?php
                    while ($row=mysqli_fetch_array($ogr_gorevlileri)){?>
                        <option value="<?php echo $row[0];?>" >
                            <?php echo $row[1];?>
                        </option>
                    <?php
                    }

                    ?>
                </select>


            </td>
        </tr>

        <tr>
            <td>Ders Günü</td>
            <td><input type="text" name="ders_gunu" class="form-control" ></td>
        </tr>

        <tr>
            <td>Başlangıç Saati</td>
            <td><input type="text" name="baslangic_saati" class="form-control" ></td>
        </tr>

        <tr>
            <td>Bitiş Saati</td>
            <td><input type="text" name="bitis_saati" class="form-control" ></td>
        </tr>

        <tr>
            <td>Bölüm</td>
<!--            <td><input type="text" name="bolum_id" class="form-control" ></td>-->
            <td>
                <select name="bolum_id" class="form-control">
                    <option value="0">Seçiniz</option>
                    <?php
                    while ($row=mysqli_fetch_array($bolumler)){?>
                        <option value="<?php echo $row[0];?>" >
                            <?php echo $row[1];?>
                        </option>
                        <?php
                    }

                    ?>
                </select>


            </td>
        </tr>

        <tr>
            <td></td>
            <td><input class="btn btn-primary"  type="submit" value="Ekle"></td>
        </tr>

    </table>

</form>

<!-- Öncelikle HTML düzenimizi oluşturuyoruz. Daha sonra girdiğimiz verileri veritabanına eklemesi için PHP kodlarına geçiyoruz. -->

<?php 

if ($_POST) { // Sayfada post olup olmadığını kontrol ediyoruz.

    // Sayfa yenilendikten sonra post edilen değerleri değişkenlere atıyoruz
    $ders_adi = $_POST['ders_adi']; 
    $ders_gunu = $_POST['ders_gunu']; 
    $ogr_gorevli_id = $_POST['ogr_gorevli_id']; 
    $baslangic_saati = $_POST['baslangic_saati']; 
    $bitis_saati = $_POST['bitis_saati'];
    $bolum_id = $_POST['bolum_id'];

    if ($ders_gunu<>"" && $ogr_gorevli_id<>""&& $baslangic_saati<>""&& $bitis_saati<>""&& $bolum_id<>""&& $ders_adi<>"") { 
    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
        
         // Veri ekleme sorgumuzu yazıyoruz.
        if ($baglanti->query("INSERT INTO dersler (ders_adi, ogr_gorevli_id, ders_gunu, baslangic_saati, bitis_saati, bolum_id) VALUES ('$ders_adi','$ogr_gorevli_id','$ders_gunu','$baslangic_saati','$bitis_saati','$bolum_id')")) 
        {
            echo "Veri Eklendi"; // Eğer veri eklendiyse eklendi yazmasını sağlıyoruz.
        }
        else
        {
            echo "Hata oluştu";
        }

    }

}

?>
</div>
<!-- ############################################################## -->


<!-- Veritabanına eklenmiş verileri sıralamak için önce üst kısmı hazırlayalım. -->
<div class="col-md-7">
<table class="table">
    
    <tr>
        <th>ID</th>
        <th>Ders</th>
        <th>Öğretim Görevlisi</th>
        <th>Ders Günü</th>
        <th>Başlangıç Saati</th>
        <th>Bitiş Saati</th>
        <th>Bölüm</th>
        <th></th>
        <th></th>
    </tr>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

<?php 

$sorgu = $baglanti->query("SELECT * FROM dersler"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

    $id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
    $ders_adi = $sonuc['ders_adi']; 
    $ders_gunu = $sonuc['ders_gunu']; 
    $ogr_gorevli_id = $sonuc['ogr_gorevli_id']; 
    $baslangic_saati = $sonuc['baslangic_saati']; 
    $bitis_saati = $sonuc['bitis_saati'];
    $bolum_id = $sonuc['bolum_id'];


// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo $ders_adi; ?></td>
        <td><?php echo $ogr_gorevli_id; ?></td>
        <td><?php echo $ders_gunu; ?></td>
        <td><?php echo $baslangic_saati; ?></td>
        <td><?php echo $bitis_saati; ?></td>
        <td><?php echo $bolum_id; ?></td>
        <td><a href="duzenle.php?id=<?php echo $id; ?>" class="btn btn-primary">Düzenle</a></td>
        <td><a href="sil.php?id=<?php echo $id; ?>" class="btn btn-danger">Sil</a></td>
    </tr>

<?php 
} 
// Tekrarlanacak kısım bittikten sonra PHP tagının içinde while döngüsünü süslü parantezi kapatarak sonlandırıyoruz. 
?>

</table>
</div>
</div>
</body>
</html>