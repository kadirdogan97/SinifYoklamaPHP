<?php 
include("../vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Veritabanı İşlemleri</title>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>
<body>

<?php 

$sorgu = $baglanti->query("SELECT * FROM ogr_gorevli WHERE id =".(int)$_GET['id']); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>

<div class="container">
<div class="col-md-6">

<form action="" method="post">
    
    <table class="table">
        
        <tr>
            <td>Ad Soyad</td>
            <td><input type="text" name="ad_soyad" class="form-control" value="<?php echo $sonuc['ad_soyad']; ?>"></td>
        </tr>

        <tr>
            <td>Mail</td>
            <td><input type="text" name="mail" class="form-control"value="<?php echo $sonuc['mail']; ?>" ></td>
        </tr>

        <tr>
            <td>Kullanıcı Adı</td>
            <td><input type="text" name="kullanici_adi" class="form-control" value="<?php echo $sonuc['kullanici_adi']; ?>"></td>
        </tr>

        <tr>
            <td>Parola</td>
            <td><input type="text" name="parola" class="form-control" value="<?php echo $sonuc['parola']; ?>"></td>
        </tr>

        <tr>
            <td></td>
            <td><input type="submit" class="btn btn-primary" value="Kaydet"></td>
        </tr>

    </table>

</form>
</div>
<div>
<?php 

if ($_POST) {
    
    $mail = $_POST['mail']; 
    $ad_soyad = $_POST['ad_soyad']; 
    $kullanici_adi = $_POST['kullanici_adi']; 
    $parola = $_POST['parola']; 

    if ($mail<>"" && $ad_soyad<>""&& $kullanici_adi<>""&& $parola<>"") { 
        

        if ($baglanti->query("UPDATE ogr_gorevli SET mail = '$mail', ad_soyad = '$ad_soyad', kullanici_adi = '$kullanici_adi', parola = '$parola' WHERE id =".$_GET['id'])) 
        {
            header("location:ekle.php"); 
        }
        else
        {
            echo "Hata oluştu";
        }
    }
}
?>
</body>
</html>