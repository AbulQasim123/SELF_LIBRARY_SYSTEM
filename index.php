<?php 
      session_start(); // session start
      if (isset($_POST['login'])) {
            require_once('db_connect.php');
            $username = mysqli_real_escape_string($con,$_POST['username']);
            $password = mysqli_real_escape_string($con,md5($_POST['password']));
            $sql = "SELECT * FROM `admin` WHERE `username`='$username' AND `password`='$password' ";
            $result = mysqli_query($con,$sql);
            if (mysqli_num_rows($result) > 0) {
                  while($rows = mysqli_fetch_assoc($result)){
                        session_start(); //session start
                        $_SESSION['admin_name'] = $rows['admin_name'];
                        $_SESSION['username'] = $rows['username'];
                        $_SESSION['user_id'] = $rows['user_id'];
                  }
                  header('Location:http://localhost/PHP-PRACTICAL/SELF_LIBRARY_SYSTEM/dashboard.php');
            }else{
                  $msg = '<div class="alert alert-danger"><button class="close" data-dismiss="alert">&times;</button>Invalid Credential.</div>';
            }
      }
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
      <meta charset="UTF-8">
      <meta http-equiv="X-UA-Compatible" content="IE=edge">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Login | Library system</title>
            <!-- BOOTSTRAP -->
      <link rel="stylesheet" href="css\bootstrap.css">
            <!-- Custom Stylesheet -->
      <link rel="stylesheet" href="css/Customstyle.css">

      <script type="text/javascript" src="js\jquery-3.6.0.min.js"></script>
      <script type="text/javascript" src="js\bootstrap.bundle.js"></script>
      <script type="text/javascript" src="js\popper.min.js"></script>
</head>
<body>
      <div id="wrapper-admin">
            <div class="container">
                  <div class="row">
                        <div class="offset-md-4 col-md-4">
                              <div class="logo border border-danger">
                                    <img src="images\library.png" alt="Image not found">
                              </div>
                              <div>
                                    <?php 
                                          if (isset($msg)) {
                                                echo $msg;
                                          } 
                                          // if (isset($_GET['redirect']) && isset($_POST['success'])) {
                                          //       echo $success;
                                          // }
                                          
                                    ?>
                              </div>
                              <form class="yourform" action="<?php $_SERVER['PHP_SELF'] ?>" method="post">
                                        <h3 class="heading">Admin Login</h3>
                                    <div class="form-group">
                                          <label for="username">Username</label>
                                          <input type="text" name="username" id="username" class="form-control" placeholder="Username" required>
                                    </div>
                                    <div class="form-group">
                                          <label for="password">Password</label>
                                          <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                                    </div>
                                    <input type="submit" value="login" name="login" id="login" class="btn btn-primary">
                              </form>
                        </div>
                  </div>
            </div>
      </div>
      <?php
            echo md5('abul');
            echo "<br>";
            echo md5('ram');
      ?>
</body>
</html>