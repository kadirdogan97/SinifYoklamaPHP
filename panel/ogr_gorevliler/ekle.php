<?php 
include("../vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>ÖĞRETİM GÖREVLİLERİ</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
</head>
<body>
<div class="container">
<div class="col-md-6">
<form action="" method="post">
    
    <table class="table">
        
        

        <tr>
            <td>Ad Soyad</td>
            <td><input type="text" name="ad_soyad" class="form-control" ></td>
        </tr>

        <tr>
            <td>Mail</td>
            <td><input type="text" name="mail" class="form-control" ></td>
        </tr>

        <tr>
            <td>Kullanıcı Adı</td>
            <td><input type="text" name="kullanici_adi" class="form-control" ></td>
        </tr>

        <tr>
            <td>Parola</td>
            <td><input type="text" name="parola" class="form-control" ></td>
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
    $mail = $_POST['mail']; 
    $ad_soyad = $_POST['ad_soyad']; 
    $kullanici_adi = $_POST['kullanici_adi']; 
    $parola = $_POST['parola']; 

    if ($mail<>"" && $ad_soyad<>""&& $kullanici_adi<>""&& $parola<>"") { 
    // Veri alanlarının boş olmadığını kontrol ettiriyoruz. Başka kontrollerde yapabilirsiniz.
        
         // Veri ekleme sorgumuzu yazıyoruz.
        if ($baglanti->query("INSERT INTO ogr_gorevli (ad_soyad, mail, kullanici_adi, parola) VALUES ('$ad_soyad','$mail','$kullanici_adi','$parola')")) 
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
        <th>Ad Soyad</th>
        <th>Mail</th>
        <th>Kullanıcı Adı</th>
        <th>Parola</th>
        <th></th>
        <th></th>
    </tr>

<!-- Şimdi ise verileri sıralayarak çekmek için PHP kodlamamıza geçiyoruz. -->

<?php 

$sorgu = $baglanti->query("SELECT * FROM ogr_gorevli"); // Makale tablosundaki tüm verileri çekiyoruz.

while ($sonuc = $sorgu->fetch_assoc()) { 

$id = $sonuc['id']; // Veritabanından çektiğimiz id satırını $id olarak tanımlıyoruz.
$mail = $sonuc['mail'];
$ad_soyad = $sonuc['ad_soyad'];
$kullanici_adi = $sonuc['kullanici_adi'];
$parola = $sonuc['parola'];

// While döngüsü ile verileri sıralayacağız. Burada PHP tagını kapatarak tırnaklarla uğraşmadan tekrarlatabiliriz. 
?>
    
    <tr>
        <td><?php echo $id; // Yukarıda tanıttığımız gibi alanları dolduruyoruz. ?></td>
        <td><?php echo $ad_soyad; ?></td>
        <td><?php echo $mail; ?></td>
        <td><?php echo $kullanici_adi; ?></td>
        <td><?php echo $parola; ?></td>
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