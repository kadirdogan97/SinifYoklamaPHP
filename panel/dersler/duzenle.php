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

$sorgu = $baglanti->query("SELECT * FROM dersler WHERE id =".(int)$_GET['id']); 
//id değeri ile düzenlenecek verileri veritabanından alacak sorgu

$sonuc = $sorgu->fetch_assoc(); //sorgu çalıştırılıp veriler alınıyor

?>

<div class="container">
<div class="col-md-6">

<form action="" method="post">
    
    <table class="table">
        
    <tr>
            <td>Ders</td>
            <td><input type="text" name="ders_adi" class="form-control" value="<?php echo $sonuc['ders_adi']; ?>"></td>
        </tr>

        <tr>
            <td>Öğretim Görevlisi</td>
            <td><input type="text" name="ogr_gorevli_id" class="form-control"value="<?php echo $sonuc['ogr_gorevli_id']; ?>" ></td>
        </tr>

        <tr>
            <td>Ders Günü</td>
            <td><input type="text" name="ders_gunu" class="form-control" value="<?php echo $sonuc['ders_gunu']; ?>"></td>
        </tr>

        <tr>
            <td>Başlangıç Saati</td>
            <td><input type="text" name="baslangic_saati" class="form-control" value="<?php echo $sonuc['baslangic_saati']; ?>"></td>
        </tr>

        <tr>
            <td>Bitiş Saati</td>
            <td><input type="text" name="bitis_saati" class="form-control" value="<?php echo $sonuc['bitis_saati']; ?>"></td>
        </tr>

        <tr>
            <td>Bölüm</td>
            <td><input type="text" name="bolum_id" class="form-control" value="<?php echo $sonuc['bolum_id']; ?>"></td>
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
    
    $ders_adi = $_POST['ders_adi']; 
    $ders_gunu = $_POST['ders_gunu']; 
    $ogr_gorevli_id = $_POST['ogr_gorevli_id']; 
    $baslangic_saati = $_POST['baslangic_saati']; 
    $bitis_saati = $_POST['bitis_saati'];
    $bolum_id = $_POST['bolum_id'];

    if ($ders_gunu<>"" && $ogr_gorevli_id<>""&& $baslangic_saati<>""&& $bitis_saati<>""&& $bolum_id<>""&& $ders_adi<>"") { 
        

        if ($baglanti->query("UPDATE dersler SET ders_adi = '$ders_adi', ogr_gorevli_id = '$ogr_gorevli_id', baslangic_saati = '$baslangic_saati', bitis_saati = '$bitis_saati', bolum_id = '$bolum_id' WHERE id =".$_GET['id'])) 
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