<?php 
    $username = 'root';
    $password = '';
    $host = 'localhost';
    $db_name = 'yoklamadb';
    if(isset($_GET['ders_id'])){

        $ders_id = $_GET['ders_id'];

        $db = mysqli_connect($host,$username,$password,$db_name);

        $result = mysqli_query($db, "SELECT * FROM dersler WHERE id='$ders_id' AND yoklama_aktif='1'");

        $barkod="test";
        if($row = mysqli_fetch_assoc($result)){
            $barkod = $row['barkod'];
            $image = 'https://chart.googleapis.com/chart?chs=547x547&cht=qr&chl='.$barkod;
            $imageData = base64_encode(file_get_contents($image));
            echo '<div style="text-align:center"><img src="data:image/jpeg;base64,'.$imageData.'" width="700" height="700"></div>';
            $page = 'index_qr.php?ders_id='.$ders_id;
            $sec = "2";
            header("Refresh: $sec; url=$page");
        }else{
            echo '<div role="alert" class="alert  alert-danger  text-center" style="font-size:25px;text-align:center">Şuanda Açık Dersiniz Bulunmamaktadır.</div>';
        }
            

        

        mysqli_close($db);
    }
    
?>