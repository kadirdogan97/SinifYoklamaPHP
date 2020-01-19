<?php 

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ders']) ) {
    header("Location: panel/dersler/ekle.php");  
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ogr']) ) {
    header("Location: panel/ogrenciler/ekle.php");  
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['ogr_gorevli']) ) {
    header("Location: panel/ogr_gorevliler/ekle.php");
}
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['yoklamalar']) ) {
    header("Location: panel/yoklamalar/ekle.php");
}



?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Hoşgeldiniz</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
</head>

<body>
    <div id="loginbox" style="margin-top:40px;" class="mainbox col-md-6 col-md-offset-3 col-sm-8 col-sm-offset-2">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Lütfen Düzenlemek İstediğinizi Seçiniz</div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="loginform" class="form-horizontal" role="form" method="post">

                    <div style="margin-top:10px;float:left;margin-left:10px;" class="form-group" >
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button id="ogr" class="btn btn-success " type="submit" name="ogr">Öğrenciler</button>
                        </div>
                    </div>
            
                    <div style="margin-top:10px;float:left;margin-left:10px;" class="form-group" >
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button id="ders" class="btn btn-success " type="submit" name="ders">Dersler</button>
                        </div>
                    </div>
                    <div style="margin-top:10px;float:left;margin-left:10px;" class="form-group" >
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button id="ogr_gorevli" class="btn btn-success " type="submit" name="ogr_gorevli">Öğretim Görevlileri</button>
                        </div>
                    </div>
                    <div style="margin-top:10px;float:left;margin-left:10px;" class="form-group" >
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button id="yoklamalar" class="btn btn-success " type="submit" name="yoklamalar">Yoklamalar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

</body>