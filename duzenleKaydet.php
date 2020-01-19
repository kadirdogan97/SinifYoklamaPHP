<?php
include("panel/vt.php"); // veritabanı bağlantımızı sayfamıza ekliyoruz.
if ($_POST) { // Post olup olmadığını kontrol ediyoruz.
    //+ (artı) değerini post edemediğimizden {0} ile gönderip burada tekrar + ya çeviriyoruz
    $deger = str_replace('{0}','+',$_POST['deger']);
    $id = $_POST['id'];
    if ($baglanti->query("UPDATE yoklama_log SET devamsizlik = '$deger' WHERE id =$id")) // Veri güncelleme sorgumuzu yazıyoruz.
    {
        echo true; // Eğer güncelleme sorgusu çalıştıysa geriye true döndürüyoruz
    }
    else
    {
        echo false; // id bulunamadıysa veya sorguda hata varsa false döndürüyoruz
    }
}

?>