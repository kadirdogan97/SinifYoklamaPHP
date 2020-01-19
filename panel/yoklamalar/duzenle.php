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

$sorgu = $baglanti->query("SELECT yoklama_log.id, ogrenciler.ogr_no, ogrenciler.ad_soyad as ogr_ad_soyad, yoklama_log.tarih, yoklama_log.devamsizlik FROM yoklama_log INNER JOIN ogrenciler ON yoklama_log.ogr_id = ogrenciler.id WHERE yoklama_log.id=".(int)$_GET['id']);
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>

<div class="container">
<div class="col-md-6">

<form action="" method="post">
    
    <table class="table">
        
        <tr>
            <td>Öğrenci No</td>
            <td><input type="text" name="ogr_no" class="form-control" value="<?php echo $sonuc['ogr_no']; ?>">
            </td>
        </tr>

        <tr>
            <td>Ad Soyad</td> 
            <td><input type="text" name="ogr_ad_soyad" class="form-control" value="<?php echo $sonuc['ogr_ad_soyad']; ?>"></td>
        </tr>

        <tr>
            <td>Tarih</td>
            <td><input type="text" name="tarih" class="form-control" value="<?php echo $sonuc['tarih'];?>"></td>
        </tr>

        <tr>
            <td>Devamsızlık</td>
            <td><input type="text" name="devamsizlik" class="form-control" value="<?php echo $sonuc['devamsizlik']; ?>"></td>
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
    $devamsizlik = $_POST['devamsizlik'];
    if ($devamsizlik<>"") {
        if ($baglanti->query("UPDATE yoklama_log SET devamsizlik = '$devamsizlik' WHERE id =".$_GET['id']))
        {
            echo "<script type='text/javascript'>alert('Yoklama İşlemi Başarılı');window.location.replace(\"ekle.php\");</script>";
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