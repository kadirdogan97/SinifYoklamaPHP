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

$sorgu = $baglanti->query("SELECT * FROM ogrenciler WHERE id =".(int)$_GET['id']); 
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
            <td><input type="text" name="ad_soyad" class="form-control" value="<?php echo $sonuc['ad_soyad']; ?>"></td>
        </tr>

        <tr>
            <td>Ağ Adresi</td>
            <td><input type="text" name="ag_adresi" class="form-control" value="<?php echo $sonuc['ag_adresi'];?>"></td>
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
    
    $ogr_no = $_POST['ogr_no']; 
    $ad_soyad = $_POST['ad_soyad'];
    $ag_adresi = $_POST['ag_adresi'];
    $parola = $_POST['parola'];

    if ($ogr_no<>"" && $ad_soyad<>"") { 
        

        if ($baglanti->query("UPDATE ogrenciler SET ogr_no = '$ogr_no', ad_soyad = '$ad_soyad', ag_adresi = '$ag_adresi', parola = '$parola' WHERE id =".$_GET['id'])) 
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