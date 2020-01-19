<?php 

if ($_GET) 
{

    include("../vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz. 

// id'si seçilen veriyi silme sorgumuzu yazıyoruz.
if ($baglanti->query("DELETE FROM ogrenciler WHERE id =".(int)$_GET['id'])) 
{
    if($baglanti->query("DELETE FROM ogr_ders WHERE ogr_id =".(int)$_GET['id']))
        header("location:ekle.php"); // Eğer sorgu çalışırsa ekle.php sayfasına gönderiyoruz.
}
}

?>