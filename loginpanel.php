<?php

require_once 'netting/class.crud.php';
$db=new crud();


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login.css">
    
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Document</title>
</head>
<body>
    <div class="cont">
      <div class="logo">Giriş Paneli</div>
        <div class="demo">
          
          <div class="login"></div>
          
          <form action="" method="post"> 
            
            <div class="login__form">
              
              <div class="login__row">
                <svg class="login__icon name svg-icon" viewBox="0 0 20 20">
                  <path d="M0,20 a10,8 0 0,1 20,0z M10,0 a4,4 0 0,1 0,8 a4,4 0 0,1 0,-8" />
                </svg>
                 
                <input type="text" class="login__input name"  name = "admins_username" placeholder="Kullanıcı Adı"/>
              </div>
              <div class="login__row">
                <svg class="login__icon pass svg-icon" viewBox="0 0 20 20">
                  <path d="M0,20 20,20 20,8 0,8z M10,13 10,16z M4,8 a6,8 0 0,1 12,0" />
                </svg>
                <input type="password" class="login__input pass" name = "admins_pass" placeholder="Şifreniz"/>
              </div>
              <button type="submit" name="admins_login" class="login__submit">Giriş Yap</button>
              <?php    
          if (isset($_POST['admins_login'])) {
            
            $sonuc=$db-> adminsLogin(htmlspecialchars($_POST['admins_username']), htmlspecialchars($_POST['admins_pass']));
          if ($sonuc['status']) {
            header("location:index.php");
            exit;
          }
          else{ ?>
            <div class="alert alert-danger" > Bilgilerinizi Kontrol Ediniz. </div>
            <?php
          }
          }
          
          ?>
            </form>
            
            
            </div>
          </div>
          
</body>
</html>