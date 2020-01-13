<?php 

if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['btn-login']) ) {
  
  // prevent sql injections/ clear user invalid inputs
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass = trim($_POST['pass']);
  $pass = strip_tags($pass);
  $pass = htmlspecialchars($pass);
  // prevent sql injections / clear user invalid inputs
  
    if($email=="admin"&&$pass=="admin"){
      header("Location: index_panel.php");  
    }else if($email=="hyigit"&&$pass=="hy1"){
      header("Location: index_qr.php?ders_id=1");
    }else if($email=="serdars"&&$pass=="ss1"){
    header("Location: index_qr.php?ders_id=2");
    }else if($email=="ekaracan"&&$pass=="ek1"){
        header("Location: index_qr.php?ders_id=3");
    }else if($email=="seken"&&$pass=="se1"){
        header("Location: index_qr.php?ders_id=4");
    }else if($email=="asondas"&&$pass=="as1"){
        header("Location: index_qr.php?ders_id=5");
    }else if($email=="minal"&&$pass=="mi1"){
        header("Location: index_qr.php?ders_id=6");
    }else{
     $error = true;
     $passError = "Kullanıcı adı veya şifre hatalı.";
  }
  
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
    <?php if(isset($emailError)|| isset($passError)) { ?>
              <div role="alert" class="alert  alert-danger  text-center">
            <?php 
               if(isset($emailError)) { echo $emailError; }  
               if(isset($passError)) { echo $passError; }
            ?>
          </div>
      <?php } ?>
        <div class="panel panel-primary">
            <div class="panel-heading">
                <div class="panel-title">Giriş</div>
            </div>
            <div style="padding-top:30px" class="panel-body">
                <div style="display:none" id="login-alert" class="alert alert-danger col-sm-12"></div>
                <form id="loginform" class="form-horizontal" role="form" method="post">
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">
										<i class="glyphicon glyphicon-user"></i>
									</span>
                        <input id="login-username" type="text" class="form-control" name="email" value="" placeholder="kullanici adi">
                    </div>
                    <div style="margin-bottom: 25px" class="input-group">
                        <span class="input-group-addon">
											<i class="glyphicon glyphicon-lock"></i>
										</span>
                        <input id="login-password" type="password" class="form-control" name="pass" placeholder="parola">
                    </div>
                    <div style="margin-top:10px" class="form-group">
                        <!-- Button -->
                        <div class="col-sm-12 controls">
                            <button id="btn-login" class="btn btn-success " type="submit" name="btn-login">Giriş Yap</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    </div>
</body>