<!DOCTYPE HTML>
<html>
  <head> <title>Andy Remote</title> </head>
  <body>





    <form name="login" action="" method="post" enctype="text/html">
      <input type="text" placeholder="user" name="user"><br>
      <input type="text" placeholder="password" name="password"><br>
      <input type="submit" name="submit" value="login">
    </form>

    <?php>

      if(isset($_Post['submit'])){
        $user = $_POST ['user'];
        $password = $_POST ['password'];

        if($user_login == "Andi" && password_login == 1234){
          echo "Login erfolgreich";
          echo <URL = Home/Home.html />;
        }
      }
    ?>

  </body>
</html>
