<?php

//fetch_second_level_category.php

include('../vt.php');

if(isset($_POST["selected"]))
{
    $id = $_POST["selected"];
    $query = "SELECT * FROM dersler WHERE ogr_gorevli_id = '$id'";
    $result = $baglanti->query($query);
    $output = '<option value="0">Ders Seçiniz</option>';
    foreach($result as $row)
    {
        $output .= '<option value="'.$row['id'].'">'.$row['ders_adi'].'</option>';
    }
    echo $output;
}

?>