<?php

//fetch_second_level_category.php

include('../vt.php');

if(isset($_POST["selected"]))
{
    $id = $_POST["selected"];
    $query = "SELECT DISTINCT tarih FROM yoklama_log WHERE ders_id='".$id."' ORDER BY tarih DESC";
    $result = $baglanti->query($query);
    $output = '<option value="0">Tarih Seçiniz</option>';
    $i=1;
    foreach($result as $row)
    {
        $output .= '<option value="'.$row['tarih'].'">'.$row['tarih'].'</option>';
    }
    echo $output;
}

?>