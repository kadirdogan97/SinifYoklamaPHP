<?php
   $username = 'root';
   $password = '';
   $host = 'localhost';
   $db_name = 'yoklamadb';
   $db = mysqli_connect($host,$username,$password,$db_name);
   $result = mysqli_query($db, "SELECT * FROM ogr_gorevli");
   $json_array = array();
   while($row = mysqli_fetch_assoc($result)){
       $json_array[]=$row;
   }
   print(json_encode($json_array));
   mysqli_close($db);
?>